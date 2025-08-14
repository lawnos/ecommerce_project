@extends('admin.layouts.app')

@section('style')
@endsection
@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Thêm mới danh mục</h1>
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
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{ old('name') }}" placeholder="Nhập tên danh mục">
                                        <div style="color:red">{{ $errors->first('name') }}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Slug <span style="color:red">*</span></label>
                                        <input type="text" class="form-control" id="slug" name="slug"
                                               value="{{ old('slug') }}" placeholder="Slug Ex. URL">
                                        <div style="color:red">{{ $errors->first('slug') }}</div>
                                    </div>


                                    <div class="form-group">
                                        <label>Trạng thái <span style="color:red">*</span></label>
                                        <select class="form-control" name="status" id="" required>
                                            <option {{ old('status') == 0 ? 'selected' : '' }} value="0">
                                                Hoạt động
                                            </option>
                                            <option {{ old('status') == 1 ? 'selected' : '' }} value="1">
                                                Không hoạt động
                                            </option>
                                        </select>
                                    </div>

                                    <hr>

                                    {{--                                    <div class="form-group ">--}}
                                    {{--                                        <label>Tiêu đề Meta <span style="color:red">*</span></label>--}}
                                    {{--                                        <input type="text" class="form-control" name="meta_title" required--}}
                                    {{--                                            value="{{ old('meta_title') }}" placeholder="Nhập tiêu đề Meta">--}}
                                    {{--                                    </div>--}}

                                    {{--                                    <div class="form-group ">--}}
                                    {{--                                        <label>Mô tả Meta</label>--}}
                                    {{--                                        <textarea name="meta_description" class="form-control" cols="30" rows="10"--}}
                                    {{--                                            placeholder="Nhập mô tả Meta">{{ old('meta_description') }}</textarea>--}}
                                    {{--                                    </div>--}}

                                    {{--                                    <div class="form-group ">--}}
                                    {{--                                        <label>Từ khóa Meta</label>--}}
                                    {{--                                        <input type="text" class="form-control" name="meta_keywords"--}}
                                    {{--                                            value="{{ old('meta_keywords') }}" placeholder="Nhập từ khóa Meta">--}}
                                    {{--                                    </div>--}}

                                </div>

                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Lưu</button>
                                    <a href="{{ route('admin.category.list') }}" class="btn btn-primary">Quay lại</a>
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
    <script>
        function convertToSlug(text) {
            text = text.toLowerCase().trim();

            const from = "áàảãạăắằẳẵặâấầẩẫậđéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựýỳỷỹỵ";
            const to = "aaaaaaaaaaaaaaaaadeeeeeeeeeeeiiiiiooooooooooooooooouuuuuuuuuuuyyyyy";

            for (let i = 0; i < from.length; i++) {
                text = text.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
            }

            text = text.replace(/[\s\W-]+/g, '-');
            text = text.replace(/^-+|-+$/g, '');

            return text;
        }

        document.getElementById('name').addEventListener('input', function () {
            const nameValue = this.value;
            const slugValue = convertToSlug(nameValue);
            document.getElementById('slug').value = slugValue;
        });
    </script>

@endsection
