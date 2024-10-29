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
                                <p class="text animated" data-animation-in="fadeInDown" data-delay-in=".300">
                                    ArtiCraft
                                </p>
                                <h2 class="title animated">
                                    <span class="animated d-block" data-animation-in="fadeInLeft" data-delay-in=".800">Vẽ
                                        sáng tạo - Tô hạnh phúc</span>
                                    <span class="animated font-weight-bold" data-animation-in="fadeInRight"
                                        data-delay-in="1.5">Sale 30% Off</span>
                                </h2>
                                <ngay href="shop-grid-4-column.html"
                                    class="btn btn-outline-primary btn--lg animated mt-45 mt-sm-25"
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
                                <p class="text animated" data-animation-in="fadeInLeft" data-delay-in=".300">
                                    ArtiCraft
                                </p>

                                <h2 class="title">
                                    <span class="animated d-block" data-animation-in="fadeInRight" data-delay-in=".800">Vẽ
                                        sáng tạo - Tô hạnh phúc</span>
                                    <span class="animated font-weight-bold" data-animation-in="fadeInUp"
                                        data-delay-in="1.5">Sale 30% Off</span>
                                </h2>
                                <Nga href="shop-grid-4-column.html"
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
                                <p class="text animated" data-animation-in="fadeInLeft" data-delay-in=".300">
                                    ArtiCraft
                                </p>
                                <h2 class="title">
                                    <span class="animated d-block" data-animation-in="fadeInRight" data-delay-in=".800">Vẽ
                                        sáng tạo - Tô hạnh phúc</span>
                                    <span class="animated font-weight-bold" data-animation-in="fadeInUp"
                                        data-delay-in="1.5">Sale 30% Off</span>
                                </h2>
                                <a href="shop-grid-4-column.html"
                                    class="btn btn-outline-primary btn--lg animated mt-45 mt-sm-25"
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
                            <img src="{{ asset('assets/client/images/banner/1a.jpg') }}" alt="banner-thumb-naile" />
                        </a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-30">
                    <div class="banner-thumb">
                        <a href="shop-grid-4-column.html" class="zoom-in d-block overflow-hidden">
                            <img src="{{ asset('assets/client/images/banner/2.jpg') }}" alt="banner-thumb-naile" />
                        </a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-30">
                    <div class="banner-thumb">
                        <a href="shop-grid-4-column.html" class="zoom-in d-block overflow-hidden">
                            <img src="{{ asset('assets/client/images/banner/3.jpg') }}" alt="banner-thumb-naile" />
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
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                                Perspiciatis, culpa?
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
                                @foreach ($sanPhamMois as $item )
                                <div class="slider-item">
                                    <div class="card product-card">
                                        <div class="card-body p-0">
                                            <div class="media flex-column">
                                                <div class="product-thumbnail position-relative">
                                                    <span class="badge badge-danger top-right">New</span>
                                                    <a href="single-product.html">
                                                        <img class="first-img"
                                                            src="{{ asset('assets/client/images/product/1.png') }}"
                                                            alt="thumbnail" />
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
                                                            <a href="shop-grid-4-column.html">{{$item->ten_san_pham}}</a>
                                                        </h3>
                                                        <div class="star-rating">
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star de-selected"></span>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-between">
<<<<<<< HEAD
                                                            <span class="product-price">{{$item->gia_goc}}</span>
