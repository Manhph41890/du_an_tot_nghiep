<!-- offcanvas-overlay start -->
<div class="offcanvas-overlay"></div>
<!-- offcanvas-overlay end -->
<!-- offcanvas-mobile-menu start -->
<div id="offcanvas-mobile-menu" class="offcanvas theme1 offcanvas-mobile-menu">
    <div class="inner">
        <div class="border-bottom mb-4 pb-4 text-end">
            <button class="offcanvas-close">×</button>
        </div>
        <div class="offcanvas-head mb-4">
            <nav class="offcanvas-top-nav">
                <ul class="d-flex flex-wrap">

                    <li class="my-2 mx-2">
                        <a class="search search-toggle" href="javascript:void(0)">
                            <i class="icon-magnifier"></i> Tìm kiếm</a>
                    </li>
                </ul>
            </nav>
        </div>
        <nav class="offcanvas-menu">
            <ul>
                <li>
                    <a href="{{ route('client.home') }}"><span class="menu-text">Trang chủ</span></a>
                    <!-- <ul class="offcanvas-submenu">
                        <li><a href="index.html">Home 1</a></li>
                        <li><a href="index-2.html">Home 2</a></li>
                    </ul> -->
                </li>
                <li>
                    <a href="#"><span class="menu-text">Giới thiệu</span></a>
                    <!-- <ul class="offcanvas-submenu">
                        <li><a href="about-us.html">About Page</a></li>
                        <li><a href="cart.html">Cart Page</a></li>
                        <li><a href="checkout.html">Checkout Page</a></li>
                        <li><a href="compare.html">Compare Page</a></li>
                        <li><a href="login.html">Login &amp; Register Page</a></li>
                        <li><a href="myaccount.html">Account Page</a></li>
                        <li><a href="wishlist.html">Wishlist Page</a></li>
                    </ul> -->
                </li>
                <li>
                    <a href="#"><span class="menu-text">Cửa hàng</span></a>
                    <ul class="offcanvas-submenu">
                        <li>
                            <a href="#"><span class="menu-text">Shop Grid</span></a>
                            <ul class="offcanvas-submenu">
                                <li>
                                    <a href="shop-grid-3-column.html">Shop Grid 3 Column</a>
                                </li>
                                <li>
                                    <a href="shop-grid-4-column.html">Shop Grid 4 Column</a>
                                </li>
                                <li>
                                    <a href="shop-grid-left-sidebar.html">Shop Grid Left Sidebar</a>
                                </li>
                                <li>
                                    <a href="shop-grid-right-sidebar.html">Shop Grid Right Sidebar</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><span class="menu-text">Shop List</span></a>
                            <ul class="offcanvas-submenu">
                                <li><a href="shop-grid-list.html">Shop List</a></li>
                                <li>
                                    <a href="shop-grid-list-left-sidebar.html">Shop List Left Sidebar</a>
                                </li>
                                <li>
                                    <a href="shop-grid-list-right-sidebar.html">Shop List Right Sidebar</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><span class="menu-text">Shop Single</span></a>
                            <ul class="offcanvas-submenu">
                                <li><a href="single-product.html">Shop Single</a></li>
                                <li>
                                    <a href="single-product-configurable.html">Shop Variable</a>
                                </li>
                                <li>
                                    <a href="single-product-affiliate.html">Shop Affiliate</a>
                                </li>
                                <li><a href="single-product-group.html">Shop Group</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><span class="menu-text">other pages</span></a>
                            <ul class="offcanvas-submenu">
                                <li><a href="about-us.html">About Page</a></li>
                                <li><a href="cart.html">Cart Page</a></li>
                                <li><a href="checkout.html">Checkout Page</a></li>
                                <li><a href="compare.html">Compare Page</a></li>
                                <li><a href="login.html">Login &amp; Register Page</a></li>
                                <li><a href="myaccount.html">Account Page</a></li>
                                <li><a href="wishlist.html">Wishlist Page</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{ url('client/baiviet') }}"><span class="menu-text">Blog</span></a>
                    <!-- <ul class="offcanvas-submenu">
                        <li>
                            <a href="#"><span class="menu-text">Blog Grid</span></a>
                            <ul class="offcanvas-submenu">
                                <li>
                                    <a href="blog-grid-3-column.html">Blog Grid 3 column</a>
                                </li>
                                <li>
                                    <a href="blog-grid-4-column.html">Blog Grid 4 column</a>
                                </li>
                                <li>
                                    <a href="blog-grid-left-sidebar.html">Blog Grid Left Sidebar</a>
                                </li>
                                <li>
                                    <a href="blog-grid-right-sidebar.html">Blog Grid Right Sidebar</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><span class="menu-text">Blog List</span></a>
                            <ul class="offcanvas-submenu">
                                <li>
                                    <a href="blog-list-left-sidebar.html">Blog List Left Sidebar</a>
                                </li>
                                <li>
                                    <a href="blog-list-right-sidebar.html">Blog List Right Sidebar</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><span class="menu-text">Blog Single</span></a>
                            <ul class="offcanvas-submenu">
                                <li><a href="single-blog.html">Single Blog</a></li>
                                <li>
                                    <a href="blog-single-left-sidebar.html">Blog Single Left Sidebar</a>
                                </li>
                                <li>
                                    <a href="blog-single-right-sidebar.html">Blog Single Right Sidbar</a>
                                </li>
                            </ul>
                        </li>
                    </ul> -->
                </li>
                <li><a href="{{ route('client.lienhe') }}">Liên hệ</a></li>
            </ul>
        </nav>
        <div class="offcanvas-social py-30">
            <ul>
                <li>
                    <a href="#"><i class="icon-social-facebook"></i></a>
                </li>
                <li>
                    <a href="#"><i class="icon-social-twitter"></i></a>
                </li>
                <li>
                    <a href="#"><i class="icon-social-instagram"></i></a>
                </li>
                <li>
                    <a href="#"><i class="icon-social-google"></i></a>
                </li>
                <li>
                    <a href="#"><i class="icon-social-instagram"></i></a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- offcanvas-mobile-menu end -->

