@extends('client.layout')

@section('content')
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
                                </p>
                                <h2 class="title animated">
                                    <span class="animated d-block main_text tex" style=" color: #5a5ac9 !important;" data-animation-in="fadeInLeft" data-delay-in=".800">Vẽ
                                        sáng tạo - Tô hạnh phúc</span>
                                    <span class="animated font-weight-bold text_sale" style=" color: #5a5ac9 !important;" data-animation-in="fadeInRight"
                                        data-delay-in="1.5">Sale 30% Off</span>
                                </h2>
                                <ngay href="shop-grid-4-column.html"
                                    class="btn btn-outline-primary btn--lg animated mt-45 mt-sm-25 button_primary"
                                    data-animation-in="fadeInLeft" data-delay-in="1.9">Mua ngay</ngay>
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
                                </p>

                                <h2 class="title">
                                    <span class="animated d-block main_text tex" data-animation-in="fadeInRight" data-delay-in=".800">Vẽ
                                        sáng tạo - Tô hạnh phúc</span>
                                    <span class="animated font-weight-bold text_sale" data-animation-in="fadeInUp"
                                        data-delay-in="1.5">Sale 30% Off</span>
                                </h2>
                                <Nga href="shop-grid-4-column.html"
                                    class="btn btn-outline-primary btn--lg animated mt-45 mt-sm-25 button_primary"
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
                                </p>
                                <h2 class="title">
                                    <span class="animated d-block main_text " data-animation-in="fadeInRight" data-delay-in=".800">Vẽ
                                        sáng tạo - Tô hạnh phúc</span>
                                    <span class="animated font-weight-bold text_sale" data-animation-in="fadeInUp"
                                        data-delay-in="1.5">Sale 30% Off</span>
                                </h2>
                                <a href="shop-grid-4-column.html"
                                    class="btn btn-outline-primary btn--lg animated mt-45 mt-sm-25 button_primary"
                                    data-animation-in="fadeInLeft" data-delay-in="1.9">Mua ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- slider-item end -->
        </div>
    </section>
    <!-- main slider end -->
    <!-- staic media start -->
    <section class="static-media-section py-80 bg-white">
        <div class="container">
            <div class="static-media-wrap theme-bg">
                <div class="row">
                    <div class="col-lg-3 col-sm-6 py-3">
                        <div class="d-flex static-media2 flex-column flex-sm-row">
                            <img class="align-self-center mb-2 mb-sm-0 me-auto me-sm-3"
                                src="{{ asset('assets/client/images/icon/2.png') }}" alt="icon" />
                            <div class="media-body">
                                <h4 class="title">Miễn phí vận chuyển</h4>
                                <p class="text">Tất cả đơn hàng trên 50.000d</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 py-3">
                        <div class="d-flex static-media2 flex-column flex-sm-row">
                            <img class="align-self-center mb-2 mb-sm-0 me-auto me-sm-3"
                                src="{{ asset('assets/client/images/icon/3.png') }}" alt="icon" />
                            <div class="media-body">
                                <h4 class="title">Trả hàng miễn phí</h4>
                                <p class="text">Trong vòng 9 ngày</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 py-3">
                        <div class="d-flex static-media2 flex-column flex-sm-row">
                            <img class="align-self-center mb-2 mb-sm-0 me-auto me-sm-3"
                                src="{{ asset('assets/client/images/icon/4.png') }}" alt="icon" />
                            <div class="media-body">
                                <h4 class="title">Thanh toán an toàn 100%</h4>
                                <p class="text">Thanh toán của bạn sẽ an toàn với chúng tôi</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 py-3">
                        <div class="d-flex static-media2 flex-column flex-sm-row">
                            <img class="align-self-center mb-2 mb-sm-0 me-auto me-sm-3"
                                src="{{ asset('assets/client/images/icon/5.png') }}" alt="icon" />
                            <div class="media-body">
                                <h4 class="title">Hỗ trợ 24/7</h4>
                                <p class="text">Liên hệ với chúng tôi 24h/7</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- staic media end -->
    <!-- common banner  start -->
    <div class="common-banner bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-30">
                    <div class="banner-thumb">
                        <a href="shop-grid-4-column.html" class="zoom-in d-block overflow-hidden">
                            <img src="{{ asset('assets/client/images/banner/bottom_banner_3.jpg') }}"
                                alt="banner-thumb-naile" />
                        </a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-30">
                    <div class="banner-thumb">
                        <a href="shop-grid-4-column.html" class="zoom-in d-block overflow-hidden">
                            <img src="{{ asset('assets/client/images/banner/right_banner_1.jpg') }}"
                                alt="banner-thumb-naile" />
                        </a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-30">
                    <div class="banner-thumb">
                        <a href="shop-grid-4-column.html" class="zoom-in d-block overflow-hidden">
                            <img src="{{ asset('assets/client/images/banner/right_banner_1.jpg') }}"
                                alt="banner-thumb-naile" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- common banner  end -->

    <!-- product tab start -->
    <section class="product-tab bg-white pt-50 pb-80">
        <div class="container">
            <div class="product-tab-nav mb-50">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="section-title text-center">
                            <h2 class="title pb-3 mb-3">Sản phẩm của chúng tôi</h2>
                            <p class="text">
                                Vẽ sáng tạo - Tô hạnh phúc
                            </p>
                        </div>
                    </div>
                    <div class="col-12">
                        <nav class="product-tab-menu theme1">
                            <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                        href="#pills-home" role="tab" aria-controls="pills-home"
                                        aria-selected="true">Sản phẩm mới</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                        href="#pills-profile" role="tab" aria-controls="pills-profile"
                                        aria-selected="false">Đang giảm giá</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                        href="#pills-contact" role="tab" aria-controls="pills-contact"
                                        aria-selected="false">Sắp ra mắt</a>
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
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <div class="product-slider-init theme1 slick-nav">
                                @foreach ($sanPhamMois as $item)
                                    <div class="slider-item">
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
                                                        <!-- product links -->
                                                        
                                                        <!-- product links end-->
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="product-desc">
                                                            <h3 class="title">
                                                                <a href="{{ route('sanpham.chitiet', $item->id) }}">
                                                                    {{ $item->ten_san_pham }}
                                                                </a>
                                                            </h3>
                                                            <div class="star-rating">
                                                                <span class="ion-ios-star"></span>
                                                                <span class="ion-ios-star"></span>
                                                                <span class="ion-ios-star"></span>
                                                                <span class="ion-ios-star"></span>
                                                                <span class="ion-ios-star de-selected"></span>
                                                            </div>
                                                            <div class="d-flex align-items-center justify-content-between">
                                                                <span
                                                                    class="product-price">{{ number_format($item->gia_goc) }}</span>
                                                                {{-- <button class="pro-btn" data-bs-toggle="modal"
                                                                    data-bs-target="#add-to-cart">
                                                                    <i class="icon-basket"></i>
                                                                </button> --}}
                                                                {{-- <form action="{{ route('cart.add') }}" method="POST"
                                                                    class="d-inline">
                                                                    @csrf
                                                                    <input type="hidden" name="san_pham_id"
                                                                        value="{{ $item->id }}">
                                                                    <input type="number" name="so_luong" value="1"
                                                                        min="1" class="d-none">
                                                                    <button type="submit" class="pro-btn">
                                                                        <i class="icon-basket"></i>
                                                                    </button>
                                                                </form> --}}


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
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                            aria-labelledby="pills-profile-tab">
                            <div class="product-slider-init theme1 slick-nav">
                                <!-- slider-item end -->
                                @foreach ($sanPhamGiamGias as $sanPhamGg)
                                    <div class="slider-item">
                                        <div class="card product-card">
                                            <div class="card-body p-0">
                                                <div class="media flex-column">
                                                    <div class="product-thumbnail position-relative">
                                                        <span
                                                            class=" bg-danger badge badge-danger top-right p-2">-{{ $sanPhamGg->phan_tram_giam_gia }}%</span>
                                                        <a href="{{ route('sanpham.chitiet', $sanPhamGg->id) }}">
                                                            <img
                                                                src="{{ asset('/storage/' . $sanPhamGg->anh_san_pham) }}">
                                                        </a>
                                                        <!-- product links -->
                                                        
                                                        <!-- product links end-->
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="product-desc">
                                                            <h3 class="title">
                                                                <a
                                                                    href="{{ route('san-phams.incrementViews', $sanPhamGg->id) }}">
                                                                    {{ $sanPhamGg->ten_san_pham }}
                                                                </a>
                                                            </h3>
                                                            <div class="star-rating d-flex justify-content-around">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    @if ($i <= $sanPhamGg->diem_trung_binh)
                                                                        <i class="mdi mdi-star text-warning"
                                                                            style="font-size: 2.3em;"></i>
                                                                        <!-- Ngôi sao đầy -->
                                                                    @else
                                                                        <i class="mdi mdi-star-outline text-muted"
                                                                            style="font-size: 2.3em;"></i>
                                                                        <!-- Ngôi sao rỗng -->
                                                                    @endif
                                                                @endfor
                                                                <span
                                                                    class="ms-2 small">({{ $sanPhamGg->diem_trung_binh }})</span>
                                                            </div>
                                                            <div class="d-flex align-items-center justify-content-between">
                                                                <div class="price-wrapper">
                                                                    <span
                                                                        class="product-price me-2">{{ number_format($sanPhamGg->gia_goc) }}</span>
                                                                    <span
                                                                        class="text-decoration-line-through text-muted">{{ number_format($sanPhamGg->gia_km) }}</span>
                                                                </div>
                                                                {{-- <button class="pro-btn" data-bs-toggle="modal"
                                                                    data-bs-target="#add-to-cart">
                                                                    <i class="icon-basket"></i>
                                                                </button> --}}
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
                        <!-- third tab-pane -->
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                            aria-labelledby="pills-contact-tab">
                            <div class="product-slider-init theme1 slick-nav">
                                @foreach ($sanPhamView as $sanphamview)
                                    <div class="slider-item">
                                        <div class="card product-card">
                                            <div class="card-body p-0">
                                                <div class="media flex-column">
                                                    <div class="product-thumbnail position-relative">
                                                        <span class="badge badge-danger top-right">New</span>
                                                        <a href="{{ route('sanpham.chitiet', $sanphamview->id) }}">
                                                            <img class="first-img"
                                                                src="{{ asset('/storage/' . $sanphamview->anh_san_pham) }}"
                                                                alt="anh san pham" />
                                                        </a>
                                                        <!-- product links -->
                                                        
                                                        <!-- product links end-->
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="product-desc">
                                                            <h3 class="title">
                                                                <a
                                                                    href="{{ route('sanpham.chitiet', $sanphamview->id) }}">{{ $sanphamview->ten_san_pham }}</a>
                                                            </h3>
                                                            <div class="star-rating">
                                                                <span class="ion-ios-star"></span>
                                                                <span class="ion-ios-star"></span>
                                                                <span class="ion-ios-star"></span>
                                                                <span class="ion-ios-star"></span>
                                                                <span class="ion-ios-star de-selected"></span>
                                                            </div>
                                                            <div class="d-flex align-items-center justify-content-between">
                                                                <span
                                                                    class="product-price">{{ number_format($sanphamview->gia_goc) }}</span>
                                                                {{-- <button class="pro-btn" data-bs-toggle="modal"
                                                                data-bs-target="#add-to-cart">
                                                                <i class="icon-basket"></i>
                                                            </button> --}}
                                                                {{-- <form action="{{ route('cart.add') }}" method="POST"
                                                                    class="d-inline">
                                                                    @csrf
                                                                    <input type="hidden" name="san_pham_id"
                                                                        value="{{ $sanphamview->id }}">
                                                                    <input type="number" name="so_luong" value="1"
                                                                        min="1" class="d-none">
                                                                    <button type="submit" class="pro-btn">
                                                                        <i class="icon-basket"></i>
                                                                    </button>
                                                                </form> --}}


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
                        <h2 class="title pb-3 mb-3">Sản phẩm nhiều lượt xem</h2>
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
                                                <!-- product links -->
                                                <ul class="actions d-flex justify-content-center">
                                                    <li>
                                                        <a class="action" href="wishlist.html">
                                                            <span data-bs-toggle="tooltip" data-placement="bottom"
                                                                title="add to wishlist" class="icon-heart">
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="action" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#compare">
                                                            <span data-bs-toggle="tooltip" data-placement="bottom"
                                                                title="Add to compare" class="icon-shuffle"></span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="action" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#quick-view">
                                                            <span data-bs-toggle="tooltip" data-placement="bottom"
                                                                title="Quick view" class="icon-magnifier"></span>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <!-- product links end-->
                                            </div>
                                            <div class="media-body">
                                                <div class="product-desc">
                                                    <h3 class="title">
                                                        <a
                                                            href="{{ route('san-phams.incrementViews', $sanphamview->id) }}">
                                                            {{ $sanphamview->ten_san_pham }}
                                                        </a>
                                                    </h3>
                                                    <div class="star-rating">
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star de-selected"></span>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <span
                                                            class="product-price">{{ number_format($sanphamview->gia_goc) }}</span>
                                                        {{-- <button class="pro-btn" data-bs-toggle="modal"
                                                    data-bs-target="#add-to-cart">
                                                    <i class="icon-basket"></i>
                                                </button> --}}
                                                        {{-- <form action="{{ route('cart.add') }}" method="POST"
                                                            class="d-inline">
                                                            @csrf
                                                            <input type="hidden" name="san_pham_id"
                                                                value="{{ $sanphamview->id }}">
                                                            <input type="number" name="so_luong" value="1"
                                                                min="1" class="d-none">
                                                            <button type="submit" class="pro-btn">
                                                                <i class="icon-basket"></i>
                                                            </button>
                                                        </form> --}}


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
                                    <a class="blog-thumb mb-20 zoom-in d-block overflow-hidden"
                                        href="{{ url('client/baivietchitiet', $baivietmoi->id) }}">
                                        <img src="{{ asset('/storage/' . $baivietmoi->anh_bai_viet) }}"
                                            alt="blog-thumb-naile" />
                                    </a>
                                    <div class="blog-post-content">
                                        <a class="blog-link theme-color d-inline-block mb-10 text-uppercase"
                                            href="{{ url('client/baivietchitiet', $baivietmoi->id) }}">{{ $baivietmoi->user?->ho_ten }}</a>
                                        <h3 class="title mb-15">
                                            <a href="single-blog.html">{{ $baivietmoi->tieu_de_bai_viet }}</a>
                                        </h3>
                                        <p class="sub-title">
                                            Ngày đăng
                                            <a class="theme-color d-inline-block mx-1"
                                                href="{{ url('client/baivietchitiet', $baivietmoi->id) }}"></a>
                                            {{ $baivietmoi->ngay_dang }}
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
                                    <a href="{{ route('client.cuahang') }}" class="brand-thumb">
                                        <img src="{{ asset('/storage/' . $anhdm->anh_danh_muc) }}" />
                                    </a>
                                </div>
                            </div>
                        @endforeach

                        <!-- slider-item end -->
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- modals start -->
    <!-- modal giỏ hàng -->
    {{-- <div class="modal fade theme1 style1" id="quick-view" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 mx-auto col-lg-5 mb-5 mb-lg-0">
                            <div class="product-sync-init mb-20">
                                <div class="single-product">
                                    <div class="product-thumb">
                                        <img src="assets/img/slider/thumb/1.jpg" alt="product-thumb" />
                                    </div>
                                </div>
                                <!-- single-product end -->
                                <div class="single-product">
                                    <div class="product-thumb">
                                        <img src="assets/img/slider/thumb/2.jpg" alt="product-thumb" />
                                    </div>
                                </div>
                                <!-- single-product end -->
                                <div class="single-product">
                                    <div class="product-thumb">
                                        <img src="assets/img/slider/thumb/3.jpg" alt="product-thumb" />
                                    </div>
                                </div>
                                <!-- single-product end -->
                                <div class="single-product">
                                    <div class="product-thumb">
                                        <img src="assets/img/slider/thumb/4.jpg" alt="product-thumb" />
                                    </div>
                                </div>
                                <!-- single-product end -->
                            </div>

                            <div class="product-sync-nav">
                                <div class="single-product">
                                    <div class="product-thumb">
                                        <a href="javascript:void(0)">
                                            <img src="assets/img/slider/thumb/1.1.jpg" alt="product-thumb" /></a>
                                    </div>
                                </div>
                                <!-- single-product end -->
                                <div class="single-product">
                                    <div class="product-thumb">
                                        <a href="javascript:void(0)">
                                            <img src="assets/img/slider/thumb/2.1.jpg" alt="product-thumb" /></a>
                                    </div>
                                </div>
                                <!-- single-product end -->
                                <div class="single-product">
                                    <div class="product-thumb">
                                        <a href="javascript:void(0)"><img src="assets/img/slider/thumb/3.1.jpg"
                                                alt="product-thumb" /></a>
                                    </div>
                                </div>
                                <!-- single-product end -->
                                <div class="single-product">
                                    <div class="product-thumb">
                                        <a href="javascript:void(0)"><img src="assets/img/slider/thumb/4.1.jpg"
                                                alt="product-thumb" /></a>
                                    </div>
                                </div>
                                <!-- single-product end -->
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="modal-product-info">
                                <div class="product-head">
                                    <h2 class="title">
                                        New Balance Running Arishi trainers in triple
                                    </h2>
                                    <h4 class="sub-title">Reference: demo_5</h4>
                                    <div class="star-content mb-20">
                                        <span class="star-on"><i class="fas fa-star"></i> </span>
                                        <span class="star-on"><i class="fas fa-star"></i> </span>
                                        <span class="star-on"><i class="fas fa-star"></i> </span>
                                        <span class="star-on"><i class="fas fa-star"></i> </span>
                                        <span class="star-on de-selected"><i class="fas fa-star"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="product-body">
                                    <span class="product-price text-center">
                                        <span class="new-price">$29.00</span>
                                    </span>
                                    <p>
                                        Break old records and make new goals in the New Balance®
                                        Arishi Sport v1.
                                    </p>
                                    <ul>
                                        <li>Predecessor: None.</li>
                                        <li>Support Type: Neutral.</li>
                                        <li>Cushioning: High energizing cushioning.</li>
                                    </ul>
                                </div>
                                <div class="d-flex mt-30">
                                    <div class="product-size">
                                        <h3 class="title">Dimension</h3>
                                        <select>
                                            <option value="0">40x60cm</option>
                                            <option value="1">60x90cm</option>
                                            <option value="2">80x120cm</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="product-footer">
                                    <div class="product-count style d-flex flex-column flex-sm-row my-4">
                                        <div class="count d-flex">
                                            <input type="number" min="1" max="10" step="1"
                                                value="1" />
                                            <div class="button-group">
                                                <button class="count-btn increment">
                                                    <i class="fas fa-chevron-up"></i>
                                                </button>
                                                <button class="count-btn decrement">
                                                    <i class="fas fa-chevron-down"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="btn btn-dark btn--xl mt-5 mt-sm-0">
                                                <span class="me-2"><i class="ion-android-add"></i></span>
                                                Add to cart
                                            </button>
                                        </div>
                                    </div>
                                    <div class="addto-whish-list">
                                        <a href="#"><i class="icon-heart"></i> Add to wishlist</a>
                                        <a href="#"><i class="icon-shuffle"></i> Add to compare</a>
                                    </div>
                                    <div class="pro-social-links mt-10">
                                        <ul class="d-flex align-items-center">
                                            <li class="share">Share</li>
                                            <li>
                                                <a href="#"><i class="ion-social-facebook"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="ion-social-twitter"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="ion-social-google"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="ion-social-pinterest"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- <!-- second modal -->
    <div class="modal fade style2" id="compare" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="title">
                        <i class="fa fa-check"></i> Product added to compare shoppp.
                    </h5>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- second modal -->
    <div class="modal fade style3" id="add-to-cart" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-center bg-dark">
                    <h5 class="modal-title" id="add-to-cartCenterTitle">
                        Product successfully
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-5 divide-right">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="assets/img/modal/1.jpg" alt="img" />
                                </div>
                                <div class="col-md-6 mb-2 mb-md-0">
                                    <h4 class="product-name">
                                        New Balance Running Arishi trainers in triple
                                    </h4>
                                    <h5 class="price">$$29.00</h5>
                                    <h6 class="color">
                                        <strong>Dimension: </strong>: <span class="dmc">40x60cm</span>
                                    </h6>
                                    <h6 class="quantity"><strong>Quantity:</strong>&nbsp;1</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="modal-cart-content">
                                <p class="cart-products-count">There is 1 item in your cart.</p>
                                <p><strong>Total products:</strong>&nbsp;$123.72</p>
                                <p><strong>Total shipping:</strong>&nbsp;$7.00</p>
                                <p><strong>Taxes</strong>&nbsp;$0.00</p>
                                <p><strong>Total:</strong>&nbsp;$130.72 (tax excl.)</p>
                                <div class="cart-content-btn">
                                    <button type="button" class="btn btn-dark btn--md mt-4" data-bs-dismiss="modal">
                                        Continue shopping
                                    </button>
                                    <button class="btn btn-dark btn--md mt-4">
                                        Proceed to checkout
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modals end -->
@endsection
<style>
    .text-slider,
    .text_sale,
    .main_text{
        color: #5a5ac9 !important;
    }
    .button_primary{
        color: #5a5ac9 !important;
        border-color: #5a5ac9 !important;
    }
    .button_primary:hover{
        color: #fff !important;
        border-color: #5a5ac9 !important;
        background: #5a5ac9 !important;
    }
</style>