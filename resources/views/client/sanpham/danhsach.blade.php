@extends('client.layout')

@section('content')
    <nav class="breadcrumb-section theme1 bg-lighten2 pt-110 pb-110 opacity-75">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title pb-4 text-dark text-uppercase">
                            {{ $title }}
                        </h2>
                    </div>
                </div>
                <div class="col-12">
                    <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
                        <li class="breadcrumb-item"><a href="{{ route('client.home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ $title }}
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </nav>
    <div class="product-tab bg-white pt-80 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mb-30">
                    <div class="grid-nav-wraper bg-lighten2 mb-30">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-6 mb-3 mb-md-0">
                                <nav class="shop-grid-nav">
                                    <ul class="nav nav-pills align-items-center" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                                href="#pills-home" role="tab" aria-controls="pills-home"
                                                aria-selected="true">
                                                <i class="fa fa-th"></i>
                                            </a>
                                        </li>
                                        <li class="nav-item mr-0">
                                            <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                                href="#pills-profile" role="tab" aria-controls="pills-profile"
                                                aria-selected="false"><i class="fa fa-list"></i></a>
                                        </li>
                                        <li>
                                            <span class="total-products text-capitalize ms-2">{{ $soluongsanpham }} sản
                                                phẩm</span>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="col-12 col-md-6 position-relative">
                                <div class="shop-grid-button d-flex align-items-center">
                                    <span class="sort-by">Sắp xếp:</span>
                                    <select class="form-select custom-select" aria-label="Default select example">
                                        <option selected>Chọn</option>
                                        <option value="1">Sản phẩm mới</option>
                                        <option value="2">Giá giảm dần</option>
                                        <option value="3">Giá tăng dần</option>
                                        <option value="4">Xem nhiều gần đây</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <div class="row grid-view theme1">
                                @foreach ($list_sanphams as $item)
                                    <div class="col-sm-6 col-lg-4 mb-30">
                                        <div class="card product-card">
                                            <div class="card-body">
                                                <div class="product-thumbnail position-relative">
                                                    <span
                                                        class="badge badge-danger top-right">{{ intval($item->phantramgia) }}%</span>
                                                    <a href="{{ route('sanpham.chitiet', $item->id) }}">
                                                        <img class="first-img"
                                                            src="{{ asset('storage/' . $item->anh_san_pham) }}"
                                                            alt="thumbnail" />
                                                    </a>
                                                    <ul class="actions d-flex justify-content-center">
                                                        <li>
                                                            <a class="action" href="#" data-bs-toggle="modal"
                                                                data-bs-target="#quickview{{ $item->id }}">
                                                                <span data-bs-toggle="tooltip" data-placement="bottom"
                                                                    title="Quick view" class="icon-magnifier"></span>
                                                            </a>
                                                            {{-- <a class="action"
                                                                href="{{ route('client.quickview', $item->id) }}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#quickview{{ $item->id }}">
                                                                <span data-bs-toggle="tooltip" data-placement="bottom"
                                                                    title="Quick view" class="icon-magnifier"></span>
                                                            </a>
                                                            @include('client.sanpham.quickview', [
                                                                'quick_view' => $item,
                                                            ]) --}}
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="product-desc py-0 px-0">
                                                    <h3 class="title">
                                                        <a href="shop-grid-4-column.html">{{ $item->ten_san_pham }}</a>
                                                    </h3>
                                                    <div class="star-rating">
                                                        @if ($item->danh_gia > 0)
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if ($i <= floor($item->danh_gia))
                                                                    <span class="ion-ios-star"></span>
                                                                @else
                                                                    <span class="ion-ios-star-outline"></span>
                                                                @endif
                                                            @endfor
                                                        @endif
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <span class="product-price">
                                                            @if (isset($item->gia_km) && !empty($item->gia_km))
                                                                {{ $item?->gia_km }} đ
                                                            @else
                                                                {{ $item->gia_goc }} đ
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- second tab-pane -->
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="row grid-view-list theme1">
                                @foreach ($list_sanphams as $item)
                                    <div class="col-12 mb-30">
                                        <div class="card product-card">
                                            <div class="card-body">
                                                <div class="media flex-column flex-md-row">
                                                    <div class="product-thumbnail position-relative">
                                                        <span
                                                            class="badge badge-danger top-right">{{ intval($item->phantramgia) }}%</span>
                                                        <a href="{{ route('sanpham.chitiet', $item->id) }}">
                                                            <img class="first-img"
                                                                src="{{ asset('storage/' . $item->anh_san_pham) }}"
                                                                alt="thumbnail" />
                                                        </a>
                                                        <ul class="actions d-flex justify-content-center">
                                                            <li>
                                                                <a class="action" href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#quick-view">
                                                                    <span data-bs-toggle="tooltip" data-placement="bottom"
                                                                        class="icon-magnifier" aria-label="Quick view"
                                                                        data-bs-original-title="Quick view"></span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="media-body ps-md-4">
                                                        <div class="product-desc py-0 px-0">
                                                            <h3 class="title">
                                                                <a
                                                                    href="shop-grid-4-column.html">{{ $item->ten_san_pham }}</a>
                                                            </h3>
                                                            <div class="star-rating mb-10">
                                                                @if ($item->danh_gia > 0)
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        @if ($i <= floor($item->danh_gia))
                                                                            <span class="ion-ios-star"></span>
                                                                        @else
                                                                            <span class="ion-ios-star-outline"></span>
                                                                        @endif
                                                                    @endfor
                                                                @endif

                                                            </div>
                                                            <span class="product-price">
                                                                @if (isset($item->gia_km) && !empty($item->gia_km))
                                                                    {{ $item?->gia_km }} đ
                                                                @else
                                                                    {{ $item->gia_goc }} đ
                                                                @endif
                                                            </span>
                                                        </div>
                                                        <ul class="product-list-des">
                                                            <li>
                                                                {{ $item->ma_ta_san_pham }}
                                                            </li>

                                                        </ul>
                                                        <div class="availability-list mb-20">
                                                            <p>Còn lại: <span> {{ $item->so_luong }}</span> sản phẩm</p>
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
                <div class="col-lg-3 mb-30 order-lg-first">
                    <aside class="left-sidebar theme1">
                        <div class="search-filter">
                            <form action="#">
                                <div class="sidbar-widget mt-10">
                                    <h4 class="title">LỌC THEO</h4>
                                    <h4 class="sub-title pt-10">Danh mục</h4>
                                    @foreach ($danhmucs as $item)
                                        <div class="widget-check-box">
                                            <input type="checkbox" id="danhmuc_{{ $item->id }}" />
                                            <label for="danhmuc_{{ $item->id }}">{{ $item->ten_danh_muc }}
                                                <span> ({{ $item->soluong_sp_dm }}) </span></label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="sidbar-widget mt-10">
                                    <h4 class="sub-title pt-10">Giá</h4>
                                    <div class="widget-check-box">
                                        <input type="checkbox" id="" />
                                        <label for="">0 - 100.000</label>
                                    </div>
                                    <div class="widget-check-box">
                                        <input type="checkbox" id="" />
                                        <label for="">100.000 - 500.000</label>
                                    </div>
                                    <div class="widget-check-box">
                                        <input type="checkbox" id="" />
                                        <label for="">500.000 - 1.000.000</label>
                                    </div>
                                    <div class="widget-check-box">
                                        <input type="checkbox" id="" />
                                        <label for="">> 1.000.000</label>
                                    </div>
                                </div>
                                <div class="sidbar-widget mt-10">
                                    <h4 class="sub-title">Size</h4>
                                    @foreach ($size_sidebar as $item)
                                        <div class="widget-check-box">
                                            <input type="checkbox" id="size-{{ $item->id }}" />
                                            <label for="size-{{ $item->id }}">{{ $item->ten_size }}
                                                <span>({{ $item->sl_size }})</span></label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="sidbar-widget mt-10">
                                    <h4 class="sub-title">color</h4>
                                    @foreach ($color_sidebar as $item)
                                        <div class="widget-check-box color-grey">
                                            <input type="checkbox" id="color-{{ $item->id }}" />
                                            <label for="color-{{ $item->id }}"
                                                style=" background-color: {{ $item->ma_mau }} !important;">
                                                {{ $item->ten_color }} <span>({{ $item->sl_color }})</span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </form>
                        </div>
                    </aside>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-9 offset-lg-3">
                    <nav class="pagination-section mt-30 mb-30">
                        <ul class="pagination justify-content-center pni">
                            {{ $list_sanphams->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>



    <!-- first modal -->
    <div class="modal fade theme1 style1" id="{{ $item->id }}" tabindex="-1" role="dialog">
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
                                        New Balance Running Arishi trainers
                                        in triple
                                    </h2>
                                    <h4 class="sub-title">Reference: demo_5
                                    </h4>
                                    <div class="star-content mb-20">
                                        <span class="star-on"><i class="fas fa-star"></i>
                                        </span>
                                        <span class="star-on"><i class="fas fa-star"></i>
                                        </span>
                                        <span class="star-on"><i class="fas fa-star"></i>
                                        </span>
                                        <span class="star-on"><i class="fas fa-star"></i>
                                        </span>
                                        <span class="star-on de-selected"><i class="fas fa-star"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="product-body">
                                    <span class="product-price text-center">
                                        <span class="new-price">$29.00</span>
                                    </span>
                                    <p>
                                        Break old records and make new goals
                                        in the New Balance®
                                        Arishi Sport v1.
                                    </p>
                                    <ul>
                                        <li>Predecessor: None.</li>
                                        <li>Support Type: Neutral.</li>
                                        <li>Cushioning: High energizing
                                            cushioning.</li>
                                    </ul>
                                </div>
                                <div class="d-flex mt-30">
                                    <div class="product-size">
                                        <h3 class="title">Dimension</h3>
                                        <select>
                                            <option value="0">40x60cm
                                            </option>
                                            <option value="1">60x90cm
                                            </option>
                                            <option value="2">80x120cm
                                            </option>
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
                                        <a href="#"><i class="icon-heart"></i> Add
                                            to wishlist</a>
                                        <a href="#"><i class="icon-shuffle"></i>
                                            Add to compare</a>
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
    </div>
@endsection
