@extends('client.layout')

@section('content')
    <style>
        .notification-dot {
            width: 20px;
            /* Điều chỉnh lại kích thước chấm đỏ */
            height: 20px;
            /* Điều chỉnh lại kích thước chấm đỏ */
            background-color: red;
            border-radius: 50%;
            position: absolute;
            top: -60px;
            /* Điều chỉnh vị trí chấm đỏ */
            left: 240px;
            /* Điều chỉnh vị trí chấm đỏ */
            color: white;
            /* Màu chữ trắng */
            display: flex;
            align-items: center;
            /* Căn giữa chữ theo chiều dọc */
            justify-content: center;
            /* Căn giữa chữ theo chiều ngang */
            font-size: 12px;
            /* Kích thước chữ */
            animation: pulse 1s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
                /* Kích thước ban đầu */
            }

            50% {
                transform: scale(0.8);
                /* Thu nhỏ */
            }
        }


        .notification-dot2 {
            width: 10px;
            height: 10px;
            background-color: red;
            border-radius: 50%;
            border: 2px solid white;
            position: absolute;
            top: -22px;
            left: -10px;
            /* animation: pulse 1s infinite; */
        }
    </style>
    <!-- breadcrumb-section start -->
    <nav class="breadcrumb-section theme1 bg-lighten2 pt-110 pb-110">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title pb-4 text-dark text-capitalize" style=" color: #fff !important">Thông tin tài khoản
                        </h2>
                    </div>
                </div>
                <div class="col-12">
                    <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
                        <li class="breadcrumb-item"><a href="{{ route('client.home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Thông tin tài khoản</li>
                    </ol>
                </div>
            </div>
        </div>
    </nav>
    <!-- breadcrumb-section end -->
    <!-- product tab start -->

    <div class="my-account pt-80 pb-50">
        <div class="container">
            <div class="row">
                <!-- <div class="col-12">                                                                                                                                                          </div> -->
                <!-- My Account Tab Menu Start -->
                <div class="col-lg-3 col-12 mb-30">
                    <div class="myaccount-tab-menu nav" role="tablist">
                        <a href="{{ route('taikhoan.thongtin') }}"
                            class="{{ Request::routeIs('taikhoan.thongtin') ? 'active' : '' }}">
                            <i class="fa fa-user"></i> Chi tiết tài khoản
                        </a>

                        @if ($user->chuc_vu->ten_chuc_vu === 'nhan_vien' || $user->chuc_vu->ten_chuc_vu === 'admin')
                            <a href="{{ route('taikhoan.quantri') }}"
                                class="{{ Request::routeIs('taikhoan.quantri') ? 'active' : '' }}">
                                <i class="fas fa-tachometer-alt"></i> Vào trang quản trị
                            </a>
                        @endif

                        <a href="{{ route('taikhoan.donhang') }}"
                            class="{{ Request::routeIs('taikhoan.donhang') ? 'active' : '' }}">
                            <i class="fa fa-cart-arrow-down"></i> Đơn hàng của bạn
                        </a>

                        @php
                            $tongDonHang = DB::table('don_hangs')
                                ->where('trang_thai_don_hang', 'Chờ xác nhận')
                                ->where('user_id', Auth::id())
                                ->count();
                        @endphp

                        @if ($tongDonHang > 0)
                            <span class="ms-2 position-relative">
                                <span class="notification-dot">{{ $tongDonHang }}</span>
                            </span>
                        @endif

                        <a href="{{ route('taikhoan.vitien') }}"
                            class="{{ Request::routeIs('taikhoan.vitien') ? 'active' : '' }}">
                            <i class="fa fa-credit-card"></i> Ví người dùng
                        </a>
                    </div>

                </div>
                <!-- My Account Tab Menu End -->

                <!-- My Account Tab Content Start -->
                <div class="col-lg-9 col-12 mb-30">
                    <div class="container-fluid">

                        @yield('conten-taikhoan')

                    </div>

                    <!-- Single Tab Content End -->
                </div>

                {{-- aa a --}}

                <!-- My Account Tab Content End -->
            </div>
        </div>
    </div>

    {{-- ssssss --}}
    <script>
        document.getElementById('change-avatar-form').addEventListener('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            fetch('{{ route('taikhoan.dashboard.avatar') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update the image src without reloading
                        document.querySelector('img[alt="Profile Image"]').src = data.newAvatarUrl;
                        // Hide the form
                        document.getElementById('change-avatar-form').style.display = 'none';
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>

    {{-- xử lý ảnh + thông tin --}}
    <script>
        // Define routes in a JavaScript object
        const routes = {
            taikhoanDashboard: "{{ route('taikhoan.dashboard') }}",
            updateThongtin: "{{ route('update_thongtin') }}",
            avatarUpdate: "{{ route('taikhoan.dashboard.avatar') }}"
        };

        function toggleGioiTinh() {
            const gioiTinhField = document.getElementById('gioi_tinh');

            // Loại bỏ thuộc tính disabled để có thể thao tác
            gioiTinhField.disabled = false;

            // Có thể thay đổi thêm style hoặc class nếu cần thiết (tùy chỉnh thêm)
            gioiTinhField.style.backgroundColor = "#fff"; // Ví dụ thay đổi màu nền khi có thể chỉnh sửa
        }
        // Function to toggle edit mode
        function toggleEdit() {
            document.querySelectorAll(
                '#user-info-form input[type="text"],#user-info-form input[type="email"], #user-info-form input[type="number"], #user-info-form input[type="date"],#user-info-form select'
            ).forEach(field => {

                field.disabled = !field.disabled;
            });
            toggleGioiTinh();
            document.getElementById('toggleEditBtn').style.display = 'none';
            document.getElementById('saveBtn').style.display = 'inline-block';
        }


        // Function to show avatar change form
        function toggleAvatarForm(event) {
            event.preventDefault();
            document.getElementById('change-avatar-form').style.display = 'block';
            document.getElementById('avatarSaveBtn').style.display = 'inline-block';
        }

        // Function to set the form action dynamically
        function setFormAction(routeName) {
            if (routes[routeName]) {
                document.getElementById('user-info-form').action = routes[routeName];
            } else {
                console.error(`Route [${routeName}] is not defined.`);
            }
        };
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const accountInfoTab = document.querySelector('[href="#account-info"]');
            const ordersTab = document.querySelector('[href="#orders"]');
            const paymentMethodTab = document.querySelector('[href="#payment-method"]');

            accountInfoTab.addEventListener('click', function() {
                document.getElementById('account-info').style.display = 'block';
                document.getElementById('orders').style.display = 'none';
                document.getElementById('payment-method').style.display = 'none';
            });

            ordersTab.addEventListener('click', function() {
                document.getElementById('account-info').style.display = 'none';
                document.getElementById('orders').style.display = 'block';
                document.getElementById('payment-method').style.display = 'none';
            });

            paymentMethodTab.addEventListener('click', function() {
                document.getElementById('account-info').style.display = 'none';
                document.getElementById('orders').style.display = 'none';
                document.getElementById('payment-method').style.display = 'block';
            });
        });
    </script>
@endsection
