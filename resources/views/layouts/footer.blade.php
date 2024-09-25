<footer class="footer footer-dark">
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="widget widget-about">
                        <img src="client/assets/images/logo-footer.png" class="footer-logo" alt="Footer Logo" width="105"
                            height="25">
                        <p>Praesent dapibus, neque id cursus ucibus, tortor neque egestas augue, eu vulputate magna eros
                            eu erat.</p>

                        <div class="social-icons">
                            <a href="#" class="social-icon" title="Facebook" target="_blank"><i
                                    class="icon-facebook-f"></i></a>
                            <a href="#" class="social-icon" title="Twitter" target="_blank"><i
                                    class="icon-twitter"></i></a>
                            <a href="#" class="social-icon" title="Instagram" target="_blank"><i
                                    class="icon-instagram"></i></a>
                            <a href="#" class="social-icon" title="Youtube" target="_blank"><i
                                    class="icon-youtube"></i></a>
                            <a href="#" class="social-icon" title="Pinterest" target="_blank"><i
                                    class="icon-pinterest"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title">Liên kết hữu ích</h4>

                        <ul class="widget-list">
                            <li><a href="{{ url('about') }}">Về TrendyThreads</a></li>
                            <li><a href="">Cách mua sắm trên TrendyThreads</a></li>
                            <li><a href="{{ url('faq') }}">FAQ</a></li>
                            <li><a href="{{ url('contact') }}">Liên hệ chúng tôi</a></li>
                            <li><a href="#signin-modal" data-toggle="modal">Đăng nhập</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title">Dịch vụ khách hàng</h4>

                        <ul class="widget-list">
                            <li><a href="">Phương thức thanh toán</a></li>
                            <li><a href="">Chính sách đổi hàng và bảo hành</a></li>
                            <li><a href="">Chính sách ưu đãi sinh nhật</a></li>
                            <li><a href="">Các điều khoản và điều kiện</a></li>
                            <li><a href="">Chính sách bảo mật</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title">Tài khoản của tôi</h4>

                        <ul class="widget-list">
                            <li><a href="#signin-modal" data-toggle="modal">Đăng nhập</a></li>
                            <li><a href="{{ url('cart') }}">Xem giỏ hàng</a></li>
                            <li><a href="{{ url('my-wishlist') }}">Sản phẩm yêu thích</a></li>
                            <li><a href="{{ url('user/order') }}">Theo dõi đơn hàng của tôi</a></li>
                            <li><a href="">Giúp đỡ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <p class="footer-copyright">Bản quyền © {{ date('Y') }} Cửa hàng TrendyThreads. Đã đăng ký Bản quyền.
            </p>
            <figure class="footer-payments">
                <img src="client/assets/images/payments.png" alt="Payment methods" width="272" height="20">
            </figure>
        </div>
    </div>
</footer>
