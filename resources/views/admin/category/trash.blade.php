@extends('admin.layouts.app')

@section('style')
@endsection
@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Danh sách danh mục</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{ route('admin.category.list') }}" class="btn btn-primary"><i
                                class="fa-solid fa-arrow-left-long"></i> Quay lại</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        {{--                        @include('admin.layouts.message')--}}
                        <div class="card">

                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên danh mục</th>
                                        {{--                                            <th>Slug</th>--}}
                                        {{--                                            <th>Tiêu đề Meta</th>--}}
                                        {{--                                            <th>Mô tả Meta</th>--}}
                                        {{--                                            <th>Từ khóa Meta</th>--}}
                                        <th>Được tạo bởi</th>
                                        <th>Trạng thái</th>
                                        <th>Thời gian tạo</th>
                                        <th>Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if ($deletedCategories->isEmpty())
                                        <tr>
                                            <td colspan="10" class="text-center">Thùng rác trống.</td>
                                        </tr>
                                    @else
                                        @foreach ($deletedCategories as $value)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $value->name }}</td>
                                                {{--                                                <td>{{ $value->slug }}</td>--}}
                                                {{--                                                <td>{{ $value->meta_title }}</td>--}}
                                                {{--                                                <td>{{ $value->meta_description }}</td>--}}
                                                {{--                                                <td>{{ $value->meta_keywords }}</td>--}}
                                                <td>{{ $value->created_by_name }}</td>
                                                <td>{{ $value->status == 0 ? 'Hoạt dộng' : 'Không hoạt động' }}</td>
                                                <td>{{ date('y-m-Y', strtotime($value->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ route('admin.category.restore', $value->id) }}"
                                                       class="btn btn-success">Khôi phục</a>
                                                    <a href="{{ route('admin.category.forceDelete', $value->id) }}"
                                                       class="btn btn-danger"
                                                       onclick="return confirm('Bạn chắc chắn muốn xóa vĩnh viễn danh mục này?');">Xóa
                                                        vĩnh viễn</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>

                                    </tbody>
                                </table>
                                <div style="padding: 10px; float: right">
                                    {!! $deletedCategories->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
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




