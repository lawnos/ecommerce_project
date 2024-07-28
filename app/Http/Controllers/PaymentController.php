<?php

namespace App\Http\Controllers;

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
        } else {
            $json['status'] = false;
            $json['message'] = $message;
        }
        return response()->json($json);
    }
}