=======
                                                            <span class="product-price">$11.90</span>
                                                            <button class="pro-btn" data-bs-toggle="modal"
                                                                data-bs-target="#add-to-cart">
                                                                <i class="icon-basket"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- slider-item end -->
                                <div class="slider-item">
                                    <div class="card product-card">
                                        <div class="card-body p-0">
                                            <div class="media flex-column">
                                                <div class="product-thumbnail position-relative">
                                                    <span class="badge badge-danger top-right">New</span>
                                                    <a href="single-product.html">
                                                        <img class="first-img"
                                                            src="{{ asset('assets/client/images/product/2.png') }}"
                                                            alt="thumbnail" />
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
                                                            <a href="shop-grid-4-column.html">On Trend Makeup and Beauty
                                                                Cosmetics</a>
                                                        </h3>
                                                        <div class="star-rating">
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star de-selected"></span>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <span class="product-price">$11.90</span>
                                                            <button class="pro-btn" data-bs-toggle="modal"
                                                                data-bs-target="#add-to-cart">
                                                                <i class="icon-basket"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- slider-item end -->
                                <div class="slider-item">
                                    <div class="card product-card">
                                        <div class="card-body p-0">
                                            <div class="media flex-column">
                                                <div class="product-thumbnail position-relative">
                                                    <span class="badge badge-danger top-right">New</span>
                                                    <a href="single-product.html">
                                                        <img class="first-img"
                                                            src="{{ asset('assets/client/images/product/3.png') }}"
                                                            alt="thumbnail" />
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
                                                            <a href="shop-grid-4-column.html">The Cosmetics and Beauty
                                                                brand Shoppe</a>
                                                        </h3>
                                                        <div class="star-rating">
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star de-selected"></span>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <span class="product-price">$21.51</span>
                                                            <button class="pro-btn" data-bs-toggle="modal"
                                                                data-bs-target="#add-to-cart">
                                                                <i class="icon-basket"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- slider-item end -->
                                <div class="slider-item">
                                    <div class="card product-card">
                                        <div class="card-body p-0">
                                            <div class="media flex-column">
                                                <div class="product-thumbnail position-relative">
                                                    <span class="badge badge-danger top-right">New</span>
                                                    <a href="single-product.html">
                                                        <img class="first-img"
                                                            src="{{ asset('assets/client/images/product/4.png') }}"
                                                            alt="thumbnail" />
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
                                                            <a href="shop-grid-4-column.html">orginal Age Defying Cosmetics
                                                                Makeup</a>
                                                        </h3>
                                                        <div class="star-rating">
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star de-selected"></span>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <span class="product-price">$11.90</span>
                                                            <button class="pro-btn" data-bs-toggle="modal"
                                                                data-bs-target="#add-to-cart">
                                                                <i class="icon-basket"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- slider-item end -->
                                <div class="slider-item">
                                    <div class="card product-card">
                                        <div class="card-body p-0">
                                            <div class="media flex-column">
                                                <div class="product-thumbnail position-relative">
                                                    <span class="badge badge-danger top-right">New</span>
                                                    <a href="single-product.html">
                                                        <img class="first-img"
                                                            src="{{ asset('assets/client/images/product/5.png') }}"
                                                            alt="thumbnail" />
                                                        <img class="second-img"
                                                            src="{{ asset('assets/client/images/product/6.png') }}"
                                                            alt="thumbnail" />
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
                                                            <a href="shop-grid-4-column.html">orginal Clear Water Cosmetics
                                                                On Trend</a>
                                                        </h3>
                                                        <div class="star-rating">
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star de-selected"></span>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <span class="product-price">$11.90</span>
>>>>>>> 18f0796a608698621cb0c7f94c23a36b5635344c
                                                            <button class="pro-btn" data-bs-toggle="modal"
                                                                data-bs-target="#add-to-cart">
                                                                <i class="icon-basket"></i>
                                                            </button>
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
                                                        <a href="{{route('sanpham.chitiet',$sanPhamGg->id)}}">
                                                            <img
                                                                src="{{ asset('/storage/' . $sanPhamGg->anh_san_pham) }}">
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
                                                                        title="Add to compare"
                                                                        class="icon-shuffle"></span>
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
                                                                    href="{{route('sanpham.chitiet',$sanPhamGg->id)}}">{{ $sanPhamGg->ten_san_pham }}</a>
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
                                                                        class="product-price me-2">{{ $sanPhamGg->gia_goc }}</span>
                                                                    <span
                                                                        class="text-decoration-line-through text-muted">{{ $sanPhamGg->gia_km }}</span>
                                                                </div>
                                                                <button class="pro-btn" data-bs-toggle="modal"
                                                                    data-bs-target="#add-to-cart">
                                                                    <i class="icon-basket"></i>
                                                                </button>
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
                                <div class="slider-item">
                                    <div class="card product-card">
                                        <div class="card-body p-0">
                                            <div class="media flex-column">
                                                <div class="product-thumbnail position-relative">
                                                    <span class="badge badge-danger top-right">New</span>
                                                    <a href="single-product.html">
                                                        <img class="first-img"
                                                            src="{{ asset('assets/client/images/product/1.png') }}"
                                                            alt="thumbnail" />
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
                                                            <a href="shop-grid-4-column.html">All Natural Makeup Beauty
                                                                Cosmetics</a>
                                                        </h3>
                                                        <div class="star-rating">
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star de-selected"></span>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <span class="product-price">$11.90</span>
                                                            <button class="pro-btn" data-bs-toggle="modal"
                                                                data-bs-target="#add-to-cart">
                                                                <i class="icon-basket"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- slider-item end -->
                                <div class="slider-item">
                                    <div class="card product-card">
                                        <div class="card-body p-0">
                                            <div class="media flex-column">
                                                <div class="product-thumbnail position-relative">
                                                    <span class="badge badge-danger top-right">New</span>
                                                    <a href="single-product.html">
                                                        <img class="first-img"
                                                            src="{{ asset('assets/client/images/product/2.png') }}"
                                                            alt="thumbnail" />
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
                                                            <a href="shop-grid-4-column.html">On Trend Makeup and Beauty
                                                                Cosmetics</a>
                                                        </h3>
                                                        <div class="star-rating">
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star de-selected"></span>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <span class="product-price">$11.90</span>
                                                            <button class="pro-btn" data-bs-toggle="modal"
                                                                data-bs-target="#add-to-cart">
                                                                <i class="icon-basket"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- slider-item end -->
                                <div class="slider-item">
                                    <div class="card product-card">
                                        <div class="card-body p-0">
                                            <div class="media flex-column">
                                                <div class="product-thumbnail position-relative">
                                                    <span class="badge badge-danger top-right">New</span>
                                                    <a href="single-product.html">
                                                        <img class="first-img"
                                                            src="{{ asset('assets/client/images/product/3.png') }}"
                                                            alt="thumbnail" />
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
                                                            <a href="shop-grid-4-column.html">The Cosmetics and Beauty
                                                                brand Shoppe</a>
                                                        </h3>
                                                        <div class="star-rating">
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star de-selected"></span>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <span class="product-price">$21.51</span>
                                                            <button class="pro-btn" data-bs-toggle="modal"
                                                                data-bs-target="#add-to-cart">
                                                                <i class="icon-basket"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- slider-item end -->
                                <div class="slider-item">
                                    <div class="card product-card">
                                        <div class="card-body p-0">
                                            <div class="media flex-column">
                                                <div class="product-thumbnail position-relative">
                                                    <span class="badge badge-danger top-right">New</span>
                                                    <a href="single-product.html">
                                                        <img class="first-img"
                                                            src="{{ asset('assets/client/images/product/4.png') }}"
                                                            alt="thumbnail" />
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
                                                            <a href="shop-grid-4-column.html">orginal Age Defying Cosmetics
                                                                Makeup</a>
                                                        </h3>
                                                        <div class="star-rating">
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star de-selected"></span>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <span class="product-price">$11.90</span>
                                                            <button class="pro-btn" data-bs-toggle="modal"
                                                                data-bs-target="#add-to-cart">
                                                                <i class="icon-basket"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- slider-item end -->
                                <div class="slider-item">
                                    <div class="card product-card">
                                        <div class="card-body p-0">
                                            <div class="media flex-column">
                                                <div class="product-thumbnail position-relative">
                                                    <span class="badge badge-danger top-right">New</span>
                                                    <a href="single-product.html">
                                                        <img class="first-img"
                                                            src="{{ asset('assets/client/images/product/5.png') }}"
                                                            alt="thumbnail" />
                                                        <img class="second-img"
                                                            src="{{ asset('assets/client/images/product/6.png') }}"
                                                            alt="thumbnail" />
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
                                                            <a href="shop-grid-4-column.html">orginal Clear Water Cosmetics
                                                                On Trend</a>
                                                        </h3>
                                                        <div class="star-rating">
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star de-selected"></span>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <span class="product-price">$11.90</span>
                                                            <button class="pro-btn" data-bs-toggle="modal"
                                                                data-bs-target="#add-to-cart">
                                                                <i class="icon-basket"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- slider-item end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product tab end -->
    <!-- common banner  start -->
    <div class="common-banner bg-white pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-30">
                    <div class="banner-thumb">
                        <a class="zoom-in d-block overflow-hidden position-relative" href="shop-grid-4-column.html"><img
                                src="assets/client/images/banner/1a.jpg" alt="banner-thumb-naile" /></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-30">
                    <div class="banner-thumb">
                        <a class="zoom-in d-block overflow-hidden position-relative" href="shop-grid-4-column.html">
                            <img src="assets/client/images/banner/bottom_banner_1.jpg" alt="banner-thumb-naile" /></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 mb-30">
                    <div class="banner-thumb">
                        <a class="zoom-in d-block overflow-hidden position-relative" href="shop-grid-4-column.html">
                            <img src="assets/client/images/banner/bottom_banner_3.jpg" alt="banner-thumb-naile" /></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- common banner  end -->
    <!-- product tab repetation start -->
    <section class="bg-white theme1 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section-title start -->
                    <div class="section-title text-center">
                        <h2 class="title pb-3 mb-3">New Arrival products</h2>
                        <p class="text">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                            Dignissimos, repellat.
                        </p>
                    </div>
                    <!-- section-title end -->
                    <div class="product-slider-init theme1 slick-nav">
                        <div class="slider-item">
                            <div class="card product-card">
                                <div class="card-body p-0">
                                    <div class="media flex-column">
                                        <div class="product-thumbnail position-relative">
                                            <span class="badge badge-danger top-right">New</span>
                                            <a href="single-product.html">
                                                <img class="first-img"
                                                    src="{{ asset('assets/client/images/product/8.png') }}"
                                                    alt="thumbnail" />
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
                                                    <a href="shop-grid-4-column.html">All Natural Makeup Beauty
                                                        Cosmetics</a>
                                                </h3>
                                                <div class="star-rating">
                                                    <span class="ion-ios-star"></span>
                                                    <span class="ion-ios-star"></span>
                                                    <span class="ion-ios-star"></span>
                                                    <span class="ion-ios-star"></span>
                                                    <span class="ion-ios-star de-selected"></span>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="product-price">$11.90</span>
                                                    <button class="pro-btn" data-bs-toggle="modal"
                                                        data-bs-target="#add-to-cart">
                                                        <i class="icon-basket"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- slider-item end -->
                        <div class="slider-item">
                            <div class="card product-card">
                                <div class="card-body p-0">
                                    <div class="media flex-column">
                                        <div class="product-thumbnail position-relative">
                                            <span class="badge badge-danger top-right">New</span>
                                            <a href="single-product.html">
                                                <img class="first-img"
                                                    src="{{ asset('assets/client/images/product/9.png') }}"
                                                    alt="thumbnail" />
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
                                                    <a href="shop-grid-4-column.html">On Trend Makeup and Beauty
                                                        Cosmetics</a>
                                                </h3>
                                                <div class="star-rating">
                                                    <span class="ion-ios-star"></span>
                                                    <span class="ion-ios-star"></span>
                                                    <span class="ion-ios-star"></span>
                                                    <span class="ion-ios-star"></span>
                                                    <span class="ion-ios-star de-selected"></span>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="product-price">$11.90</span>
                                                    <button class="pro-btn" data-bs-toggle="modal"
                                                        data-bs-target="#add-to-cart">
                                                        <i class="icon-basket"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- slider-item end -->
                        <div class="slider-item">
                            <div class="card product-card">
                                <div class="card-body p-0">
                                    <div class="media flex-column">
                                        <div class="product-thumbnail position-relative">
                                            <span class="badge badge-danger top-right">New</span>
                                            <a href="single-product.html">
                                                <img class="first-img"
                                                    src="{{ asset('assets/client/images/product/10.png') }}"
                                                    alt="thumbnail" />
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
                                                    <a href="shop-grid-4-column.html">The Cosmetics and Beauty brand
                                                        Shoppe</a>
                                                </h3>
                                                <div class="star-rating">
                                                    <span class="ion-ios-star"></span>
                                                    <span class="ion-ios-star"></span>
                                                    <span class="ion-ios-star"></span>
                                                    <span class="ion-ios-star"></span>
                                                    <span class="ion-ios-star de-selected"></span>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="product-price">$21.51</span>
                                                    <button class="pro-btn" data-bs-toggle="modal"
                                                        data-bs-target="#add-to-cart">
                                                        <i class="icon-basket"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- slider-item end -->
                        <div class="slider-item">
                            <div class="card product-card">
                                <div class="card-body p-0">
                                    <div class="media flex-column">
                                        <div class="product-thumbnail position-relative">
                                            <span class="badge badge-danger top-right">New</span>
                                            <a href="single-product.html">
                                                <img class="first-img"
                                                    src="{{ asset('assets/client/images/product/11.png') }}"
                                                    alt="thumbnail" />
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
                                                    <a href="shop-grid-4-column.html">orginal Age Defying Cosmetics
                                                        Makeup</a>
                                                </h3>
                                                <div class="star-rating">
                                                    <span class="ion-ios-star"></span>
                                                    <span class="ion-ios-star"></span>
                                                    <span class="ion-ios-star"></span>
                                                    <span class="ion-ios-star"></span>
                                                    <span class="ion-ios-star de-selected"></span>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="product-price">$11.90</span>
                                                    <button class="pro-btn" data-bs-toggle="modal"
                                                        data-bs-target="#add-to-cart">
                                                        <i class="icon-basket"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- slider-item end -->
                        <div class="slider-item">
                            <div class="card product-card">
                                <div class="card-body p-0">
                                    <div class="media flex-column">
                                        <div class="product-thumbnail position-relative">
                                            <span class="badge badge-danger top-right">New</span>
                                            <a href="single-product.html">
                                                <img class="first-img"
                                                    src="{{ asset('assets/client/images/product/12.png') }}"
                                                    alt="thumbnail" />
                                                <img class="second-img"
                                                    src="{{ asset('assets/client/images/product/13.png') }}"
                                                    alt="thumbnail" />
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
                                                    <a href="shop-grid-4-column.html">orginal Clear Water Cosmetics On
                                                        Trend</a>
                                                </h3>
                                                <div class="star-rating">
                                                    <span class="ion-ios-star"></span>
                                                    <span class="ion-ios-star"></span>
                                                    <span class="ion-ios-star"></span>
                                                    <span class="ion-ios-star"></span>
                                                    <span class="ion-ios-star de-selected"></span>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="product-price">$11.90</span>
                                                    <button class="pro-btn" data-bs-toggle="modal"
                                                        data-bs-target="#add-to-cart">
                                                        <i class="icon-basket"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                        <h2 class="title pb-3 mb-3">from our Latest Blogs</h2>
                        <p class="text">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="blog-init slick-nav">
                        <div class="slider-item">
                            <div class="single-blog">
                                <a class="blog-thumb mb-20 zoom-in d-block overflow-hidden"
                                    href="blog-grid-left-sidebar.html">
                                    <img src="{{ asset('assets/client/images/blog-post/1.png') }}"
                                        alt="blog-thumb-naile" />
                                </a>
                                <div class="blog-post-content">
                                    <a class="blog-link theme-color d-inline-block mb-10 text-uppercase"
                                        href="https://themeforest.net/user/hastech">Fashion</a>
                                    <h3 class="title mb-15">
                                        <a href="single-blog.html">This is first Post For Blog</a>
                                    </h3>
                                    <p class="sub-title">
                                        Posted by
                                        <a class="theme-color d-inline-block mx-1"
                                            href="https://themeforest.net/user/hastech">HasTech</a>
                                        12TH Nov 2023
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- slider-item end -->
                        <div class="slider-item">
                            <div class="single-blog">
                                <a class="blog-thumb mb-20 zoom-in d-block overflow-hidden"
                                    href="blog-grid-left-sidebar.html">
                                    <img src="{{ asset('assets/client/images/blog-post/2.png') }}"
                                        alt="blog-thumb-naile" />
                                </a>
                                <div class="blog-post-content">
                                    <a class="blog-link theme-color d-inline-block mb-10 text-uppercase"
                                        href="https://themeforest.net/user/hastech">Fashion</a>
                                    <h3 class="title mb-15">
                                        <a href="single-blog.html">This is Secound Post For Blog</a>
                                    </h3>
                                    <p class="sub-title">
                                        Posted by
                                        <a class="theme-color d-inline-block mx-1"
                                            href="https://themeforest.net/user/hastech">HasTech</a>
                                        12TH Nov 2023
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- slider-item end -->
                        <div class="slider-item">
                            <div class="single-blog">
                                <a class="blog-thumb mb-20 zoom-in d-block overflow-hidden"
                                    href="blog-grid-left-sidebar.html">
                                    <img src="{{ asset('assets/client/images/blog-post/3.png') }}"
                                        alt="blog-thumb-naile" />
                                </a>
                                <div class="blog-post-content">
                                    <a class="blog-link theme-color d-inline-block mb-10 text-uppercase"
                                        href="https://themeforest.net/user/hastech">Fashion</a>
                                    <h3 class="title mb-15">
                                        <a href="single-blog.html">This is third Post For Blog</a>
                                    </h3>
                                    <p class="sub-title">
                                        Posted by
                                        <a class="theme-color d-inline-block mx-1"
                                            href="https://themeforest.net/user/hastech">HasTech</a>
                                        12TH Nov 2023
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- slider-item end -->
                        <div class="slider-item">
                            <div class="single-blog">
                                <a class="blog-thumb mb-20 zoom-in d-block overflow-hidden"
                                    href="blog-grid-left-sidebar.html">
                                    <img src="{{ asset('assets/client/images/blog-post/4.png') }}"
                                        alt="blog-thumb-naile" />
                                </a>
                                <div class="blog-post-content">
                                    <a class="blog-link theme-color d-inline-block mb-10 text-uppercase"
                                        href="https://themeforest.net/user/hastech">Fashion</a>
                                    <h3 class="title mb-15">
                                        <a href="single-blog.html">This is fourth Post For Blog</a>
                                    </h3>
                                    <p class="sub-title">
                                        Posted by
                                        <a class="theme-color d-inline-block mx-1"
                                            href="https://themeforest.net/user/hastech">HasTech</a>
                                        12TH Nov 2023
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- slider-item end -->
                        <div class="slider-item">
                            <div class="single-blog">
                                <a class="blog-thumb mb-20 zoom-in d-block overflow-hidden"
                                    href="blog-grid-left-sidebar.html">
                                    <img src="{{ asset('assets/client/images/blog-post/5.png') }}"
                                        alt="blog-thumb-naile" />
                                </a>
                                <div class="blog-post-content">
                                    <a class="blog-link theme-color d-inline-block mb-10 text-uppercase"
                                        href="https://themeforest.net/user/hastech">Fashion</a>
                                    <h3 class="title mb-15">
                                        <a href="single-blog.html">This is fiveth Post For Blog</a>
                                    </h3>
                                    <h5 class="sub-title">
                                        Posted by
                                        <a class="theme-color d-inline-block mx-1"
                                            href="https://themeforest.net/user/hastech">HasTech
                                        </a>
                                        12TH Nov 2023
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <!-- slider-item end -->
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
                        <div class="slider-item">
                            <div class="single-brand">
                                <a href="https://themeforest.net/user/hastech" class="brand-thumb">
                                    <img src="{{ asset('assets/client/images/brand/1.jpg') }}"
                                        alt="brand-thumb-nail" />
                                </a>
                            </div>
                        </div>
                        <!-- slider-item end -->
                        <div class="slider-item">
                            <div class="single-brand">
                                <a href="https://themeforest.net/user/hastech" class="brand-thumb">
                                    <img src="{{ asset('assets/client/images/brand/2.jpg') }}"
                                        alt="brand-thumb-nail" />
                                </a>
                            </div>
                        </div>
                        <!-- slider-item end -->
                        <div class="slider-item">
                            <div class="single-brand">
                                <a href="https://themeforest.net/user/hastech" class="brand-thumb">
                                    <img src="{{ asset('assets/client/images/brand/3.jpg') }}"
                                        alt="brand-thumb-nail" />
                                </a>
                            </div>
                        </div>
                        <!-- slider-item end -->
                        <div class="slider-item">
                            <div class="single-brand">
                                <a href="https://themeforest.net/user/hastech" class="brand-thumb">
                                    <img src="{{ asset('assets/client/images/brand/4.jpg') }}"
                                        alt="brand-thumb-nail" />
                                </a>
                            </div>
                        </div>
                        <!-- slider-item end -->
                        <div class="slider-item">
                            <div class="single-brand">
                                <a href="https://themeforest.net/user/hastech" class="brand-thumb">
                                    <img src="{{ asset('assets/client/images/brand/5.jpg') }}"
                                        alt="brand-thumb-nail" />
                                </a>
                            </div>
                        </div>
                        <!-- slider-item end -->
                        <div class="slider-item">
                            <div class="single-brand">
                                <a href="https://themeforest.net/user/hastech" class="brand-thumb">
                                    <img src="{{ asset('assets/client/images/brand/2.jpg') }}"
                                        alt="brand-thumb-nail" />
                                </a>
                            </div>
                        </div>
                        <!-- slider-item end -->
                        <div class="slider-item">
                            <div class="single-brand">
                                <a href="https://themeforest.net/user/hastech" class="brand-thumb">
                                    <img src="{{ asset('assets/client/images/brand/4.jpg') }}"
                                        alt="brand-thumb-nail" />
                                </a>
                            </div>
                        </div>
                        <!-- slider-item end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
