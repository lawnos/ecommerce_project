@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ 'client/assets/css/plugins/nouislider/nouislider.css' }}">
@endsection
@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('client/assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Giỏ hàng<span></span></h1>
            </div>
        </div>
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
                </ol>
            </div>
        </nav>

        <div class="page-content">
            <div class="cart">
                <div class="container">
                    @if (!empty(Cart::getContent()->count()))
                        <div class="row">
                            <div class="col-lg-9">
                                <form action="{{ url('update_cart') }}" method="POST">
                                    {{ csrf_field() }}
                                    <table class="table table-cart table-mobile">
                                        <thead>
                                            <tr>
                                                <th>Sản phẩm</th>
                                                <th>Giá</th>
                                                <th>Số lượng</th>
                                                <th>Tổng</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach (Cart::getContent() as $key => $cart)
                                                @php
                                                    $getCartProduct = App\Models\ProductModel::getSingle($cart->id);
                                                @endphp
                                                @if (!empty($getCartProduct))
                                                    @php
                                                        $getProductImage = $getCartProduct->getImageSingle(
                                                            $getCartProduct->id,
                                                        );
                                                    @endphp
                                                    <tr>
                                                        <td class="product-col">
                                                            <div class="product">
                                                                <figure class="product-media">
                                                                    <a href="{{ url($getCartProduct->slug) }}">
                                                                        <img src="{{ $getProductImage->getLogo() }}"
                                                                            alt="Product image">
                                                                    </a>
                                                                </figure>

                                                                <h3 class="product-title">
                                                                    <a
                                                                        href="{{ url($getCartProduct->slug) }}">{{ $getCartProduct->title }}</a>
                                                                </h3>
                                                            </div>
                                                        </td>
                                                        <td class="price-col"> x ₫{{ number_format($cart->price) }}</td>
                                                        <td class="quantity-col">
                                                            <div class="cart-product-quantity">
                                                                <input type="number" class="form-control"
                                                                    value="{{ $cart->quantity }}"
                                                                    name="cart[{{ $key }}][qty]" min="1"
                                                                    max="100" step="1" data-decimals="0"
                                                                    required>
                                                            </div>
                                                            <input type="hidden" value="{{ $cart->id }}"
                                                                name="cart[{{ $key }}][id]">
                                                        </td>
                                                        <td class="total-col">
                                                            ₫{{ number_format($cart->price * $cart->quantity) }}
                                                        </td>
                                                        <td class="remove-col"><a
                                                                href="{{ url('cart/delete/' . $cart->id) }}"
                                                                class="btn-remove"><i class="icon-close"></i></a></td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div class="cart-bottom">
                                       
                                        <button type="submit" class="btn btn-outline-dark-2"><span>CẬP NHẬT GIỎ
                                                HÀNG</span><i class="icon-refresh"></i></button>
                                    </div>
                                </form>
                            </div>
                            <aside class="col-lg-3">
                                <div class="summary summary-cart">
                                    <h3 class="summary-title">Tổng giỏ hàng</h3>

                                    <table class="table table-summary">
                                        <tbody>
                                            <tr class="summary-subtotal">
                                                <td>Tổng phụ:</td>
                                                <td>₫ {{ number_format(Cart::getSubTotal()) }}</td>
                                            </tr>
                                            

                                            <tr class="summary-total">
                                                <td>Tổng:</td>
                                                <td>₫ {{ number_format(Cart::getSubTotal()) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <a href="{{ url('checkout') }}"
                                        class="btn btn-outline-primary-2 btn-order btn-block">THANH TOÁN</a>
                                </div>

                                <a href="{{ url('') }}" class="btn btn-outline-dark-2 btn-block mb-3"><span>TIẾP TỤC
                                        MUA
                                        SẮM</span><i class="icon-refresh"></i></a>
                            </aside>
                        </div>
                    @else
                        <p style="text-align: center; font-size:25px;">GIỎ HÀNG CỦA BẠN TRỐNG</p>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')
    <script src="{{ url('client/assets/js/bootstrap-input-spinner.js') }}"></script>
@endsection