<!-- OffCanvas Wishlist Start -->
<div id="offcanvas-wishlist" class="offcanvas offcanvas-wishlist theme1">
    <div class="inner">
        <div class="head d-flex flex-wrap justify-content-between">
            <span class="title">Wishlist</span>
            <button class="offcanvas-close">×</button>
        </div>
        <ul class="minicart-product-list">
            <li>
                <a href="single-product.html" class="image"><img src="assets/client/images/mini-cart/4.png"
                        alt="Cart product Image" /></a>
                <div class="content">
                    <a href="single-product.html" class="title">orginal Age Defying Cosmetics Makeup</a>
                    <span class="quantity-price">1 x <span class="amount">$100.00</span></span>
                    <a href="#" class="remove">×</a>
                </div>
            </li>
            <li>
                <a href="single-product.html" class="image"><img src="assets/client/images/mini-cart/5.png"
                        alt="Cart product Image" /></a>
                <div class="content">
                    <a href="single-product.html" class="title">On Trend Makeup and Beauty Cosmetics</a>
                    <span class="quantity-price">1 x <span class="amount">$35.00</span></span>
                    <a href="#" class="remove">×</a>
                </div>
            </li>
            <li>
                <a href="single-product.html" class="image"><img src="assets/client/images/mini-cart/6.png"
                        alt="Cart product Image" /></a>
                <div class="content">
                    <a href="single-product.html" class="title">orginal Age Defying Cosmetics Makeup</a>
                    <span class="quantity-price">1 x <span class="amount">$9.00</span></span>
                    <a href="#" class="remove">×</a>
                </div>
            </li>
        </ul>
        <a href="wishlist.html" class="btn btn-secondary btn--lg d-block d-sm-inline-block mt-30">view wishlist</a>
    </div>

</div>
<!-- OffCanvas Wishlist End -->

