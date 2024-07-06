@extends('admin.layouts.app')

@section('style')
@endsection
@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sửa màu sắc</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{ url('admin/color/list') }}" class="btn btn-primary">Quay lại</a>
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
                                        <label>Tên màu sắc <span style="color:red">*</span></label>
                                        <input type="text" class="form-control" name="name" required
                                            value="{{ old('name', $getRecord->name) }}" placeholder="Nhập tên màu sắc">
                                    </div>

                                    <div class="form-group">
                                        <label>Code <span style="color:red">*</span></label>
                                        <input type="color" class="form-control" name="code" required
                                            value="{{ old('code', $getRecord->code) }}" placeholder="Code">

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
@endsection
