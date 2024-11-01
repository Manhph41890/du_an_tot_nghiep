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
                                <div class="shop-grid-button d-flex align-items-center justify-content-end">
                                    <span class="sort-by">Sắp xếp:</span>
                                    <form action="{{ route('client.cuahang') }}" method="post">
                                        @csrf
                                        @method('GET')
                                        <select class="form-select custom-select" name="sort"
                                            aria-label="Default select example" onchange="this.form.submit()">
                                            <option value="" @if (request('sort') == '') selected @endif>Chọn
                                            </option>
                                            <option value="1" @if (request('sort') == '1') selected @endif>Sản
                                                phẩm mới</option>
                                            <option value="2" @if (request('sort') == '2') selected @endif>Giá
                                                giảm dần</option>
                                            <option value="3" @if (request('sort') == '3') selected @endif>Giá
                                                tăng dần</option>
                                            <option value="4" @if (request('sort') == '4') selected @endif>Xem
                                                nhiều gần đây</option>
                                        </select>
                                    </form>

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
                                                        class="badge badge-danger top-right">{{ $item->phantramgia }}%</span>
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
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="product-desc py-0 px-0">
                                                    <h3 class="title">
                                                        <a
                                                            href="{{ route('sanpham.chitiet', $item->id) }}">{{ $item->ten_san_pham }}</a>
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
                                                        <p class="product-price">
                                                            <del class="text-secondary"> {{ $item->gia_goc }}</del>
                                                            <span class="ms-2"> {{ $item?->gia_km }} đ</span>
                                                        </p>
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
                                                            class="badge badge-danger top-right">{{ $item->phantramgia }}%</span>
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
                                                                    href="{{ route('sanpham.chitiet', $item->id) }}">{{ $item->ten_san_pham }}</a>
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
                                                            <p class="product-price">
                                                                <del class="text-secondary"> {{ $item->gia_goc }}</del>
                                                                <span class="ms-2"> {{ $item?->gia_km }} đ</span>
                                                            </p>
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
                            <form action="{{ route('client.cuahang') }}" method="post">
                                @csrf
                                @method('GET')
                                <div class="sidbar-widget mt-10">
                                    <h4 class="title">LỌC THEO</h4>
                                    <h4 class="sub-title pt-10">Danh mục</h4>
                                    <div class="form-group">
                                        @foreach ($danhmucs as $item)
                                            <div class="widget-check-box">
                                                <input type="checkbox" id="danhmuc_{{ $item->id }}" name="danhmuc[]"
                                                    value="{{ $item->id }}"
                                                    @if (isset($request->danhmuc) && in_array($item->id, $request->danhmuc)) checked @endif />
                                                <label for="danhmuc_{{ $item->id }}">{{ $item->ten_danh_muc }}
                                                    <span> ({{ $item->soluong_sp_dm }}) </span></label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="sidbar-widget mt-10">
                                    <h4 class="sub-title pt-10">Giá</h4>
                                    <div class="widget-check-box">
                                        <input type="checkbox" id="price1" name="price[]" value="0-100000"
                                            @if (isset($request->price) && in_array('0-100000', $request->price)) checked @endif />
                                        <label for="price1">0 - 100.000</label>
                                    </div>
                                    <div class="widget-check-box">
                                        <input type="checkbox" id="price2" name="price[]" value="100000-500000"
                                            @if (isset($request->price) && in_array('100000-500000', $request->price)) checked @endif />
                                        <label for="price2">100.000 - 500.000</label>
                                    </div>
                                    <div class="widget-check-box">
                                        <input type="checkbox" id="price3" name="price[]" value="500000-1000000"
                                            @if (isset($request->price) && in_array('500000-1000000', $request->price)) checked @endif />
                                        <label for="price3">500.000 - 1.000.000</label>
                                    </div>
                                    <div class="widget-check-box">
                                        <input type="checkbox" id="price4" name="price[]" value="1000000+"
                                            @if (isset($request->price) && in_array('1000000+', $request->price)) checked @endif />
                                        <label for="price4">> 1.000.000</label>
                                    </div>
                                </div>
                                <div class="sidbar-widget mt-10">
                                    <h4 class="sub-title">Size</h4>
                                    <div class="form-group">
                                        @foreach ($size_sidebar as $item)
                                            <div class="widget-check-box">
                                                <input type="checkbox" id="size-{{ $item->id }}" name="size[]"
                                                    value="{{ $item->id }}"
                                                    @if (isset($request->size) && in_array($item->id, $request->size)) checked @endif />
                                                <label for="size-{{ $item->id }}">{{ $item->ten_size }}
                                                    <span>({{ $item->sl_size }})</span></label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="sidbar-widget mt-10">
                                    <h4 class="sub-title">Color</h4>
                                    <div class="form-group">
                                        @foreach ($color_sidebar as $item)
                                            <div class="widget-check-box color-grey">
                                                <input type="checkbox" id="color-{{ $item->id }}" name="color[]"
                                                    value="{{ $item->id }}"
                                                    @if (isset($request->color) && in_array($item->id, $request->color)) checked @endif />
                                                <label for="color-{{ $item->id }}"
                                                    style="background-color: {{ $item->ma_mau }} !important;">
                                                    {{ $item->ten_color }} <span>({{ $item->sl_color }})</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Lọc</button>
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


    <!-- Modal cho từng sản phẩm -->
    @foreach ($list_sanphams as $item)
        <div class="modal fade theme1 style1" id="quickview{{ $item->id }}" tabindex="-1" role="dialog">
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
                                <div class="product-sync-init mb-20 slick-initialized slick-slider">
                                    <div class="slick-list">
                                        <div class="slick-track" style="opacity: 1; width: 1544px;">
                                            <div class="single-product slick-slide slick-current slick-active"
                                                data-slick-index="0" aria-hidden="false" tabindex="0"
                                                style="width: 386px; position: relative; left: 0px; top: 0px; z-index: 999; opacity: 1;">
                                                <div class="product-thumb">
                                                    <a href="javascript:void(0)">
                                                        <img src="{{ asset('/storage/' . $item->anh_san_pham) }}"
                                                            alt="product-thumb" />
                                                    </a>
                                                </div>
                                            </div>
                                            @foreach ($item->bien_the_san_phams as $index => $bien_the)
                                                <div class="single-product slick-slide"
                                                    data-slick-index="{{ $index + 1 }}" aria-hidden="true"
                                                    tabindex="-1"
                                                    style="width: 386px; position: relative; left: -{{ ($index + 1) * 386 }}px; top: 0px; z-index: 998; opacity: 0; transition: opacity 500ms;">
                                                    <div class="product-thumb">
                                                        <a href="javascript:void(0)">
                                                            <img src="{{ asset('/storage/' . $bien_the->anh_bien_the) }}"
                                                                alt="product-thumb" />
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="product-sync-nav slick-initialized slick-slider">
                                    <div class="slick-list">
                                        <div class="slick-track"
                                            style="opacity: 1; width: 388px; transform: translate3d(0px, 0px, 0px);">
                                            <div class="single-product slick-slide slick-current slick-active"
                                                data-slick-index="0" aria-hidden="false" tabindex="0"
                                                style="width: 97px;">
                                                <div class="product-thumb">
                                                    <a href="javascript:void(0)">
                                                        <img src="{{ asset('/storage/' . $item->anh_san_pham) }}"
                                                            alt="product-thumb" />
                                                    </a>
                                                </div>
                                            </div>
                                            @foreach ($item->bien_the_san_phams as $index => $bien_the)
                                                <div class="single-product slick-slide"
                                                    data-slick-index="{{ $index + 1 }}" aria-hidden="false"
                                                    tabindex="0" style="width: 97px;">
                                                    <div class="product-thumb">
                                                        <a href="javascript:void(0)">
                                                            <img src="{{ asset('/storage/' . $bien_the->anh_bien_the) }}"
                                                                alt="product-thumb" />
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-7">
                                <div class="modal-product-info">
                                    <div class="product-head">
                                        <h2 class="title">{{ $item->ten_san_pham }}</h2>
                                        <h4 class="sub-title">Danh mục: {{ $item->danh_muc->ten_danh_muc }}</h4>
                                        <div class="star-content mb-20">
                                            @if ($item->danh_gia > 0)
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= floor($item->danh_gia))
                                                        <span class="star-on"><i class="fas fa-star"></i></span>
                                                    @else
                                                        <span class="star-on de-selected"><i
                                                                class="fas fa-star"></i></span>
                                                    @endif
                                                @endfor
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-body">
                                        <span class="product-price text-center">
                                            <p class="new-price">
                                                <del class="text-secondary">{{ $item->gia_goc }}</del>
                                                <span class="ms-2">{{ $item?->gia_km }} VNĐ</span>
                                            </p>
                                        </span>
                                        <p>{{ $item?->ma_ta_san_pham }}</p>
                                    </div>
                                    <div class="d-flex mt-30">
                                        <div class="product-size col-3">
                                            <h3 class="title">Size</h3>
                                            <select class="mt-0">
                                                @foreach ($item->bien_the_san_phams as $bien_the)
                                                    <option value="{{ $bien_the->size->id }}">
                                                        {{ $bien_the->size->ten_size }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="product-size col-3">
                                            <h3 class="title">Màu sắc</h3>
                                            <div class="d-flex">
                                                @foreach ($item->bien_the_san_phams as $bien_the)
                                                    <div class="widget-check-box color-grey">
                                                        <input type="radio"
                                                            id="color-{{ $item->id }}-{{ $bien_the->id }}"
                                                            name="color[{{ $item->id }}]"
                                                            value="{{ $bien_the->color->id }}"
                                                            @if (isset($request->color[$item->id]) && $request->color[$item->id] == $bien_the->color->id) checked @endif />
                                                        <label for="color-{{ $item->id }}-{{ $bien_the->id }}">
                                                            {{ $bien_the->color->ten_color }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-footer">
                                        <div class="product-count style d-flex flex-column flex-sm-row my-4">
                                            <div class="count d-flex">
                                                <input type="number" min="1" max="10" step="1"
                                                    value="1" id="quantity-{{ $item->id }}" />
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
                                                <button class="btn btn-dark btn--xl mt-5 mt-sm-0"
                                                    onclick="addToCart('{{ $item->id }}')">
                                                    <span class="me-2"><i class="ion-android-add"></i></span>
                                                    Thêm giỏ hàng
                                                </button>
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
        <script>
            document.getElementById('add-to-cart-form').addEventListener('submit', function(event) {
                // Kiểm tra nếu size chưa được chọn
                const sizeSelect = document.getElementById('size_san_pham_id');
                const sizeError = document.getElementById('size-error');
                const colorError = document.getElementById('color-error');
                let isValid = true;

                // Kiểm tra size
                if (sizeSelect.value === "") {
                    sizeError.style.display = 'block';
                    isValid = false;
                } else {
                    sizeError.style.display = 'none';
                }

                // Kiểm tra nếu không có màu nào được chọn
                const colorCheckboxes = document.querySelectorAll('input[name="color[]"]:checked');
                if (colorCheckboxes.length === 0) {
                    colorError.style.display = 'block';
                    isValid = false;
                } else {
                    colorError.style.display = 'none';
                }

                // Nếu không hợp lệ, ngăn không cho gửi form
                if (!isValid) {
                    event.preventDefault();
                }
            });

            function showMainImage(imageUrl) {
                // Tìm phần tử của ảnh chính
                const mainImage = document.querySelector('.main-product .product-thumb img');
                if (mainImage) {
                    mainImage.src = imageUrl;
                }
            }
        </script>
    @endforeach
@endsection
