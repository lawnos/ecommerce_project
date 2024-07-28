@extends('admin.layouts.app')

@section('style')
@endsection
@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sửa mã giảm giá</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{ url('admin/discount_code/list') }}" class="btn btn-primary">Quay lại</a>
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
                                        <label>Tên mã giảm giá <span style="color:red">*</span></label>
                                        <input type="text" class="form-control" name="name" required
                                            value="{{ old('name', $getRecord->name) }}" placeholder="Nhập tên mã giảm giá ">
                                    </div>

                                    <div class="form-group">
                                        <label>Type <span style="color:red">*</span></label>
                                        <select class="form-control" name="type" id="" required>
                                            <option {{ old('type', $getRecord->type) == 'Số lượng' ? 'selected' : '' }}
                                                value="Số lượng">
                                                Số lượng
                                            </option>
                                            <option {{ old('type', $getRecord->type) == 'Phần trăm' ? 'selected' : '' }}
                                                value="Phần trăm">
                                                Phần trăm
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Phần trăm / Số lượng<span style="color:red">*</span></label>
                                        <input type="text" class="form-control" name="percent_amount" required
                                            value="{{ old('percent_amount', $getRecord->percent_amount) }}"
                                            placeholder="Nhập phần trăm / số lượng">
                                    </div>

                                    <div class="form-group">
                                        <label>Hạn sử dụng<span style="color:red">*</span></label>
                                        <input type="date" class="form-control" name="expire_date" required
                                            value="{{ old('expire_date', $getRecord->expire_date) }}"
                                            placeholder="Nhập hạn sử dụng">
                                    </div>

                                    <div class="form-group">
                                        <label>Trạng thái <span style="color:red">*</span></label>
                                        <select class="form-control" name="status" id="" required>
                                            <option {{ old('status', $getRecord->status) == 0 ? 'selected' : '' }}
                                                value="0">
                                                Hoạt động
                                            </option>
                                            <option {{ old('status', $getRecord->status) == 1 ? 'selected' : '' }}
                                                value="1">
                                                Không hoạt động
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Gửi</button>
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
