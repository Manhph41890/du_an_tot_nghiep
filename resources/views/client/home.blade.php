@extends('client.layout')

@section('content')
    <style>
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
    <!-- staic media start -->
    <section class="static-media-section py-80 bg-white">
        <div class="container">
            <div class="static-media-wrap theme-bg padding_box">
                <div class="row">
                    <div class="col-lg-3 col-sm-6 py-3">
                        <div class="d-flex static-media2 flex-column flex-sm-row">
                            <img class="align-self-center mb-2 mb-sm-0 me-auto me-sm-3"
                                src="{{ asset('assets/client/images/icon/2.png') }}" alt="icon" />
                            <div class="media-body">
                                <h4 class="title">Miễn phí vận chuyển</h4>
                                <p class="text">Đơn hàng trên 50.000d</p>
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
                                <h4 class="title">Bảo mật an toàn 100%</h4>
                                <p class="text">Bảo mật thông tin</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 py-3">
                        <div class="d-flex static-media2 flex-column flex-sm-row">
                            <img class="align-self-center mb-2 mb-sm-0 me-auto me-sm-3"
                                src="{{ asset('assets/client/images/icon/5.png') }}" alt="icon" />
                            <div class="media-body">
                                <h4 class="title">Hỗ trợ 24/7</h4>
                                <p class="text">Hỗ trợ khách hàng 24/7</p>
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
                                                                <a class="min_h"
                                                                    href="{{ route('sanpham.chitiet', $item->id) }}">
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
                                                                <a class="min_h"
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
                                                <!-- product links end-->
                                            </div>
                                            <div class="media-body">
                                                <div class="product-desc">
                                                    <h3 class="title">
                                                        <a class="min_h"
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
