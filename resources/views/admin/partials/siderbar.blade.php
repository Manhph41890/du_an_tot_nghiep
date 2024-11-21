<!-- Left Sidebar Start -->
<style>
    .notification-dot {
        width: 20px;
        /* Điều chỉnh kích thước chấm đỏ */
        height: 20px;
        /* Điều chỉnh kích thước chấm đỏ */
        background-color: red;
        border-radius: 50%;
        position: absolute;
        top: -15px;
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
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="user">
                        <ul class="nav-second-level">
                            <li><a class="tp-link" href="{{ route('user.index') }}">Danh sách</a></li>
                            @if (auth()->user()->chuc_vu->ten_chuc_vu === 'admin')
                                <li><a class="tp-link" href="{{ route('user.create') }}">Thêm nhân viên</a></li>
                                <li><a class="tp-link" href="{{ route('duyetruttienAdmin') }}">Duyệt rút tiền</a></li>
                            @endif

                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#danhgia" data-bs-toggle="collapse" aria-expanded="false" data-bs-parent="#side-menu">
                        <i data-feather="star"></i>
                        <span> Đánh giá </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="danhgia">
                        <ul class="nav-second-level">
                            <li><a class="tp-link" href="{{ route('danhgia.index') }}">Danh sách</a></li>
                        </ul>
                    </div>
                </li>



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

                {{-- <!-- Chức vụ -->
                <li>
                    <a href="#chucvu" data-bs-toggle="collapse" aria-expanded="false" data-bs-parent="#side-menu">
                        <i data-feather="award"></i>
                        <span> Chức vụ </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="chucvu">
                        <ul class="nav-second-level">
                            @if (auth()->user()->chuc_vu->ten_chuc_vu === 'admin')
                                <li><a class="tp-link" href="{{ route('chucvus.create') }}">Thêm</a></li>
                            @endif
                            <li><a class="tp-link" href="{{ route('chucvus.index') }}">Danh sách</a></li>
                        </ul>
                    </div>
                </li>
                <!-- Phương thức thanh toán -->
                <li>
                    <a href="#phuongthucthanhtoan" data-bs-toggle="collapse" aria-expanded="false"
                        data-bs-parent="#side-menu">
                        <i data-feather="credit-card"></i>
                        <span> PT thanh toán </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="phuongthucthanhtoan">
                        <ul class="nav-second-level">
                            @if (auth()->user()->chuc_vu->ten_chuc_vu === 'admin')
                                <li><a class="tp-link" href="{{ route('phuongthucthanhtoans.create') }}">Thêm</a>
                                </li>
                            @endif
                            <li><a class="tp-link" href="{{ route('phuongthucthanhtoans.index') }}">Danh sách</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Phương thức vận chuyển -->
                <li>
                    <a href="#phuongthucvanchuyen" data-bs-toggle="collapse" aria-expanded="false"
                        data-bs-parent="#side-menu">
                        <i data-feather="truck"></i>
                        <span> PT vận chuyển </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="phuongthucvanchuyen">
                        <ul class="nav-second-level">
                            @if (auth()->user()->chuc_vu->ten_chuc_vu === 'admin')
                                <li><a class="tp-link" href="{{ route('phuongthucvanchuyens.create') }}">Thêm</a>
                                </li>
                            @endif
                            <li><a class="tp-link" href="{{ route('phuongthucvanchuyens.index') }}">Danh sách</a>
                            </li>
                        </ul>
                    </div>
                </li> --}}


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
