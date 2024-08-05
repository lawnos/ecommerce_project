@extends('layouts.app')
@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('client/assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Đổi Mật Khẩu</h1>
            </div>
        </div>
        <br>
        <br>

        <div class="page-content">
            <div class="dashboard">
                <div class="container">
                    <div class="row">
                        @include('user.sidebar')
                        <div class="col-md-8 col-lg-9">
                            <div class="tab-content">

                                <form action="" method="POST">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-lg-9">
                                            @include('admin.layouts.message')

                                            <label>Mật khẩu cũ *</label>
                                            <input type="password" name="old_password" class="form-control" required>

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Mật khẩu mới *</label>
                                                    <input type="password" name="password" class="form-control" required>
                                                </div>

                                                <div class="col-sm-6">
                                                    <label>Xác nhận lại mật khẩu mới *</label>
                                                    <input type="password" name="cpassword" class="form-control" required>
                                                </div>
                                            </div>


                                            <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                                <span class="btn-text">Cập nhật</span>
                                                <span class="btn-hover-text">Cập nhật</span>
                                            </button>
                                        </div>
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
