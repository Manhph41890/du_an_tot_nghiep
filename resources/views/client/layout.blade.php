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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha384-dyB8oeAf6iLs/n8TYqyeK1zwy6/iDVB+P5vDXR1RylsNcsSD5T3U7Kbk4WV0bv+W" crossorigin="anonymous">


    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <style>
        body {
            font-family: "Itim", cursive;
        }

        .bg-img1 {
            background-image: url('./assets/client/images/banner/Banner1@2x.png');
            width: 50%;
        }

        .bg-img2 {
            background-image: url('./assets/client/images/banner/Banner2.png');
        }

        .bg-img3 {
            background-image: url('./assets/client/images/banner/Banner3.png');
        }

        .breadcrumb-section {
            background-image: url('/assets/client/images/banner/banner_0.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            /* height: 568px; */
        }

        .discount-codes {
            padding: 50px 0;
            background-color: #f9f9f9;
        }

        .discount-codes .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .discount-codes .section-title {
            text-align: center;
            font-size: 2em;
            margin-bottom: 30px;
            color: #333;
        }

        .discount-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .discount-item {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 250px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .discount-item:hover {
            transform: scale(1.05);
        }

        .discount-code {
            font-size: 1.5em;
            font-weight: bold;
            color: #5C5BCA;
            margin-bottom: 15px;
        }

        .discount-description {
            font-size: 1.3em;
            color: #777;
            margin-bottom: 15px;
        }

        .copy-btn {
            background-color: #5C5BCA;
            color: white;
            padding: 15px 25px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .copy-btn:hover {
            background-color: #4a4db3;
        }

        .hot-tag {
            color: #fd0000;
            /* Màu tuyết */
            font-weight: bold;
            position: relative;
            padding: 0 10px;
            animation: blink 1s infinite alternate;
            /* Hiệu ứng nhấp nháy */
        }

        /* Hiệu ứng nhấp nháy cho chữ "HOT" */
        @keyframes blink {
            0% {
                opacity: 1;
            }

            100% {
                opacity: 0.6;
            }
        }

        /* Bông tuyết xung quanh chữ "HOT" */
        .hot-tag::before,
        .hot-tag::after {
            content: "❄️";
            position: absolute;
            color: #ffffff;
            font-size: 1.2em;
            animation: snowflake-blink 1.5s infinite alternate;
        }

        /* Vị trí bông tuyết bên trái */
        .hot-tag::before {
            top: -5px;
            left: -15px;
            animation-delay: 0.2s;
        }

        /* Vị trí bông tuyết bên phải */
        .hot-tag::after {
            top: -5px;
            right: -15px;
            animation-delay: 0.5s;
        }

        /* Hiệu ứng nhấp nháy cho bông tuyết */
        @keyframes snowflake-blink {
            0% {
                opacity: 1;
            }

            100% {
                opacity: 0.5;
            }
        }


        .discount-item {
            position: relative;
            padding: 15px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .discount-code {
            font-size: 18px;
            font-weight: bold;
        }

        /* Hiệu ứng cho button sao chép */
        .copy-btn {
            margin-top: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 8px 15px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .copy-btn:hover {
            background-color: #218838;
        }

        /* Mặc định ẩn modal */
        .copy-modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            border-radius: 10px;
            z-index: 1000;
        }

        /* Chỉnh sửa nội dung modal */
        .modal-content {
            text-align: center;
        }

        /* Thêm hiệu ứng chuyển động cho modal */
        .copy-modal.show {
            display: block;
            animation: fadeInOut 3s forwards;
        }

        /* Hiệu ứng fade in và fade out */
        @keyframes fadeInOut {
            0% {
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
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
        window.addEventListener('scroll', function(e) {
            // Nội dung sự kiện cuộn
        }, {
            passive: true
        });
    </script>
</body>

</html>
