<style>
    .dropdown-menu {
        display: none;
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.3s ease-in-out;
    }

    .dropdown:hover .dropdown-menu,
    .dropdown-menu.show {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }

    .notification-dot {
        width: 15px;
        height: 15px;
        background-color: red;
        border-radius: 50%;
        position: absolute;
        top: -20px;
        left: -10px;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
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

    .btn-login {
        border: 1px solid #5a5a9c !important;
        padding: 6px 12px !important;
        border-radius: 4px;
        background: #5a5a9c !important;
        color: #fff !important;
        transform: translateX(10px);
    }
    .btn-login:hover {
        border: 1px solid #5a5a9c !important;
        background: #fff !important;
        color: #5a5a9c !important;
    }


</style>

<!-- header start -->
<header>
    <!-- header-middle satrt -->
    <div id="sticky" class="header-middle theme1 py-15 py-lg-0">
        <div class="container position-relative">
            <div class="row align-items-center justify-content-between">
                <div class="col-xl-3 col-lg-3 col-6  ">
                    <div class="logo col-8">
                        <a href="{{ route('client.home') }}"><img
                                src="{{ asset('assets/client/images/logo/logo_art2.png') }}" alt="logo" /></a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 d-none d-lg-block">
                    <ul class="main-menu d-flex justify-content-center">
                        <li class="ml-0">
                            <a href="{{ route('client.home') }}" class="ps-0">Trang chủ </a>
                        </li>
                        <li>
                            <a href="{{ route('client.gioithieu') }}">Giới thiệu <i class="menu-text"></i></a>
                        </li>
                        <li>
                            <a href="{{ route('client.cuahang') }}">Cửa hàng</a>
                        </li>

                        <li>
                            <a href="{{ url('client/baiviet') }}">Blog</a>
                        </li>
                        <li><a href="{{ route('client.lienhe') }}">Liên hệ</a></li>
                    </ul>
                </div>
                <div class="col-xl-3 col-lg-3 col-6 ">
                    <!-- search-form end -->
                    <div class="d-flex align-items-center justify-content-end">
                        <!-- static-media end -->
                        <div class="cart-block-links theme1 d-none d-sm-block">
                            <ul class="d-flex align-items-center gap-2" style="transform: translateY(3px);">
                                <!-- <li>
                                    <a href="{{ route('cart.index') }}" class="search search-toggle">
                                        <i class="icon-magnifier"></i>
                                    </a>
                                </li> -->
                                <li class="mr-xl-0 cart-block position-relative me-1">
                                    <form class="search-box" style="margin: 0;" action="{{ url('/') }}"
                                        method="get">
                                        @csrf
                                        <div class="d-flex align-items-center flex-row-reverse position-relative" id="searchContainer">
                                            <div class="my-2 mx-2">
                                                <!-- Icon tìm kiếm -->
                                                <a class="search-toggle" id="searchIcon" role="button" style="font-size: 20px; cursor: pointer;">
                                                    <i class="icon-magnifier"></i>
                                                </a>
                                            </div>
                                            <!-- Input tìm kiếm (ẩn mặc định) -->
                                            <div id="searchInput" class="search-input d-none position-relative">
                                                <div class="input-group">
                                                    <input type="text" name="search" id="inputsearch" class="form-control" placeholder="Tìm kiếm..." aria-label="Search">
                                                    <div id="product-search" class="product-grouped product-count style" style="position: absolute; width: 100%; top: 100%; background: white; z-index: 100; display: none;">
                                                     
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                </li>
                                <li class="mr-xl-0 cart-block position-relative">
                                    <a class="" href="{{ route('cart.index') }}">
                                        <span class="position-relative">
                                            <i class="icon-bag"></i>
                                            <span class="badge cbdg1">{{ $cartItemsCount }}</span>
                                            {{-- tổng số sản phẩm có trong giỏ hàng --}}
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
                                    <a class="nav-link dropdown-toggle nav-user me-0 avatar_box" href="#"
                                        style="width: 50px;" id="profileDropdown" role="button">
                                        @php
                                        $avatar = Auth::user()->anh_dai_dien;
                                        $isUrl = filter_var($avatar, FILTER_VALIDATE_URL) !== false;
                                        @endphp
                                        <img src="{{ $isUrl ? $avatar : asset('storage/' . $avatar) }}"
                                            alt="Ảnh đại diện" width="32" height="32" class="rounded-circle">
                                        @php
                                        $tongDonHang = DB::table('don_hangs')
                                        ->where('trang_thai_don_hang', 'Chờ xác nhận')
                                        ->where('user_id', Auth::id()) // Lọc theo ID người dùng hiện tại
                                        ->count();
                                        @endphp
                                        @if ($tongDonHang > 0)
                                        <span class="ms-2 position-relative">
                                            <span class="notification-dot">{{ $tongDonHang }}</span>
                                        </span>
                                        @endif
                                    </a>
                                    <div
                                        class="dropdown-menu dropdown-menu-end profile-dropdown profile-dropdown__info">
                                        <a class="notify-item notify-item__form"
                                            href="{{ route('taikhoan.dashboard') }}">
                                            <i class="far fa-user"></i> <span>Thông tin tài khoản</span>
                                        </a>
                                        <form id="logout-form" class="notify-item notify-item__form"
                                            style="margin-bottom: 0;" action="{{ route('auth.logout') }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item notify-item__button">
                                                <i class="mdi mdi-location-exit fs-16 align-middle"></i>
                                                <span>Đăng Xuất</span>
                                            </button>
                                        </form>
                                    </div>
                                </li>
                                @else
                                <li class="me-0" >
                                    <a style=" font-size: 15px; " class="btn-login " href="{{ route('auth.login') }}">
                                        Đăng Nhập
                                    </a>
                                    <!-- <button class="btn-login btn-30">Đăng Nhập</button> -->
                                </li>
                                @endauth
                            </ul>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header-middle end -->


    </div>


</header>
<!-- header end -->
<!-- CSS cho modal -->
<script>
    @auth
    var isAuthenticated = true;
    @else
    var isAuthenticated = false;
    @endauth
</script>

<style>
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideOut {
        from {
            opacity: 1;
            transform: translateY(0);
        }

        to {
            opacity: 0;
            transform: translateY(-10px);
        }
    }

    #searchInput {
        width: 200px;
    }

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



    #product-search .dropdown-item {
        padding: 8px 12px;
        cursor: pointer;
        font-size: 14px;
        color: #333;
    }

    #product-search .dropdown-item:hover {
        background-color: #f1f1f1;
        /* Màu nền khi hover */
        color: #007bff;
        /* Đổi màu chữ khi hover */
    }

    #product-search .suggestion-ite #product-search .dropdown-item {
        padding: 8px 12px;
        cursor: pointer;
    }

    #product-search .dropdown-item:hover {
        background-color: #f8f8f8;
    }

    .profile-dropdown__info {
        /* display: flex ; */
        align-items: flex-start;
        flex-direction: column;
        padding: 0;
    }

    .profile-dropdown__info a {
        text-align: justify !important;
    }

    .notify-item {
        font-size: 14px !important;
        font-weight: 400 !important;
        color: #515151 !important;
        width: 100%;
        display: block;
        border-bottom: 1px solid #ccc !important;
        padding: 8px 12px;
    }

    .notify-item__form:hover {
        background: #e9ecef;
    }

    .notify-item__button {
        padding: 0;
        font-size: 14px !important;
        font-weight: 400 !important;
        color: #515151 !important;
    }
