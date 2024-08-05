@extends('admin.layouts.app')

@section('style')
@endsection
@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Danh sách tài khoản khách hàng (Tổng: {{ $getRecord->total() }})</h1>
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
                                                <label for="">Họ và Tên</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ Request::get('name') }}" placeholder="Họ và Tên">
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
                                            <a href="{{ url('admin/customer/list') }}" class="btn btn-primary">Làm mới</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @include('admin.layouts.message')
                        <div class="card">
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ID</th>
                                            <th>Tên</th>
                                            <th>Email</th>
                                            <th>Email xác minh tại</th>
                                            <th>Trạng thái</th>
                                            <th>Ngày tạo</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRecord as $value)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->email_verified_at }}</td>
                                                <td>{{ $value->status == 0 ? 'Hoạt dộng' : 'Không hoạt động' }}</td>
                                                <td>{{ \Carbon\Carbon::parse($value->created_at)->format('d-m-Y') }}</td>
                                                <td>
                                                    <a href="{{ url('admin/customer/delete/' . $value->id) }}"
                                                        class="btn btn-danger"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa mục này không?');">
                                                        Xóa</a>
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
@endsection
