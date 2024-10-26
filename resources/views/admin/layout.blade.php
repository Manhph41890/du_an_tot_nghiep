<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc." />
    <meta name="author" content="Zoyothemes" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{ $title }}</title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/admin/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('assets/admin/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{ asset('assets/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha384-..." crossorigin="anonymous">

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha384-..." crossorigin="anonymous">

    {{-- biểu đồ  --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- toast  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <style>
        h4 {
            color: white;
            text-transform: uppercase;
            font-weight: 600;
        }

        body {
            position: relative;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background-image: url('assets/admin/images/bg.png');
            background-size: cover;
            background-position: center;
            filter: blur(3px);
            /* Adjust the blur level as needed */
            z-index: -1;
            /* Keep the blurred background behind other content */
        }
    </style>
</head>

<!-- body start -->

<body data-menu-color="light" data-sidebar="default">


    <script>
        $(document).ready(function() {
            @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}", "Thông báo", {
                progressBar: true,
                closeButton: true,
                timeOut: 3000
            });
            @endif
            @if(Session::has('error'))
            toastr.error("{{ Session::get('error') }}", "Thông báo", {
                progressBar: true,
                closeButton: true,
                timeOut: 3000
            });
            @endif
        });
    </script>

    <!-- Begin page -->
    <div id="app-layout">
        @include('admin.partials.header')
        @include('admin.partials.siderbar')


        <!-- Start Page Content here -->
        @yield('content')
        <!-- End Page content -->

        {{-- @include('admin.partials.footer') --}}
    </div>
    <!-- END wrapper -->

    <!-- Vendor Scripts -->
    <script src="{{ asset('assets/admin/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/feather-icons/feather.min.js') }}"></script>

    <!-- Apexcharts JS -->
    <script src="{{ asset('assets/admin/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Stock prices script -->
    <script src="{{ asset('assets/admin/apexcharts.com/samples/assets/admin/stock-prices.js') }}"></script>

    <!-- Widgets Init Js -->
    <script src="{{ asset('assets/admin/js/pages/analytics-dashboard.init.js') }}"></script>

    <!-- App js-->
    <script src="{{ asset('assets/admin/js/app.js') }}"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>



</body>

</html>