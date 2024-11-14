@extends('client.layout')

@section('content')
    <style>
        .product-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .product-card h5 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .product-card p {
            font-size: 14px;
            color: #555;
        }

        .product-card p:last-child {
            font-weight: bold;
            color: #000;
        }
    </style>
    <div class="container">
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
                                            data-delay-in="1.5" style="color: #5C5BCA" style="color: #5C5BCA">Ưu đãi
                                            20%</span>
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
                                    <p class="text animated text-slider" data-animation-in="fadeInLeft"
                                        data-delay-in=".300">
                                        ArtiCraft
                                    <p class="text animated" data-animation-in="fadeInLeft" data-delay-in=".300"
                                        style="color: #5C5BCA">
                                        Nghệ thuật cho mọi người
                                    </p>

                                    <h2 class="title">
                                        <span class="animated d-block" data-animation-in="fadeInRight" data-delay-in=".800"
                                            style="color: #5C5BCA">
                                            Sáng tạo không giới hạn</span>
                                        <span class="animated font-weight-bold" data-animation-in="fadeInUp"
                                            data-delay-in="1.5" style="color: #5C5BCA">Giảm giá 40%</span>
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
                                    <p class="text animated text-slider" data-animation-in="fadeInLeft"
                                        data-delay-in=".300">
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
                                        <span class="animated font-weight-bold" data-animation-in="fadeInUp"
                                            data-delay-in="1.5" style="color: #5C5BCA">Sản phẩm mới</span>
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
        @if ($sanPhams->isEmpty())
            <!-- Kiểm tra nếu danh sách sản phẩm trống -->
            <p class="text-center">Sản phẩm hiện không có hàng.</p>
        @else
            <div class="row">
                @foreach ($sanPhams as $sanPham)
                    <div class="col-md-4">
                        <div class="product-card">
                            <a href="{{ route('san-phams.incrementViews', $sanPham->id) }}">
                                <img src="{{ asset('storage/' . $sanPham->anh_san_pham) }}"
                                    alt="{{ $sanPham->ten_san_pham }}" class="product-image">
                                <h5>{{ $sanPham->ten_san_pham }}</h5>
                                <p>{{ $sanPham->mo_ta }}</p>
                                <p>{{ number_format($sanPham->gia) }} VND</p>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
