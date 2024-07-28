@extends('layouts.app')
@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('client/assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Thanh Toán<span></span></h1>
            </div>
        </div>
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('cart') }}">Giỏ hàng</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
                </ol>
            </div>
        </nav>

        <div class="page-content">
            <div class="checkout">
                <div class="container">
                    {{-- <div class="checkout-discount">
                        <form action="#">
                            <input type="text" class="form-control" required id="checkout-discount-input">
                            <label for="checkout-discount-input" class="text-truncate">Có phiếu giảm giá? <span>Bấm vào đây
                                    để nhập mã của bạn</span></label>
                        </form>
                    </div> --}}
                    <form action="" id="SubmitForm" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-9">
                                <h2 class="checkout-title">Chi Tiết Thanh Toán</h2>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Họ *</label>
                                        <input type="text" name="first_name" class="form-control" required>
                                    </div>

                                    <div class="col-sm-6">
                                        <label>Tên *</label>
                                        <input type="text" name="last_name" class="form-control" required>
                                    </div>
                                </div>

                                <label>Tên công ty (nếu có)</label>
                                <input type="text" name="company_name" class="form-control">

                                <label>Quốc gia *</label>
                                <input type="text" name="country" class="form-control" required>

                                <label>Địa chỉ đường phố *</label>
                                <input type="text" name="address_one" class="form-control"
                                    placeholder="House number and Street name" required>
                                <input type="text" name="address_two" class="form-control"
                                    placeholder="Appartments, suite, unit etc ..." required>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Thị trấn / Thành phố *</label>
                                        <input type="text" name="city" class="form-control" required>
                                    </div>

                                    <div class="col-sm-6">
                                        <label>Quận / Phường *</label>
                                        <input type="text" name="district" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Mã bưu / Zip *</label>
                                        <input type="text" name="code_zip" class="form-control" required>
                                    </div>

                                    <div class="col-sm-6">
                                        <label>Số điện thoại *</label>
                                        <input type="tel" name="phone" class="form-control" required>
                                    </div>
                                </div>

                                <label>Địa chỉ Email *</label>
                                <input type="email" name="email" class="form-control" required>

                                @if (empty(Auth::check()))
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input createAccount"
                                            id="checkout-create-acc" name="is_create">
                                        <label class="custom-control-label" for="checkout-create-acc">Tạo một tài
                                            khoản?</label>
                                    </div>
                                @endif
                                
                                <div class="row" id="showPassword" style="display: none;">
                                    <div class="col-sm-12">
                                        <label>Mật khẩu *</label>
                                        <input type="text" id="inputPassword" name="password" class="form-control">
                                    </div>

                                    {{-- <div class="col-sm-6">
                                        <label>Xác nhận mật khẩu *</label>
                                        <input type="text" id="inputCPassword" name="cpassword" class="form-control">
                                    </div> --}}
                                </div>

                                <label>Ghi chú đơn hàng</label>
                                <textarea class="form-control" name="note" cols="30" rows="4"
                                    placeholder="Ghi chú về đơn đặt hàng của bạn, ví dụ: ghi chú đặc biệt khi giao hàng"></textarea>
                            </div>
                            <aside class="col-lg-3">
                                <div class="summary">
                                    <h3 class="summary-title">Đơn hàng của bạn</h3>

                                    <table class="table table-summary">
                                        <thead>
                                            <tr>
                                                <th>Sản phẩm</th>
                                                <th>Tổng</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach (Cart::getContent() as $key => $cart)
                                                @php
                                                    $getCartProduct = App\Models\ProductModel::getSingle($cart->id);
                                                @endphp
                                                <tr>
                                                    <td><a
                                                            href="{{ url($getCartProduct->slug) }}">{{ $getCartProduct->title }}</a>
                                                    </td>
                                                    <td>₫{{ number_format($cart->price * $cart->quantity) }}</td>
                                                </tr>
                                            @endforeach

                                            <tr class="summary-subtotal">
                                                <td>Tổng phụ:</td>
                                                <td>₫ {{ number_format(Cart::getSubTotal()) }}</td>
                                            </tr>
                                            <tr class="summary-shipping">
                                                <td>Phí vận chuyển:</td>
                                                <td>&nbsp;</td>
                                            </tr>

                                            @foreach ($getShipping as $shipping)
                                                <tr class="summary-shipping-row">
                                                    <td>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="shipping{{ $shipping->id }}"
                                                                name="shipping" required value="{{ $shipping->id }}"
                                                                data-price="{{ !empty($shipping->price) ? $shipping->price : 0 }}"
                                                                class="custom-control-input getShippingCharge">
                                                            <label class="custom-control-label"
                                                                for="shipping{{ $shipping->id }}">{{ $shipping->name }}</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if (!empty($shipping->price))
                                                            ₫ {{ number_format($shipping->price) }}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach

                                            <tr>
                                                <td colspan="2">
                                                    <div class="cart-discount">
                                                        <div class="input-group">
                                                            <input type="text" name="discount_code"
                                                                id="getDiscountCode" class="form-control"
                                                                placeholder="mã giảm giá">
                                                            <div class="input-group-append">
                                                                <button id="ApplyDiscount" type="button"
                                                                    class="btn btn-outline-primary-2" style="height: 40px"
                                                                    type="submit"><i
                                                                        class="icon-long-arrow-right"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Giảm giá:</td>
                                                <td><span id="getDiscountAmount">₫0</span></td>
                                            </tr>

                                            <tr class="summary-total">
                                                <td>Tổng:</td>
                                                <td>
                                                    <span
                                                        id="getPayableTotal">₫{{ number_format(Cart::getSubTotal()) }}</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <input type="hidden" id="getShippingChargeTotal" value="0">
                                    <input type="hidden" id="PayableTotal" value="{{ Cart::getSubTotal() }}">

                                    <div class="accordion-summary" id="accordion-payment">

                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="cashondelivery" name="payment_method" required
                                                class="custom-control-input" value="cashondelivery">
                                            <label class="custom-control-label" for="cashondelivery">Thanh toán khi giao
                                                hàng</label>
                                        </div>

                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="paypal" name="payment_method" required
                                                class="custom-control-input" value="paypal">
                                            <label class="custom-control-label" for="paypal"> PayPal</label>
                                        </div>

                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="card" name="payment_method" required
                                                class="custom-control-input" value="card">
                                            <label class="custom-control-label" for="card">Thẻ Tín Dụng
                                                <img src="client/assets/images/payments-summary.png"
                                                    alt="payments cards"></label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                        <span class="btn-text">Đặt hàng</span>
                                        <span class="btn-hover-text">Tiến hành kiểm tra</span>
                                    </button>
                                </div>
                            </aside>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {

            $('body').delegate('.createAccount', 'change', function() {
                if (this.checked) {
                    $('#showPassword').show();
                    $("#inputPassword").prop("required", true);
                } else {
                    $('#showPassword').hide();
                    $("#inputPassword").prop("required", false);
                }
            });

            $('body').delegate('#SubmitForm', 'submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "{{ url('checkout/place_order') }}",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function(data) {
                        if (data.status == false) {
                            alert(data.message)
                        } else {
                            alert(data.message)
                        }
                    },
                    error: function(data) {
                        // Xử lý lỗi
                    }
                });
            });

            $('body').delegate('.getShippingCharge', 'change', function() {

                var price = $(this).attr('data-price');
                var total = $('#PayableTotal').val();

                $('#getShippingChargeTotal').val(price);

                var final_total = parseFloat(price) + parseFloat(total);
                var formatted_total = number_format(final_total, 0, ',', ',');

                $('#getPayableTotal').html('₫' + formatted_total);
            });

            $('body').delegate('#ApplyDiscount', 'click', function() {
                var discount_code = $('#getDiscountCode').val();

                $.ajax({
                    type: "POST",
                    url: "{{ url('checkout/apply_discount_code') }}",
                    data: {
                        discount_code: discount_code,
                        "_token": "{{ csrf_token() }}",
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#getDiscountAmount').html('₫' + data.discount_amount);

                        var shipping = $('#getShippingChargeTotal').val();

                        var final_total = parseFloat(shipping) + parseFloat(data.payable_total);
                        var formatted_total = number_format(final_total, 0, ',', ',');

                        $('#getPayableTotal').html('₫' + formatted_total);
                        $('#PayableTotal').val('₫' + data.payable_total);



                        if (data.status == false) {
                            alert(data.message);
                        }
                    },
                    error: function(data) {
                        console.error('Error:', data);
                    }
                });
            });
            // $('body').delegate('#ApplyDiscount', 'click', function() {
            //     var discount_code = $('#getDiscountCode').val();

            //     $.ajax({
            //         type: "POST",
            //         url: "{{ url('checkout/apply_discount_code') }}",
            //         data: {
            //             discount_code: discount_code,
            //             "_token": "{{ csrf_token() }}",
            //         },
            //         dataType: "json",
            //         success: function(data) {
            //             if (data.status) {
            //                 $('#getDiscountAmount').html('₫' + data.discount_amount);

            //                 var shipping = $('#getShippingChargeTotal').val();
            //                 var shippingAmount = shipping ? parseFloat(shipping) : 0;

            //                 var final_total = shippingAmount + parseFloat(data.payable_total
            //                     .replace(/,/g, ''));
            //                 var formatted_total = number_format(final_total, 0, ',', '.');

            //                 $('#getPayableTotal').html('₫' + formatted_total);
            //                 $('#PayableTotal').val(data.payable_total);
            //             } else {
            //                 alert(data.message);
            //             }
            //         },
            //         error: function(data) {
            //             console.error('Error:', data);
            //         }
            //     });
            // });
        });

        function number_format(number, decimals, dec_point, thousands_sep) {
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + (Math.round(n * k) / k).toFixed(prec);
                };
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }
    </script>
@endsection
