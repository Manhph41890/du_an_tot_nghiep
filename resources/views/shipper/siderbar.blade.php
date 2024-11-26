<!-- Left Sidebar Start -->
<style>
    .notification-dot {
        width: 18px;
        /* Điều chỉnh kích thước chấm đỏ */
        height: 18px;
        /* Điều chỉnh kích thước chấm đỏ */
        background-color: red;
        border-radius: 50%;
        position: absolute;
        top: -11px;
        /* Điều chỉnh vị trí chấm đỏ */
        left: -8px;
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
        position: absolute;
        top: -5px;
        left: 0px;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
    }

    .notification-dot3 {
        width: 14px;
        height: 14px;
        background-color: red;
        border-radius: 50%;
        position: absolute;
        top: -35px;
        left: 160px;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
    }

    .h-sidebar {
        position: relative;
        height: 100vh;
    }

    .footer-sibar {
        flex-shrink: 0;
        /* Không thu nhỏ footer */
        padding: 10px;
        background-color: #f8f9fa;
        text-align: center;
        border-top: 1px solid #ddd;
        bottom: 11%;
        position: absolute;
        width: 100%;
        /* Đường viền trên */
    }

    .app-sidebar-menu {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .hidden {
        display: none;
    }
</style>
<div class="app-sidebar-menu">
    <div class="h-sidebar" data-simplebar>

        <div id="sidebar-menu">
            <div class="logo-box">
                <img src="{{ asset('assets/client/img/logo/logo_art.png') }}" alt="" width="200px">
            </div>

            <ul id="side-menu" class="list-unstyled">



                <!-- Đơn hàng -->

                <li>
                    <a href="#donhang-menu" data-bs-toggle="collapse" aria-expanded="false" data-bs-parent="#side-menu"
                        class="d-flex align-items-center">
                        <i data-feather="shopping-cart"></i>
                        <span> Đơn hàng mới </span>
                        {{-- @if (isset($notifications) && $notifications['totalNotifications'] > 0)
                        <span class="ms-2 position-relative">
                            <span class="notification-dot">{{ $notifications['totalNotifications'] }}</span>
                        </span>
                        @endif --}}
                        <span class="menu-arrow ms-auto"></span>
                    </a>

                    <div class="collapse" id="donhang-menu">
                        <ul class="nav-second-level">
                            <!-- Menu con: Danh sách -->
                            <li>
                                <a class="tp-link d-flex align-items-center" href="{{ route('shipper.index') }}">
                                    Danh sách
                                    {{-- @if (isset($notifications) && $notifications['newOrdersCount'] > 0)
                                    <span class="ms-2 position-relative">
                                        <span class="notification-dot2"></span>
                                    </span>
                                @endif --}}
                                </a>
                            </li>
                            <!-- Menu con: Thành công -->
                            <li>
                                <a class="tp-link d-flex align-items-center" href="{{ route('shipper.show') }}">
                                    Vận chuyển
                                    {{-- @if (isset($notifications) && $notifications['cancelRequestsCount'] > 0)
                                    <span class="ms-2 position-relative">
                                        <span class="notification-dot2"></span>
                                    </span>
                                @endif --}}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- Lợi tức --}}
                <li>
                    <a href="#loinhuan-menu" data-bs-toggle="collapse" aria-expanded="false" data-bs-parent="#side-menu"
                        class="d-flex align-items-center">
                        <i class="fa-solid fa-money-bill"></i>
                        <span> Hoa hồng </span>
                        {{-- @if (isset($notifications) && $notifications['totalNotifications'] > 0)
                        <span class="ms-2 position-relative">
                            <span class="notification-dot">{{ $notifications['totalNotifications'] }}</span>
                        </span>
                        @endif --}}
                        <span class="menu-arrow ms-auto"></span>
                    </a>

                    <div class="collapse" id="loinhuan-menu">
                        <ul class="nav-second-level">
                            <!-- Menu con: Danh sách -->
                            <li>
                                <a class="tp-link d-flex align-items-center" href="{{ route('shipper.profits') }}">
                                    Lợi nhuận
                                    {{-- @if (isset($notifications) && $notifications['newOrdersCount'] > 0)
                                    <span class="ms-2 position-relative">
                                        <span class="notification-dot2"></span>
                                    </span>
                                @endif --}}
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#policy-menu" data-bs-toggle="collapse" aria-expanded="false" data-bs-parent="#side-menu"
                        class="d-flex align-items-center">
                        <i class="fa-solid fa-book-open-reader"></i>
                        <span> Chính sách vận chuyển </span>
                        {{-- @if (isset($notifications) && $notifications['totalNotifications'] > 0)
                        <span class="ms-2 position-relative">
                            <span class="notification-dot">{{ $notifications['totalNotifications'] }}</span>
                        </span>
                        @endif --}}
                        <span class="menu-arrow ms-auto"></span>
                    </a>

                    <div class="collapse" id="policy-menu">
                        <ul class="nav-second-level">
                            <!-- Menu con: Danh sách -->
                            <li>
                                <a class="tp-link d-flex align-items-center" href="{{ route('shipper.policy') }}">
                                    Chính sách
                                    {{-- @if (isset($notifications) && $notifications['newOrdersCount'] > 0)
                                    <span class="ms-2 position-relative">
                                        <span class="notification-dot2"></span>
                                    </span>
                                @endif --}}
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <!-- End Sidebar -->


        <!--- Sidemenu -->
        <div class="footer-sibar">
            <div class="col fs-13 text-muted text-center">
                &copy;
                <script>
                    document.write(new Date().getFullYear())
                </script> - Made with <span class="mdi mdi-heart text-danger"></span> by <a
                    href="#!" class="text-reset fw-semibold"><img src="assets/client/img/logo/logo_art.png"
                        alt="" height="40" style="margin-bottom: 5px"></a>
            </div>
        </div>
    </div>
</div>
<!-- Left Sidebar End -->