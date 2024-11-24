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
            background-image: url('./assets/client/images/banner/banner.png');
            width: 50%;
        }

        .bg-img2 {
            background-image: url('./assets/client/images/banner/Banner2.jpg');
        }

        .bg-img3 {
            background-image: url('./assets/client/images/banner/Banner3.png');
        }

        .breadcrumb-section {
            background-image: url('/assets/client/images/banner/banner_0.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
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
            color: #5a5ac9;
            font-weight: 700;
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
            font-weight: bold;
            position: relative;
            padding: 0 10px;
            animation: blink 1s infinite alternate;
        }

        @keyframes blink {
            0% {
                opacity: 1;
            }

            100% {
                opacity: 0.6;
            }
        }

        /* Bông tuyết xung quanh chữ "HOT" */
        /* .hot-tag::before,
        .hot-tag::after {
            content: "❄️";
            position: absolute;
            color: #ffffff;
            font-size: 1.2em;
            animation: snowflake-blink 1.5s infinite alternate;
        } */

        /* Vị trí bông tuyết bên trái */
        .hot-tag::before {
            top: -5px;
            left: -15px;
            animation-delay: 0.2s;
        }

        .hot-tag::after {
            top: -5px;
            right: -15px;
            animation-delay: 0.5s;
        }

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

        .border-bottom .section-title .title,
        .footer-menu li a,
        .footer-widget .text {
            color: #fff !important;
        }

        /* Thêm hiệu ứng chuyển động cho modal */
        .copy-modal.show {
            display: block;
            animation: fadeInOut 3s forwards;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: "Itim", cursive;
            margin: 0;
            line-height: 1.25;
            color: #5a5ac9;
        }

        .product-tab {
            background-color: #ffffff;
            padding-top: 80px;
            padding-bottom: 50px;
        }

        .discount-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .discount-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .discount-icon img {
            width: 60px;
            height: 39px;
            object-fit: cover;
            margin-top: -30px;
        }

        .discount-content {
            flex-grow: 1;
            padding-left: 0px;
            margin-left: -5px;

            line-height: 1;
        }

        .zigzag {

            text-align: center;
            line-height: 1;
        }


        .discount-code {
            font-size: 1.25em;
            font-weight: 700;
            color: #5c5bca;
            margin-bottom: 10px;
        }

        .discount-description {
            text-align: center;
            font-size: 14px;
            color: #555;
            line-height: 1.5;
        }

        .discount-description p {
            margin: 0;
        }

        .text-danger {
            color: #e74c3c;
            font-weight: bold;
        }

        .copy-btn {
            background-color: #1e98f6;
            color: white;
            border: none;
            width: 80px;
            height: 40px;
            padding: 0;
            font-size: 15px;
            border-radius: 25px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .copy-btn:hover {
            background-color: #4a4db3;
            transform: scale(1.05);
        }

        .copy-btn:focus {
            outline: none;
        }

        /* Styling for the container */
        .discounts-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .copy-btn:hover {
            background-color: #0056b3;
        }

        .copy-modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.7);
            padding: 1rem;
            border-radius: 8px;
            color: #fff;
            text-align: center;
            z-index: 9999;
        }

        .copy-modal .modal-content {
            background-color: #333;
            padding: 1rem;
            border-radius: 8px;
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

        /* Lớp phủ toàn màn hình */
        #loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #c7d2dd;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            visibility: visible;
            opacity: 1;
            transition: opacity 1s ease;
        }

        /* Phần tử bao quanh ảnh và vệt quay */
        .loading-spinner {
            position: relative;
            width: 150px;
            height: 150px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
        }

        /* Ảnh không quay */
        .loading-image {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: contain;
        }

        /* Vệt quay quanh ảnh */
        .spin-ring {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 5px solid transparent;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            animation: spin 2s linear infinite;
        }

        /* Hiệu ứng quay tròn */
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

</head>

<body>
    <div id="loading-overlay" class="loading-overlay">
        <div class="loading-spinner">
            <img src="{{ asset('assets/client/images/logo/load-removebg.png') }}" alt="Loading Image"
                class="loading-image">
            <div class="spin-ring"></div>
        </div>
    </div>

    <script>
        window.addEventListener('load', () => {
            const loadingOverlay = document.getElementById('loading-overlay');
            // Sau 3 giây, ẩn lớp phủ
            setTimeout(() => {
                loadingOverlay.style.opacity = '0';
                loadingOverlay.style.visibility = 'hidden';
            }, 1000);
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
    @yield('js')
</body>

</html>
