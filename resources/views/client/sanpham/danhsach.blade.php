@extends('client.layout')

@section('content')
    <!-- breadcrumb-section start -->
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
                    <!-- product-tab-nav end -->
                    <div class="tab-content" id="pills-tabContent">
                        <!-- first tab-pane -->
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <div class="row grid-view theme1">
                                @foreach ($list_sanphams as $item)
                                    <div class="col-sm-6 col-lg-4 mb-30">
                                        <div class="card product-card">
                                            <div class="card-body">
                                                <div class="product-thumbnail position-relative">
                                                    <span class="badge badge-danger top-right">New</span>
                                                    <a href="single-product.html">
                                                        <img class="first-img"
                                                            src="{{ asset('storage/' . $item->anh_san_pham) }}"
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
                                                        <button class="pro-btn" data-bs-toggle="modal"
                                                            data-bs-target="#add-to-cart">
                                                            <i class="icon-basket"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- product-list End -->
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- second tab-pane -->
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                            aria-labelledby="pills-profile-tab">
                            <div class="row grid-view-list theme1">
                                @foreach ($list_sanphams as $item)
                                    <div class="col-12 mb-30">
                                        <div class="card product-card">
                                            <div class="card-body">
                                                <div class="media flex-column flex-md-row">
                                                    <div class="product-thumbnail position-relative">
                                                        <span class="badge badge-danger top-right">New</span>
                                                        <a href="single-product.html">
                                                            <img class="first-img"
                                                                src="{{ asset('storage/' . $item->anh_san_pham) }}"
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
                                                                @else
                                                                    <p>Chưa có đánh giá nào.</p>
                                                                @endif

                                                            </div>
                                                            <span class="product-price">$11.90</span>
                                                        </div>
                                                        <ul class="product-list-des">
                                                            <li>
                                                                {{ $item->ma_ta_san_pham }}
                                                            </li>

                                                        </ul>
                                                        <div class="availability-list mb-20">
                                                            <p>Còn lại: <span> {{ $item->so_luong }}</span> sản phẩm</p>
                                                        </div>
                                                        <button class="btn btn-dark btn--xl" data-bs-toggle="modal"
                                                            data-bs-target="#add-to-cart">
                                                            Thêm giỏ hàng
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- product-list End -->
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mb-30 order-lg-first">
                    <aside class="left-sidebar theme1">
                        <!-- search-filter start -->
                        {{-- <div class="search-filter">
                            <div class="sidbar-widget pt-0">
                                <h4 class="title">Beauty & Cosmetics</h4>
                            </div>
                        </div>
                        <ul id="offcanvas-menu2" class="blog-ctry-menu">
                            <li>
                                <a href="javascript:void(0)">Shoes</a>
                                <ul class="category-sub-menu">
                                    <li><a href="#">Women Shoes</a></li>
                                    <li><a href="#">Men Shoes</a></li>
                                    <li><a href="#">Boots</a></li>
                                    <li><a href="#">Casual Shoes</a></li>
                                    <li><a href="#">Flip Flops</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)">Luggage &amp; Bags</a>
                                <ul class="category-sub-menu">
                                    <li><a href="#">Stylish Backpacks</a></li>
                                    <li><a href="#">Shoulder Bags</a></li>
                                    <li><a href="#">Crossbody Bags</a></li>
                                    <li><a href="#">Briefcases</a></li>
                                    <li><a href="#">Luggage &amp; Travel</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)">Accessories</a>
                                <ul class="category-sub-menu">
                                    <li><a href="#">Cosmetic Bags &amp; Cases</a></li>
                                    <li><a href="#">Wallets &amp; Card Holders</a></li>
                                    <li><a href="#">Luggage Covers</a></li>
                                    <li><a href="#">Passport Covers</a></li>
                                    <li><a href="#">Bag Parts &amp; Accessories</a></li>
                                </ul>
                            </li>
                        </ul> --}}

                        <div class="search-filter">
                            <form action="#">
                                <div class="sidbar-widget mt-10">
                                    <h4 class="title">LỌC THEO</h4>
                                    <h4 class="sub-title pt-10">Danh mục</h4>
                                    <div class="">{{-- class form-group sẽ ẩn bớt  --}}
                                        @foreach ($danhmucs as $item)
                                            <div class="widget-check-box">
                                                <input type="checkbox" id="danhmuc_{{ $item->id }}" />
                                                <label for="danhmuc_{{ $item->id }}">{{ $item->ten_danh_muc }}
                                                    <span> ({{ $item->soluong_sp_dm }}) </span></label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- sidbar-widget -->
                                {{-- <div class="sidbar-widget mt-10">
                                    <h4 class="sub-title">Price</h4>
                                    <div class="price-filter mt-10">
                                        <div class="price-slider-amount">
                                            <input type="text" id="amount" name="price" readonly
                                                placeholder="Add Your Price" />
                                        </div>
                                        <div id="slider-range"></div>
                                    </div>
                                </div> --}}
                                <div class="sidbar-widget mt-10">
                                    <h4 class="sub-title pt-10">Giá</h4>
                                    <div class="widget-check-box">
                                        <input type="checkbox" id="" />
                                        <label for="">0 - 100.000
                                            {{-- <span> ( 32 ) </span> --}} </label>
                                    </div>
                                    <div class="widget-check-box">
                                        <input type="checkbox" id="" />
                                        <label for="">100.000 - 500.000
                                            {{-- <span> ( 32 ) </span> --}} </label>
                                    </div>
                                    <div class="widget-check-box">
                                        <input type="checkbox" id="" />
                                        <label for="">500.000 - 1.000.000
                                            {{-- <span> ( 32 ) </span> --}} </label>
                                    </div>
                                    <div class="widget-check-box">
                                        <input type="checkbox" id="" />
                                        <label for="">> 1.000.000
                                            {{-- <span> ( 32 ) </span> --}} </label>
                                    </div>
                                </div>

                                <div class="sidbar-widget mt-10">
                                    <h4 class="sub-title">Size</h4>
                                    <div class="widget-check-box">
                                        <input type="checkbox" id="test9" />
                                        <label for="test9">s <span>(2)</span></label>
                                    </div>
                                    <div class="widget-check-box">
                                        <input type="checkbox" id="test10" />
                                        <label for="test10">m <span>(2)</span></label>
                                    </div>
                                    <div class="widget-check-box">
                                        <input type="checkbox" id="test11" />
                                        <label for="test11">l <span>(2)</span></label>
                                    </div>
                                    <div class="widget-check-box">
                                        <input type="checkbox" id="test12" />
                                        <label for="test12">xl <span>(2)</span></label>
                                    </div>
                                </div>
                                <!-- sidbar-widget -->
                                <div class="sidbar-widget mt-10">
                                    <h4 class="sub-title">color</h4>
                                    <div class="widget-check-box color-grey">
                                        <input type="checkbox" id="20826" />
                                        <label for="20826">grey <span>(4)</span></label>
                                    </div>
                                    <div class="widget-check-box color-white">
                                        <input type="checkbox" id="20827" />
                                        <label for="20827">white <span>(3)</span></label>
                                    </div>
                                    <div class="widget-check-box color-black">
                                        <input type="checkbox" id="20828" />
                                        <label for="20828">black <span>(6)</span></label>
                                    </div>
                                    <div class="widget-check-box color-camel">
                                        <input type="checkbox" id="20829" />
                                        <label for="20829">camel <span>(2)</span></label>
                                    </div>
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
    <!-- product tab end -->
@endsection
