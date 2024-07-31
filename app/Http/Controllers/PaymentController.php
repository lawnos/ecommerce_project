<?php

namespace App\Http\Controllers;

use App\Mail\OrderInvoiceMail;
use App\Models\ColorModel;
use App\Models\OrderItemModel;
use App\Models\OrderModel;
use App\Models\ProductModel;
use App\Models\ProductSizeModel;
use App\Models\DiscountCodeModel;
use App\Models\ShippingChargeModel;
use App\Models\User;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function apply_discount_code(Request $request)
    {
        $getDiscount = DiscountCodeModel::CheckDiscount($request->discount_code);

        if (!empty($getDiscount)) {
            $total = Cart::getSubTotal();

            if ($getDiscount->type == 'Số lượng') {
                $discount_amount = $getDiscount->percent_amount;
                $payable_total = $total - $getDiscount->percent_amount;
            } else {
                $discount_amount = ($total * $getDiscount->percent_amount) / 100;
                $payable_total = $total - $discount_amount;
            }

            $json['status'] = true;
            $json['discount_amount'] = number_format($discount_amount);
            $json['payable_total'] = $payable_total;
            $json['message'] = "success";
        } else {
            $json['status'] = false;
            $json['discount_amount'] = '0';
            $json['payable_total'] = Cart::getSubTotal();
            $json['message'] = "Mã giảm giá không hợp lệ";
        }

        return response()->json($json); // Thay vì echo json_encode, sử dụng response()->json
    }

    public function checkout(Request $request)
    {
        $data['meta_title']         = 'Thanh Toán';
        $data['meta_desription']    = '';
        $data['meta_keywords']      = '';
        $data['getShipping']        = ShippingChargeModel::getRecordActive();

        return view('payment.checkout', $data);
    }

    public function cart(Request $request)
    {
        $data['meta_title']         = 'Giỏ Hàng';
        $data['meta_desription']    = '';
        $data['meta_keywords']      = '';
        // dd(Cart::getContent());
        return view('payment.cart', $data);
    }

    public function add_to_cart(Request $request)
    {
        $getProduct = ProductModel::getSingle($request->product_id);
        $total      = $getProduct->price;

        if (!empty($request->size_id)) {
            $size_id    = $request->size_id;
            $getSize    = ProductSizeModel::getSingle($size_id);
            $size_price = !empty($getSize->price) ? $getSize->price : 0;
            $total      = $total + $size_price;
        } else {
            $size_id = 0;
        }

        $color_id = !empty($request->color_id) ? $request->color_id : 0;

        Cart::add([
            'id' => $getProduct->id,
            'name' => 'Sản Phẩm',
            'price' => $total,
            'quantity' => $request->qty,
            'attributes' => [
                'size_id' => $size_id,
                'color_id' => $color_id,

            ]
        ]);

        return redirect()->back();
    }

    public function update_cart(Request $request)
    {
        foreach ($request->cart as $cart) {
            Cart::update($cart['id'], array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $cart['qty']
                ),
            ));
        }
        return redirect()->back();
    }

    public function cart_delete($id)
    {
        Cart::remove($id);
        return redirect()->back();
    }

    public function place_order(Request $request)
    {
        $validate = 0;
        $message = '';

        if (!empty(Auth::check())) {
            $user_id = Auth::user()->id;
        } else {
            if (!empty($request->is_create)) {
                $checkEmail = User::checkEmail($request->email);

                if (!empty($checkEmail)) {
                    $message = 'Email đã tồn tại';
                    $validate = 1;
                } else {
                    $save           = new User;
                    $save->name     = trim($request->first_name);
                    $save->email    = trim($request->email);
                    $save->password = Hash::make($request->password);
                    $save->save();

                    $user_id = $save->id;
                }
            } else {
                $user_id = '';
            }
        }

        if (empty($validate)) {

            $getShipping        = ShippingChargeModel::getSingle(($request->shipping));
            $payable_total      = Cart::getSubTotal();
            $discount_amount    = 0;
            $discount_code      = '';

            if (!empty($request->discount_code)) {
                $getDiscount = DiscountCodeModel::CheckDiscount($request->discount_code);

                if (!empty($getDiscount)) {
                    $discount_code = $request->discount_code;

                    if ($getDiscount->type == 'Số lượng') {
                        $discount_amount = $getDiscount->percent_amount;
                        $payable_total = $payable_total - $getDiscount->percent_amount;
                    } else {
                        $discount_amount = ($payable_total * $getDiscount->percent_amount) / 100;
                        $payable_total = $payable_total - $discount_amount;
                    }
                }
            }
            $shipping_amount = !empty($getShipping->price) ? $getShipping->price : 0;
            $total_amount = $payable_total + $shipping_amount;

            $order = new OrderModel;

            if (!empty($user_id)) {
                $order->user_id = trim($user_id);
            }
            $order->order_number        = mt_rand(10000000, 99999999);
            $order->first_name          = trim($request->first_name);
            $order->last_name           = trim($request->last_name);
            $order->company_name        = trim($request->company_name);
            $order->country             = trim($request->country);
            $order->address_one         = trim($request->address_one);
            $order->address_two         = trim($request->address_two);
            $order->city                = trim($request->city);
            $order->district            = trim($request->district);
            $order->code_zip            = trim($request->code_zip);
            $order->phone               = trim($request->phone);
            $order->email               = trim($request->email);
            $order->note                = trim($request->note);
            $order->discount_code       = trim($discount_code);
            $order->discount_amount     = trim($discount_amount);
            $order->shipping_id         = trim($request->shipping);
            $order->shipping_amount     = trim($shipping_amount);
            $order->total_amount        = trim($total_amount);
            $order->payment_method      = trim($request->payment_method);
            $order->save();

            foreach (Cart::getContent() as $key => $cart) {

                $order_item             = new OrderItemModel;
                $order_item->order_id   = $order->id;
                $order_item->product_id = $cart->id;
                $order_item->quantity   = $cart->quantity;
                $order_item->price      = $cart->price;

                $color_id = $cart->attributes->color_id;

                if (!empty($color_id)) {
                    $getColor = ColorModel::getSingle($color_id);
                    $order_item->color_name = $getColor->name;
                }
                $size_id = $cart->attributes->size_id;
                if (!empty($size_id)) {
                    $getSize  = ProductSizeModel::getSingle($size_id);
                    $order_item->size_name = $getSize->name;
                    $order_item->size_amount = $getSize->price;
                }

                $order_item->total_price = $cart->price;
                $order_item->save();
            }
            $json['status'] = true;
            $json['message'] = "Đặt hàng thành công";
            $json['redirect'] = url('checkout/payment?order_id=' . base64_encode($order->id));
        } else {
            $json['status'] = false;
            $json['message'] = $message;
        }
        return response()->json($json);
    }

    public function payment(Request $request)
    {
        if (!empty(Cart::getSubTotal()) && !empty($request->order_id)) {
            $order_id = base64_decode($request->order_id);
            $getOrder = OrderModel::getSingle($order_id);
            if (!empty($getOrder)) {

                if ($getOrder->payment_method == 'cashondelivery') {

                    $getOrder->is_payment = 1;
                    $getOrder->save();
                    Mail::to($getOrder->email)->send(new OrderInvoiceMail($getOrder));
                    Cart::clear();
                    return redirect('cart')->with('success', "Đặt hàng thành công");
                } else if ($getOrder->payment_method == 'paypal') {

                    $query                  = array();
                    $query['business']      = "info@trendythreads.com";
                    $query['cmd']           = '_xclick';
                    $query['item_name']     = "TrendyThreads";
                    $query['no_shipping']   = '1';
                    $query['item_number']   = $getOrder->id;
                    $query['amount']        = $getOrder->total_amount;
                    $query['currency_code'] = '₫';
                    $query['cancel_return'] = url('checkout');
                    $query['return']        = url('paypal/success-payment');
                    $query_string = http_build_query($query);

                    //header('Location: https://www.sandbox.paypal.com/cgi-bin/webscr?' . $query_string);
                    header('Location: https://www.paypal.com/cgi-bin/webscr?' . $query_string);

                    exit();
                } else if ($getOrder->payment_method == 'vnpay') {

                    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
                    $vnp_Returnurl = "https://localhost/vnpay_php/vnpay_return.php";
                    $vnp_TmnCode = "DMJPUNDN"; //Mã website tại VNPAY 
                    $vnp_HashSecret = "RUUV8H3LZ9ZI3XUE3FDXV2E8UX09I3GG"; //Chuỗi bí mật

                    $vnp_TxnRef = $request->input('order_id'); // Sử dụng $request->input() thay vì $_POST
                    $vnp_OrderInfo = 'Thanh toán đơn hàng';
                    $vnp_OrderType = 'billpayment';
                    $vnp_Amount = $request->input('total_amount') * 100;
                    $vnp_Locale = 'vn';
                    $vnp_BankCode = '';
                    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
                    //Add Params of 2.0.1 Version
                    $vnp_ExpireDate = $request->input('txtexpire');
                    //Billing

                    $inputData = array(
                        "vnp_Version" => "2.1.0",
                        "vnp_TmnCode" => $vnp_TmnCode,
                        "vnp_Amount" => $vnp_Amount,
                        "vnp_Command" => "pay",
                        "vnp_CreateDate" => date('YmdHis'),
                        "vnp_CurrCode" => "VND",
                        "vnp_IpAddr" => $vnp_IpAddr,
                        "vnp_Locale" => $vnp_Locale,
                        "vnp_OrderInfo" => $vnp_OrderInfo,
                        "vnp_OrderType" => $vnp_OrderType,
                        "vnp_ReturnUrl" => $vnp_Returnurl,
                        "vnp_TxnRef" => $vnp_TxnRef,
                        "vnp_ExpireDate" => $vnp_ExpireDate
                    );

                    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                        $inputData['vnp_BankCode'] = $vnp_BankCode;
                    }
                    if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                        $inputData['vnp_Bill_State'] = $vnp_Bill_State;
                    }

                    //var_dump($inputData);
                    ksort($inputData);
                    $query = "";
                    $i = 0;
                    $hashdata = "";
                    foreach ($inputData as $key => $value) {
                        if ($i == 1) {
                            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                        } else {
                            $hashdata .= urlencode($key) . "=" . urlencode($value);
                            $i = 1;
                        }
                        $query .= urlencode($key) . "=" . urlencode($value) . '&';
                    }

                    $vnp_Url = $vnp_Url . "?" . $query;
                    if (isset($vnp_HashSecret)) {
                        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
                        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
                    }
                    $returnData = array(
                        'code' => '00', 'message' => 'success', 'data' => $vnp_Url
                    );
                    if (isset($_POST['payment_method'])) {
                        header('Location: ' . $vnp_Url);
                        die();
                    } else {
                        echo json_encode($returnData);
                    }
                } else if ($getOrder->payment_method == 'card') {
                    Stripe::setApiKey(env('STRIPE_SECRET'));
                    $finalprice = $getOrder->total_amount * 100;

                    $session = \Stripe\Checkout\Session::create([
                        'payment_method_types' => ['card'],
                        'customer_email' => $getOrder->email,
                        'line_items' => [[
                            'price_data' => [
                                'currency' => 'vnd',
                                'product_data' => [
                                    'name' => 'Trendy Threads'
                                ],
                                'unit_amount' => intval($finalprice),
                            ],
                            'quantity' => 1,
                        ]],
                        'mode' => 'payment',
                        'success_url' => url('stripe/payment-success'),
                        'cancel_url' => url('checkout'),
                    ]);

                    $getOrder->stripe_session_id = $session['id'];
                    $getOrder->save();
                    $data['session_id'] = $session['id'];
                    Session::put('stripe_session_id', $session['id']);
                    $data['setPublicKey'] = env('STRIPE_KEY');
                    return view('payment.stripe_charge', $data);
                }
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    public function paypal_success_payment(Request $request)
    {
        if (!empty($request->item_number) && !empty($request->st) && $request->st == 'Completed') {
            $getOrder = OrderModel::getSingle($request->item_number);

            if (!empty($getOrder)) {
                $getOrder->is_payment = 1;
                $getOrder->transaction_id = $request->tx;
                $getOrder->payment_data = json_encode($request->all());

                $getOrder->save();
                Mail::to($getOrder->email)->send(new OrderInvoiceMail($getOrder));

                Cart::clear();

                return redirect('cart')->with('success', "Đặt hàng thành công");
            }
        } else {
            abort(404);
        }
    }

    public function vnpay_success_payment(Request $request)
    {
    }

    public function stripe_payment_success(Request $request)
    {
        $trans_id  = Session::get('stripe_session_id');
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $getdata = \Stripe\Checkout\Session::retrieve($trans_id);

        $getOrder = OrderModel::where('stripe_session_id', '=', $getdata->id)->first();

        if (!empty($getorder) && !empty($getdata->id) && $getdata->id == $getOrder->stripe_session_id) {
            $getOrder->is_payment = 1;
            $getOrder->transaction_id = $getdata->id;
            $getOrder->payment_data = json_encode($getdata);
            $getOrder->save();
            
            Mail::to($getOrder->email)->send(new OrderInvoiceMail($getOrder));

            Cart::clear();
            return redirect('cart')->with('success', "Đặt hàng thành công");
        } else {
            return redirect('cart')->with('error', "Do có một số lỗi, vui lòng thử lại");
        }
    }
}
