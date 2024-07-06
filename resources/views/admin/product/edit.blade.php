@extends('admin.layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ url('assets/plugins/summernote/summernote-bs4.min.css') }}">
    <style>
        .delete-icon {
            transition: transform 0.2s ease-in-out;
        }

        .delete-icon:hover {
            transform: scale(1.2);
            color: white;
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sửa sản phẩm</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{ url('admin/product/list') }}" class="btn btn-primary">Quay lại</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @include('admin.layouts.message')
                        <div class="card card-primary">
                            <form action="" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tiêu đề <span style="color:red">*</span></label>
                                                <input type="text" class="form-control" name="title" required
                                                    value="{{ old('title', $product->title) }}"
                                                    placeholder="Nhập tên tiêu đề sản phẩm">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>SKU <span style="color:red">*</span></label>
                                                <input type="text" class="form-control" name="sku" required
                                                    value="{{ old('sku', $product->sku) }}" placeholder="Nhập SKU">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Danh mục <span style="color:red">*</span></label>
                                                <select class="form-control" name="category_id" id="ChangeCategory"
                                                    required>
                                                    <option value="">Chọn danh mục</option>
                                                    @foreach ($getCategory as $category)
                                                        <option
                                                            {{ $product->category_id == $category->id ? 'selected' : '' }}
                                                            value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Danh mục phụ<span style="color:red">*</span></label>
                                                <select class="form-control" name="sub_category_id" id="getSubCategory"
                                                    required>
                                                    <option value="">Chọn danh mục phụ</option>
                                                    @foreach ($getSubCategory as $subcategory)
                                                        <option
                                                            {{ $product->sub_category_id == $subcategory->id ? 'selected' : '' }}
                                                            value="{{ $subcategory->id }}">{{ $subcategory->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Thương hiệu<span style="color:red">*</span></label>
                                                <select class="form-control" name="brand_id" required>
                                                    <option value="">Chọn thương hiệu</option>
                                                    @foreach ($getBrand as $brand)
                                                        <option {{ $product->brand_id == $brand->id ? 'selected' : '' }}
                                                            value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Màu sắc <span style="color:red">*</span></label>
                                                <div>
                                                    @foreach ($getColor as $color)
                                                        @php
                                                            $checked = '';
                                                        @endphp
                                                        @foreach ($product->getColor as $product_color)
                                                            @if ($product_color->color_id == $color->id)
                                                                @php
                                                                    $checked = 'checked';
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                        <label style="margin-right: 10px;"><input {{ $checked }}
                                                                type="checkbox" value=" {{ $color->id }}"
                                                                name="color_id[]">
                                                            {{ $color->name }}</label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Giá (VND) <span style="color:red">*</span></label>
                                                <input type="text" class="form-control" name="price" required
                                                    value="{{ !empty($product->price) ? $product->price : '' }}"
                                                    placeholder="Nhập giá sản phẩm">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Giá cũ (VND) <span style="color:red">*</span></label>
                                                <input type="text" class="form-control" name="old_price" required
                                                    value="{{ !empty($product->old_price) ? $product->old_price : '' }}"
                                                    placeholder="Nhập giá cũ sản phẩm">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Kích cỡ <span style="color:red">*</span></label>
                                                <div>
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Tên</th>
                                                                <th>Giá (VND)</th>
                                                                <th>Hoạt động</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="AppendSize">
                                                            @php
                                                                $i_s = 1;
                                                            @endphp
                                                            @foreach ($product->getSize as $product_size)
                                                                <tr id="delete{{ $i_s }}">
                                                                    <td>
                                                                        <input type="text"
                                                                            value="{{ $product_size->name }}"
                                                                            name="size[{{ $i_s }}][name]"
                                                                            placeholder="Nhập tên" class="form-control">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text"
                                                                            value="{{ $product_size->price }}"
                                                                            name="size[{{ $i_s }}][price]"
                                                                            placeholder="Nhập giá" class="form-control">
                                                                    </td>
                                                                    <td style="width: 150px">
                                                                        <button type="button" id="{{ $i_s }}"
                                                                            class="btn btn-danger delete">Xóa</button>
                                                                    </td>
                                                                </tr>
                                                                @php
                                                                    $i_s++;
                                                                @endphp
                                                            @endforeach
                                                            <tr>
                                                                <td>
                                                                    <input type="text" name="size[100000][name]"
                                                                        placeholder="Nhập tên" class="form-control">
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="size[100000][price]"
                                                                        placeholder="Nhập giá" class="form-control">
                                                                </td>
                                                                <td style="width: 150px">
                                                                    <button type="button"
                                                                        class="btn btn-info AddSize">Thêm</button>
                                                                </td>
                                                            </tr>
                                                        </tbody>

                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Hình ảnh <span style="color:red"></span></label>
                                                <input type="file" name="image[]" id="" class="form-control"
                                                    style="padding: 3px;" multiple accept="image/*">
                                            </div>
                                        </div>
                                    </div>
                                    @if (!empty($product->getImage->count()))
                                        <div class="row" id="sortable">
                                            @foreach ($product->getImage as $image)
                                                @if (!empty($image->getLogo()))
                                                    <div class="col-md-1 image-container sortable_image"
                                                        id="{{ $image->id }}"
                                                        style="position: relative; display: inline-block;">
                                                        <img src="{{ $image->getLogo() }}" alt=""
                                                            style="width: 100%; height: 120px;">
                                                        <span class="delete-icon delete-image"
                                                            data-id="{{ $image->id }}"
                                                            style="position: absolute; 
                                                                    top: 0px;
                                                                    right: 5px; 
                                                                    cursor: pointer; 
                                                                    padding-right: 7px;">
                                                            <a href="{{ url('admin/product/image_delete/' . $image->id) }}"
                                                                style="color: inherit; text-decoration: none;"
                                                                onclick="return confirm('Bạn có chắc chắn muốn xóa ảnh này không?')"><i
                                                                    class="fas fa-times"></i></a>
                                                        </span>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                    <hr>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Mô tả ngắn <span style="color:red">*</span></label>
                                                <textarea class="form-control" name="short_description" placeholder="Nhập mô tả ngắn">{{ $product->short_description }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Mô tả <span style="color:red">*</span></label>
                                                <textarea class="form-control editor" name="description" placeholder="Nhập mô tả">{{ $product->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Thông tin thêm <span style="color:red">*</span></label>
                                                <textarea class="form-control editor" name="additional_information" placeholder="Nhập mô thông tin thêm">{{ $product->additional_information }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Chuyển hàng trả lại <span style="color:red">*</span></label>
                                                <textarea class="form-control editor" name="shipping_returns" placeholder="Nhập hàng trả lại">{{ $product->shipping_returns }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Trạng thái <span style="color:red">*</span></label>
                                                <select class="form-control" name="status" id="" required>
                                                    <option {{ $product->status == 0 ? 'selected' : '' }} value="0">
                                                        Hoạt động
                                                    </option>
                                                    <option {{ $product->status == 1 ? 'selected' : '' }} value="1">
                                                        Không hoạt động
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
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
    <script src="{{ url('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    {{-- <script src="{{ url('assets/dist/jquery-ui.js') }}"></script> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> --}}
    
    <script src="{{ url('assets/dist/jquery-ui.js') }}"></script>

    <script type="text/javascript">
        $(function() {
            $("#sortable").sortable({
                update: function(event, ui) {
                    var photo_id = new Array();
                    $('.sortable_image').each(function() {
                        var id = $(this).attr('id');
                        photo_id.push(id);
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('admin/product_image_sortable') }}",
                        data: {
                            "photo_id": photo_id,
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {},
                        error: function(data) {}
                    });
                }
            });
        });

        $('.editor').summernote({
            height: 200
        });



        var i = 100000;
        $('body').delegate('.AddSize', 'click', function() {
            i++;
            var html = '<tr id="delete' + i + '">\n\
                                    <td>\n\
                                        <input type="text" name="size[' + i + '][name]" placeholder="Nhập tên" class="form-control">\n\
                                    </td>\n\
                                    <td>\n\
                                        <input type="text" name="size[' + i + '][price]" placeholder="Nhập giá" class="form-control">\n\
                                    </td>\n\
                                    <td style="width: 150px">\n\
                                        <button type="button" id="' + i + '" class="btn btn-danger delete">Xóa</button>\n\
                                    </td>\n\
                                    </tr>';
            $('#AppendSize').append(html);
        });


        $('body').delegate('.delete', 'click', function() {
            var id = $(this).attr('id');
            $('#delete' + id).remove();
        });


        $('body').delegate('#ChangeCategory', 'change', function(e) {
            var id = $(this).val();
            $.ajax({
                type: "POST",
                url: "{{ url('admin/get_sub_category') }}",
                data: {
                    "id": id,
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(data) {
                    $('#getSubCategory').html(data.html)
                },
                error: function(data) {}
            });
        });
    </script>
@endsection
