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
                <h1 class="page-title">Sản Phẩm Yêu Thích</h1>
            </div>
        </div>
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="javasrcipt:;">Sản phẩm yêu thích</a></li>

                </ol>
            </div>
        </nav>

        <div class="page-content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-9">
                        <div id="getProductAjax">
                            @include('product._list')
                        </div>
                    </div>
                    <div class="col-lg-12">

                        {!! $getProduct->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')
    <script src="{{ url('client/assets/js/wNumb.js') }}"></script>
    <script src="{{ url('client/assets/js/bootstrap-input-spinner.js') }}"></script>
    <script src="{{ url('client/assets/js/nouislider.min.js') }}"></script>

    <script type="text/javascript"></script>
@endsection
