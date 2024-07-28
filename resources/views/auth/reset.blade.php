@extends('layouts.app')
@section('style')
@endsection
@section('content')
    <main class="main">
        <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17"
            style="background-image: url('client/assets/images/backgrounds/login-bg.jpg')">
            <div class="container">
                <div class="form-box">
                    <div class="form-tab">
                        <ul class="nav nav-pills nav-fill" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="signin-tab-2" aria-selected="false">Đặt Lại Mật Khẩu</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="" style="display: block;">
                                @include('layouts.message')
                                <form action="" style="margin-top: 30px;" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="singin-email-2">Nhập mật khẩu mới *</label>
                                        <input type="password" class="form-control" name="password"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="singin-email-2">Xác nhận lại mật khẩu *</label>
                                        <input type="password" class="form-control" name="cpassword"
                                            required>
                                    </div>

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>TIẾP TỤC</span>   
                                            <i class="icon-long-arrow-right"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')
@endsection
