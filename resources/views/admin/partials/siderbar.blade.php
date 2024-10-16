<!-- Left Sidebar Start -->
<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <div class="logo-box">
                <a class='logo logo-light' href='http://127.0.0.1:8000/dashboard'>
                    <span class="logo-sm">
                        <img src="assets/client/img/logo/logo_art.png" alt="" height="70">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/client/img/logo/logo_art.png" alt="" height="70">
                    </span>
                </a>
                <a class='logo logo-dark' href='http://127.0.0.1:8000/dashboard'>
                    <span class="logo-sm">
                        <img src="assets/client/img/logo/logo_art.png" alt="" height="70">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/client/img/logo/logo_art.png" alt="" height="70">
                    </span>
                </a>
            </div>

            <ul id="side-menu" class="list-unstyled">
                <li class="menu-title">Menu</li>

                <!-- Dashboard Link -->
                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="fa-duotone fa-solid fa-chart-simple"></i>
                        <span> Thống kê </span>
                    </a>
                </li>

                <li class="menu-title">Pages</li>

                <!-- Danh mục -->
                <li>
                    <a href="#danhmuc" data-bs-toggle="collapse" aria-expanded="false" data-bs-parent="#side-menu">
                        <i class="fa-duotone fa-solid fa-list"></i>
                        <span> Danh mục </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="danhmuc">
                        <ul class="nav-second-level">
                            <li><a class="tp-link" href="{{ route('danhmucs.create') }}">Thêm</a></li>
                            <li><a class="tp-link" href="{{ route('danhmucs.index') }}">Danh sách</a></li>
                        </ul>
                    </div>
                </li>

                <!-- Chức vụ -->
                <li>
                    <a href="#chucvu" data-bs-toggle="collapse" aria-expanded="false" data-bs-parent="#side-menu">
                        <i class="fa-duotone fa-solid fa-users"></i>
                        <span> Chức vụ </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="chucvu">
                        <ul class="nav-second-level">
                            <li><a class="tp-link" href="{{ route('chucvus.create') }}">Thêm</a></li>
                            <li><a class="tp-link" href="{{ route('chucvus.index') }}">Danh sách</a></li>
                        </ul>
                    </div>
                </li>

                <!-- Sản phẩm -->
                <li>
                    <a href="#sanpham" data-bs-toggle="collapse" aria-expanded="false" data-bs-parent="#side-menu">
                        {{-- <i data-feather="file-text"></i> --}}
                        <i class="fa-duotone fa-solid fa-cart-shopping"></i>
                        <span> Sản phẩm </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sanpham">
                        <ul class="nav-second-level">
                            <li><a class="tp-link" href="{{ route('sanphams.create') }}">Thêm</a></li>
                            <li><a class="tp-link" href="{{ route('sanphams.index') }}">Danh sách</a></li>
                        </ul>
                    </div>
                </li>

                <!-- Phương thức thanh toán -->
                <li>
                    <a href="#phuongthucthanhtoan" data-bs-toggle="collapse" aria-expanded="false"
                        data-bs-parent="#side-menu">
                        <i class="fa-duotone fa-solid fa-money-bill"></i>
                        <span> PT thanh toán </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="phuongthucthanhtoan">
                        <ul class="nav-second-level">
                            <li><a class="tp-link" href="{{ route('phuongthucthanhtoans.create') }}">Thêm</a></li>
                            <li><a class="tp-link" href="{{ route('phuongthucthanhtoans.index') }}">Danh sách</a></li>
                        </ul>
                    </div>
                </li>

                <!-- Phương thức vận chuyển -->
                <li>
                    <a href="#phuongthucvanchuyen" data-bs-toggle="collapse" aria-expanded="false"
                        data-bs-parent="#side-menu">
                        {{-- <i data-feather="file-text"></i> --}}
                        <i class="fa-duotone fa-solid fa-motorcycle"></i>
                        <span> PT vận chuyển </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="phuongthucvanchuyen">
                        <ul class="nav-second-level">
                            <li><a class="tp-link" href="{{ route('phuongthucvanchuyens.create') }}">Thêm</a></li>
                            <li><a class="tp-link" href="{{ route('phuongthucvanchuyens.index') }}">Danh sách</a></li>
                        </ul>
                    </div>
                </li>

                <!-- Khuyến mãi -->
                <li>
                    <a href="#khuyenmai" data-bs-toggle="collapse" aria-expanded="false" data-bs-parent="#side-menu">
                        <i class="fa-sharp-duotone fa-solid fa-percent"></i>
                        <span> Khuyến mãi </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="khuyenmai">
                        <ul class="nav-second-level">
                            <li><a class="tp-link" href="{{ route('khuyenmais.create') }}">Thêm</a></li>
                            <li><a class="tp-link" href="{{ route('khuyenmais.index') }}">Danh sách</a></li>
                        </ul>
                    </div>
                </li>

                <!-- User -->
                <li>
                    <a href="#user" data-bs-toggle="collapse" aria-expanded="false" data-bs-parent="#side-menu">
                        <i class="fa-duotone fa-solid fa-user"></i>
                        <span> User </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="user">
                        <ul class="nav-second-level">
                            <li><a class="tp-link" href="{{ route('user.index') }}">Danh sách</a></li>
                        </ul>
                    </div>
                </li>

                <!-- Bài viết -->
                <li>
                    <a href="#baiviet" data-bs-toggle="collapse" aria-expanded="false" data-bs-parent="#side-menu">
                        <i class="fa-duotone fa-solid fa-pen-to-square"></i>
                        <span> Bài viết </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="baiviet">
                        <ul class="nav-second-level">
                            <li><a class="tp-link" href="{{ route('baiviets.create') }}">Thêm</a></li>
                            <li><a class="tp-link" href="{{ route('baiviets.index') }}">Danh sách</a></li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>
    </div>
</div>
<!-- Left Sidebar End -->
