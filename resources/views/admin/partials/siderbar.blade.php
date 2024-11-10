<!-- Left Sidebar Start -->
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
                    <a href="#donhang" data-bs-toggle="collapse" aria-expanded="false" data-bs-parent="#side-menu">
                        <i data-feather="shopping-cart"></i>
                        <span> Đơn hàng </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="donhang">
                        <ul class="nav-second-level">
                            <li><a class="tp-link" href="{{ route('donhangs.index') }}">Danh sách</a></li>
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
                            <li><a class="tp-link" href="{{ route('user.create') }}">Thêm nhân viên</a></li>
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

                <!-- Chức vụ -->
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
                </li>


            </ul>
        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>
        {{-- <div class="row" style="margin-top: 180px">
            <div class="col fs-13 text-muted text-center">
                &copy;
                <script>
                    document.write(new Date().getFullYear())
                </script> - Made with <span class="mdi mdi-heart text-danger"></span> by <a
                    href="#!" class="text-reset fw-semibold"><img src="assets/client/img/logo/logo_art.png"
                        alt="" height="40" style="margin-bottom: 5px"></a>
            </div>
        </div> --}}
    </div>
</div>
<!-- Left Sidebar End -->
