<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ !empty($meta_title) ? $meta_title : '' }}</title>
    @if (!empty($meta_keywords))
        <meta name="keywords" content="{{ $meta_keywords }}">
    @endif
    @if (!empty($meta_description))
        <meta name="description" content="{{ $meta_description }}">
    @endif
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('client/assets/images/icons/logo-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('client/assets/images/icons/logo-icon.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('client/assets/images/icons/logo-icon.png') }}">
    <link rel="manifest" href="{{ asset('client/assets/images/icons/site.html') }}">
    <link rel="mask-icon" href="{{ asset('client/assets/images/icons/logo-icon.png') }}" color="#666666">
    <link rel="shortcut icon" href="{{ asset('client/assets/images/icons/logo-icon.png') }}">


    <link rel="stylesheet" href="{{ asset('client/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/assets/css/plugins/owl-carousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('client/assets/css/plugins/magnific-popup/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('client/assets/css/style.css') }}">
    @yield('style')
    <style type="text/css">
        .btn-wishlist-add::before {
            content: '\f233' !important;
        }
    </style>
</head>

<body>
    <div class="page-wrapper">
        @include('layouts.header')
        @yield('content')
        @include('layouts.footer')
    </div>
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>


    <div class="mobile-menu-overlay"></div>

    @include('layouts.mobile')


    <div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>

                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin"
                                        role="tab" aria-controls="signin" aria-selected="true">ĐĂNG NHẬP</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="register-tab" data-toggle="tab" href="#register"
                                        role="tab" aria-controls="register" aria-selected="false">TẠO TÀI KHOẢN</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="tab-content-5">
                                <div class="tab-pane fade show active" id="signin" role="tabpanel"
                                    aria-labelledby="signin-tab">
                                    <form action="" id="SubmitFormLogin" method="POST">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="singin-email">Địa chỉ Email *</label>
                                            <input type="text" class="form-control" id="singin-email" name="email"
                                                required>
                                        </div>

                                        <div class="form-group">
                                            <label for="singin-password">Mật khẩu *</label>
                                            <input type="password" class="form-control" id="singin-password"
                                                name="password" required>
                                        </div>

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>ĐĂNG NHẬP</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="is_remember"
                                                    class="custom-control-input" id="signin-remember" required>
                                                <label class="custom-control-label" for="signin-remember">Nhớ
                                                    tôi</label>
                                            </div>

                                            <a href="{{ url('forgot-password') }}" class="forgot-link">Quên mật
                                                khẩu?</a>
                                        </div>
                                    </form>
                                    <div class="form-choice">
                                        <p class="text-center">hoặc đăng nhập bằng</p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-g">
                                                    <i class="icon-google"></i>
                                                    Đăng nhập Google
                                                </a>
                                            </div>
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-f">
                                                    <i class="icon-facebook-f"></i>
                                                    Đăng nhập Facebook
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="register" role="tabpanel"
                                    aria-labelledby="register-tab">
                                    <form action="" id="SubmitFormRegister" method="POST">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="register-name">Họ và tên *</label>
                                            <input type="text" class="form-control" id="register-name"
                                                name="name" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="register-email">Địa chỉ email *</label>
                                            <input type="email" class="form-control" id="register-email"
                                                name="email" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="register-password">Mật khẩu *</label>
                                            <input type="password" class="form-control" id="register-password"
                                                name="password" required>
                                        </div>

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>ĐĂNG KÝ</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="register-policy" required>
                                                <label class="custom-control-label" for="register-policy">Tôi đồng ý
                                                    với <a href="#">chính sách bảo mật</a> *</label>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="form-choice">
                                        <p class="text-center">hoặc đăng nhập bằng</p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-g">
                                                    <i class="icon-google"></i>
                                                    Đăng nhập Google
                                                </a>
                                            </div>
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login  btn-f">
                                                    <i class="icon-facebook-f"></i>
                                                    Đăng nhập Facebook
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="container newsletter-popup-container mfp-hide" id="newsletter-popup-form">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="row no-gutters bg-white newsletter-popup-content">
                    <div class="col-xl-3-5col col-lg-7 banner-content-wrap">
                        <div class="banner-content text-center">
                            <img src="{{ url('') }}/client/assets/images/popup/newsletter/logo.png"
                                class="logo" alt="logo" width="60" height="15">
                            <h2 class="banner-title">giảm <span> 25<light>%</light></span> giá</h2>
                            <p>Đăng ký nhận bản tin Thương mại điện tử TrendyThreads để nhận thông tin cập nhật kịp thời
                                từ sản phẩm yêu thích của bạn
                                các sản phẩm.</p>
                            <form action="#">
                                <div class="input-group input-group-round">
                                    <input type="email" class="form-control form-control-white"
                                        placeholder="Địa chỉ email của bạn" aria-label="Email Adress" required>
                                    <div class="input-group-append">
                                        <button class="btn" type="submit"><span>go</span></button>
                                    </div>
                                </div>
                            </form>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="register-policy-2" required>
                                <label class="custom-control-label" for="register-policy-2">Không hiển thị cửa sổ
                                    này</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2-5col col-lg-5 ">
                        <img src="{{ url('') }}/client/assets/images/popup/newsletter/img-1.jpg"
                            class="newsletter-img" alt="newsletter">
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <script src="{{ asset('client/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('client/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('client/assets/js/jquery.hoverIntent.min.js') }}"></script>
    <script src="{{ asset('client/assets/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('client/assets/js/superfish.min.js') }}"></script>
    <script src="{{ asset('client/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('client/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('client/assets/js/main.js') }}"></script>
    @yield('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var alert = document.getElementById('alert');
            if (alert) {
                setTimeout(function() {
                    alert.classList.add('hidden');
                }, 2000);

                setTimeout(function() {
                    alert.style.display = 'none';
                }, 2500);
            }
        });
    </script>

    {{-- <script type="text/javascript">
        $('body').delegate('#SubmitFormRegister', 'submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{ url('auth_register') }},
                data: $(this).serialize(),
                dataType: "json",
                success: function(data) {
                    alert(data.message)
                    if (data.status == true) {
                        location.reload();
                    }
                },
                error: function(data) {

                }
            });
        });
    </script> --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('body').delegate('#SubmitFormLogin', 'submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "{{ url('auth_login') }}",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(data) {

                        if (data.status == true) {
                            location.reload();
                            alert(data.message);
                        } else {
                            alert(data.message);
                        }
                    },
                    error: function(data) {
                        console.error('Error:', data);
                    }
                });
            });

            $('body').delegate('#SubmitFormRegister', 'submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "{{ url('auth_register') }}",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(data) {

                        alert(data.message);
                        if (data.status == true) {
                            location.reload();
                        }
                    },
                    error: function(data) {
                        console.error('Error:', data);
                    }
                });
            });

            $('body').delegate('.add_to_wishlist', 'click', function(e) {
                e.preventDefault();
                var product_id = $(this).attr('id');
                $.ajax({
                    type: "POST",
                    url: "{{ url('add-to-wishlist') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "product_id": product_id,
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.is_wishlist == 0) {
                            $('.add_to_wishlist' + product_id).removeClass('btn-wishlist-add');
                        } else {
                            $('.add_to_wishlist' + product_id).addClass('btn-wishlist-add');
                        }
                    }
                });
            });


        });
    </script>


</body>



</html>
