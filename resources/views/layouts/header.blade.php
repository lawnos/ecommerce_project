<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <div class="header-dropdown">
                    <a href="#">VND</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="">VND</a></li>
                        </ul>
                    </div>
                </div>

                <div class="header-dropdown">
                    <a href="#">VIE</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="">Tiếng Việt</a></li>
                            <li><a href="">Tiếng Anh</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="header-right">
                <ul class="top-menu">
                    <li>
                        <ul>
                            <li><a href="tel:#"><i class="icon-phone"></i>Liên hệ: +84 866 228 460</a></li>
                            <li>
                                <a href="{{ url('wishlist') }}">
                                    <i class="icon-heart-o"></i>Sản phẩm yêu thích
                                    <span>(3)</span>
                                </a>
                            </li>
                            <li><a href="{{ url('about') }}">Về chúng tôi</a></li>
                            <li><a href="{{ url('contact') }}">Liên hệ chúng tôi</a></li>
                            <li><a href="#signin-modal" data-toggle="modal"><i class="icon-user"></i>Đăng nhập</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="header-middle sticky-header">
        <div class="container">
            <div class="header-left">
                <button class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars"></i>
                </button>

                <a href="{{ url('') }}" class="logo">
                    <img src="{{ asset('client/assets/images/logo.png') }}" alt="" width="105"
                        height="25">
                </a>

                <nav class="main-nav">
                    <ul class="menu sf-arrows">
                        <li class=" active">
                            <a href="{{ url('') }}">Trang chủ</a>
                        </li>
                        <li>
                            <a href="javascript:;" class="sf-with-ul">Cửa hàng</a>

                            <div class="megamenu megamenu-md">
                                <div class="row no-gutters">
                                    <div class="col-md-12">
                                        <div class="menu-col">
                                            <div class="row">
                                                @php
                                                    $getCategoryHeader = App\Models\CategoryModel::getRecordMenu();
                                                @endphp
                                                @foreach ($getCategoryHeader as $value_category_header)
                                                    @if (!empty($value_category_header->getSubCategory->count()))
                                                        <div class="col-md-4" style="margin-bottom: 20px">
                                                            <a href="{{ url($value_category_header->slug) }}"
                                                                class="menu-title">{{ $value_category_header->name }}</a>
                                                            <ul>
                                                                @foreach ($value_category_header->getSubCategory as $value_sub)
                                                                    <li><a
                                                                            href="{{ url($value_category_header->slug . '/' . $value_sub->slug) }}">{{ $value_sub->name }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                    </ul>
                </nav>
            </div>

            <div class="header-right">
                <div class="header-search">
                    <a href="#" class="search-toggle" role="button" title="Tìm kiếm"><i
                            class="icon-search"></i></a>
                    <form action="{{ url('search') }}" method="get">
                        <div class="header-search-wrapper">
                            <label for="q" class="sr-only">Tìm kiếm</label>
                            <input type="search" class="form-control" name="q" id="q"
                                placeholder="Tìm kiếm..."
                                value="{{ !empty(Request::get('q')) ? Request::get('q') : '' }}" required>
                        </div>
                    </form>
                </div>

                <div class="dropdown cart-dropdown">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" data-display="static">
                        <i class="icon-shopping-cart"></i>
                        <span class="cart-count">2</span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-cart-products">
                            <div class="product">
                                <div class="product-cart-details">
                                    <h4 class="product-title">
                                        <a href="product.html">Beige knitted elastic runner shoes</a>
                                    </h4>

                                    <span class="cart-product-info">
                                        <span class="cart-product-qty">1</span>
                                        x $84.00
                                    </span>
                                </div>

                                <figure class="product-image-container">
                                    <a href="product.html" class="product-image">
                                        <img src="{{ asset('client/assets/images/products/cart/product-1.jpg') }}"
                                            alt="product">
                                    </a>
                                </figure>
                                <a href="#" class="btn-remove" title="Remove Product"><i
                                        class="icon-close"></i></a>
                            </div>

                            <div class="product">
                                <div class="product-cart-details">
                                    <h4 class="product-title">
                                        <a href="product.html">Blue utility pinafore denim dress</a>
                                    </h4>

                                    <span class="cart-product-info">
                                        <span class="cart-product-qty">1</span>
                                        x $76.00
                                    </span>
                                </div>

                                <figure class="product-image-container">
                                    <a href="product.html" class="product-image">
                                        <img src="{{ asset('client/assets/images/products/cart/product-2.jpg') }}"
                                            alt="product">
                                    </a>
                                </figure>
                                <a href="#" class="btn-remove" title="Remove Product"><i
                                        class="icon-close"></i></a>
                            </div>
                        </div>

                        <div class="dropdown-cart-total">
                            <span>Total</span>

                            <span class="cart-total-price">$160.00</span>
                        </div>

                        <div class="dropdown-cart-action">
                            <a href="cart.html" class="btn btn-primary">View Cart</a>
                            <a href="checkout.html" class="btn btn-outline-primary-2"><span>Checkout</span><i
                                    class="icon-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
