@extends('client.layout')

@section('content')
    <style>
        .product-card {
            /* height: 450px; */
            /* Thiết lập chiều cao cố định cho thẻ sản phẩm */
            display: flex;
            flex-direction: column;
        }

        .product-card .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .product-thumbnail {
            height: 250px;
            /* Thiết lập chiều cao cố định cho phần hình ảnh sản phẩm */
            overflow: hidden;
        }

        .product-desc {
            flex-grow: 1;
        }

        .title {
            height: 40px;
            /* Thiết lập chiều cao cố định cho tiêu đề sản phẩm */
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-price {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .product-tab .row {
            display: flex;
            flex-wrap: wrap;
        }

        .product-tab .col-12 {
            flex: 1;
            margin-bottom: 1.5rem;
        }

        .product-tab .col-md-4 {
            flex: 1 1 33.33333%;
        }

        .product-tab .col-lg-2 {
            flex: 1 1 20%;
        }

        .product-card {
            /* Add your styling here */
        }

        .card-body {
            padding: 0;
        }

        .product-thumbnail img {
            width: 100%;
        }

        /* Đảm bảo mỗi phần tử brand có kích thước phù hợp */
        .single-brand {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .brand-content {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .brand-image {
            width: 120px;
            /* Thay đổi kích thước ảnh theo ý muốn */
            height: 120px;
            border-radius: 50%;
            /* Để ảnh hình tròn */
            object-fit: cover;
            /* Cắt ảnh để vừa với khung */
            margin-bottom: 10px;
            /* Khoảng cách giữa ảnh và tên danh mục */
        }

        .brand-name {
            font-size: 14px;
            font-weight: bold;
            color: #333;
            text-transform: uppercase;
            margin-top: 5px;
            /* Khoảng cách giữa tên và các phần tử khác */
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0;
            }
        }

        .badge-danger {
            background-color: red;
            color: white;
            animation: blink 1s infinite;
        }
    </style>
    <!-- main slider start -->
    <section class="bg-light">
        <div class="main-slider dots-style theme1">
            <div class="slider-item bg-img bg-img1">
                <div class="container">
                    <div class="row align-items-center slider-height">
                        <div class="col-12">
                            <div class="slider-content">
                                <p class="text animated text-slider" data-animation-in="fadeInDown" data-delay-in=".300">
                                    ArtiCraft
                                <p class="text animated" data-animation-in="fadeInDown" data-delay-in=".300"
                                    style="color: #5C5BCA">
                                </p>
                                <h2 class="title animated">
                                    <span class="animated d-block" data-animation-in="fadeInLeft" data-delay-in=".800"
                                        style="color: #5C5BCA">Khơi
                                        nguồn đam mê nghệ thuật</span>
                                    <span class="animated font-weight-bold" data-animation-in="fadeInRight"
                                        data-delay-in="1.5" style="color: #5C5BCA" style="color: #5C5BCA">Ưu đãi 20%</span>
                                </h2>
                                <a href="{{ route('client.cuahang') }}"
                                    class="btn btn-outline-primary btn--lg animated mt-45 mt-sm-25"
                                    data-animation-in="fadeInLeft" data-delay-in="1.9">Xem thêm</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- slider-item end -->
            <div class="slider-item bg-img bg-img2">
                <div class="container">
                    <div class="row align-items-center slider-height">
                        <div class="col-12">
                            <div class="slider-content">
                                <p class="text animated text-slider" data-animation-in="fadeInLeft" data-delay-in=".300">
                                    ArtiCraft
                                <p class="text animated" data-animation-in="fadeInLeft" data-delay-in=".300"
                                    style="color: #5C5BCA">
                                    Nghệ thuật cho mọi người
                                </p>

                                <h2 class="title">
                                    <span class="animated d-block" data-animation-in="fadeInRight" data-delay-in=".800"
                                        style="color: #5C5BCA">
                                        Sáng tạo không giới hạn</span>
                                    <span class="animated font-weight-bold" data-animation-in="fadeInUp" data-delay-in="1.5"
                                        style="color: #5C5BCA">Giảm giá 40%</span>
                                </h2>
                                <Nga href="shop-grid-4-column.html"
                                    class="btn btn-outline-primary btn--lg animated mt-45 mt-sm-25 button_primary" <a
                                    href="{{ route('client.cuahang') }}"
                                    class="btn btn-outline-primary btn--lg animated mt-45 mt-sm-25"
                                    data-animation-in="fadeInLeft" data-delay-in="1.9">Mua Ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- slider-item end -->
            <div class="slider-item bg-img bg-img3">
                <div class="container">
                    <div class="row align-items-center slider-height">
                        <div class="col-12">
                            <div class="slider-content">
                                <p class="text animated text-slider" data-animation-in="fadeInLeft" data-delay-in=".300">
                                    ArtiCraft
                                <p class="text animated" data-animation-in="fadeInLeft" data-delay-in=".300"
                                    style="color: #5C5BCA">
                                    Sản phẩm mới - Cảm hứng bất tận
                                </p>
                                <h2 class="title">
                                    <span class="animated d-block" data-animation-in="fadeInRight" data-delay-in=".800"
                                        style="color: #5C5BCA">Vẽ
                                        sáng tạo - Tô hạnh phúc</span>
                                    <span class="animated font-weight-bold text_sale" data-animation-in="fadeInUp"
                                        data-delay-in="1.5">Sale 30% Off</span>
                                    <span class="animated font-weight-bold" data-animation-in="fadeInUp" data-delay-in="1.5"
                                        style="color: #5C5BCA">Sản phẩm mới</span>
                                </h2>

                                <a href="{{ route('client.cuahang') }}"
                                    class="btn btn-outline-primary btn--lg animated mt-45 mt-sm-25"
                                    data-animation-in="fadeInLeft" data-delay-in="1.9">Khám phá ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- slider-item end -->
        </div>
    </section>
    <!-- main slider end -->

    {{-- mã giảm giá 'voucher' --}}
    <section class="discount-codes">
        <div class="container">
            <h2 class="section-title">Mã Giảm Giá <span class="hot-tag">HOT</span> <!-- Thêm chữ HOT -->
            </h2>
            <div class="discount-list">
                @foreach ($discounts as $item)
                    <div class="discount-item">
                        <div class="discount-code">
                            <span class="code">{{ $item->ma_khuyen_mai }}</span>
                        </div>
                        <div class="discount-description">
                            <p>Giảm {{ number_format($item->gia_tri_khuyen_mai, 0, ',', '.') }} VNĐ cho tất cả các sản phẩm.
                            </p>
                        </div>
                        <button class="copy-btn" onclick="copyCode('{{ $item->ma_khuyen_mai }}')">Sao chép mã</button>
                    </div>
                @endforeach


                <!-- Thêm các mã giảm giá khác ở đây -->
            </div>
        </div>
        <!-- Modal -->
        <div id="copyModal" class="copy-modal">
            <div class="modal-content">
                <p id="copyMessage">Mã giảm giá đã được sao chép!</p>
            </div>
        </div>
    </section>
    {{-- end --}}
    <!-- staic media end -->
    <!-- common banner  start -->
    <div class="common-banner bg-white">
        <div class="container">

        </div>
    </div>
    <!-- common banner  end -->

    <!-- product tab start -->
    <section class="product-tab bg-white pt-50 pb-80">
        <div class="container">
            <div class="product-tab-nav mb-50">
                <div class="row align-items-center">
                    {{-- <div class="col-12">
                        <div class="section-title text-center">
                            <h2 class="title pb-3 mb-3">Sản phẩm của chúng tôi</h2>
                            <p class="text">Vẽ sáng tạo - Tô hạnh phúc</p>
                        </div>
                    </div> --}}
                    <div class="col-12">
                        <nav class="product-tab-menu theme1">
                            <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                        href="#pills-home" role="tab" aria-controls="pills-home"
                                        aria-selected="true" style="font-size: 20px">Sản phẩm mới</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                        href="#pills-profile" role="tab" aria-controls="pills-profile"
                                        aria-selected="false" style="font-size: 20px">Đang giảm giá</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="tab-content" id="pills-tabContent">
                        <!-- first tab-pane -->
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <div class="row">
                                @foreach ($sanPhamMois as $item)
                                    <div class="col-12 col-md-4 col-lg-2 mb-4">
                                        <div class="card product-card">
                                            <div class="card-body p-0">
                                                <div class="media flex-column">
                                                    <div class="product-thumbnail position-relative">
                                                        <span class="badge badge-danger top-right">Mới</span>
                                                        <a href="{{ route('san-phams.incrementViews', $item->id) }}">
                                                            <img class="first-img"
                                                                src="{{ asset('storage/' . $item->anh_san_pham) }}"
                                                                alt="thumbnail" />
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="product-desc">
                                                            <h3 class="title min_h">
                                                                <a class=""
                                                                    href="{{ route('sanpham.chitiet', $item->id) }}">{{ $item->ten_san_pham }}</a>
                                                            </h3>
                                                            <div class="star-rating">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    @if ($item->danh_gia > 0 && $i <= floor($item->danh_gia))
                                                                        <span class="ion-ios-star"></span>
                                                                        <!-- Sao có màu -->
                                                                    @else
                                                                        <span class="ion-ios-star-outline"></span>
                                                                        <!-- Sao không màu -->
                                                                    @endif
                                                                @endfor
                                                            </div>
                                                            <div class="d-flex align-items-center justify-content-between">
                                                                <p>Giá: {{ number_format($item->gia_km, 0, ',', '.') }} VNĐ
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <!-- second tab-pane -->
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="row">
                                @foreach ($sanPhamGiamGias as $sanPhamGg)
                                    <div class="col-12 col-md-4 col-lg-2 mb-4">
                                        <div class="card product-card">
                                            <div class="card-body p-0">
                                                <div class="media flex-column">
                                                    <div class="product-thumbnail position-relative">
                                                        <span
                                                            class=" bg-danger badge badge-danger top-right p-2">-{{ $sanPhamGg->phan_tram_giam_gia }}%</span>
                                                        <a href="{{ route('san-phams.incrementViews', $sanPhamGg->id) }}">
                                                            <img class="first-img"
                                                                src="{{ asset('storage/' . $sanPhamGg->anh_san_pham) }}"
                                                                alt="thumbnail" />
                                                        </a>
                                                    </div>
                                                    <div class="media-body w-100">
                                                        <div class="product-desc">
                                                            <h3 class="title min_h">
                                                                <a class=""
                                                                    href="{{ route('sanpham.chitiet', $sanPhamGg->id) }}">{{ $sanPhamGg->ten_san_pham }}</a>
                                                            </h3>
                                                            <div class="star-rating">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    @if ($sanPhamGg->danh_gia > 0 && $i <= floor($sanPhamGg->danh_gia))
                                                                        <span class="ion-ios-star"></span>
                                                                        <!-- Sao có màu -->
                                                                    @else
                                                                        <span class="ion-ios-star-outline"></span>
                                                                        <!-- Sao không màu -->
                                                                    @endif
                                                                @endfor
                                                            </div>
                                                            <div class="d-flex align-items-center justify-content-between">
                                                                <span class="product-price">Giá:
                                                                    {{ number_format($sanPhamGg->gia_km) }} VNĐ</span>
                                                            </div>
                                                        </div>
                                                    </div>
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
    </section>

    <!-- product tab end -->

    <!-- product tab repetation start -->
    <section class="bg-white theme1 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title pb-3 mb-3">Sản phẩm được quan tâm</h2>
                    </div>
                    <div class="product-slider-init theme1 slick-nav">
                        @foreach ($sanPhamView as $sanphamview)
                            <div class="slider-item">
                                <div class="card product-card">
                                    <div class="card-body p-0">
                                        <div class="media flex-column">
                                            <div class="product-thumbnail position-relative">
                                                <span class="badge badge-danger top-right">New</span>
                                                <a href="{{ route('sanpham.chitiet', $item->id) }}">
                                                    <img class="first-img"
                                                        src="{{ asset('/storage/' . $sanphamview->anh_san_pham) }}"
                                                        alt="anh san pham" />
                                                </a>
                                                <!-- product links end-->
                                            </div>
                                            <div class="media-body w-100">
                                                <div class="product-desc">
                                                    <h3 class="title min_h">
                                                        <a class=""
                                                            href="{{ route('san-phams.incrementViews', $sanphamview->id) }}">
                                                            {{ $sanphamview->ten_san_pham }}
                                                        </a>
                                                    </h3>
                                                    <div class="star-rating">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($sanphamview->danh_gia > 0 && $i <= floor($sanphamview->danh_gia))
                                                                <span class="ion-ios-star"></span>
                                                                <!-- Sao có màu -->
                                                            @else
                                                                <span class="ion-ios-star-outline"></span>
                                                                <!-- Sao không màu -->
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <span class="product-price">Giá:
                                                            {{ number_format($sanphamview->gia_km) }} VNĐ</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- slider-item end -->
                        <!-- New women's Fresh Faced Trendy cream -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product tab repetation end -->

    <!-- blog-section start -->
    <section class="blog-section theme1 pb-65">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title pb-3 mb-3">Bài viết mới nhất</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="blog-init slick-nav">
                        @foreach ($baiVietMoi as $baivietmoi)
                            <div class="slider-item">
                                <div class="single-blog">
                                    <a class="blog-thumb mb-20 zoom-in d-block overflow-hidden height-200"
                                        href="{{ url('client/baivietchitiet', $baivietmoi->id) }}">
                                        <img src="{{ asset('/storage/' . $baivietmoi->anh_bai_viet) }}"
                                            alt="blog-thumb-naile" />
                                    </a>
                                    <div class="blog-post-content">
                                        <a class="blog-link theme-color d-inline-block mb-10"
                                            href="{{ url('client/baivietchitiet', $baivietmoi->id) }}">Tác giả: {{ $baivietmoi->user?->ho_ten }}</a>
                                        <h3 class="title mb-15">
                                            <a
                                                href="{{ url('client/baivietchitiet', $baivietmoi->id) }}">{{ $baivietmoi->tieu_de_bai_viet }}</a>
                                        </h3>
                                        <p class="sub-title">
                                            Ngày đăng:
                                            {{ date('d/m/Y', strtotime($baivietmoi->ngay_dang)) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- blog-section end -->
    <!-- brand slider start -->
    <div class="brand-slider-section theme1 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="brand-init border-top py-35 slick-nav-brand">
                        @foreach ($anhDMuc as $anhdm)
                            <div class="slider-item">
                                <div class="single-brand">
                                    <!-- Cập nhật link dẫn đến sản phẩm của danh mục -->
                                    <a href="{{ route('client.showByCategory', $anhdm->id) }}" class="brand-thumb">
                                        <!-- Hiển thị ảnh hình tròn -->
                                        <img src="{{ asset('storage/' . $anhdm->anh_danh_muc) }}" alt="Brand Image"
                                            class="brand-image" />
                                    </a>
                                    <div class="brand-name">{{ $anhdm->ten_danh_muc }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
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
    <script>
        function copyCode(code) {
            var tempInput = document.createElement("input");
            tempInput.value = code;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);
            showCopyModal("Mã giảm giá đã được sao chép: " + code);
        }

        function showCopyModal(message) {
            var modal = document.getElementById("copyModal");
            var modalMessage = document.getElementById("copyMessage");

            modalMessage.textContent = message;

            modal.classList.add("show");

            setTimeout(function() {
                modal.classList.remove("show");
            }, 3000);
        }
    </script>
@endsection
