@extends('layouts.app')
@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('client/assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Chỉnh Sửa Thông Tin</h1>
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
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Họ *</label>
                                                    <input type="text" name="name" class="form-control"
                                                        value="{{ $getRecord->name }}" required>
                                                </div>

                                                <div class="col-sm-6">
                                                    <label>Tên *</label>
                                                    <input type="text" name="last_name" class="form-control"
                                                        value="{{ $getRecord->last_name }}" required>
                                                </div>
                                            </div>

                                            <label>Địa chỉ Email *</label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ $getRecord->email }}" required>

                                            <label>Tên công ty (nếu có)</label>
                                            <input type="text" name="company_name" class="form-control"
                                                value="{{ $getRecord->company_name }}">

                                            <label>Quốc gia *</label>
                                            <input type="text" name="country" class="form-control"
                                                value="{{ $getRecord->country }}" required>

                                            <label>Địa chỉ *</label>
                                            <input type="text" name="address_one" class="form-control"
                                                placeholder="Địa chỉ 1" value="{{ $getRecord->address_one }}" required>
                                            <input type="text" name="address_two" class="form-control"
                                                placeholder="Địa chỉ 2" value="{{ $getRecord->address_two }}">

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Thị trấn / Thành phố *</label>
                                                    <input type="text" name="city" class="form-control"
                                                        value="{{ $getRecord->city }}" required>
                                                </div>

                                                <div class="col-sm-6">
                                                    <label>Quận / Phường *</label>
                                                    <input type="text" name="district" class="form-control"
                                                        value="{{ $getRecord->district }}" required>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Mã bưu / Zip *</label>
                                                    <input type="text" name="code_zip" class="form-control"
                                                        value="{{ $getRecord->code_zip }}" required>
                                                </div>

                                                <div class="col-sm-6">
                                                    <label>Số điện thoại *</label>
                                                    <input type="tel" name="phone" class="form-control"
                                                        value="{{ $getRecord->phone }}" required>
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
