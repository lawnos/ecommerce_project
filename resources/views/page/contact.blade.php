@extends('layouts.app')
@section('style')
@endsection
@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('') }}">Trang Chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Liên Hệ Chúng Tôi</li>
                </ol>
            </div>
        </nav>
        <div class="container">
            <div class="page-header page-header-big text-center"
                style="background-image: url('client/assets/images/contact-header-bg.jpg')">
                <h1 class="page-title text-white">Liên hệ chúng tôi<span class="text-white">hãy giữ liên lạc với chúng
                        tôi</span></h1>
            </div>
        </div>

        <div class="page-content pb-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mb-2 mb-lg-0">
                        <h2 class="title mb-1">Thông tin liên lạc</h2>
                        <p class="mb-3">Hãy liên hể để giải đáp mọi điều mà bạn thắc mắc.</p>
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="contact-info">
                                    <h3>Văn phòng</h3>

                                    <ul class="contact-list">
                                        <li>
                                            <i class="icon-map-marker"></i>
                                            70 Washington Square South New York, NY 10012, United States
                                        </li>
                                        <li>
                                            <i class="icon-phone"></i>
                                            <a href="tel:#">+84 866 228 460</a>
                                        </li>
                                        <li>
                                            <i class="icon-envelope"></i>
                                            <a href="mailto:#">info@trendythreads.com</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-sm-5">
                                <div class="contact-info">
                                    <h3>Văn phòng</h3>

                                    <ul class="contact-list">
                                        <li>
                                            <i class="icon-clock-o"></i>
                                            <span class="text-dark">Thứ 2 đến Thứ 7</span> <br>9h-16h
                                        </li>
                                        <li>
                                            <i class="icon-calendar"></i>
                                            <span class="text-dark">Chủ Nhật</span> <br>10h-15h
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h2 class="title mb-1">Bạn có thắc mắc gì không??</h2>
                        <p class="mb-2">Liên hệ với đội ngũ bán hàng</p>
                        <div style="padding-top: 10px;padding-bottom: 10px">
                            @include('layouts.message')
                        </div>
                        <form action="" class="contact-form mb-3" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="cname" class="sr-only">Họ và Tên</label>
                                    <input type="text" class="form-control" id="cname" name="name"
                                        placeholder="Họ và Tên *" required>
                                </div>

                                <div class="col-sm-6">
                                    <label for="cemail" class="sr-only">Email</label>
                                    <input type="email" class="form-control" id="cemail" name="email"
                                        placeholder="Email *" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="cphone" class="sr-only">Số điện thoại</label>
                                    <input type="tel" class="form-control" id="cphone" name="phone"
                                        placeholder="Số điện thoại">
                                </div>

                                <div class="col-sm-6">
                                    <label for="csubject" class="sr-only">Vấn đề</label>
                                    <input type="text" class="form-control" id="csubject" name="subject"
                                        placeholder="Vấn đề">
                                </div>
                            </div>

                            <label for="cmessage" class="sr-only">Lời nhắn</label>
                            <textarea class="form-control" cols="30" rows="4" id="cmessage" name="message" required
                                placeholder="Nội dung *"></textarea>

                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="verification" class="sr-only">Xác minh bạn không phải là người máy</label>
                                    <input type="tel" class="form-control" id="verification" name="verification"
                                        placeholder="Xác minh">
                                </div>

                                <div class="col-sm-6">
                                    <label for="verification" class="form-control">{{ $first_number }} +
                                        {{ $second_number }} = ?</label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-outline-primary-2 btn-minwidth-sm">
                                <span>GỬI</span>
                                <i class="icon-long-arrow-right"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <hr class="mt-4 mb-5">

                <div class="stores mb-4 mb-lg-5">
                    <h2 class="title text-center mb-3">Cửa hàng của chúng tôi</h2>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="store">
                                <div class="row">
                                    <div class="col-sm-5 col-xl-6">
                                        <figure class="store-media mb-2 mb-lg-0">
                                            <img src="client/assets/images/stores/img-1.jpg" alt="image">
                                        </figure>
                                    </div>
                                    <div class="col-sm-7 col-xl-6">
                                        <div class="store-content">
                                            <h3 class="store-title">Wall Street Plaza</h3>
                                            <address>88 Pine St, New York, NY 10005, USA</address>
                                            <div><a href="tel:#">+1 987-876-6543</a></div>

                                            <h4 class="store-subtitle">Store Hours:</h4>
                                            <div>Monday - Saturday 11am to 7pm</div>
                                            <div>Sunday 11am to 6pm</div>

                                            <a href="#" class="btn btn-link" target="_blank"><span>View
                                                    Map</span><i class="icon-long-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="store">
                                <div class="row">
                                    <div class="col-sm-5 col-xl-6">
                                        <figure class="store-media mb-2 mb-lg-0">
                                            <img src="client/assets/images/stores/img-2.jpg" alt="image">
                                        </figure>
                                    </div>

                                    <div class="col-sm-7 col-xl-6">
                                        <div class="store-content">
                                            <h3 class="store-title">One New York Plaza</h3>
                                            <address>88 Pine St, New York, NY 10005, USA</address>
                                            <div><a href="tel:#">+1 987-876-6543</a></div>

                                            <h4 class="store-subtitle">Store Hours:</h4>
                                            <div>Monday - Friday 9am to 8pm</div>
                                            <div>Saturday - 9am to 2pm</div>
                                            <div>Sunday - Closed</div>

                                            <a href="#" class="btn btn-link" target="_blank"><span>View
                                                    Map</span><i class="icon-long-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="map"><iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.658897402326!2d105.8293757111829!3d21.006306088467944!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ad95816c146f%3A0x2490ed9e600b1009!2zVmluY29tIENlbnRlciBQaOG6oW0gTmfhu41jIFRo4bqhY2g!5e0!3m2!1svi!2s!4v1722914638127!5m2!1svi!2s"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe></div>
        </div>
    </main>
@endsection
@section('script')
@endsection