<!-- Gio hang mini cart -->
<div id="offcanvas-cart" class="offcanvas offcanvas-cart theme1">
    <div class="inner">
        <div class="head d-flex flex-wrap justify-content-between">
            <span class="title">Cart</span>
            <button class="offcanvas-close">×</button>
        </div>
        <ul class="minicart-product-list">
            <li>
                <a href="single-product.html" class="image"><img src="assets/client/images/mini-cart/1.png"
                        alt="Cart product Image" /></a>
                <div class="content">
                    <a href="single-product.html" class="title">orginal Age Defying Cosmetics Makeup</a>
                    <span class="quantity-price">1 x <span class="amount">$100.00</span></span>
                    <a href="#" class="remove">×</a>
                </div>
            </li>
            <li>
                <a href="single-product.html" class="image"><img src="assets/client/images/mini-cart/2.png"
                        alt="Cart product Image" /></a>
                <div class="content">
                    <a href="single-product.html" class="title">On Trend Makeup and Beauty Cosmetics</a>
                    <span class="quantity-price">1 x <span class="amount">$35.00</span></span>
                    <a href="#" class="remove">×</a>
                </div>
            </li>
            <li>
                <a href="single-product.html" class="image"><img src="assets/client/images/mini-cart/3.png"
                        alt="Cart product Image" /></a>
                <div class="content">
                    <a href="single-product.html" class="title">orginal Age Defying Cosmetics Makeup</a>
                    <span class="quantity-price">1 x <span class="amount">$9.00</span></span>
                    <a href="#" class="remove">×</a>
                </div>
            </li>
        </ul>
        <div class="sub-total d-flex flex-wrap justify-content-between">
            <strong>Subtotal :</strong>
            <span class="amount">$144.00</span>
        </div>
        <a href="cart.html" class="btn btn-secondary btn--lg d-block d-sm-inline-block me-sm-2">view cart</a>
        <a href="checkout.html" class="btn btn-dark btn--lg d-block d-sm-inline-block mt-4 mt-sm-0">checkout</a>
        <p class="minicart-message">Free Shipping on All Orders Over $100!</p>
    </div>

</div>
<!-- OffCanvas Cart End -->

