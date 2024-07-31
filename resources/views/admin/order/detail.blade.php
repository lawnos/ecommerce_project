@extends('admin.layouts.app')

@section('style')
    <style>
        .content-wrapper {
            padding: 20px;
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
            text-align: center;
        }

        .card-body {
            padding: 20px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group p {
            margin: 0;
            padding: 5px;
            border-radius: 5px;
            background-color: #d1d3d4;
            font-weight: normal;
            /* Đảm bảo chữ trong thẻ p không in đậm */
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-11">
                        <h1>Chi tiết đơn hàng</h1>
                    </div>
                    <div class="col-sm-1" style="text-align: right">
                        <a href="{{ url('admin/order/list') }}" class="btn btn-primary">Quay lại</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                Thông tin đơn hàng
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>ID:</label>
                                    <p>{{ $getRecord->id }}</p>
                                </div>
                                <div class="form-group">
                                    <label>ID giao dịch:</label>
                                    <p>{{ $getRecord->transaction_id }}</p>
                                </div>
                                <div class="form-group">
                                    <label>Tên:</label>
                                    <p>{{ $getRecord->first_name }} {{ $getRecord->last_name }}</p>
                                </div>
                                <div class="form-group">
                                    <label>Tên công ty:</label>
                                    <p>{{ $getRecord->company_name }}</p>
                                </div>
                                <div class="form-group">
                                    <label>Quận:</label>
                                    <p>{{ $getRecord->county }}</p> <!-- Added missing variable -->
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ:</label>
                                    <p>Địa chỉ 1: {{ $getRecord->address_one }}<br>Địa chỉ 2: {{ $getRecord->address_two }}
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label>Thành phố:</label>
                                    <p>{{ $getRecord->city }}</p>
                                </div>
                                <div class="form-group">
                                    <label>Tình trạng:</label>
                                    <p>{{ $getRecord->state }}</p>
                                </div>
                                <div class="form-group">
                                    <label>Mã bưu chính:</label>
                                    <p>{{ $getRecord->postcode }}</p>
                                </div>
                                <div class="form-group">
                                    <label>Số điện thoại:</label>
                                    <p>{{ $getRecord->phone }}</p>
                                </div>
                                <div class="form-group">
                                    <label>Email:</label>
                                    <p>{{ $getRecord->email }}</p>
                                </div>
                                <div class="form-group">
                                    <label>Mã giảm giá:</label>
                                    <p>{{ $getRecord->discount_code }}</p>
                                </div>
                                <div class="form-group">
                                    <label>Số tiền giảm giá:</label>
                                    <p>₫{{ number_format($getRecord->discount_amount) }}</p>
                                </div>
                                <div class="form-group">
                                    <label>Loại vận chuyển:</label>
                                    <p>{{ $getRecord->getShipping->name }}</p>
                                </div>
                                <div class="form-group">
                                    <label>Số tiền vận chuyển:</label>
                                    <p>₫{{ number_format($getRecord->shipping_amount) }}</p>
                                </div>
                                <div class="form-group">
                                    <label>Tổng cộng:</label>
                                    <p>₫{{ number_format($getRecord->total_amount) }}</p>
                                </div>
                                <div class="form-group">
                                    <label>Phương thức thanh toán:</label>
                                    <p>{{ $getRecord->payment_method }}</p>
                                </div>
                                <div class="form-group">
                                    <label>Trạng thái:</label>
                                    <p>{{ $getRecord->status }}</p> <!-- Added missing variable -->
                                </div>
                                <div class="form-group">
                                    <label>Ngày tạo:</label>
                                    <p>{{ date('d-m-Y h:i A', strtotime($getRecord->created_at)) }}</p>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                Chi tiết sản phẩm
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Tên sản phẩm</th>
                                            <th>Hình ảnh</th>
                                            <th>Số lượng</th>
                                            <th>Giá</th>
                                            <th>Tên size</th>
                                            <th>Màu sắc</th>
                                            <th>Giá size</th>
                                            <th>Tổng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @foreach ($getRecord->getItem as $item)
                                                @php
                                                    $getProductImage = $item->getProduct->getImageSingle(
                                                        $item->getProduct->id,
                                                    );
                                                @endphp
                                                <td><a target="_blank"
                                                        href="{{ url($item->getProduct->slug) }}">{{ $item->getProduct->title }}</a>
                                                </td>
                                                <td><img src="{{ $getProductImage->getLogo() }}" alt=""
                                                        width="120px"></td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>₫ {{ number_format($item->price) }}</td>
                                                <td>{{ $item->color_name }}</td>
                                                <td>{{ $item->size_name }}</td>
                                                <td>₫ {{ number_format($item->size_amount) }}</td>
                                                <td>₫ {{ number_format($item->total_price) }}</td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection

@section('script')
@endsection
