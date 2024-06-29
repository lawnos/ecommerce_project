<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from adminlte.io/themes/v3/index3.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 26 Jun 2024 12:19:47 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ecommerce | Dashboard </title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min2167.css?v=3.2.0') }}">
    @yield('style')
</head>

<body class="hold-transition sidebar-mini">

    <div class="wrapper">
        @include('admin.layouts.header')
        @yield('content')
        @include('admin.layouts.footer')
    </div>

    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/dist/js/adminlte2167.js?v=3.2.0') }}"></script>

    <script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>

    <script src="{{ asset('assets/dist/js/demo.js') }}"></script>

    <script src="{{ asset('assets/dist/js/pages/dashboard3.js') }}"></script>

    @yield('script')

</body>

<!-- Mirrored from adminlte.io/themes/v3/index3.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 26 Jun 2024 12:19:49 GMT -->

</html>