<!-- header start -->
<header>

    <!-- header-middle satrt -->
    <div id="sticky" class="header-middle theme1 py-15 py-lg-0">
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-6 col-lg-2 col-xl-2">
                    <div class="logo">
                        <a href="{{ route('client.home') }}"><img
                                src="{{ asset('assets/client/images/logo/logo_art.png') }}" alt="logo" /></a>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-7 d-none d-lg-block">
                    <ul class="main-menu d-flex justify-content-center">
                        <li class="active ml-0">
                            <a style="color: #333;" href="{{ route('client.home') }}" class="ps-0">Trang chủ </a>
                        </li>
                        <li>
                            <a href="#">Giới thiệu</a>

                        </li>
                        <li class="position-static">
                            <a href="shop-grid-3-column.html">Cửa hàng </a>
                        </li>

                        <li>
                            <a href="{{ url('client/baiviet') }}">Blog</a>

                        </li>
                        <li><a href="{{ route('client.lienhe') }}">Liên hệ</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-3 col-xl-2">
                    <!-- search-form end -->
                    <div class="d-flex align-items-center justify-content-end">
                        <!-- static-media end -->
                        <div class="cart-block-links theme1 d-none d-sm-block">
                            <ul class="d-flex">
                                <li>
                                    <a href="javascript:void(0)" class="search search-toggle">
                                        <i class="icon-magnifier"></i>
                                    </a>
                                </li>


                                <li class="mr-xl-0 cart-block position-relative">
                                    <a class="offcanvas-toggle" href="#offcanvas-cart">
                                        <span class="position-relative">
                                            <i class="icon-bag"></i>
                                            <span class="badge cbdg1">3</span>
                                        </span>
                                    </a>
                                </li>
                                <!-- cart block end -->
                            </ul>
                        </div>
                        <div class="mobile-menu-toggle theme1 d-lg-none">
                            <a href="#offcanvas-mobile-menu" class="offcanvas-toggle">
                                <svg viewbox="0 0 700 550">
                                    <path
                                        d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200"
                                        id="top"></path>
                                    <path d="M300,320 L540,320" id="middle"></path>
                                    <path
                                        d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190"
                                        id="bottom"
                                        transform="translate(480, 320) scale(1, -1) translate(-480, -318)"></path>
                                </svg>
                            </a>
                        </div>
                        <div class="cart-block-links theme1 d-none d-sm-block">
                            <ul class="d-flex">
                                @auth
                                    <li class="dropdown notification-list topbar-dropdown">
                                        <a class="nav-link dropdown-toggle nav-user me-0" href="#"
                                            id="profileDropdown" role="button" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <img src="{{ asset('storage/' . Auth::user()->anh_dai_dien) }}"
                                                alt="Ảnh đại diện" width="50" height="50" class="rounded-circle">
                                            {{-- <span class="pro-user-name ms-1">
                                                {{ Auth::user()->ho_ten }} <i class="mdi mdi-chevron-down"></i>
                                            </span> --}}
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end profile-dropdown">
                                            <!-- Tài khoản -->
                                            <a class="dropdown-item notify-item" href="#" id="showUserProfile">
                                                <i class="mdi mdi-account-circle-outline fs-16 align-middle"></i>
                                                <span>Tài khoản</span>
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <!-- Đăng xuất -->
                                            <form id="logout-form" action="{{ route('auth.logout') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="dropdown-item notify-item">
                                                    <i class="mdi mdi-location-exit fs-16 align-middle"></i>
                                                    <span>Đăng Xuất</span>
                                                </button>
                                            </form>
                                        </div>
                                    </li>

                                    <!-- Popup thông tin tài khoản -->
                                    <div id="userProfilePopup" class="user-profile-popup" style="display: none">
                                        <div class="popup-content">
                                            <div class="popup-header">
                                                <h5>Thông tin tài khoản</h5>
                                                <span class="close-popup" id="closeUserProfile">&times;</span>
                                            </div>
                                            <div class="popup-body">
                                                @auth
                                                    <p><strong>Họ tên:</strong> {{ Auth::user()->ho_ten }}</p>
                                                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                                                    <p><strong>Số điện thoại:</strong> {{ Auth::user()->so_dien_thoai }}</p>
                                                    <p><strong>Địa chỉ:</strong> {{ Auth::user()->dia_chi }}</p>
                                                @else
                                                    <p>Vui lòng đăng nhập để xem thông tin tài khoản.</p>
                                                @endauth
                                            </div>
                                            <div class="popup-footer">
                                                <button class="btn btn-primary" id="editUserProfileBtn">Sửa</button>
                                                <button class="btn btn-secondary" id="closeUserProfileBtn">Đóng</button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Popup chỉnh sửa tài khoản -->
                                    <div id="editUserProfilePopup" class="user-profile-popup" style="display: none">
                                        <div class="popup-content">
                                            <div class="popup-header">
                                                <h5>Chỉnh sửa tài khoản</h5>
                                                <span class="close-popup" id="closeEditUserProfile">&times;</span>
                                            </div>
                                            <div class="popup-body">
                                                <form id="editUserProfileForm" action="{{ route('user.update') }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="hoTen" class="form-label">Họ tên</label>
                                                        <input type="text" class="form-control" id="hoTen"
                                                            name="ho_ten" value="{{ Auth::user()->ho_ten }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="anhDaiDien" class="form-label">Ảnh đại diện</label>
                                                        <input type="file" class="form-control" id="anhDaiDien"
                                                            name="anh_dai_dien">
                                                        @if (Auth::user()->anh_dai_dien)
                                                            <div class="mt-2">
                                                                <label>Ảnh hiện tại:</label>
                                                                <img src="{{ asset('storage/' . Auth::user()->anh_dai_dien) }}"
                                                                    alt="Ảnh hiện tại" class="rounded-circle"
                                                                    style="width: 100px; height: 100px;">
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="diaChi" class="form-label">Địa Chỉ</label>
                                                        <input type="text" class="form-control" id="diaChi"
                                                            name="dia_chi" value="{{ Auth::user()->dia_chi }}">
                                                    </div>
                                                    <button type="submit" class="btn btn-success">Lưu</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        id="cancelEditProfile">Hủy</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <li>
                                        <a style="font-size: 16px;" href="javascript:void(0)" onclick="openLoginModal()">
                                            Đăng Nhập
                                        </a>
                                    </li>
                                    <li>
                                        <a style="font-size: 16px;" href="javascript:void(0)"
                                            onclick="openRegisterModal()">
                                            Đăng Ký
                                        </a>
                                    </li>
                                    <!-- Modal đăng nhập -->
                                    <div id="loginModal" class="modal-overlay">
                                        <div class="modal-content">
                                            <!-- Nút đóng modal -->
                                            <span class="close-button" onclick="closeLoginModal()">&times;</span>

                                            <!-- Form đăng nhập -->
                                            <form action="{{ route('auth.login') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div
                                                    class="header-text mb-4 text-center d-flex flex-column justify-content-center align-items-center">
                                                    <h2>Đăng Nhập</h2>
                                                    <p>Chào mừng bạn quay trở lại với chúng tôi</p>
                                                </div>

                                                <!-- Input email -->
                                                <div class="input-group mb-3">
                                                    <input type="email"
                                                        class="form-control form-control-lg bg-light fs-6 @error('email') is-invalid @enderror"
                                                        name="email" id="email" required
                                                        placeholder="Email address" value="{{ old('email') }}">
                                                    @error('email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <!-- Input password -->
                                                <div class="input-group mb-1">
                                                    <input type="password" name="password" id="password" required
                                                        class="form-control form-control-lg bg-light fs-6 @error('password') is-invalid @enderror"
                                                        placeholder="Password" value="{{ old('password') }}">
                                                    @error('password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <!-- Nhớ mật khẩu và quên mật khẩu -->
                                                <div class="input-group mb-5 d-flex justify-content-between">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="remember" class="form-check-input"
                                                            id="formCheck">
                                                        <label for="formCheck"
                                                            class="form-check-label text-secondary"><small>Remember
                                                                Me</small></label>
                                                    </div>
                                                    <div class="forgot">
                                                        <small><a href="{{ route('auth.forgot_password') }}">Quên mật
                                                                khẩu?</a></small>
                                                    </div>
                                                </div>

                                                <!-- Nút đăng nhập -->
                                                <div class="input-group mb-3">
                                                    <button class="btn btn-lg btn-primary w-100 fs-6">Login</button>
                                                </div>

                                                <!-- Nút đăng nhập bằng Google và Facebook -->
                                                <div class="input-group d-flex mb-3">
                                                    <button class="btn btn-lg btn-light me-2 fs-6">
                                                        <img src="{{ asset('images/google.png') }}" style="width: 20px;"
                                                            class="me-2">
                                                        Sign In with Google
                                                    </button>
                                                    <button class="btn btn-lg btn-light ms-2 fs-6">
                                                        <img src="{{ asset('images/facebook.png') }}"
                                                            style="width: 20px;" class="me-2">
                                                        Sign In with Facebook
                                                    </button>
                                                </div>

                                                <!-- Chuyển hướng đến đăng ký -->
                                                <div class="row">
                                                    <small>Bạn chưa có tài khoản? <a href="javascript:void(0)"
                                                            onclick="switchToRegisterModal()">
                                                            Đăng Kí
                                                        </a></small>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Modal đăng ký -->
                                    <div id="registerModal" class="modal-overlay">
                                        <div class="modal-content">
                                            <!-- Nút đóng modal -->
                                            <span class="close-button" onclick="closeRegisterModal()">&times;</span>

                                            <!-- Form đăng ký -->
                                            <form action="{{ route('auth.register') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div
                                                    class="header-text mb-4 text-center d-flex flex-column justify-content-center align-items-center">
                                                    <h2>Đăng Kí</h2>
                                                </div>

                                                <!-- Input họ tên -->
                                                <div class="input-group mb-3">
                                                    <input type="text" id="ho_ten" name="ho_ten"
                                                        value="{{ old('ho_ten') }}" required
                                                        class="form-control form-control-lg bg-light fs-6 @error('ho_ten') is-invalid @enderror"
                                                        placeholder="Họ Tên">
                                                    @error('ho_ten')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <!-- Input email -->
                                                <div class="input-group mb-3">
                                                    <input type="email" id="email" name="email"
                                                        value="{{ old('email') }}" required
                                                        class="form-control form-control-lg bg-light fs-6 @error('email') is-invalid @enderror"
                                                        placeholder="Email">
                                                    @error('email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <!-- Input số điện thoại -->
                                                <div class="input-group mb-3">
                                                    <input type="number" id="so_dien_thoai" name="so_dien_thoai"
                                                        value="{{ old('so_dien_thoai') }}" required
                                                        class="form-control form-control-lg bg-light fs-6 @error('so_dien_thoai') is-invalid @enderror"
                                                        placeholder="Số điện thoại">
                                                    @error('so_dien_thoai')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <!-- Input mật khẩu -->
                                                <div class="input-group mb-3">
                                                    <input type="password" id="password" name="password" required
                                                        class="form-control form-control-lg bg-light fs-6 @error('password') is-invalid @enderror"
                                                        placeholder="Mật Khẩu">
                                                    @error('password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <!-- Input xác nhận mật khẩu -->
                                                <div class="input-group mb-3">
                                                    <input type="password" id="password_confirmation"
                                                        name="password_confirmation" required
                                                        class="form-control form-control-lg bg-light fs-6 @error('password_confirmation') is-invalid @enderror"
                                                        placeholder="Xác nhận mật khẩu">
                                                    @error('password_confirmation')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <!-- Nút đăng ký -->
                                                <div class="input-group mb-3">
                                                    <button class="btn btn-lg btn-primary w-100 fs-6">Đăng Kí</button>
                                                </div>

                                                <!-- Nút đăng ký bằng Google và Facebook -->
                                                <div class="input-group d-flex mb-3">
                                                    <button class="btn btn-lg btn-light me-2 fs-6">
                                                        <img src="{{ asset('images/google.png') }}" style="width: 20px;"
                                                            class="me-2">
                                                        Sign In with Google
                                                    </button>

                                                    <button class="btn btn-lg btn-light ms-2 fs-6">
                                                        <img src="{{ asset('images/facebook.png') }}"
                                                            style="width: 20px;" class="me-2">
                                                        Sign In with Facebook
                                                    </button>
                                                </div>

                                                <!-- Chuyển hướng đến đăng nhập -->
                                                <div class="row">
                                                    <small>Bạn đã có tài khoản? <a href="javascript:void(0)"
                                                            onclick="switchToLoginModal()"> Đăng
                                                            Nhập
                                                        </a></small>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endauth
                            </ul>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header-middle end -->
</header>
<!-- header end -->
<!-- CSS cho modal -->
<script>
    @auth
    var isAuthenticated = true;
    @else
        var isAuthenticated = false;
    @endauth
    // Hàm mở modal đăng nhập
    function openLoginModal() {
        document.getElementById("loginModal").style.display = "block";
    }

    // Hàm mở modal đăng ký
    function openRegisterModal() {
        document.getElementById("registerModal").style.display = "block";
    }

    // Hàm đóng modal đăng nhập
    function closeLoginModal() {
        document.getElementById("loginModal").style.display = "none";
    }

    // Hàm đóng modal đăng ký
    function closeRegisterModal() {
        document.getElementById("registerModal").style.display = "none";
    }

    // Chuyển từ đăng nhập sang đăng ký
    function switchToRegisterModal() {
        closeLoginModal();
        openRegisterModal();
    }

    // Chuyển từ đăng ký sang đăng nhập
    function switchToLoginModal() {
        closeRegisterModal();
        openLoginModal();
    }
</script>

<style>
    .user-profile-popup {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .popup-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        width: 400px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        position: relative;
    }

    .popup-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .close-popup {
        cursor: pointer;
        font-size: 24px;
    }

    .popup-body p,
    .popup-body .form-label {
        margin: 10px 0;
    }

    .popup-footer {
        text-align: right;
    }

    /* Nền mờ của modal */
    .modal-overlay {
        display: none;
        /* Ẩn mặc định */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        /* Làm mờ nền */
        justify-content: center;
        /* Canh giữa theo chiều ngang */
        align-items: center;
        /* Canh giữa theo chiều dọc */
        z-index: 1000;
        /* Đặt modal lên trên cùng */
    }

    /* Nội dung của modal (form đăng nhập) */
    .modal-content {
        background: white;
        padding: 20px;
        border-radius: 10px;
        width: 400px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        position: relative;
        /* Để nút close nằm bên trong */
        z-index: 1001;
        /* Bên trong modal */
    }

    /* Nút đóng modal (X) */
    .close-button {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 24px;
        cursor: pointer;
        color: #333;
    }

    /* Hiển thị modal khi nó được kích hoạt */
    .modal-overlay.active {
        display: flex;
        /* Hiển thị modal khi có class active */
    }
</style>

<!-- JavaScript cho modal -->
<script>
    $(document).ready(function() {
        // Hiển thị popup thông tin người dùng
        $('#showUserProfile').click(function(e) {
            e.preventDefault();
            console.log('Nút thông tin cá nhân đã được click!'); // Thêm dòng này để kiểm tra
            $('#userProfilePopup').fadeIn();
        });

        // Ẩn popup thông tin người dùng
        $('#closeUserProfile, #closeUserProfileBtn').click(function() {
            $('#userProfilePopup').fadeOut();
        });

        // Hiển thị popup chỉnh sửa tài khoản
        $('#editUserProfileBtn').click(function() {
            $('#userProfilePopup').fadeOut();
            $('#editUserProfilePopup').fadeIn();
        });

        // Ẩn popup chỉnh sửa tài khoản
        $('#closeEditUserProfile, #cancelEditProfile').click(function() {
            $('#editUserProfilePopup').fadeOut();
        });

        // Đóng popup khi click bên ngoài popup
        $(window).click(function(e) {
            if ($(e.target).is('#userProfilePopup')) {
                $('#userProfilePopup').fadeOut();
            }
            if ($(e.target).is('#editUserProfilePopup')) {
                $('#editUserProfilePopup').fadeOut();
            }
        });

        // Gửi form chỉnh sửa qua AJAX
        $('#editUserProfileForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    alert('Cập nhật thông tin thành công!');
                    $('#editUserProfilePopup').fadeOut();
                },
                error: function(xhr) {
                    alert('Có lỗi xảy ra. Vui lòng thử lại.');
                }
            });
        });
    });
    // Mở modal khi nhấn vào nút "Đăng Nhập"
    function openLoginModal() {
        document.getElementById('loginModal').classList.add('active');
    }

    // Đóng modal khi nhấn vào nút "X"
    function closeLoginModal() {
        document.getElementById('loginModal').classList.remove('active');
    }

    // Đóng modal khi nhấn vào bên ngoài form
    window.onclick = function(event) {
        const modal = document.getElementById('loginModal');
        if (event.target === modal) {
            modal.classList.remove('active');
        }
    }
    // Mở modal khi nhấn vào nút "Đăng Kí"
    function openRegisterModal() {
        document.getElementById('registerModal').classList.add('active');
    }

    // Đóng modal khi nhấn vào nút "X"
    function closeRegisterModal() {
        document.getElementById('registerModal').classList.remove('active');
    }

    // Đóng modal khi nhấn vào bên ngoài form
    window.onclick = function(event) {
        const modal = document.getElementById('registerModal');
        if (event.target === modal) {
            modal.classList.remove('active');
        }
    }
</script>
