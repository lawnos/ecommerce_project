@extends('admin.layouts.app')

@section('style')
@endsection
@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Danh sách mã giảm giá</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{ url('admin/discount_code/add') }}" class="btn btn-primary">Thêm mới mã giảm giá</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @include('admin.layouts.message')
                        <div class="card">
                            {{-- <div class="card-header">
                                <h3 class="card-title">List</h3>
                                <div class="card-tools">
                                    <ul class="pagination pagination-sm float-right">
                                        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                    </ul>
                                </div>
                            </div> --}}

                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tên mã giảm giá</th>
                                            <th>Type</th>
                                            <th>Phần trăm / Số lượng</th>
                                            <th>Hạn sử dụng</th>
                                            <th>Trạng thái</th>
                                            <th>Ngày tạo</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRecord as $value)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->type }}</td>
                                                <td>{{ $value->percent_amount }}</td>
                                                <td>{{ \Carbon\Carbon::parse($value->expire_date)->format('d-m-Y') }}</td>
                                                <td>{{ $value->status == 0 ? 'Hoạt dộng' : 'Không hoạt động' }}</td>
                                                <td>{{ date('y-m-Y', strtotime($value->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ url('admin/discount_code/edit/' . $value->id) }}"
                                                        class="btn btn-warning">
                                                        Sửa</a>
                                                    <a href="{{ url('admin/discount_code/delete/' . $value->id) }}"
                                                        class="btn btn-danger"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa mục này không?');">
                                                        Xóa</a>
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
        </section>

    </div>
@endsection
@section('script')
@endsection
