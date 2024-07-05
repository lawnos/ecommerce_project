@extends('admin.layouts.app')

@section('style')
@endsection
@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Danh sách sản phẩm</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{ url('admin/product/add') }}" class="btn btn-primary">Thêm mới sản phẩm</a>
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
                                            <th>Tiêu đề</th>
                                            {{-- <th>Slug</th> --}}
                                            <th>Được tạo bởi</th>
                                            <th>Trạng thái</th>
                                            <th>Thời gian tạo</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRecord as $value)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $value->title }}</td>
                                                {{-- <td>{{ $value->slug }}</td> --}}
                                                <td>{{ $value->created_by_name }}</td>
                                                <td>{{ $value->status == 0 ? 'Hoạt dộng' : 'Không hoạt động' }}</td>
                                                <td>{{ date('y-m-Y', strtotime($value->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ url('admin/product/edit/' . $value->id) }}"
                                                        class="btn btn-warning">
                                                        Sửa</a>
                                                    <a href="{{ url('admin/product/delete/' . $value->id) }}"
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
