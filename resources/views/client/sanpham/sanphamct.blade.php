@extends('client.layout')

@section('content')
    <style>
        /* Căn chỉnh các nút đánh giá ngang đều */
        .filter-rating {
            display: flex;
            justify-content: start;
            gap: 10px;
            /* Khoảng cách giữa các nút */
            /* flex-wrap: wrap; */
            /* Để các nút tự động xuống dòng nếu màn hình nhỏ */
        }

        /* Style cho các nút */
        .filter-btn {
            background-color: #ffffff;
            color: #4460b5;
            border: 1px solid #9d89ba;
            border-radius: 5px;
            padding: 5px 10px;
            /* Giảm kích thước padding */
            font-size: 1.3rem;
            /* Giảm kích thước chữ */
            line-height: 1;
            /* Đảm bảo chiều cao hợp lý */
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .filter-btn:hover {
            background-color: #fff;
            color: #5a5a9c;
            /* số */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            /* Tăng độ bóng khi hover */
            transform: translateY(-2px);
            /* Nâng nút lên */
        }

        .filter-btn:active {
            /* background-color: #0056b3; */
            box-shadow: 0 2px 4px #7148ee(0, 0, 0, 0.1);
            transform: translateY(1px);
            /* Nhấn nút xuống */
        }

        #no-reviews-message {
            font-size: 1.2rem;
            font-weight: bold;
            color: red;
            margin: 20px 0;
        }

        .single-review {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .review-img {
            margin-right: 15px;
        }

        .review-img img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
        }

        .review-content {
            flex-grow: 1;
        }

        .review-top-wrap {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .review-left h5 {
            font-size: 1.1rem;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .rating-product i {
            font-size: 1.1rem;
        }

        .rating-product {
            display: inline-flex;
            align-items: center;
        }

        .review-bottom {
            margin-top: 10px;
        }

        .review-bottom p {
            font-size: 1rem;
            color: #555;
        }

        @media (max-width: 767px) {
            .single-review {
                flex-direction: column;
                align-items: center;
            }

            .review-img {
                margin-right: 0;
                margin-bottom: 10px;
            }

            .review-top-wrap {
                flex-direction: column;
                align-items: center;
            }

            .review-left h5 {
                text-align: center;
            }
        }
    </style>
    <!-- breadcrumb-section start -->
    <nav class="breadcrumb-section theme1 bg-lighten2 pt-110 pb-110">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title pb-4 text-dark text-capitalize" style=" color: #fff !important">
                            Chi tiết sản phẩm
                        </h2>
                    </div>
                </div>
                <div class="col-12">
                    <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
                        <li class="breadcrumb-item"><a href="{{ route('client.home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Chi tiết sản phẩm
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </nav>

    <!-- breadcrumb-section end -->
    <!-- product-single start -->
    <section class="product-single theme1 pt-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div>
                        <div class="position-relative">
                            <span class="badge badge-danger top-right">Mới</span>
                        </div>
                        <div class="product-sync-init mb-20">
                            <!-- Ảnh sản phẩm chính -->
                            <div class="single-product main-product">
                                <div class="product-thumb">
                                    <img src="{{ asset('/storage/' . $sanPhamCT->anh_san_pham) }}" alt="Ảnh sản phẩm chính">
                                </div>
                            </div>

                            <!-- Ảnh các biến thể sản phẩm -->
                            @foreach ($sanPhamCT->bien_the_san_phams as $bienThe)
                                <div class="single-product variant-product">
                                    <div class="product-thumb">
                                        <img src="{{ asset('/storage/' . $bienThe->anh_bien_the) }}"
                                            alt="Ảnh biến thể sản phẩm">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Thanh điều hướng ảnh (thumbnail) -->
                    <div class="product-sync-nav single-product">
                        <!-- Ảnh sản phẩm chính -->
                        <div class="single-product thumbnail">
                            <div class="product-thumb">
                                <a href="javascript:void(0)"
                                    onclick="showMainImage('{{ asset('/storage/' . $sanPhamCT->anh_san_pham) }}')">
                                    <img src="{{ asset('/storage/' . $sanPhamCT->anh_san_pham) }}"
                                        alt="Thumbnail sản phẩm chính">
                                </a>
                            </div>
                        </div>

                        <!-- Thumbnail ảnh biến thể sản phẩm -->
                        @foreach ($sanPhamCT->bien_the_san_phams as $bienThe)
                            <div class="single-product thumbnail">
                                <div class="product-thumb">
                                    <a href="javascript:void(0)"
                                        onclick="showMainImage('{{ asset('/storage/' . $bienThe->anh_bien_the) }}')">
                                        <img src="{{ asset('/storage/' . $bienThe->anh_bien_the) }}"
                                            alt="Thumbnail biến thể sản phẩm">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
                <div class="col-lg-6">
                    <div class="single-product-info">
                        <div class="single-product-head">
                            <h2 class="title mb-20">{{ $sanPhamCT->ten_san_pham }}</h2>
                            <div class="star-content mb-20">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $sanPhamCT->diem_trung_binh)
                                        <i class="mdi mdi-star text-warning" style="font-size: 2.3em;"></i>
                                    @else
                                        <i class="mdi mdi-star-outline text-muted" style="font-size: 2.3em;"></i>
                                    @endif
                                @endfor
                                <a href="#" id="write-comment"><span class="ms-2"><i
                                            class="far fa-comment-dots"></i></span>
                                    Xem đánh giá <span>( {{ $sanPhamCT->danh_gias->count() }} )</span>
                                </a>
                                {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><span
                                            class="edite"><i class="far fa-edit"></i></span>Viết đánh giá</a> --}}
                            </div>
                        </div>
                        <div class="product-body mb-40">
                            <div class="d-flex align-items-center mb-30">
                                <div class="product-price me-2">
                                    <del class="del" id="old-price" style="font-size: 24px">
                                        {{ number_format($sanPhamCT->gia_goc) }}</del>
                                    <span id="new-price" class="onsale"
                                        style="font-size: 28px; color: red">{{ number_format($sanPhamCT->gia_km) }}</span>
                                    <!-- Giá cập nhật sẽ được hiển thị ở đây -->

                                </div>

                                <span class="badge position-static bg-dark rounded-0">Giảm
                                    {{ $sanPhamCT->phan_tram_giam_gia }}%</span>
                            </div>
                            <span style="font-size: 17px">Còn {{ $sanPhamCT->so_luong }} sản phẩm trong
                                kho</span>
                            <p class="product-summary">
                                {{ $sanPhamCT->mo_ta_ngan }}
                            </p>
                            <div class="short-description">
                                <ul class="product-specs">
                                    <!-- Thêm thông tin chi tiết sản phẩm nếu cần -->
                                </ul>
                            </div>
                        </div>

                        <!-- Hiển thị ảnh sản phẩm -->
                        <div class="product-image mb-30">

                        </div>

                        <form id="add-to-cart-form{{ $sanPhamCT->id }}" action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="san_pham_id" value="{{ $sanPhamCT->id }}">
                            <div class="product-footer">
                                <div class="d-flex">
                                    <div class="product-size me-5">
                                        <h3 class="title">Size</h3>
                                        <select name="size_san_pham_id" id="size_san_pham_id{{ $sanPhamCT->id }}">
                                            <option value="">--Chọn size--</option>
                                            @foreach ($sizes as $size)
                                                <option value="{{ $size->id }}">{{ $size->ten_size }}</option>
                                            @endforeach
                                        </select>
                                        <span id="size-error" class="text-danger" style="display: none;">Vui lòng chọn
                                            size!</span>
                                    </div>

                                    <div class="check-box ms-5">
                                        <h4 class="title">Màu Sắc</h4>
                                        <div class="d-flex check-box-wrap-list" id="color-options">
                                            <!-- Màu sắc sẽ được load sau khi chọn size -->
                                        </div>
                                        <span id="color-error" class="text-danger" style="display: none;">Vui lòng chọn
                                            màu!</span>
                                    </div>
                                </div>

                                <div class="product-count style d-flex flex-column flex-sm-row mt-30 mb-20">
                                    <div class="count d-flex">
                                        <input type="number" name="quantity" min="1"
                                            max="{{ $sanPhamCT->so_luong }}" value="1" required
                                            id="quantity-input" />
                                        <div class="button-group">
                                            <button type="button" class="count-btn increment"
                                                onclick="incrementQuantity()">
                                                <i class="fas fa-chevron-up"></i>
                                            </button>
                                            <button type="button" class="count-btn decrement"
                                                onclick="decrementQuantity()">
                                                <i class="fas fa-chevron-down"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div>
                                        @auth
                                            <button type="submit" class="btn btn-dark btn--xl mt-5 mt-sm-0">
                                                <span class="me-2"></span> Thêm vào giỏ hàng
                                            </button>

                                        @endauth
                                        @guest
                                            <button type="button" class="btn btn-dark btn--xl mt-5 mt-sm-0"
                                                onclick="promptLogin()">
                                                <span class="me-2"></span> Thêm vào giỏ hàng
                                            </button>
                                        @endguest
                                    </div>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- product-single end -->
    <!-- product tab start -->

    <div class="product-tab theme1 bg-white pt-60 pb-80">
        <div class="container">
            <div class="product-tab-nav">
                <div class="row align-items-center">
                    <div class="col-12">
                        <nav class="product-tab-menu single-product">
                            <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-home-tab" data-bs-toggle="pill" href="#pills-home"
                                        role="tab" aria-controls="pills-home" aria-selected="true">Mô tả</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-contact-tab" data-bs-toggle="pill"
                                        href="#pills-contact" role="tab" aria-controls="pills-contact"
                                        aria-selected="false">Đánh giá</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- product-tab-nav end -->
            <div class="row">
                <div class="col-12">
                    <div class="tab-content" id="pills-tabContent">
                        <!-- first tab-pane -->
                        <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="single-product-desc">
                                <p>
                                    {!! $sanPhamCT->ma_ta_san_pham !!}
                                </p>

                            </div>
                        </div>
                        <!-- second tab-pane -->
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                            aria-labelledby="pills-profile-tab">
                            <div class="single-product-desc">
                                <div class="product-anotherinfo-wrapper">
                                    <ul>
                                        {{ $sanPhamCT->mo_ta_ngan }}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- third tab-pane -->
                        <div class="tab-pane fade show active" id="pills-contact" role="tabpanel"
                            aria-labelledby="pills-contact-tab">
                            <div class="single-product-desc">
                                <h4 style="font-size: 18px;font-weight: 600;">ĐÁNH GIÁ CỦA KHÁCH HÀNG:</h4>
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="filter-rating mb-4">
                                            <button class="filter-btn" data-star="5">5 <i
                                                    class="mdi mdi-star text-warning"
                                                    style="font-size: 1.3rem;"></i></button>
                                            <button class="filter-btn" data-star="4">4 <i
                                                    class="mdi mdi-star text-warning"
                                                    style="font-size: 1.3rem;"></i></button>
                                            <button class="filter-btn" data-star="3">3 <i
                                                    class="mdi mdi-star text-warning"
                                                    style="font-size: 1.3rem;"></i></button>
                                            <button class="filter-btn" data-star="2">2 <i
                                                    class="mdi mdi-star text-warning"
                                                    style="font-size: 1.3rem;"></i></button>
                                            <button class="filter-btn" data-star="1">1 <i
                                                    class="mdi mdi-star text-warning"
                                                    style="font-size: 1.3rem;"></i></button>
                                            <button class="filter-btn" data-star="all">All</button>
                                        </div>
                                        <div id="no-reviews-message"
                                            style="display: none; color: red; text-align: center;">
                                            Không có đánh giá phù hợp.
                                        </div>
                                        <div class="review-wrapper">
                                            @foreach ($sanPhamCT->danh_gias as $danhgia)
                                                <div class="single-review mb-4 p-3 shadow-sm rounded-lg bg-light">
                                                    <div class="d-flex align-items-center" style="width: 100%">
                                                        <div class="review-img me-3">
                                                            @if ($danhgia->users->anh_dai_dien)
                                                                <img src="{{ asset('storage/' . $danhgia->users->anh_dai_dien) }}"
                                                                    alt="{{ $danhgia->users->ho_ten }}"
                                                                    class="rounded-circle" />
                                                            @else
                                                                <img src="#" alt="{{ $danhgia->users->ho_ten }}"
                                                                    class="rounded-circle" />
                                                            @endif
                                                        </div>
                                                        <div class="review-content">
                                                            <div class="review-top-wrap d-flex justify-content-between">
                                                                <div class="review-left">
                                                                    <h5 class="review-name mb-1">
                                                                        {{ $danhgia->users->ho_ten }}</h5>
                                                                </div>
                                                                <div class="rating-product">
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        @if ($i <= $danhgia->diem_so)
                                                                            <i class="mdi mdi-star text-warning"
                                                                                style="font-size: 1.5rem;"></i>
                                                                        @else
                                                                            <i class="mdi mdi-star-outline text-muted"
                                                                                style="font-size: 1.5rem;"></i>
                                                                        @endif
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                            <div class="review-bottom mt-2">
                                                                <p class="text-muted">{{ $danhgia->binh_luan }}</p>
                                                                <small>{{ \Carbon\Carbon::parse($danhgia->ngay_danh_gia)->format('d/m/Y') }}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- product tab end -->
    <!-- new arrival section start -->
    <section class="theme1 bg-white pb-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title pb-3 mb-3">Bạn cũng có thể thích</h2>

                    </div>
                </div>
                <div class="col-12">
                    <div class="product-slider-init theme1 slick-nav">
                        @foreach ($sanLienQuan as $sanphamlq)
                            <div class="slider-item">
                                <div class="card product-card">
                                    <div class="card-body p-0">
                                        <div class="media flex-column">
                                            <div class="product-thumbnail position-relative">
                                                <span class="badge badge-danger top-right"
                                                    style="background-color: red">Mới</span>
                                                <a href="{{ route('san-phams.incrementViews', $sanphamlq->id) }}">
                                                    <img class="first-img"
                                                        src="{{ asset('storage/' . $sanphamlq->anh_san_pham) }}"
                                                        alt="thumbnail" />
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="product-desc">
                                                    <h3 class="title min_h">
                                                        <a
                                                            href="{{ route('san-phams.incrementViews', $sanphamlq->id) }}">{{ $sanphamlq->ten_san_pham }}</a>
                                                    </h3>
                                                    <div class="rating">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $sanphamlq->diem_trung_binh)
                                                                <i class="mdi mdi-star text-warning"
                                                                    style="font-size: 2.3em;"></i>
                                                            @else
                                                                <i class="mdi mdi-star-outline text-muted"
                                                                    style="font-size: 2.3em;"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <span
                                                            class="product-price">{{ number_format($sanphamlq->gia_km) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- slider-item end -->
                    </div>
                </div>
            </div>
            <style>
                .min_h {
                    display: -webkit-box;
                    -webkit-line-clamp: 2;
                    /* Số dòng muốn hiển thị */
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    min-height: 3em;
                    /* Tùy chỉnh chiều cao tối thiểu dựa trên chiều cao dòng */
                }
            </style>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Hàm lọc màu sắc khi chọn size
        document.getElementById('size_san_pham_id{{ $sanPhamCT->id }}').addEventListener('change', function() {
            var sizeId = this.value; // Lấy size được chọn
            var colorOptions = @json($colorsBySize); // Mảng các màu sắc cho từng size
            var colorsBySize = @json($colorsBySize); // Mảng các biến thể theo size và màu
            var newPriceElement = document.getElementById('new-price'); // Phần tử giá mới
            var oldPriceElement = document.getElementById('old-price');

            // Làm trống các lựa chọn màu cũ
            var colorContainer = document.getElementById('color-options');
            colorContainer.innerHTML = '';

            if (sizeId && colorOptions[sizeId]) {
                // Lọc ra các màu sắc tương ứng với size đã chọn
                colorOptions[sizeId].forEach(function(color) {
                    var colorInput = document.createElement('input');
                    colorInput.type = 'radio';
                    colorInput.name = 'color';
                    colorInput.id = 'color-' + color.id;
                    colorInput.value = color.id;
                    colorInput.required = true;

                    var colorLabel = document.createElement('label');
                    colorLabel.setAttribute('for', 'color-' + color.id);
                    colorLabel.classList.add('me-2');
                    colorLabel.textContent = `${color.ten_color} (Tồn kho: ${color.so_luong})`;

                    var colorDiv = document.createElement('div');
                    colorDiv.classList.add('widget-check-box');
                    colorDiv.appendChild(colorInput);
                    colorDiv.appendChild(colorLabel);

                    colorInput.addEventListener('change', function() {
                        var selectedColorId = colorInput.value;
                        console.log('Size ID: ', sizeId);
                        console.log('Color ID: ', selectedColorId);
                        console.log('Color Options: ',
                            colorOptions); // Kiểm tra cấu trúc của colorOptions

                        // Tìm biến thể tương ứng với size và màu
                        var selectedVariant = null;
                        // Duyệt qua các biến thể để tìm match sizeId và selectedColorId
                        colorsBySize[sizeId].forEach(function(variant) {
                            if (variant.id == selectedColorId) {
                                selectedVariant = variant;
                            }
                        });

                        console.log('Selected Variant: ', selectedVariant);

                        if (selectedVariant) {
                            // Tính giá mới: gia_km + gia của cặp size và màu
                            var newPrice = parseFloat({{ $sanPhamCT->gia_km }}) + parseFloat(
                                selectedVariant.gia);
                            newPriceElement.textContent = numberWithCommas(
                                newPrice); // Cập nhật giá mới

                            var oldPrice = parseFloat({{ $sanPhamCT->gia_goc }}) + parseFloat(
                                selectedVariant.gia);
                            oldPriceElement.textContent = numberWithCommas(
                                oldPrice); // Cập nhật giá mới

                            // Cập nhật số lượng tồn kho
                            var quantityInput = document.getElementById('quantity-input');
                            quantityInput.max = selectedVariant.so_luong;
                            quantityInput.value = 1; // Đặt lại số lượng khi chọn màu mới

                            // Kiểm tra tồn kho và vô hiệu hóa nút nếu hết hàng
                            var addToCartButton = document.querySelector(
                                `#add-to-cart-form{{ $sanPhamCT->id }} button[type="submit"]`);
                            if (selectedVariant.so_luong === 0) {
                                addToCartButton.textContent = "Đã hết hàng";
                                addToCartButton.disabled = true;
                                quantityInput.disabled = true;
                            } else {
                                addToCartButton.textContent = "Thêm vào giỏ hàng";
                                addToCartButton.disabled = false;
                                quantityInput.disabled = false;
                            }
                        }
                    });

                    colorContainer.appendChild(colorDiv);
                });

            }
        });


        // Hàm hỗ trợ định dạng số có dấu phân cách ngàn
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
        // Hàm hỗ trợ định dạng số có dấu phân cách ngàn
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('form[id^="add-to-cart-form"]').forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault(); // Ngăn chặn hành động mặc định của form

                    const formData = new FormData(form); // Lấy dữ liệu của form
                    const url = form.getAttribute('action');
                    fetch(url, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json' // Cấu hình để server hiểu đây là yêu cầu JSON
                            },
                            body: formData
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(
                                    'Network response was not ok'); // Kiểm tra phản hồi HTTP
                            }
                            return response.json(); // Xử lý phản hồi JSON
                        })
                        .then(data => {
                            if (data.success) {
                                toastr.success(data.message); // Hiển thị thông báo thành công
                            } else {
                                toastr.error(data.message ||
                                    'Có lỗi xảy ra.'); // Hiển thị thông báo lỗi nếu có
                            }
                        })
                        .catch(error => {
                            toastr.error(
                                'Đã xảy ra lỗi khi thêm vào giỏ hàng. Vui lòng kiểm tra lại.'
                            ); // Thông báo lỗi chung

                            console.error('Error:', error); // Để debug lỗi trên console
                        });
                });
            });
            document.querySelectorAll('.filter-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const rating = this.getAttribute('data-star');
                    console.log('Nút đã được nhấn, giá trị rating:', rating);
                    filterReviews(rating);
                });
            });

            function filterReviews(rating) {
                const reviews = document.querySelectorAll('.single-review');
                let found = false; // Biến để kiểm tra có đánh giá phù hợp hay không

                reviews.forEach(review => {
                    const reviewRating = review.querySelector('.rating-product');
                    const stars = reviewRating.querySelectorAll('.mdi-star.text-warning')
                        .length; // Lấy số sao đã được đánh giá

                    console.log('Số sao trong đánh giá:', stars); // In ra số sao trong mỗi đánh giá

                    // Nếu đánh giá có số sao khớp với bộ lọc
                    if (rating === 'all' || stars === parseInt(rating)) {
                        review.style.display = 'block'; // Hiển thị đánh giá
                        found = true; // Đánh dấu đã tìm thấy ít nhất 1 đánh giá phù hợp
                    } else {
                        review.style.display = 'none'; // Ẩn đánh giá
                    }
                });

                // Hiển thị/ẩn thông báo nếu không có đánh giá nào phù hợp
                const noReviewsMessage = document.getElementById('no-reviews-message');
                if (found) {
                    noReviewsMessage.style.display = 'none'; // Ẩn thông báo nếu có đánh giá
                } else {
                    noReviewsMessage.style.display = 'block'; // Hiển thị thông báo nếu không có đánh giá
                }
            }

        });

        // Hàm tăng số lượng
        function incrementQuantity() {
            const quantityInput = document.querySelector('input[name="quantity"]');
            let quantity = parseInt(quantityInput.value);
            if (quantity < 1) {
                quantityInput.value = quantity + 1;
            }
        } // Hàm giảm số lượng function decrementQuantity() { const
        quantityInput = document.querySelector('input[name="quantity" ]');
        let quantity = parseInt(quantityInput.value);
        if (quantity > 1) {
            quantityInput.value = quantity - 1;
        }


        function showMainImage(imageUrl) {
            // Tìm phần tử của ảnh chính
            const mainImage = document.querySelector('.main-product .product-thumb img');
            if (mainImage) {
                mainImage.src = imageUrl;
            }
        }
        const reviewInput = document.getElementById("review");
        const charCountDisplay = document.getElementById("charCount");

        reviewInput.addEventListener("input", function() {
            const currentLength = reviewInput.value.length;

            // Cập nhật bộ đếm ký tự
            charCountDisplay.textContent = `${currentLength}/100`;

            // Nếu vượt quá 100 ký tự, cắt ngắn lại (phòng ngừa trường hợp maxlength không hoạt động trên một số trình duyệt)
            if (currentLength > 100) {
                reviewInput.value = reviewInput.value.substring(0, 100);
            }
        });

        function promptLogin() {
            // toastr.options = {
            //     "closeButton": true,
            //     "progressBar": true,
            //     "positionClass": "toast-top-right",
            //     "timeOut": "3000",
            // };
            toastr.warning("Bạn cần đăng nhập hoặc đăng ký để thêm sản phẩm vào giỏ hàng.");

            // setTimeout(function() {
            //     window.location.href = "{{ route('auth.login') }}";
            // }, 1000);
        }
    </script>
@endsection
