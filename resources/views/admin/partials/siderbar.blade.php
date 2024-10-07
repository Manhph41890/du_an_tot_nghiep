<!-- Left Sidebar Start -->
<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->

        <div id="sidebar-menu">

            <div class="logo-box">
                <a class='logo logo-light' href='index.html'>
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-light.png" alt="" height="24">
                    </span>
                </a>
                <a class='logo logo-dark' href='index.html'>
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-dark.png" alt="" height="24">
                    </span>
                </a>
            </div>

            <ul id="side-menu">

                <li class="menu-title">Menu</li>

                <li>
                    <a href="#sidebarDashboards" data-bs-toggle="collapse">
                        <i data-feather="home"></i>
                        <span> Dashboard </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarDashboards">
                        <ul class="nav-second-level">
                            <li>
                                <a class='tp-link' href='index.html'>Analytical</a>
                            </li>
                            <li>
                                <a class='tp-link' href='ecommerce.html'>E-commerce</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- <li>
            <a href="landing.html" target="_blank">
                <i data-feather="globe"></i>
                <span> Landing </span>
            </a>
        </li> -->

                <li class="menu-title">Pages</li>

                {{-- <li>
                    <a href="#sidebarAuth" data-bs-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> Authentication </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAuth">
                        <ul class="nav-second-level">
                            <li>
                                <a class='tp-link' href='auth-login.html'>Log In</a>
                            </li>
                            <li>
                                <a class='tp-link' href='auth-register.html'>Register</a>
                            </li>
                            <li>
                                <a class='tp-link' href='auth-recoverpw.html'>Recover Password</a>
                            </li>
                            <li>
                                <a class='tp-link' href='auth-lock-screen.html'>Lock Screen</a>
                            </li>
                            <li>
                                <a class='tp-link' href='auth-confirm-mail.html'>Confirm Mail</a>
                            </li>
                            <li>
                                <a class='tp-link' href='email-verification.html'>Email Verification</a>
                            </li>
                            <li>
                                <a class='tp-link' href='auth-logout.html'>Logout</a>
                            </li>
                        </ul>
                    </div>
                </li> --}}

                {{-- <li>
                    <a href="#sidebarError" data-bs-toggle="collapse">
                        <i data-feather="alert-octagon"></i>
                        <span> Error Pages </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarError">
                        <ul class="nav-second-level">
                            <li>
                                <a class='tp-link' href='error-404.html'>Error 404</a>
                            </li>
                            <li>
                                <a class='tp-link' href='error-500.html'>Error 500</a>
                            </li>
                            <li>
                                <a class='tp-link' href='error-503.html'>Error 503</a>
                            </li>
                            <li>
                                <a class='tp-link' href='error-429.html'>Error 429</a>
                            </li>
                            <li>
                                <a class='tp-link' href='offline-page.html'>Offline Page</a>
                            </li>
                        </ul>
                    </div>
                </li> --}}

                {{-- <li>
                    <a href="#sidebarExpages" data-bs-toggle="collapse">
                        <i data-feather="file-text"></i>
                        <span> Utility </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarExpages">
                        <ul class="nav-second-level">
                            <li>
                                <a class='tp-link' href='pages-starter.html'>Starter</a>
                            </li>
                            <li>
                                <a class='tp-link' href='pages-profile.html'>Profile</a>
                            </li>
                            <li>
                                <a class='tp-link' href='pages-pricing.html'>Pricing</a>
                            </li>
                            <li>
                                <a class='tp-link' href='pages-timeline.html'>Timeline</a>
                            </li>
                            <li>
                                <a class='tp-link' href='pages-invoice.html'>Invoice</a>
                            </li>
                            <li>
                                <a class='tp-link' href='pages-faqs.html'>FAQs</a>
                            </li>
                            <li>
                                <a class='tp-link' href='pages-gallery.html'>Gallery</a>
                            </li>
                            <li>
                                <a class='tp-link' href='pages-maintenance.html'>Maintenance</a>
                            </li>
                            <li>
                                <a class='tp-link' href='pages-coming-soon.html'>Coming Soon</a>
                            </li>
                        </ul>
                    </div>
                </li> --}}

                <li>
                    <a href="#danhmuc" data-bs-toggle="collapse">
                        <i data-feather="file-text"></i>
                        <span> Danh mục </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="danhmuc">
                        <ul class="nav-second-level">
                            <li>
                                <a class='tp-link' href='{{ route('danhmucs.create') }}'>Thêm</a>
                            </li>
                            <li>
                                <a class='tp-link' href='{{ route('danhmucs.index') }}'>Danh sách</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#chucvu" data-bs-toggle="collapse">
                        <i data-feather="file-text"></i>
                        <span> Chức vụ </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="chucvu">
                        <ul class="nav-second-level">
                            <li>
                                <a class='tp-link' href='{{ route('chucvus.create') }}'>Thêm</a>
                                <a class='tp-link' href='{{ route('chucvus.index') }}'>Danh sách</a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- san pham --}}
                <li>
                    <a href="#sanpham" data-bs-toggle="collapse">
                        <i data-feather="file-text"></i>
                        <span> Sản phẩm </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sanpham">
                        <ul class="nav-second-level">
                            <li>
                                <a class='tp-link' href='{{ route('sanphams.create') }}'>Thêm</a>
                            </li>
                            <li>
                                <a class='tp-link' href='{{ route('sanphams.index') }}'>Danh sách</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#phuongthucthanhtoan" data-bs-toggle="collapse">
                        <i data-feather="file-text"></i>
                        <span> PT thanh toán </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="phuongthucthanhtoan">
                        <ul class="nav-second-level">
                            <li>
                                <a class='tp-link' href='{{ route('phuongthucthanhtoans.index') }}'>Danh sách</a>
                            </li>
                            <li>
                                <a class='tp-link' href='{{ route('phuongthucthanhtoans.create') }}'>Thêm</a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#phuongthucvanchuyen" data-bs-toggle="collapse">
                        <i data-feather="file-text"></i>
                        <span> PT vận chuyển </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="phuongthucvanchuyen">
                        <ul class="nav-second-level">
                            <li>
                                <a class='tp-link' href='{{ route('phuongthucvanchuyens.index') }}'>Danh sách</a>
                            </li>
                            <li>
                                <a class='tp-link' href='{{ route('phuongthucvanchuyens.create') }}'>Thêm</a>
                            </li>

                        </ul>
                    </div>
                </li>


                <li>
                    <a href="#khuyenmai" data-bs-toggle="collapse">
                        <i data-feather="file-text"></i>
                        <span> Khuyến mãi </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="khuyenmai">
                        <ul class="nav-second-level">
                            <li>
                                <a class='tp-link' href='{{ route('khuyenmais.create') }}'>Thêm</a>
                            </li>
                            <li>
                                <a class='tp-link' href='{{ route('khuyenmais.index') }}'>Danh sách</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#user" data-bs-toggle="collapse">
                        <i data-feather="file-text"></i>
                        <span> User </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="user">
                        <ul class="nav-second-level">
                            <li>
                                <a class='tp-link' href='{{ route('user.index') }}'>Danh sách</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#baiviet" data-bs-toggle="collapse">
                        <i data-feather="file-text"></i>
                        <span> Bài viết </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="baiviet">
                        <ul class="nav-second-level">
                            <li>
                                <a class='tp-link' href='{{ route('baiviets.create') }}'>Thêm</a>
                            </li>
                            <li>
                                <a class='tp-link' href='{{ route('baiviets.index') }}'>Danh sách</a>
                            </li>
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
