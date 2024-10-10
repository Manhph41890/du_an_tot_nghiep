<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from htmldemo.net/looki/looki/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Oct 2024 09:35:59 GMT -->

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="" />
    <title>Looki - Beauty & Cosmetics eCommerce Bootstrap 5 Template</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/admin/img/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/fontawesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/ionicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/simple-line-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/plugins/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/plugins/plugins.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.min.css') }}" />

</head>

<body>

    @include('client.partials.header')


    @yield('content')
    <!-- brand slider end -->
    @include('client.partials.footer')


    <script src="{{ asset('assets/admin/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/vendor/jquery-migrate-3.3.2.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/vendor/modernizr-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/plugins.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/ajax-contact.js') }}"></script>
    <script src="{{ asset('assets/admin/js/main.js') }}"></script>



</body>

</html>
