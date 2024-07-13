@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ 'client/assets/css/plugins/nouislider/nouislider.css' }}">
@endsection
@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
            <div class="container d-flex align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a
                            href="{{ url($getProduct->getCategory->slug) }}">{{ $getProduct->getCategory->name }}</a></li>
                    <li class="breadcrumb-item"><a
                            href="{{ url($getProduct->getCategory->slug . '/' . $getProduct->getSubCategory->slug) }}">{{ $getProduct->getSubCategory->name }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $getProduct->title }}</li>
                </ol>
            </div>
        </nav>

        <div class="page-content">
            <div class="container">
                <div class="product-details-top mb-2">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-gallery">
                                <figure class="product-main-image">
                                    @php
                                        $getProductImage = $getProduct->getImageSingle($getProduct->id);
                                    @endphp

                                    @if (!empty($getProductImage) && !empty($getProductImage->getLogo()))
                                        <img id="product-zoom" src="{{ $getProductImage->getLogo() }}"
                                            data-zoom-image="{{ $getProductImage->getLogo() }}" alt="product image">

                                        <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                            <i class="icon-arrows"></i>
                                        </a>
                                    @endif
                                </figure>

                                <div id="product-zoom-gallery" class="product-image-gallery">
                                    @foreach ($getProduct->getImage as $image)
                                        <a class="product-gallery-item" href="#" data-image="{{ $image->getLogo() }}"
                                            data-zoom-image="{{ $image->getLogo() }}">
                                            <img src="{{ $image->getLogo() }}" alt="product side">
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="product-details">
                                <h1 class="product-title">{{ $getProduct->title }}</h1>


                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 80%;"></div>
                                    </div>
                                    <a class="ratings-text" href="#product-review-link" id="review-link">( 2 Reviews )</a>
                                </div>

                                <div class="product-price">
                                    ₫{{ number_format($getProduct->price) }}
                                </div>

                                <div class="product-content">
                                    <p>{{ $getProduct->short_description }}</p>
                                </div>

                                @if (!empty($getProduct->getColor->count()))
                                    <div class="details-filter-row details-row-size">
                                        <label>Màu sắc:</label>
                                        <div class="select-custom">
                                            <select name="size" id="size" class="form-control">
                                                <option value="" selected="selected">Chọn màu:</option>
                                                @foreach ($getProduct->getColor as $color)
                                                    <option value="{{ $color->getColor->id }}">
                                                        {{ $color->getColor->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif

                                @if (!empty($getProduct->getSize->count()))
                                    <div class="details-filter-row details-row-size">
                                        <label for="size">Size:</label>
                                        <div class="select-custom">
                                            <select name="size" id="size" class="form-control">
                                                <option value="#" selected="selected">Chọn size:</option>
                                                @foreach ($getProduct->getSize as $size)
                                                    <option value="{{ $size->id }}">
                                                        {{ $size->name }} @if (!empty($size->price))
                                                            (₫{{ number_format($size->price) }})
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif

                                <div class="details-filter-row details-row-size">
                                    <label for="qty">Số lượng:</label>
                                    <div class="product-details-quantity">
                                        <input type="number" id="qty" class="form-control" value="1"
                                            min="1" max="10" step="1" data-decimals="0" required>
                                    </div>
                                </div>

                                <div class="product-details-action">
                                    <a href="#" class="btn-product btn-cart"><span>thêm giỏ hàng</span></a>

                                    <div class="details-action-wrapper">
                                        <a href="#" class="btn-product btn-wishlist" title="Wishlist"><span>Thêm
                                                vào yêu thích</span></a>

                                    </div>
                                </div>

                                <div class="product-details-footer">
                                    <div class="product-cat">
                                        <span>Danh mục:</span>
                                        <a
                                            href="{{ url($getProduct->getCategory->slug) }}">{{ $getProduct->getCategory->name }}</a>,
                                        <a
                                            href="{{ url($getProduct->getCategory->slug . '/' . $getProduct->getSubCategory->slug) }}">{{ $getProduct->getSubCategory->name }}</a>
                                    </div>

                                    <div class="social-icons social-icons-sm">
                                        <span class="social-label">Chia sẻ:</span>
                                        <a href="#" class="social-icon" title="Facebook" target="_blank"><i
                                                class="icon-facebook-f"></i></a>
                                        <a href="#" class="social-icon" title="Twitter" target="_blank"><i
                                                class="icon-twitter"></i></a>
                                        <a href="#" class="social-icon" title="Instagram" target="_blank"><i
                                                class="icon-instagram"></i></a>
                                        <a href="#" class="social-icon" title="Pinterest" target="_blank"><i
                                                class="icon-pinterest"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="product-details-tab product-details-extended">
                <div class="container">
                    <ul class="nav nav-pills justify-content-center" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab"
                                role="tab" aria-controls="product-desc-tab" aria-selected="true">Mô tả</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab"
                                role="tab" aria-controls="product-info-tab" aria-selected="false">Thông tin thêm</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="product-shipping-link" data-toggle="tab"
                                href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab"
                                aria-selected="false">Vận chuyển & Trả lại</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab"
                                role="tab" aria-controls="product-review-tab" aria-selected="false">Đánh giá (2)</a>
                        </li>
                    </ul>
                </div>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel"
                        aria-labelledby="product-desc-link">
                        <div class="container" style="margin-top: 20px">
                            <p>{!! $getProduct->description !!}</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="product-info-tab" role="tabpanel"
                        aria-labelledby="product-info-link">
                        <div class="product-desc-content">
                            <div class="container" style="margin-top: 20px">
                                <p>{!! $getProduct->additional_information !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel"
                        aria-labelledby="product-shipping-link">
                        <div class="product-desc-content">
                            <div class="container" style="margin-top: 20px">
                                <p>{!! $getProduct->shipping_returns !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="product-review-tab" role="tabpanel"
                        aria-labelledby="product-review-link">
                        <div class="reviews">
                            <div class="container">
                                <h3>Reviews (2)</h3>
                                <div class="review">
                                    <div class="row no-gutters">
                                        <div class="col-auto">
                                            <h4><a href="#">Samanta J.</a></h4>
                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val" style="width: 80%;"></div>

                                                </div>
                                            </div>
                                            <span class="review-date">6 days ago</span>
                                        </div>
                                        <div class="col">
                                            <h4>Good, perfect size</h4>

                                            <div class="review-content">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus cum
                                                    dolores assumenda asperiores facilis porro reprehenderit animi culpa
                                                    atque blanditiis commodi perspiciatis doloremque, possimus, explicabo,
                                                    autem fugit beatae quae voluptas!</p>
                                            </div>

                                            <div class="review-action">
                                                <a href="#"><i class="icon-thumbs-up"></i>Helpful (2)</a>
                                                <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="review">
                                    <div class="row no-gutters">
                                        <div class="col-auto">
                                            <h4><a href="#">John Doe</a></h4>
                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val" style="width: 100%;"></div>

                                                </div>
                                            </div>
                                            <span class="review-date">5 days ago</span>
                                        </div>
                                        <div class="col">
                                            <h4>Very good</h4>

                                            <div class="review-content">
                                                <p>Sed, molestias, tempore? Ex dolor esse iure hic veniam laborum blanditiis
                                                    laudantium iste amet. Cum non voluptate eos enim, ab cumque nam, modi,
                                                    quas iure illum repellendus, blanditiis perspiciatis beatae!</p>
                                            </div>

                                            <div class="review-action">
                                                <a href="#"><i class="icon-thumbs-up"></i>Helpful (0)</a>
                                                <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <h2 class="title text-center mb-4">BẠN CŨNG CÓ THỂ THÍCH</h2>
                <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                    data-owl-options='{
                    "nav": false, 
                    "dots": true,
                    "margin": 20,
                    "loop": false,
                    "responsive": {
                        "0": {
                            "items":1
                        },
                        "480": {
                            "items":2
                        },
                        "768": {
                            "items":3
                        },
                        "992": {
                            "items":4
                        },
                        "1200": {
                            "items":4,
                            "nav": true,
                            "dots": false
                        }
                    }
                }'>
                    @foreach ($getRelatedProduct as $value)
                        @php
                            $getProductImage = $value->getImageSingle($value->id);
                        @endphp
                        <div class="product product-7">
                            <figure class="product-media">
                                {{-- <span class="product-label label-new">New</span> --}}
                                <a href="{{ url($value->slug) }}">
                                    @if (!empty($getProductImage && !empty($getProductImage->getLogo())))
                                        <img src="{{ $getProductImage->getLogo() }}" style="width: 280px; height: 280px;"
                                            alt="{{ $value->title }}" class="product-image">
                                    @endif
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>thêm vào
                                            yêu
                                            thích</span></a>
                                </div>

                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart"><span>thêm giỏ hàng</span></a>
                                </div>
                            </figure>

                            <div class="product-body">
                                <div class="product-cat">
                                    <a
                                        href="{{ url($value->category_slug . '/' . $value->sub_category_slug) }}">{{ $value->sub_category_name }}</a>
                                </div>
                                <h3 class="product-title"><a href="{{ url($value->slug) }}">{{ $value->title }}</a>
                                </h3>
                                <div class="product-price">
                                    ₫ {{ number_format($value->price) }}
                                </div>
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 20%;"></div>
                                    </div>
                                    <span class="ratings-text">( 2 Reviews )</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')
    <script src="{{ url('client/assets/js/bootstrap-input-spinner.js') }}"></script>
    <script src="{{ url('client/assets/js/jquery.elevateZoom.min.js') }}"></script>
    <script src="{{ url('client/assets/js/bootstrap-input-spinner.js') }}"></script>
@endsection
