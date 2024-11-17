
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
                                        <div class="d-flex align-items-center flex-row-reverse position-relative"
                                            id="searchContainer">
                                            <div class="my-2 mx-2">
                                                <!-- Icon tìm kiếm -->
                                                <a class="search-toggle" id="searchIcon" role="button"
                                                    style="font-size: 20px; cursor: pointer;">
                                                    <i class="icon-magnifier"></i>
                                                </a>
                                            </div>
                                            <!-- Input tìm kiếm (ẩn mặc định) -->
                                            <div id="searchInput" class="search-input d-none">
                                                <div class="input-group">
                                                    <input type="text" name="search" class="form-control"
                                                        placeholder="Tìm kiếm..." aria-label="Search">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </li>



                                <li class="mr-xl-0 cart-block position-relative me-1">
                                    <a id="notification-icon" href="javascript:void(0);">
                                        <span class="position-relative">
                                            <i class="icon-bell"></i>
                                        </span>
                                    </a>
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
                            <!-- Modal thông báo -->
                            <div class="modal fade" id="notificationModal" tabindex="-1"
                                aria-labelledby="notificationModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="notificationModalLabel">Thông báo</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <ul id="order-list">
                                                <li>

                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                            style="width: 50px;" id="profileDropdown" role="button"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            @php
                                                $avatar = Auth::user()->anh_dai_dien;

                                                // Check if 'anh_dai_dien' is a URL or a storage path
                                                $isUrl = filter_var($avatar, FILTER_VALIDATE_URL) !== false;
                                            @endphp

                                            <img src="{{ $isUrl ? $avatar : asset('storage/' . $avatar) }}"
                                                alt="Ảnh đại diện" width="32" height="32" class="rounded-circle">
                                            {{-- <span class="pro-user-name ms-1">
                                                {{ Auth::user()->ho_ten }} <i class="mdi mdi-chevron-down"></i>
                                        </span> --}}
                                        </a>
                                        <div
                                            class="dropdown-menu dropdown-menu-end profile-dropdown profile-dropdown__info">
                                            <!-- <hr> -->
                                            <a class="notify-item notify-item__form"
                                                href="{{ route('taikhoan.dashboard') }}" id="">
                                                <i class="far fa-user"></i> <span>Thông tin tài khoản</span>
                                            </a>
                                            <!-- <div class="dropdown-divider"></div> -->
                                            <!-- Đăng xuất -->
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
                                    <li class="me-0">
                                        <a style="font-size: 16px;" href="{{ route('auth.login') }}">
                                            Đăng Nhập
                                        </a>
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
    /* Hiệu ứng trượt */
    @keyframes slideIn {
        from {
            transform: translateY(-10px);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @keyframes slideOut {
        from {
            transform: translateY(0);
            opacity: 1;
        }

        to {
            transform: translateY(-10px);
            opacity: 0;
        }
    }

    /* Style cho ô nhập liệu */
    .search-input {
        position: absolute;
        top: 100%;
        /* Hiển thị ngay dưới biểu tượng */
        right: 0;
        width: 250px;
        z-index: 1000;
        background: white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        border-radius: 4px;
        animation-duration: 0.3s;
        animation-timing-function: ease-in-out;
    }

    /* Hiệu ứng trượt vào */
    @keyframes slideIn {
        0% {
            width: 0;
            opacity: 0;
        }

        100% {
            width: 200px;
            /* Độ rộng khi hiển thị */
            opacity: 1;
            /* Hiển thị nội dung */
        }
    }

    /* Hiệu ứng trượt ra */
    @keyframes slideOut {
        0% {
            width: 200px;
            /* Độ rộng ban đầu */
            opacity: 1;
            /* Hiện tại */
        }

        100% {
            width: 0;
            /* Không hiển thị khi trượt ra */
            opacity: 0;
            /* Ẩn nội dung */
        }
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


    /* search  */
    #product-search {
        position: absolute;
        /* Đặt vị trí tuyệt đối để nó không bị che khuất */
        top: 100%;
        /* Đảm bảo nó sẽ xuất hiện ngay dưới ô input */
        left: 0;
        right: 0;
        /* Để dropdown bao phủ chiều ngang của ô input */
        max-height: 300px;
        /* Giới hạn chiều cao */
        background-color: #fff;
        /* Màu nền trắng */
        border: 1px solid #ddd;
        /* Viền mờ để dễ nhìn */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        /* Để dropdown có bóng đổ */
        width: 100%;
        /* Đảm bảo chiều rộng của dropdown bằng với ô input */
        z-index: 9999;
        /* Đảm bảo dropdown hiển thị lên trên tất cả các phần tử khác */
        display: none;
        /* Ẩn mặc định */
        border-radius: 5px;
        /* Bo góc */
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
    // Đảm bảo mã JavaScript chạy sau khi DOM được tải
    document.addEventListener("DOMContentLoaded", function() {
        const searchIcon = document.getElementById("searchIcon");
        const searchInput = document.getElementById("searchInput");

        // Thêm sự kiện click vào biểu tượng tìm kiếm
        searchIcon.addEventListener("click", function() {
            if (searchInput.classList.contains("d-none")) {
                // Hiển thị ô nhập liệu với hiệu ứng trượt xuống
                searchInput.classList.remove("d-none");
                searchInput.style.animationName = "slideIn";
            } else {
                // Ẩn ô nhập liệu với hiệu ứng trượt lên
                searchInput.style.animationName = "slideOut";
                setTimeout(() => {
                    searchInput.classList.add("d-none");
                }, 300); // Chờ hiệu ứng hoàn tất trước khi ẩn
            }
        });
    });

    $(document).ready(function() {
        // Mở modal khi nhấn vào chuông thông báo
        $('#notification-icon').click(function() {
            $('#notificationModal').modal('show');
        });
    });


    // Lấy phần tử icon và container
    const searchIcon = document.getElementById("searchIcon");
    const searchContainer = document.getElementById("searchContainer");
    let isSearchInputVisible = false; // Trạng thái hiển thị của ô nhập liệu

    // Thêm sự kiện click vào icon để hiển thị/ẩn ô nhập liệu
    searchIcon.addEventListener("click", function() {
        // Kiểm tra xem phần tử tìm kiếm đã tồn tại chưa
        const existingSearchInput = document.getElementById("searchInput");

        if (!existingSearchInput) {
            // Nếu ô nhập liệu chưa hiển thị, tạo và thêm nó vào DOM
            const searchInputLi = document.createElement("div");
            searchInputLi.id = "searchInput"; // Thêm ID cho ô nhập liệu
            searchInputLi.classList.add("my-2", "mx-2", "search-input");

            // Tạo nội dung của ô nhập liệu
            searchInputLi.innerHTML = `
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Tìm kiếm..." aria-label="Search" id="inputsearch">
            <div class="product-grouped product-count style " id="product-search" style="position: absolute; width: 100%;top:100%; background: white; z-index: 100; display: none;">
            </div>
        </div>
        `;

            // Thêm ô nhập liệu ngay sau icon
            searchContainer.appendChild(searchInputLi);
            // Thêm hiệu ứng slide-in
            searchInputLi.style.animationName = "slideIn";
            isSearchInputVisible = true;
        } else {
            // Nếu ô nhập liệu đã hiển thị, thêm hiệu ứng slide-out
            existingSearchInput.style.animationName = "slideOut"; // Bỏ hiệu ứng trước khi xóa
            setTimeout(() => {
                existingSearchInput.remove();
            }, 500); // Đợi hết hiệu ứng trước khi xóa phần tử
            isSearchInputVisible = false;
        }
    });

    // Lắng nghe sự kiện 'keyup' trên input search
    $(document).on('keyup', '#inputsearch', function() {
        var query = $(this).val();

        // Kiểm tra nếu có ít nhất 2 ký tự thì bắt đầu gọi AJAX tìm kiếm
        if (query.length > 1) {
            $.ajax({
                url: "{{ route('global.search') }}", // Đảm bảo route này đúng
                type: "GET",
                data: {
                    query: query
                },
                success: function(data) {
                    $('#product-search').empty();
                    if (data.products.length) {
                        $('#product-search').show(); // Hiển thị dropdown

                        data.products.forEach(function(product) {
                            $('#product-search').append(
                                '<div class="dropdown-item">' +
                                '<a href="{{ url('client/sanphamchitiet') }}/' +
                                product.id + '" class="d-flex align-items-center">' +
                                '<img src="' + product.image_url + '" alt="' + product
                                .ten_san_pham +
                                '" style="width: 40px; height: auto;" class="me-3">' +
                                '<div class="flex-column d-flex">' +
                                '<span class="text-truncate" style="max-width: 120px;">' +
                                product.ten_san_pham + '</span>' +
                                '<span class="ms-auto">' + product.gia_km +
                                ' VNĐ</span>' +
                                '</div>' +
                                '</a>' +
                                '</div>'
                            );
                        });
                    } else {
                        $('#product-search').append(
                            '<div class="suggestion-item">Không tìm thấy kết quả</div>'
                        );
                    }
                }
            });
        } else {
            $('#product-search').empty(); // Xóa gợi ý khi không có từ khóa tìm kiếm
            $('#product-search').hide(); // Ẩn dropdown
        }
    });

    // Ẩn gợi ý khi nhấp bên ngoài
    $(document).on('click', function(e) {
        if (!$(e.target).closest('#inputsearch').length) {
            $('#product-search').empty(); // Xóa kết quả tìm kiếm
            $('#product-search').hide(); // Ẩn dropdown
        }
    });
</script>
