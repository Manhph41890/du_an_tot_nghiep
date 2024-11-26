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
</style>
<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <div class="logo-box">
                <img src="{{ asset('assets/client/img/logo/logo_art.png') }}" alt="" width="200px">
            </div>

            <ul id="side-menu" class="list-unstyled">

                <!-- Dashboard Link -->
                <li>
                    <a href="#dashboard" data-bs-toggle="collapse" aria-expanded="false" data-bs-parent="#side-menu">
                        <i data-feather="pie-chart"></i>
                        <span> Thống kê </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="dashboard">
                        <ul class="nav-second-level">
                            @if (auth()->user()->chuc_vu->ten_chuc_vu === 'admin')
                                <li><a class="tp-link" href="{{ route('thong_ke_chung') }}">Tổng quan</a></li>
                            @endif
                            @if (auth()->user()->chuc_vu->ten_chuc_vu === 'nhan_vien')
                                <li><a class="tp-link" href="{{ route('thong_ke') }}">Tổng quan</a></li>
                            @endif
                            {{-- <li><a class="tp-link" href="{{ route('thong_ke_doanh_thu') }}">Doanh thu</a></li> --}}

                        </ul>
                    </div>
                </li>

                <!-- Đơn hàng -->

                <li>
                    <a href="#donhang-menu" data-bs-toggle="collapse" aria-expanded="false" data-bs-parent="#side-menu"
                        class="d-flex align-items-center">
                        <i data-feather="shopping-cart"></i>
                        <span> Đơn hàng </span>
                        @if (isset($notifications) && $notifications['totalNotifications'] > 0)
                            <span class="ms-2 position-relative">
                                <span class="notification-dot">{{ $notifications['totalNotifications'] }}</span>
                            </span>
                        @endif
                        <span class="menu-arrow ms-auto"></span>
                    </a>

                    <div class="collapse" id="donhang-menu">
                        <ul class="nav-second-level">
                            <!-- Menu con: Danh sách -->
                            <li>
                                <a class="tp-link d-flex align-items-center" href="{{ route('donhangs.index') }}">
                                    Danh sách
                                    @if (isset($notifications) && $notifications['newOrdersCount'] > 0)
                                        <span class="ms-2 position-relative">
                                            <span class="notification-dot2"></span>
                                        </span>
                                    @endif
                                </a>
                            </li>
                            <!-- Menu con: Yêu cầu hủy -->
                            <li>
                                <a class="tp-link d-flex align-items-center" href="{{ route('xacnhanhuy.index') }}">
                                    Yêu cầu hủy đặt hàng
                                    @if (isset($notifications) && $notifications['cancelRequestsCount'] > 0)
                                        <span class="ms-2 position-relative">
                                            <span class="notification-dot2"></span>
                                        </span>
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>





                <!-- Danh mục -->
                <li>
                    <a href="#danhmuc" data-bs-toggle="collapse" aria-expanded="false" data-bs-parent="#side-menu">
                        <i data-feather="layers"></i>
                        <span> Danh mục </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="danhmuc">
                        <ul class="nav-second-level">
                            @if (auth()->user()->chuc_vu->ten_chuc_vu === 'admin')
                                <li><a class="tp-link" href="{{ route('danhmucs.create') }}">Thêm</a></li>
                            @endif
                            <li><a class="tp-link" href="{{ route('danhmucs.index') }}">Danh sách</a></li>
                        </ul>
                    </div>
                </li>


                <!-- Sản phẩm -->
                <li>
                    <a href="#sanpham" data-bs-toggle="collapse" aria-expanded="false" data-bs-parent="#side-menu">
                        <i data-feather="book"></i>
                        <span> Sản phẩm </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sanpham">
                        <ul class="nav-second-level">
                            @if (auth()->user()->chuc_vu->ten_chuc_vu === 'admin')
                                <li><a class="tp-link" href="{{ route('sanphams.create') }}">Thêm</a></li>
                            @endif
                            <li><a class="tp-link" href="{{ route('sanphams.index') }}">Danh sách</a></li>
                            <li><a class="tp-link" href="{{ route('variants.index') }}">Quản lý biến thể</a></li>
                        </ul>
                    </div>
                </li>

                {{-- Khuyến mãi --}}
                <li>
                    <a href="#khuyenmai" data-bs-toggle="collapse" aria-expanded="false" data-bs-parent="#side-menu">
                        <i data-feather="tag"></i>
                        <span> Khuyến mãi </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="khuyenmai">
                        <ul class="nav-second-level">
                            @if (auth()->user()->chuc_vu->ten_chuc_vu === 'admin')
                                <li><a class="tp-link" href="{{ route('khuyenmais.create') }}">Thêm</a></li>
                            @endif
                            <li><a class="tp-link" href="{{ route('khuyenmais.index') }}">Danh sách</a></li>

                        </ul>
                    </div>
                </li>




                <!-- User -->
                <li>
                    <a href="#user" data-bs-toggle="collapse" aria-expanded="false" data-bs-parent="#side-menu">
                        <i data-feather="user"></i>
                        <span> User </span>
                        @if (isset($viewMoney) && $viewMoney > 1)
                            <span class="ms-2 position-relative">
                                <span class="notification-dot">{{ $viewMoney }}</span>
                            </span>
                        @endif
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="user">
                        <ul class="nav-second-level">
                            <li><a class="tp-link" href="{{ route('user.index') }}">Danh sách</a></li>
                            @if (auth()->user()->chuc_vu->ten_chuc_vu === 'admin')
                                <li><a class="tp-link" href="{{ route('user.create') }}">Thêm nhân viên</a></li>

                                <li><a class="tp-link" href="{{ route('duyetruttienAdmin') }}">Duyệt rút tiền</a></li>
                                @if (isset($viewMoney) && $viewMoney > 1)
                                    <span class="ms-2 position-relative">
                                        <span class="notification-dot3">{{ $viewMoney }}</span>
                                    </span>
                                @endif
                            @endif

                        </ul>
                    </div>
                </li>
                {{-- Đánh giá --}}

                <li>
                    <a href="#danhgia" data-bs-toggle="collapse" aria-expanded="false" data-bs-parent="#side-menu">
                        <i data-feather="star"></i>
                        <span> Đánh giá </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="danhgia">
                        <ul class="nav-second-level">
                            @if (auth()->user()->chuc_vu->ten_chuc_vu === 'admin' || auth()->user()->chuc_vu->ten_chuc_vu === 'nhan_vien')
                                <li><a class="tp-link" href="{{ route('danhgia.index') }}">Danh sách</a></li>
                            @endif
                        </ul>
                    </div>
                </li>


                {{-- Bài viết --}}
                <li>
                    <a href="#baiviet" data-bs-toggle="collapse" aria-expanded="false" data-bs-parent="#side-menu">
                        <i data-feather="book-open"></i>
                        <span> Bài viết </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="baiviet">
                        <ul class="nav-second-level">
                            @if (auth()->user()->chuc_vu->ten_chuc_vu === 'admin')
                                <li><a class="tp-link" href="{{ route('baiviets.create') }}">Thêm</a></li>
                            @endif
                            <li><a class="tp-link" href="{{ route('baiviets.index') }}">Danh sách</a></li>
                        </ul>
                    </div>
                </li>
                {{-- Quản lý nhân viên vận chuyển --}}
                <li>
                    <a href="#shipper" data-bs-toggle="collapse" aria-expanded="false" data-bs-parent="#side-menu">
                        <i class="fa-solid fa-person-running"></i>
                        <span>Nhân viên vận chuyển </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="shipper">
                        <ul class="nav-second-level">
                            @if (auth()->user()->chuc_vu->ten_chuc_vu === 'admin')
                                <li><a class="tp-link" href="{{ route('shipper.create')}}">Thêm</a></li>
                            @endif
                            <li><a class="tp-link" href="{{ route('shipper.index') }}">Danh sách</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>
        <div class="row" style="margin-top: 180px">
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
