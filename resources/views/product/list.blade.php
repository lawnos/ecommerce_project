@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ url('client/assets/css/plugins/nouislider/nouislider.css') }}">
    <style>
        .active-color {
            border: 3px solid #727171 !important;
        }
    </style>
@endsection
@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('client/assets/images/page-header-bg.jpg')">
            <div class="container">
                @if (!empty($getSubCategory))
                    <h1 class="page-title">{{ $getSubCategory->name }}</h1>
                @else
                    <h1 class="page-title">{{ $getCategory->name }}</h1>
                @endif

            </div>
        </div>
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="javasrcipt:;">Cửa hàng</a></li>
                    @if (!empty($getSubCategory))
                        <li class="breadcrumb-item" aria-current="page">
                            <a href="{{ url($getCategory->slug) }}">{{ $getCategory->name }}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $getSubCategory->name }}</li>
                    @else
                        <li class="breadcrumb-item active" aria-current="page">{{ $getCategory->name }}</li>
                    @endif

                </ol>
            </div>
        </nav>

        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="toolbox">
                            <div class="toolbox-left">
                                <div class="toolbox-info">
                                    Showing <span>9 of 56</span> Products
                                </div>
                            </div>

                            <div class="toolbox-right">
                                <div class="toolbox-sort">
                                    <label for="sortby">Sắp xếp theo:</label>
                                    <div class="select-custom">
                                        <select name="sortby" id="sortby" class="form-control ChangSortBy">
                                            <option value="">---</option>
                                            <option value="popularity">Phổ biến nhất</option>
                                            <option value="rating">Được đánh giá cao nhất</option>
                                            <option value="date">Ngày</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="getProductAjax">
                            @include('product._list')
                        </div>
                    </div>

                    <aside class="col-lg-3 order-lg-first">
                        <form action="" id="FilterForm" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="sub_category_id" id="get_sub_category_id">
                            <input type="hidden" name="brand_id" id="get_brand_id">
                            <input type="hidden" name="color_id" id="get_color_id">
                            <input type="hidden" name="sort_by_id" id="get_sort_by_id">
                        </form>
                        <div class="sidebar sidebar-shop">
                            <div class="widget widget-clean">
                                <label>Bộ lọc:</label>
                                <a href="#" class="sidebar-filter-clear">Làm mới</a>
                            </div>

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true"
                                        aria-controls="widget-1">
                                        Danh mục
                                    </a>
                                </h3>

                                <div class="collapse show" id="widget-1">
                                    <div class="widget-body">
                                        <div class="filter-items filter-items-count">
                                            @foreach ($getSubCategoryFilter as $filter_sub)
                                                <div class="filter-item">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input ChangeCategory"
                                                            id="cat-{{ $filter_sub->id }}" value="{{ $filter_sub->id }}">
                                                        <label class="custom-control-label"
                                                            for="cat-{{ $filter_sub->id }}">{{ $filter_sub->name }}</label>
                                                    </div>
                                                    <span class="item-count">{{ $filter_sub->TotalProduct() }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-3" role="button" aria-expanded="true"
                                        aria-controls="widget-3">
                                        Màu sắc
                                    </a>
                                </h3>

                                <div class="collapse show" id="widget-3">
                                    <div class="widget-body">
                                        <div class="filter-colors">
                                            @foreach ($getColor as $filter_color)
                                                <a href="javascript:;" class="ChangeColor" id="{{ $filter_color->id }}"
                                                    data-val="0" style="background: {{ $filter_color->code }};"><span
                                                        class="sr-only">{{ $filter_color->name }}</span></a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true"
                                        aria-controls="widget-4">
                                        Thương hiệu
                                    </a>
                                </h3>

                                <div class="collapse show" id="widget-4">
                                    <div class="widget-body">
                                        <div class="filter-items">
                                            @foreach ($getBrand as $filter_brand)
                                                <div class="filter-item">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input ChangeBrand"
                                                            value="{{ $filter_brand->id }}"
                                                            id="brand-{{ $filter_brand->id }}">
                                                        <label class="custom-control-label"
                                                            for="brand-{{ $filter_brand->id }}">{{ $filter_brand->name }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true"
                                        aria-controls="widget-5">
                                        Giá
                                    </a>
                                </h3>

                                <div class="collapse show" id="widget-5">
                                    <div class="widget-body">
                                        <div class="filter-price">
                                            <div class="filter-price-text">
                                                Phạm vi giá:
                                                <span id="filter-price-range"></span>
                                            </div>

                                            <div id="price-slider"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')
    <script src="{{ url('client/assets/js/wNumb.js') }}"></script>
    <script src="{{ url('client/assets/js/bootstrap-input-spinner.js') }}"></script>
    <script src="{{ url('client/assets/js/nouislider.min.js') }}"></script>

    <script type="text/javascript">
        $('.ChangSortBy').change(function() {
            var id = $(this).val();
            $('#get_sort_by_id').val(id);
            FilterForm();
        });

        $('.ChangeCategory').change(function() {
            var ids = '';
            $('.ChangeCategory').each(function() {
                if (this.checked) {
                    var id = $(this).val();
                    ids += id + ',';
                }
            });
            $('#get_sub_category_id').val(ids);
            FilterForm();
        });

        $('.ChangeBrand').change(function() {
            var ids = '';
            $('.ChangeBrand').each(function() {
                if (this.checked) {
                    var id = $(this).val();
                    ids += id + ',';
                }
            });

            $('#get_brand_id').val(ids);
            FilterForm();
        });

        $('.ChangeColor').click(function() {
            var id = $(this).attr('id');
            var status = $(this).attr('data-val');
            if (status == 0) {
                $(this).attr('data-val', 1)
                $(this).addClass('active-color');
            } else {
                $(this).attr('data-val', 0)
                $(this).removeClass('active-color');
            }

            var ids = '';
            $('.ChangeColor').each(function() {
                var status = $(this).attr('data-val');
                if (status == 1) {
                    var id = $(this).attr('id');
                    ids += id + ',';
                }
            });
            $('#get_color_id').val(ids);
            FilterForm();
        });

        function FilterForm() {
            $.ajax({
                type: "POST",
                url: "{{ url('get_filter_product_ajax') }}",
                data: $('#FilterForm').serialize(),
                dataType: "json",
                success: function(data) {
                    $('#getProductAjax').html(data.success);
                },
                error: function(data) {
                    console.error('Error:', data);
                }
            });
        }
    </script>
@endsection