</style>

<!-- JavaScript cho modal -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchIcon = document.getElementById("searchIcon");
        const searchInputContainer = document.getElementById("searchInput");
        const inputSearch = document.getElementById("inputsearch");
        const productSearch = document.getElementById("product-search");

        // Thêm sự kiện click vào biểu tượng tìm kiếm
        searchIcon.addEventListener("click", function() {
            if (searchInputContainer.classList.contains("d-none")) {
                searchInputContainer.classList.remove("d-none");
                searchInputContainer.style.animation = "slideIn 0.3s forwards";
            } else {
                searchInputContainer.style.animation = "slideOut 0.3s forwards";
                setTimeout(() => {
                    searchInputContainer.classList.add("d-none");
                    productSearch.style.display = "none"; // Ẩn dropdown khi đóng ô input
                    productSearch.innerHTML = ""; // Xóa nội dung kết quả tìm kiếm
                }, 300); // Chờ hiệu ứng hoàn tất trước khi ẩn
            }
        });

        // Lắng nghe sự kiện 'keyup' trên input tìm kiếm
        $(document).on("keyup", "#inputsearch", function() {
            const query = $(this).val();

            if (query.length > 0) { // Nếu có bất kỳ ký tự nào
                $.ajax({
                    url: "{{ route('global.search') }}",
                    type: "GET",
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $("#product-search").empty();
                        $("#product-search").show(); // Hiển thị dropdown

                        if (data.products.length > 0) {
                            data.products.forEach(function(product) {
                                $("#product-search").append(`
                                <div class="dropdown-item">
                                    <a href="{{ url('client/sanphamchitiet') }}/${product.id}" class="d-flex align-items-center">
                                        <img src="${product.image_url}" alt="${product.ten_san_pham}" style="width: 40px; height: auto;" class="me-3">
                                        <div class="flex-column d-flex align-items-start">
                                            <span class="text-truncate" style="max-width: 120px;">${product.ten_san_pham}</span>
                                            <span class="ms-auto">${product.gia_km} VNĐ</span>
                                        </div>
                                    </a>
                                </div>
                            `);
                            });
                        } else {
                            // Hiển thị thông báo "Không tìm thấy sản phẩm"
                            $("#product-search").append(
                                '<div class="suggestion-item p-2 text-center text-muted">Không tìm thấy sản phẩm</div>'
                            );
                        }
                    },
                    error: function() {
                        $("#product-search").empty();
                        $("#product-search")
                            .show(); // Hiển thị thông báo lỗi nếu AJAX thất bại
                        $("#product-search").append(
                            '<div class="suggestion-item p-2 text-center text-danger">Có lỗi xảy ra, vui lòng thử lại sau</div>'
                        );
                    }
                });
            } else {
                $("#product-search").empty();
                $("#product-search").hide();
            }
        });

        // Ẩn gợi ý khi nhấp bên ngoài
        $(document).on("click", function(e) {
            if (!$(e.target).closest("#inputsearch").length && !$(e.target).closest("#product-search")
                .length) {
                $("#product-search").empty();
                $("#product-search").hide();
            }
        });
    });
</script>