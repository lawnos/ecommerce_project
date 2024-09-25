@extends('admin.layouts.app')

@section('style')
@endsection
@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Bảng điều khiển</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12 col-sm-6 col-md-2">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Tổng đơn hàng</span>
                                <span class="info-box-number">{{ $TotalOrder }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-2">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Đơn hàng hôm nay</span>
                                <span class="info-box-number">{{ $TotalTodayOrder }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-2">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-credit-card"></i>
                                </i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Tổng thanh toán</span>
                                <span class="info-box-number">₫ {{ number_format($TotalAmount) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-2">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-credit-card"></i>
                                </i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Thanh toán hôm nay</span>
                                <span class="info-box-number">₫ {{ number_format($TotalTodayAmount) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-2">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-circle"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Tổng khách hàng</span>
                                <span class="info-box-number">{{ $TotalCustomer }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-2">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-circle"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Tổng khách hàng hôm nay</span>
                                <span class="info-box-number">{{ $TotalTodayCustomer }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">Việc bán hàng</h3>
                                    <select class="form-control ChangeYear" style="width: 100px">
                                        @for ($i = 2022; $i <= date('Y'); $i++)
                                            <option {{ $year == $i ? 'selected' : '' }} value="{{ $i }}">
                                                {{ $i }}
                                            </option>
                                        @endfor
                                    </select>

                                </div>
                            </div>

                            <div class="card-body">
                                <div class="d-flex">
                                    <p class="d-flex flex-column">
                                        <span class="text-bold text-lg">₫ {{ number_format($totalAmount) }}</span>
                                        <span>Doanh số theo thời gian (VND)</span>
                                    </p>

                                </div>

                                <div class="position-relative mb-4">
                                    <canvas id="sales-chart-order" height="200"></canvas>
                                </div>
                                <div class="d-flex flex-row justify-content-end">
                                    <span class="mr-2">
                                        <i class="fas fa-square text-primary"></i> Khách hàng
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-square text-gray"></i> Đơn hàng
                                    </span class="mr-2">
                                    <span>
                                        <i class="fas fa-square text-danger"></i> Doanh thu (VND)
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header border-0">
                                <h3 class="card-title">Danh sách đơn hàng mới</h3>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-tool btn-sm">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <a href="#" class="btn btn-tool btn-sm">
                                        <i class="fas fa-bars"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-striped table-valign-middle">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tên</th>
                                            <th>Địa chỉ</th>
                                            <th>Mã đơn hàng</th>
                                            <th>Mã bưu chính</th>
                                            <th>Số điện thoại</th>
                                            <th>Email</th>
                                            <th>Tổng cộng</th>
                                            <th>Phương thức thanh toán</th>
                                            <th>Ngày đặt</th>
                                            <th>Hoạt động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getLatestOrder as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                                                <td>{{ $value->address_one }} <br /> {{ $value->address_two }}</td>
                                                <td>{{ $value->order_number }}</td>
                                                <td>{{ $value->postcode }}</td>
                                                <td>{{ $value->phone }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>₫{{ number_format($value->total_amount) }}</td>
                                                <td style="text-transform: capitalize">{{ $value->payment_method }}
                                                </td>
                                                <td>{{ date('d-m-Y h:i A', strtotime($value->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ url('admin/order/detail/' . $value->id) }}"
                                                        class="btn btn-warning">
                                                        Chi tiết</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ChangeYear').change(function() {
                var year = $(this).val();
                window.location.href = "{{ url('admin/dashboard?year=') }}" + year;
            });
        });


        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        }

        var mode = 'index'
        var intersect = true

        var $salesChart = $('#sales-chart-order')
        var salesChart = new Chart($salesChart, {
            type: 'bar',
            data: {
                labels: ['THÁNG 1', 'THÁNG 2', 'THÁNG 3', 'THÁNG 4', 'THÁNG 5', 'THÁNG 6', 'THÁNG 7 ', 'THÁNG 8',
                    'THÁNG 9', 'THÁNG 10', 'THÁNG 11', 'THÁNG 12'
                ],
                datasets: [{
                    backgroundColor: '#007bff',
                    borderColor: '#007bff',
                    data: [{{ $getTotalCustomerMonth }}]
                }, {
                    backgroundColor: '#ced4da',
                    borderColor: '#ced4da',
                    data: [{{ $getTotalOrderMonth }}]
                }, {
                    backgroundColor: '#dc3545',
                    borderColor: '#dc3545',
                    data: [{{ $getTotalOrderAmountMonth }}]
                }]
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    mode: mode,
                    intersect: intersect
                },
                hover: {
                    mode: mode,
                    intersect: intersect
                },
                legend: {
                    display: false
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        suggestedMax: 200, // Thay đổi giá trị này tùy thuộc vào nhu cầu của bạn
                        grid: {
                            display: true,
                            drawBorder: false,
                            color: 'rgba(0, 0, 0, .2)',
                            zeroLineColor: 'transparent',
                            borderWidth: 1
                        },
                        ticks: $.extend({
                            callback: function(value) {

                                return '₫' + value;
                            }
                        }, ticksStyle)
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: ticksStyle
                    }
                }
            }
        })
    </script>
@endsection
