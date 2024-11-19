@extends('client.layout')

@section('content')
    <nav class="breadcrumb-section theme1 bg-lighten2 pt-110 pb-110">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title pb-4 text-dark text-uppercase" style=" color: #fff !important">
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
                <div class="col-lg-10 mb-30">
                    <div class="grid-nav-wraper bg-lighten2 mb-30">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-5 mb-3 mb-md-0">
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
                            <div class="col-12 col-md-7 position-relative">
                                <div class="shop-grid-button d-flex align-items-center justify-content-end">
                                    <span class="sort-by">Sắp xếp:</span>
                                    <form action="{{ route('client.cuahang') }}" method="post">
                                        @csrf
                                        @method('GET')
                                        <select class="form-select custom-select ms-3" name="sort"
                                            aria-label="Default select example" onchange="this.form.submit()">
                                            <option value="" @if (request('sort') == '') selected @endif>Chọn
                                            </option>
                                            <option value="2" @if (request('sort') == '2') selected @endif>Giá
                                                giảm dần</option>
                                            <option value="3" @if (request('sort') == '3') selected @endif>Giá
                                                tăng dần</option>
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
                                    <div class="col-6 col-sm-4 col-lg-3 mb-30">
                                        <div class="card product-card">
                                            <div class="card-body">
                                                <div class="product-thumbnail position-relative">
                                                    <span class="badge badge-danger top-right">-
                                                        {{ $item->phantramgia }}%</span>
                                                    <a href="{{ route('sanpham.chitiet', $item->id) }}">
                                                        <img class="first-img"
                                                            src="{{ asset('storage/' . $item->anh_san_pham) }}"
                                                            alt="thumbnail" />
                                                    </a>
                                                    {{-- <ul class="actions d-flex justify-content-center">
                                                        <li>
                                                            <a class="action" href="#" data-bs-toggle="modal"
                                                                data-bs-target="#quickview{{ $item->id }}">
                                                                <span data-bs-toggle="tooltip" data-placement="bottom"
                                                                    title="Quick view" class="icon-magnifier"></span>
                                                            </a>
                                                        </li>
                                                    </ul> --}}
                                                </div>
                                                <div class="product-desc py-0 px-0">
                                                    <h3 class="title min_h">
                                                        <a
                                                            href="{{ route('sanpham.chitiet', $item->id) }}">{{ $item->ten_san_pham }}</a>
                                                    </h3>
                                                    <div class="star-rating">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($item->danh_gia > 0 && $i <= floor($item->danh_gia))
                                                                <span class="ion-ios-star"></span> <!-- Sao có màu -->
                                                            @else
                                                                <span class="ion-ios-star-outline"></span>
                                                                <!-- Sao không màu -->
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <p>Giá: </p>
                                                        <p style="color: red">
                                                            <del style="color: black">{{ $item->gia_goc }}</del>
                                                            {{ $item?->gia_km }} VNĐ
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
                                        <div class="card product-card minh">
                                            <div class="card-body">
                                                <div class="media flex-column flex-md-row">
                                                    <div class="product-thumbnail position-relative  w-300">
                                                        <span class="badge badge-danger top-right">-
                                                            {{ $item->phantramgia }}%</span>
                                                        <a href="{{ route('sanpham.chitiet', $item->id) }}">
                                                            <img class="first-img"
                                                                src="{{ asset('storage/' . $item->anh_san_pham) }}"
                                                                alt="thumbnail" />
                                                        </a>
                                                        {{-- <ul class="actions d-flex justify-content-center">
                                                            <li>
                                                                <a class="action" href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#quickview{{ $item->id }}">
                                                                    <span data-bs-toggle="tooltip" data-placement="bottom"
                                                                        class="icon-magnifier" aria-label="Quick view"
                                                                        data-bs-original-title="Quick view"></span>
                                                                </a>
                                                            </li>
                                                        </ul> --}}
                                                    </div>
                                                    <div class="media-body ps-md-4">
                                                        <div class="product-desc py-0 px-0">
                                                            <h3 class="title min_h">
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
                                                                <span class="ms-2"> {{ $item?->gia_km }} VNĐ</span>
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
                <div class="col-lg-2 mb-30 order-lg-first bg-lighten2">
                    <aside class="left-sidebar theme1">
                        <div class="search-filter">
                            <form action="{{ route('client.cuahang') }}" method="post">
                                @csrf
                                @method('GET')
                                <div class="">
                                    <div class="header-sidebar mt-3">
                                        <div class="d-flex justify-content-center rounded " style="background-color: #5b5bad;">
                                            <h5 class="title m-2 text-white" style="font-weight:600">LỌC THEO</h5>
                                        </div>
                                        {{-- <button type="submit" class="btn btn-primary sidebar-loc rounded-2">Lọc</button> --}}
                                    </div>
                                    <h6 class="sub-title mt-30 mb-2 ">Danh mục</h6>
                                    <div class="form-group">
                                        @foreach ($danhmucs as $item)
                                            <div class="widget-check-box">
                                                <input type="checkbox" id="danhmuc_{{ $item->id }}" name="danhmuc[]"
                                                    onchange="this.form.submit()" value="{{ $item->id }}"
                                                    @if (isset($request->danhmuc) && in_array($item->id, $request->danhmuc)) checked @endif />
                                                <label
                                                    for="danhmuc_{{ $item->id }}">{{ $item->ten_danh_muc }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="">
                                    <h6 class="sub-title mt-30  mb-2 fs-15">Giá</h6>
                                    <div class="widget-check-box">
                                        <input type="checkbox" id="price1" name="price[]" value="0-100000"
                                            onchange="this.form.submit()"
                                            @if (isset($request->price) && in_array('0-100000', $request->price)) checked @endif />
                                        <label for="price1">0 - 100.000</label>
                                    </div>
                                    <div class="widget-check-box">
                                        <input type="checkbox" id="price2" name="price[]" value="100000-500000"
                                            onchange="this.form.submit()"
                                            @if (isset($request->price) && in_array('100000-500000', $request->price)) checked @endif />
                                        <label for="price2">100.000 - 500.000</label>
                                    </div>
                                    <div class="widget-check-box">
                                        <input type="checkbox" id="price3" name="price[]" value="500000-1000000"
                                            onchange="this.form.submit()"
                                            @if (isset($request->price) && in_array('500000-1000000', $request->price)) checked @endif />
                                        <label for="price3">500.000 - 1.000.000</label>
                                    </div>
                                    <div class="widget-check-box">
                                        <input type="checkbox" id="price4" name="price[]" value="1000000+"
                                            onchange="this.form.submit()"
                                            @if (isset($request->price) && in_array('1000000+', $request->price)) checked @endif />
                                        <label for="price4">> 1.000.000</label>
                                    </div>
                                </div>
                                <div class="">
                                    <h6 class="sub-title mt-30  mb-2 fs-15">Size</h6>
                                    <div class="form-group">
                                        @foreach ($size_sidebar as $item)
                                            <div class="widget-check-box">
                                                <input type="checkbox" id="size-{{ $item->id }}" name="size[]"
                                                    onchange="this.form.submit()" value="{{ $item->id }}"
                                                    @if (isset($request->size) && in_array($item->id, $request->size)) checked @endif />
                                                <label for="size-{{ $item->id }}">{{ $item->ten_size }}
                                                    {{-- <span>({{ $item->sl_size }})</span> --}}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="">
                                    <h6 class="sub-title mt-30  mb-2 fs-15">Color</h6>
                                    <div class="form-group">
                                        @foreach ($color_sidebar as $item)
                                            <div class="widget-check-box">
                                                <input type="checkbox" id="color-{{ $item->id }}" name="color[]"
                                                    onchange="this.form.submit()" value="{{ $item->id }}"
                                                    @if (isset($request->color) && in_array($item->id, $request->color)) checked @endif />
                                                <label for="color-{{ $item->id }}">
                                                    {{ $item->ten_color }}
                                                    {{-- <span>({{ $item->sl_color }})

                                                    </span> --}}
                                                </label>
                                            </div>
                                        @endforeach
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
    <!-- Modal cho từng sản phẩm -->
    {{-- @foreach ($list_sanphams as $item)
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
                                <div>
                                    <div class="position-relative">
                                        <span class="badge badge-danger top-right">{{ $item->phantramgia }}%</span>
                                    </div>
                                    <div class="product-sync-init mb-20">
                                        <!-- Ảnh sản phẩm chính -->
                                        <div class="single-product main-product">
                                            <div class="product-thumb">
                                                <img src="{{ asset('/storage/' . $item->anh_san_pham) }}"
                                                    alt="Ảnh sản phẩm chính">
                                            </div>
                                        </div>

                                        <!-- Ảnh các biến thể sản phẩm -->
                                        @foreach ($item->bien_the_san_phams as $bien_the)
                                            <div class="single-product variant-product">
                                                <div class="product-thumb">
                                                    <img src="{{ asset('/storage/' . $bien_the->anh_bien_the) }}"
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
                                                onclick="showMainImage('{{ asset('/storage/' . $item->anh_san_pham) }}')">
                                                <img src="{{ asset('/storage/' . $item->anh_san_pham) }}"
                                                    alt="Thumbnail sản phẩm chính">
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Thumbnail ảnh biến thể sản phẩm -->
                                    @foreach ($item->bien_the_san_phams as $bien_the)
                                        <div class="single-product thumbnail">
                                            <div class="product-thumb">
                                                <a href="javascript:void(0)"
                                                    onclick="showMainImage('{{ asset('/storage/' . $bien_the->anh_bien_the) }}')">
                                                    <img src="{{ asset('/storage/' . $bien_the->anh_bien_the) }}"
                                                        alt="Thumbnail biến thể sản phẩm">
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
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
                                        <p>{{ $item?->mo_ta_san_pham }}</p>
                                    </div>

                                    <form id="add-to-cart-form{{ $item->id }}" method="POST"
                                        action="{{ route('cart.add') }}">
                                        @csrf <!-- Thêm token CSRF để bảo mật -->

                                        <!-- Hidden field for san_pham_id -->
                                        <input type="hidden" name="san_pham_id" value="{{ $item->id }}">

                                        <div class="d-flex mt-30">
                                            <div class="product-size col-3">
                                                <h3 class="title">Size</h3>
                                                <select class="mt-0" id="size_san_pham_id{{ $item->id }}"
                                                    name="size_san_pham_id">
                                                    <option value="">Chọn</option>
                                                    <!-- Thêm tùy chọn "Chọn kích thước" -->
                                                    @foreach ($item->bien_the_san_phams as $bien_the)
                                                        <option value="{{ $bien_the->size->id }}">
                                                            {{ $bien_the->size->ten_size }}</option>
                                                    @endforeach
                                                </select>
                                                <span id="size-error{{ $item->id }}" class="text-danger"
                                                    style="display: none;">Vui lòng
                                                    chọn size!</span>
                                            </div>
                                            <div class="product-size col-3">
                                                <h3 class="title">Màu sắc</h3>
                                                <div class="d-flex">
                                                    @foreach ($item->bien_the_san_phams as $bien_the)
                                                        <div class="widget-check-box color-grey">
                                                            <input type="radio"
                                                                id="color-{{ $item->id }}-{{ $bien_the->id }}"
                                                                name="color" value="{{ $bien_the->color->id }}"
                                                                @if (isset($request->color[$item->id]) && $request->color[$item->id] == $bien_the->color->id) checked @endif />
                                                            <label for="color-{{ $item->id }}-{{ $bien_the->id }}">
                                                                {{ $bien_the->color->ten_color }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <span id="color-error{{ $item->id }}" class="text-danger"
                                                    style="display: none;">Vui
                                                    lòng chọn màu!</span>
                                            </div>
                                        </div>
                                        <div class="product-footer">
                                            <div class="product-count style d-flex flex-column flex-sm-row my-4">
                                                <div class="count d-flex">
                                                    <input type="number" name="quantity" min="1" max="10"
                                                        step="1" value="1" required />
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
                                                    <button type="submit" class="btn btn-dark btn--xl mt-5 mt-sm-0">
                                                        <span class="me-2"><i class="ion-android-add"></i></span>
                                                        Thêm giỏ hàng
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .min_h {
                display: -webkit-box;
                -webkit-line-clamp: 1;
                /* Số dòng */
                -webkit-box-orient: vertical;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            .sub-title{
                font-size: 18px;
            }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('add-to-cart-form{{ $item->id }}').addEventListener('submit', function(
                    event) {
                    const sizeSelect = document.getElementById('size_san_pham_id{{ $item->id }}');
                    const sizeError = document.getElementById('size-error{{ $item->id }}');
                    const colorError = document.getElementById('color-error{{ $item->id }}');
                    let isValid = true;

                    // Kiểm tra size
                    if (sizeSelect.value === "") {
                        sizeError.style.display = 'block'; // Hiện thông báo lỗi cho size
                        isValid = false;
                    } else {
                        sizeError.style.display = 'none'; // Ẩn thông báo lỗi cho size
                    }

                    // Kiểm tra nếu không có màu nào được chọn
                    const colorRadios = document.querySelectorAll('input[name="color"]:checked');
                    if (colorRadios.length === 0) {
                        colorError.style.display = 'block'; // Hiện thông báo lỗi cho màu
                        isValid = false;
                    } else {
                        colorError.style.display = 'none'; // Ẩn thông báo lỗi cho màu
                    }

                    // Nếu không hợp lệ, ngăn không cho gửi form
                    if (!isValid) {
                        event.preventDefault(); // Ngăn gửi form
                    }
                });
            });
            // Hàm tăng số lượng
            function incrementQuantity() {
                const quantityInput = document.querySelector('input[name="quantity"]');
                let quantity = parseInt(quantityInput.value);
                if (quantity < 10) {
                    quantityInput.value = quantity + 1;
                }
            }

            // Hàm giảm số lượng
            function decrementQuantity() {
                const quantityInput = document.querySelector('input[name="quantity"]');
                let quantity = parseInt(quantityInput.value);
                if (quantity > 1) {
                    quantityInput.value = quantity - 1;
                }
            }

            function showMainImage(imageUrl) {
                // Tìm phần tử của ảnh chính
                const mainImage = document.querySelector('.main-product .product-thumb img');
                if (mainImage) {
                    mainImage.src = imageUrl;
                }
            }
        </script>
    @endforeach --}}
@endsection
