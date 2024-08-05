@extends('layouts.app')
@section('style')
    <style type="text/css">
        .box-btn {
            padding: 20px;
            ;
            text-align: center;
            border-radius: 5px;
            box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
        }
    </style>
@endsection
@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('client/assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Tài Khoản Của Tôi</h1>
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

                                <div class="row">
                                    <div class="col-md-3" style="margin-bottom: 20px;">
                                        <div class="box-btn">
                                            <div style="font-size: 20px; font-weight: bold;">{{ $TotalOrder }}</div>
                                            <div style="font-size: 16px;">Tổng đơn hàng</div>
                                        </div>
                                    </div>

                                    <div class="col-md-3" style="margin-bottom: 20px;">
                                        <div class="box-btn">
                                            <div style="font-size: 20px; font-weight: bold;">{{ $TotalTodayOrder }}</div>
                                            <div style="font-size: 16px;">Đặt hàng hôm nay</div>
                                        </div>
                                    </div>

                                    <div class="col-md-3" style="margin-bottom: 20px;">
                                        <div class="box-btn">
                                            <div style="font-size: 20px; font-weight: bold;">
                                                ₫ {{ number_format($TotalTodayAmount) }}</div>
                                            <div style="font-size: 16px;">Tổng tiền hôm nay</div>
                                        </div>
                                    </div>

                                    <div class="col-md-3" style="margin-bottom: 20px;">
                                        <div class="box-btn">
                                            <div style="font-size: 20px; font-weight: bold;">
                                                ₫ {{ number_format($TotalAmount) }}</div>
                                            <div style="font-size: 16px;">Tổng tiền</div>
                                        </div>
                                    </div>

                                    <div class="col-md-3" style="margin-bottom: 20px;">
                                        <div class="box-btn">
                                            <div style="font-size: 20px; font-weight: bold;">{{ $getPending }}</div>
                                            <div style="font-size: 16px;">Đang xử lý</div>
                                        </div>
                                    </div>

                                    <div class="col-md-3" style="margin-bottom: 20px;">
                                        <div class="box-btn">
                                            <div style="font-size: 20px; font-weight: bold;">{{ $getDelivered }}</div>
                                            <div style="font-size: 16px;">Đang vận chuyển</div>
                                        </div>
                                    </div>

                                    <div class="col-md-3" style="margin-bottom: 20px;">
                                        <div class="box-btn">
                                            <div style="font-size: 20px; font-weight: bold;">{{ $getCompleted }}</div>
                                            <div style="font-size: 16px;">Hoàn thành</div>
                                        </div>
                                    </div>

                                    <div class="col-md-3" style="margin-bottom: 20px;">
                                        <div class="box-btn">
                                            <div style="font-size: 20px; font-weight: bold;">{{ $getCancelled }}</div>
                                            <div style="font-size: 16px;">Đơn hàng hủy</div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
