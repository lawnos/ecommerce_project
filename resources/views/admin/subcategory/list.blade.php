@extends('admin.layouts.app')

@section('style')
@endsection
@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Danh sách danh mục phụ</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{ url('admin/sub_category/add') }}" class="btn btn-primary">Thêm mới danh mục phụ</a>
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
                                            <th>Tên danh mục</th>
                                            <th>Tên danh mục phụ</th>
                                            <th>Slug</th>
                                            <th>Tiêu đề Meta</th>
                                            <th>Mô tả Meta</th>
                                            <th>Từ khóa Meta</th>
                                            <th>Được tạo bởi</th>
                                            <th>Trạng thái</th>
                                            <th>Thời gian tạo</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRecord as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->category_name }}</td>
                                                <td>{{ $value->slug }}</td>
                                                <td>{{ $value->meta_title }}</td>
                                                <td>{{ $value->meta_description }}</td>
                                                <td>{{ $value->meta_keywords }}</td>
                                                <td>{{ $value->created_by_name }}</td>
                                                <td>{{ $value->status == 0 ? 'Hoạt dộng' : 'Không hoạt động' }}</td>
                                                <td>{{ date('y-m-Y', strtotime($value->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ url('admin/sub_category/edit/' . $value->id) }}"
                                                        class="btn btn-warning">
                                                        Sửa</a>
                                                    <a href="{{ url('admin/sub_category/delete/' . $value->id) }}"
                                                        class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa mục này không?');">
                                                        Xóa</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div style="padding: 10px; float: right;">
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
    <script src="{{ asset('assets/dist/js/pages/dashboard3.js') }}"></script>
@endsection
