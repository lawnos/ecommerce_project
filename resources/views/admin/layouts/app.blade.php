<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from adminlte.io/themes/v3/index3.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 26 Jun 2024 12:19:47 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ !empty($header_title) ? $header_title : '' }} | Ecommerce </title>

    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min2167.css?v=3.2.0') }}">

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@yield('script')

<style>
    #alert {
        transition: opacity 0.5s ease-in-out;
    }

    #alert.hidden {
        opacity: 0;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var alert = document.getElementById('alert');
        if (alert) {
            setTimeout(function () {
                alert.classList.add('hidden');
            }, 2000);

            setTimeout(function () {
                alert.style.display = 'none';
            }, 2500);
        }
    });
</script>


<script>
    @if(session('success'))
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
    });
    @endif
</script>

<script>
    $(document).ready(function () {
        $('.btn-status').click(function () {
            var button = $(this);
            var categoryId = button.data('id');
            var requestUrl = button.data('url');

            $.ajax({
                url: requestUrl,
                type: "POST",
                data: {
                    id: categoryId,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    if (response.status === 'success') {
                        if (response.new_status == 0) {
                            button.removeClass('btn-danger').addClass('btn-success');
                            button.text('Hoạt động');
                        } else {
                            button.removeClass('btn-success').addClass('btn-danger');
                            button.text('Không hoạt động');
                        }
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 2500,
                            timerProgressBar: true,
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi',
                            text: response.message,
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi',
                        text: 'Có lỗi xảy ra, vui lòng thử lại!',
                    });
                }
            });
        });
    });
</script>


</body>


</html>
