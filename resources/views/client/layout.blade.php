<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="{{ $description ?? 'Default description' }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>ArtiCraft</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/client/img/logo/logo_art.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/client/css/fontawesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/client/css/ionicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/client/css/simple-line-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/client/css/plugins/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/client/css/plugins/plugins.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/client/css/style.min.css') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <style>
        body {
            font-family: "Itim", cursive;
        }

        .bg-img1 {
            background-image: url('./assets/client/images/banner/slider_1.jpg');
            width: 50%;
        }

        .bg-img2 {
            background-image: url('./assets/client/images/banner/bottom_banner_1.jpg');
        }

        .bg-img3 {
            background-image: url('./assets/client/images/slider/banner_3.jpg');
        }

        .breadcrumb-section {
            background-image: url('/assets/client/images/banner/slider_1.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>

</head>

<body>


    <script>
        $(document).ready(function() {
            @if (Session::has('success'))
                toastr.success("{{ Session::get('success') }}", "Thông báo", {
                    progressBar: true,
                    closeButton: true,
                    timeOut: 3000
                });
            @endif
            @if (Session::has('error'))
                toastr.error("{{ Session::get('error') }}", "Thông báo", {
                    progressBar: true,
                    closeButton: true,
                    timeOut: 3000
                });
            @endif
        });
    </script>

    @include('client.partials.header')

    @yield('content')

    @include('client.partials.footer')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('assets/client/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('assets/client/js/vendor/jquery-migrate-3.3.2.min.js') }}"></script>
    <script src="{{ asset('assets/client/js/vendor/modernizr-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/client/js/plugins/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/client/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/client/js/plugins/plugins.js') }}"></script>
    <script src="{{ asset('assets/client/js/plugins/ajax-contact.js') }}"></script>
    <script src="{{ asset('assets/client/js/main.js') }}"></script>

    {{-- toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#profileDropdown').on('click', function() {
                $(this).next('.dropdown-menu').toggle();
            });
        });
        $(document).ready(function() {
            @if (Session::has('success'))
                toastr.success("{{ Session::get('success') }}", "Thông báo", {
                    progressBar: true,
                    closeButton: true,
                    timeOut: 3000
                });
            @endif
            @if (Session::has('error'))
                toastr.error("{{ Session::get('error') }}", "Thông báo", {
                    progressBar: true,
                    closeButton: true,
                    timeOut: 3000
                });
            @endif
        });
    </script>
    @yield('js')
</body>

</html>
