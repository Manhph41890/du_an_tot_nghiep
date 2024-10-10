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
                    <a href="<?php echo e(route('dashboard')); ?>">
                        <span> Thông kê </span>
                    </a>
                </li>

                <li class="menu-title">Pages</li>

                <li>
                    <a href="#danhmuc" data-bs-toggle="collapse">
                        <i data-feather="file-text"></i>
                        <span> Danh mục </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="danhmuc">
                        <ul class="nav-second-level">
                            <li>
                                <a class='tp-link' href='<?php echo e(route('danhmucs.create')); ?>'>Thêm</a>
                            </li>
                            <li>
                                <a class='tp-link' href='<?php echo e(route('danhmucs.index')); ?>'>Danh sách</a>
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
                                <a class='tp-link' href='<?php echo e(route('chucvus.create')); ?>'>Thêm</a>
                                <a class='tp-link' href='<?php echo e(route('chucvus.index')); ?>'>Danh sách</a>
                            </li>
                        </ul>
                    </div>
                </li>
                
                <li>
                    <a href="#sanpham" data-bs-toggle="collapse">
                        <i data-feather="file-text"></i>
                        <span> Sản phẩm </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sanpham">
                        <ul class="nav-second-level">
                            <li>
                                <a class='tp-link' href='<?php echo e(route('sanphams.create')); ?>'>Thêm</a>
                            </li>
                            <li>
                                <a class='tp-link' href='<?php echo e(route('sanphams.index')); ?>'>Danh sách</a>
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
                                <a class='tp-link' href='<?php echo e(route('phuongthucthanhtoans.index')); ?>'>Danh sách</a>
                            </li>
                            <li>
                                <a class='tp-link' href='<?php echo e(route('phuongthucthanhtoans.create')); ?>'>Thêm</a>
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
                                <a class='tp-link' href='<?php echo e(route('phuongthucvanchuyens.index')); ?>'>Danh sách</a>
                            </li>
                            <li>
                                <a class='tp-link' href='<?php echo e(route('phuongthucvanchuyens.create')); ?>'>Thêm</a>
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
                                <a class='tp-link' href='<?php echo e(route('khuyenmais.create')); ?>'>Thêm</a>
                            </li>
                            <li>
                                <a class='tp-link' href='<?php echo e(route('khuyenmais.index')); ?>'>Danh sách</a>
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
                                <a class='tp-link' href='<?php echo e(route('user.index')); ?>'>Danh sách</a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li>
                    <a href="#baiviet" data-bs-toggle="collapse">
                        <i data-feather="file-text"></i>
                        <span>Bài viết </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="baiviet">
                        <ul class="nav-second-level">
                            <li>
                                <a class='tp-link' href='<?php echo e(route('baiviets.create')); ?>'>Thêm</a>
                            </li>
                            <li>
                                <a class='tp-link' href='<?php echo e(route('baiviets.index')); ?>'>Danh sách</a>
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
<?php /**PATH C:\laragon\www\du_an_tot_nghiep\du_an_tot_nghiep\resources\views/admin/partials/siderbar.blade.php ENDPATH**/ ?>