@extends('admin.layouts.app')

@section('style')
@endsection
@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sửa danh mục</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{ url('admin/category/list') }}" class="btn btn-primary">Quay lại</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <form action="" method="POST">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Tên danh mục <span style="color:red">*</span></label>
                                        <input type="text" class="form-control" name="name" required
                                            value="{{ old('name', $getRecord->name) }}" placeholder="Nhập tên danh mục">
                                    </div>

                                    <div class="form-group">
                                        <label>Slug <span style="color:red">*</span></label>
                                        <input type="text" class="form-control" name="slug" required
                                            value="{{ old('slug', $getRecord->slug) }}" placeholder="Slug Ex. URL">
                                        <div style="color:red">{{ $errors->first('slug') }}</div>
                                    </div>

                                    <div class="form-group">
                                        <label>Trạng thái <span style="color:red">*</span></label>
                                        <select class="form-control" name="status" id="" required>
                                            <option {{ $getRecord->status == 0 ? 'selected' : '' }} value="0">
                                                Hoạt động
                                            </option>
                                            <option {{ $getRecord->status == 1 ? 'selected' : '' }} value="1">
                                                Không hoạt động
                                            </option>
                                        </select>
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <label>Tiêu đề Meta <span style="color:red">*</span></label>
                                        <input type="text" class="form-control" name="meta_title" required
                                            value="{{ old('meta_title', $getRecord->meta_title) }}"
                                            placeholder="Nhập tiêu đề Meta">
                                    </div>

                                    <div class="form-group">
                                        <label>Mô tả Meta</label>
                                        <textarea name="meta_description" class="form-control" cols="30" rows="10" placeholder="Nhập mô tả Meta">{{ old('meta_description', $getRecord->meta_description) }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Từ khóa Meta</label>
                                        <input type="text" class="form-control" name="meta_keywords"
                                            value="{{ old('meta_keywords', $getRecord->meta_keywords) }}"
                                            placeholder="Nhập từ khóa Meta">
                                    </div>

                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
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
