@extends('layouts.app')
@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('client/assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Đơn Hàng Của Bạn</h1>
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
                                @if ($getRecord->isEmpty())
                                    <h4 style="text-align: center;">Không có đơn hàng nào</h4>
                                @else
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Tên</th>
                                                <th>Mã đơn hàng</th>
                                                <th>Số điện thoại</th>
                                                <th>Tổng cộng</th>
                                                <th>Trạng thái</th>
                                                <th>Hoạt động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $item = 1; @endphp
                                            @foreach ($getRecord as $value)
                                                <tr>
                                                    <td>{{ $item }}</td>
                                                    @php $item++; @endphp
                                                    <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                                                    <td>{{ $value->order_number }}</td>
                                                    <td>{{ $value->phone }}</td>
                                                    <td>₫ {{ number_format($value->total_amount) }}</td>
                                                    </td>
                                                    <td>
                                                        @if ($value->status == 0)
                                                            Chờ xác nhận
                                                        @elseif($value->status == 1)
                                                            Đang xử lý
                                                        @elseif($value->status == 2)
                                                            Đang vận chuyển
                                                        @elseif($value->status == 3)
                                                            Giao hàng thành công
                                                        @elseif($value->status == 4)
                                                            Đã hủy
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('user/order/detail/' . $value->id) }}"
                                                            class="btn btn-primary">
                                                            Chi tiết</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div style="padding: 10px; float: right">
                                        {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
