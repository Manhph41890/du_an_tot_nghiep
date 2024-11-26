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
    <nav class="breadcrumb-section theme1 bg-lighten2 pt-110 pb-110">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title pb-4 text-dark text-capitalize" style=" color: #fff !important">{{ $danhMuc->ten_danh_muc }}</h2>
                    </div>
                </div>
                <div class="col-12">
                    <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
                        <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $danhMuc->ten_danh_muc }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <section class="mb-5 mt-3">
            <div class="brand-slider-section theme1 bg-white">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                           
                    </div>
                </div>
            </div>
        </section>
        <section>
            <!-- <div class="mb-50 d-flex justify-content-center">
                <h3><strong>Danh mục: {{ $danhMuc->ten_danh_muc }}</strong></h3>
            </div> -->

        </section>
        @if ($sanPhams->isEmpty())
            <!-- Kiểm tra nếu danh sách sản phẩm trống -->
            <p class="text-center">Sản phẩm hiện không có hàng.</p>
        @else
            <div class="row">
                @foreach ($sanPhams as $sanPham)
                    <div class="col-md-3">
                        <div class="product-card">
                            <a href="{{ route('san-phams.incrementViews', $sanPham->id) }}">
                                <img src="{{ asset('storage/' . $sanPham->anh_san_pham) }}"
                                    alt="{{ $sanPham->ten_san_pham }}" class="product-image">
                                <h5 class="min_h">{{ $sanPham->ten_san_pham }}</h5>
                                <p>{{ $sanPham->mo_ta }}</p>
                                <p> Giá: <small>{{ number_format($sanPham->gia_goc) }} VND</small></p>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        <style>
            small{
                color: red;
                font-size: 16px;
                font-weight: 600;
            }
            .min_h {
                display: -webkit-box;
                -webkit-line-clamp: 3;
                /* Số dòng muốn hiển thị */
                -webkit-box-orient: vertical;
                overflow: hidden;
                text-overflow: ellipsis;
                min-height: 4em;
                font-weight: 600;
                /* Tùy chỉnh chiều cao tối thiểu dựa trên chiều cao dòng */
            }

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
    </div>
@endsection
