@extends('admin.layouts.app')

@section('style')
@endsection
@section('content')
    <div class="content-wrapper">


        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Danh sách đơn hàng (Tổng: {{ $getRecord->total() }})</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">

                        <form action="" method="get">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Tìm kiếm đơn hàng</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">ID</label>
                                                <input type="text" name="id" class="form-control"
                                                    value="{{ Request::get('id') }}" placeholder="ID">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Họ</label>
                                                <input type="text" name="first_name" class="form-control"
                                                    value="{{ Request::get('first_name') }}" placeholder="Họ">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Tên</label>
                                                <input type="text" name="last_name" class="form-control"
                                                    value="{{ Request::get('last_name') }}" placeholder="Tên">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Email</label>
                                                <input type="text" name="email" class="form-control"
                                                    value="{{ Request::get('email') }}" placeholder="Email">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Quốc gia</label>
                                                <input type="text" name="country" class="form-control"
                                                    value="{{ Request::get('country') }}" placeholder="Quốc gia">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Tình trạng</label>
                                                <input type="text" name="state" class="form-control"
                                                    value="{{ Request::get('state') }}" placeholder="Tình trạng">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Thành phố</label>
                                                <input type="text" name="city" class="form-control"
                                                    value="{{ Request::get('city') }}" placeholder="Thành phố">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Số điện thoại</label>
                                                <input type="text" name="phone" class="form-control"
                                                    value="{{ Request::get('phone') }}" placeholder="Số điện thoại">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Từ ngày</label>
                                                <input type="date" name="form_date" class="form-control"
                                                    value="{{ Request::get('form_date') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Tới ngày</label>
                                                <input type="date" name="to_date" class="form-control"
                                                    value="{{ Request::get('to_date') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <button class="btn btn-primary">Tìm kiếm</button>
                                            <a href="{{ url('admin/order/list') }}" class="btn btn-primary">Làm mới</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="card">
                            <div class="card-body p-0">
                                <table class="table table-striped">
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
                                            <th>Trạng thái</th>
                                            <th>Ngày đặt</th>
                                            <th>Hoạt động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRecord as $value)
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
                                                <td>
                                                    <select name="" id="{{ $value->id }}"
                                                        class="form-control ChangeStatus" style="width: 150px">
                                                        <option {{ $value->status == 0 ? 'selected' : '' }}
                                                            value="0">Chờ xác nhận</option>
                                                        <option {{ $value->status == 1 ? 'selected' : '' }}
                                                            value="1">Đang xử lý</option>
                                                        <option {{ $value->status == 2 ? 'selected' : '' }}
                                                            value="2">Đang vận chuyển</option>
                                                        <option {{ $value->status == 3 ? 'selected' : '' }}
                                                            value="3">Giao hàng thành công</option>
                                                        <option {{ $value->status == 4 ? 'selected' : '' }}
                                                            value="4">Đã hủy</option>
                                                    </select>
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
                                <div style="padding: 10px; float: right">
                                    {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
@section('script')
    <script type="text/javascript">

        $('body').delegate('.ChangeStatus', 'change', function() {
            var status = $(this).val();
            var order_id = $(this).attr('id');

            if (!status || !order_id) {
                alert("Dữ liệu không hợp lệ.");
                return;
            }

            $.ajax({
                type: "GET",
                url: "{{ url('admin/order_status') }}",
                data: {
                    status: status,
                    order_id: order_id
                },
                dataType: "json",
                success: function(data) {
                    alert(data.message);
                },
                error: function(xhr, status, error) {
                    alert('Có lỗi xảy ra. Vui lòng thử lại.');
                    console.error('Error:', status, error, xhr.responseText);
                }
            });
        });
    </script>
@endsection
