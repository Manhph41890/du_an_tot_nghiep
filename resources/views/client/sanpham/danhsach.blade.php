@extends('client.layout')

@section('content')
    {{-- <nav class="breadcrumb-section theme1 bg-lighten2 pt-110 pb-110">
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
    </nav> --}}
    {{-- mã giảm giá 'voucher' --}}
    <section class="discount-codes">
        <div class="discount-list">
            @foreach ($discounts as $item)
                <div class="discount-item">
                    <div class="discount-code">
                        <span class="code">{{ $item->ma_khuyen_mai }}</span>
                    </div>
                    <div class="discount-description">
                        <p>Giảm <span class="text-danger">{{ number_format($item->gia_tri_khuyen_mai, 0, ',', '.') }}</span>
                            VNĐ cho tất cả các sản phẩm.
                        </p>
                    </div>
                    <button style="font-size: 1em" class="copy-btn" onclick="copyCode('{{ $item->ma_khuyen_mai }}')">Sao
                        chép mã</button>
                </div>
            @endforeach
        </div>
        <!-- Modal -->
        <div id="copyModal" class="copy-modal">
            <div class="modal-content">
                <p id="copyMessage">Mã giảm giá đã được sao chép!</p>
            </div>
        </div>
    </section>
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
                                        <div class="d-flex justify-content-center rounded "
                                            style="background-color: #5b5bad;">
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
