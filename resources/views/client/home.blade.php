@extends('client.layout')

@section('content')
    <style>
        .main-slider {
            height: 100vh;
            display: flex;

        }

        .slider-item {
            max-height: 500px;
            display: flex;
            justify-content: center;
            align-items: center;
            /* Ensures no content overflows */
        }

        .slider-content {
            margin-bottom: 50px;
            text-align: center;

        }

        .text {
            margin: 0;
            font-size: 1.5rem;
        }

        .title {
            font-size: 2.5rem;
            margin-top: 10px;
        }

        .btn {
            margin-top: 20px;
        }


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
            width: 100%;
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

        .product-tab .col-lg-3 {
            flex: 0 0 25%;
            /* 4 sản phẩm trong 1 hàng */
        }



        .product-thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
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



        .snowflake {
            position: absolute;
            top: -10px;
            font-size: 1em;
            color: #ffffff;
            opacity: 0.9;
            user-select: none;
            pointer-events: none;
            animation: fall 10s linear infinite;
        }

        @keyframes fall {
            0% {
                transform: translateY(-10px) translateX(0);
                opacity: 1;
            }

            100% {
                transform: translateY(100vh) translateX(20px);
                opacity: 0.3;
            }
        }

        .blinking-text {
            color: red;
            font-size: 15px;
            animation: blink 1s infinite;
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

        svg {
            width: 350px;
            height: 150px;
        }

        /* Phần chữ Merry Christmas - Cong nhẹ */
        .curved-text text {
            font-size: 22px;
            font-weight: 500;
            fill: #e74c3c;

        }

        /* Đường cong */
        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
                /* Chữ nhảy lên */
            }
        }

        /* Phần chữ SALE UPTO 20% - Nhảy */
        .bouncing-text {
            font-size: 48px;
            font-weight: bold;
            fill: #e74c3c;
            text-transform: uppercase;
            animation: bounce 1s infinite;
        }

        .slider-content1 {
            display: flex;
            flex-direction: column;
            align-items: center;
            transform: translate(64%, -100%);
            position: absolute;
        }

        .curved-text {
            margin-bottom: -10px;
            /* Giảm khoảng cách dưới của chữ Merry Christmas */
        }

        .bouncing-text {
            position: absolute;
            top: 100%;
            right: 16%;
        }

        .btn-see-cart {
            position: relative;
            left: 25%;
            top: 100px;
            background: #4498c8;
            color: #fff;
            border-color: #4498c8;
            border-radius: 8px;
        }

        .btn-see-cart:hover {
            background: #367da5;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
                /* Chữ nhảy lên */
            }
        }

        .bg-img {
            height: 100vh !important;
            max-height: 100vh !important;
        }
    </style>
    <!-- main slider start -->
    <section class="bg-light">
        <div class=" main-slider dots-style theme1">
            <div class="slider-item bg-img bg-img1 ">
                <div class="container">
                    <div class="row align-items-center slider-height">
                        <div class="col-12">
                            <div class="slider-content1">
                                <svg class="curved-text" viewBox="0 25 400 30">
                                    <path id="curve1" d="M50,120 Q150,90 250,120" fill="transparent" stroke="none" />
                                    <text>
                                        <textPath href="#curve1" startOffset="50%" text-anchor="middle">
                                            Merry Christmas
                                        </textPath>
                                    </text>
                                </svg>

                                <!-- Chữ SALE UPTO 20%, nhảy nhót -->
                                <svg class="bouncing-text">
                                    <text class="bouncing-text" x="50%" y="50%" text-anchor="middle">
                                        SALE UPTO 50%
                                    </text>
                                </svg>

                                {{-- <p class="text animated text-slider" data-animation-in="fadeInDown" data-delay-in=".300">
                                    ArtiCraft
                                <p class="text animated" data-animation-in="fadeInDown" data-delay-in=".300"
                                    style="color: #5C5BCA">
                                </p> --}}
                                {{-- <h2 class="title animated">
                                    <span class="animated d-block" data-animation-in="fadeInLeft" data-delay-in=".800"
                                        style="color: #5C5BCA">Khơi
                                        nguồn đam mê nghệ thuật</span>
                                    <span class="animated font-weight-bold" data-animation-in="fadeInRight"
                                        data-delay-in="1.5" style="color: #5C5BCA" style="color: #5C5BCA">Ưu đãi 20%</span>
                                </h2>
                                <a href="{{ route('client.cuahang') }}"
                            class="btn btn-outline-primary btn--lg animated mt-45 mt-sm-25"
                            data-animation-in="fadeInLeft" data-delay-in="1.9">Xem thêm</a> --}}
                            </div>
                            <div>
                                <a href="{{ route('client.cuahang') }}"
                                    class="btn btn-outline-primary btn--lg  mt-45 mt-sm-25 btn-see-cart"
                                    data-animation-in="fadeInLeft">Mua ngay</a>
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
                                {{-- <p class="text animated text-slider" data-animation-in="fadeInLeft" data-delay-in=".300">
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
                                <a href="shop-grid-4-column.html"
                                    class="btn btn-outline-primary btn--lg animated mt-45 mt-sm-25 button_primary"
                                    href="{{ route('client.cuahang') }}"
                            class="btn btn-outline-primary btn--lg animated mt-45 mt-sm-25"
                            data-animation-in="fadeInLeft" data-delay-in="1.9">Mua Ngay</a> --}}
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
                                {{-- <p class="text animated text-slider" data-animation-in="fadeInLeft" data-delay-in=".300">
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
                            data-animation-in="fadeInLeft" data-delay-in="1.9">Khám phá ngay</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- slider-item end -->
        </div>
    </section>
    <!-- main slider end -->
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

    <!-- staic media end -->
    <!-- common banner  start -->
    <div class="common-banner bg-white">
        <div class="container">

        </div>
    </div>
    <!-- common banner  end -->

    <!-- product tab start -->
    <section class="product-tab bg-white pb-80">
        <div class="container">

            <div class="product-tab-nav mb-50">
                <div class="row align-items-center">
                    {{-- <div class="col-12">
                        <div class="section-title text-center">
                            <h2 class="title pb-3 mb-3">Sản phẩm của chúng tôi</h2>
                            <p class="text">Vẽ sáng tạo - Tô hạnh phúc</p>
                        </div>
                    </div> --}}

                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="tab-content" id="pills-tabContent">
                        <!-- first tab-pane -->
                        <div class="pb-80">
                            <div class="row">
                                <div class="section-title text-center">
                                    <h2 class="title pb-3 mb-3">SẢN PHẨM MỚI</h2>
                                </div>
                                @foreach ($sanPhamMois as $item)
                                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                                        <div class="card product-card">
                                            <div class="card-body p-0">
                                                <div class="media flex-column">
                                                    <div class="product-thumbnail position-relative" style="">
                                                        <span class="badge badge-danger top-right blinking-text">Mới</span>
                                                        <a href="{{ route('san-phams.incrementViews', $item->id) }}">
                                                            <img class="first-img"
                                                                src="{{ asset('storage/' . $item->anh_san_pham) }}"
                                                                alt="thumbnail" />
                                                        </a>
                                                    </div>
                                                    <div class="media-body w-100">
                                                        <div class="product-desc">
                                                            <h3 class="title min_h">
                                                                <a class=""
                                                                    href="{{ route('sanpham.chitiet', $item->id) }}">{{ $item->ten_san_pham }}</a>
                                                            </h3>
                                                            <div class="star-rating">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    @if ($item->diem_trung_binh > 0 && $i <= floor($item->diem_trung_binh))
                                                                        <span class="ion-ios-star"></span>
                                                                        <!-- Sao có màu -->
                                                                    @else
                                                                        <span class="ion-ios-star-outline"></span>
                                                                        <!-- Sao không màu -->
                                                                    @endif
                                                                @endfor
                                                            </div>
                                                            <div class="d-flex align-items-center justify-content-between">
                                                                <p>Giá: </p>
                                                                <p style="color:red;font-weight: 600;">

                                                                    {{ number_format($item->gia_goc, 0, ',', '.') }}
                                                                    VNĐ
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
                        <div class="pb-80">
                            <div class="row">
                                <div class="section-title text-center">
                                    <h2 class="title pb-3 mb-3">SẢN PHẨM GIẢM GIÁ</h2>
                                </div>
                                @foreach ($sanPhamGiamGias as $sanPhamGg)
                                    <div class="col-12 col-md-6 col-lg-3 mb-4"> <!-- Sửa col-lg-2 thành col-lg-3 -->
                                        <div class="card product-card">
                                            <div class="card-body p-0">
                                                <div class="media flex-column">
                                                    <div class="product-thumbnail position-relative">
                                                        <span
                                                            class="bg-danger badge badge-danger top-right p-2">-{{ $sanPhamGg->phan_tram_giam_gia }}%</span>
                                                        <a href="{{ route('san-phams.incrementViews', $sanPhamGg->id) }}">
                                                            <img class="first-img"
                                                                src="{{ asset('storage/' . $sanPhamGg->anh_san_pham) }}"
                                                                alt="thumbnail" />
                                                        </a>
                                                    </div>
                                                    <div class="media-body w-100">
                                                        <div class="product-desc">
                                                            <h3 class="title min_h">
                                                                <a
                                                                    href="{{ route('sanpham.chitiet', $sanPhamGg->id) }}">{{ $sanPhamGg->ten_san_pham }}</a>
                                                            </h3>
                                                            <div class="star-rating">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    @if ($sanPhamGg->danh_gia > 0 && $i <= floor($sanPhamGg->danh_gia))
                                                                        <span class="ion-ios-star"></span>
                                                                    @else
                                                                        <span class="ion-ios-star-outline"></span>
                                                                    @endif
                                                                @endfor
                                                            </div>
                                                            <div class="d-flex align-items-center justify-content-between">
                                                                <p>Giá: </p>
                                                                <p style="color: red">
                                                                    <del
                                                                        style="color: black">{{ number_format($sanPhamGg->gia_goc, 0, ',', '.') }}</del>
                                                                    {{ number_format($sanPhamGg->gia_km, 0, ',', '.') }}
                                                                    VNĐ
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
                        <h2 class="title pb-3 mb-3">SẢN PHẨM ĐƯỢC QUAN TÂM</h2>
                    </div>
                    <div class="product-slider-init theme1 slick-nav">
                        @foreach ($sanPhamView as $sanphamview)
                            <div class="slider-item">
                                <div class="card product-card">
                                    <div class="card-body p-0">
                                        <div class="media flex-column">
                                            <div class="product-thumbnail position-relative">
                                                <span class="badge badge-danger top-right">{{ $sanphamview->views }} lượt
                                                    xem</span>
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
                                                        <p>Giá: </p>
                                                        <p style="color: red">
                                                            <del
                                                                style="color: black">{{ number_format($sanphamview->gia_goc, 0, ',', '.') }}</del>
                                                            {{ number_format($sanphamview->gia_km, 0, ',', '.') }} VNĐ
                                                        </p>
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
                        <h2 class="title pb-3 mb-3">BÀI VIẾT MỚI NHẤT</h2>
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
                                            href="{{ url('client/baivietchitiet', $baivietmoi->id) }}">Tác giả:
                                            {{ $baivietmoi->user?->ho_ten }}</a>
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

    {{-- end --}}

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
        const maxSnowflakes = 20;

        function createSnowflake() {
            if (document.querySelectorAll('.snowflake').length < maxSnowflakes) {
                const snowflake = document.createElement('div');
                snowflake.classList.add('snowflake');
                snowflake.innerText = '❄️';


                snowflake.style.left = `${Math.random() * 100}%`;
                snowflake.style.fontSize = `${Math.random() * 1.5 + 0.5}em`;

                document.querySelector('.discount-codes').appendChild(snowflake);

                snowflake.addEventListener('animationend', () => {
                    snowflake.remove();
                });
            }
        }

        // Tạo bông tuyết mới mỗi 500ms
        setInterval(createSnowflake, 500);
    </script>
@endsection
