@extends('client.layout')

@section('content')
    <!-- header end -->
    <!-- breadcrumb-section start -->
    <nav class="breadcrumb-section theme1 bg-primary pt-110 pb-110">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title pb-4 text-white text-capitalize" style=" color: #fff !important">
                            BLOG
                        </h2>
                    </div>
                </div>
                <div class="col-12">
                    <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
                        <li class="breadcrumb-item"><a href="{{ route('client.home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Blog
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </nav>
    <!-- breadcrumb-section end -->

    <!-- Blog Section Start -->
    <section class="blog-section py-80 bg-light">
        <div class="container">
            <div class="row">
                @foreach ($baiviets as $baiviet)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-30">
                        <div class="single-blog overflow-hidden position-relative">
                            <!-- Image -->
                            <a class="blog-thumb mb-20 zoom-in d-block"
                                href="{{ url('client/baivietchitiet', $baiviet->id) }}">
                                <img src="{{ asset('/storage/' . $baiviet->anh_bai_viet) }}" class="img-fluid"
                                    alt="{{ $baiviet->tieu_de_bai_viet }}">
                            </a>
                            <!-- Blog Content -->
                            <div class="blog-post-content p-4">
                                <div class="d-flex justify-content-between text-muted mb-2">
                                    <p>Tác giả: <a
                                            href="{{ url('client/baivietchitiet', $baiviet->id) }}">{{ $baiviet->user->ho_ten }}</a>
                                    </p>
                                    <p>Xuất bản: {{ $baiviet->ngay_dang }}</p>
                                </div>
                                <h3 class="title mb-15 mt-10">
                                    <a href="{{ url('client/baivietchitiet', $baiviet->id) }}"
                                        class="text-primary">{{ $baiviet->tieu_de_bai_viet }}</a>
                                </h3>
                                <p class="text-muted mb-3">
                                    {{ Str::limit($baiviet->noi_dung, 120, '...') }}
                                </p>
                                <a class="read-more text-primary"
                                    href="{{ url('client/baivietchitiet', $baiviet->id) }}">Đọc thêm</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="row">
                <div class="col-12">
                    <nav class="pagination-section mt-30 text-center">
                        <ul class="pagination justify-content-center">
                            {{ $baiviets->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection

@section('styles')
    <style>
        /* Cải thiện giao diện của phần Breadcrumb */
        .breadcrumb-section {
            background: #0056b3;
        }

        .breadcrumb-section .breadcrumb-item a {
            color: #fff;
        }

        .breadcrumb-section .breadcrumb-item.active {
            color: #ffd700;
        }

        /* Tinh chỉnh layout cho blog */
        .single-blog {
            background: #fff;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .single-blog:hover {
            transform: translateY(-10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .blog-thumb {
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .blog-thumb:hover {
            transform: scale(1.05);
        }

        /* Tinh chỉnh thông tin bài viết */
        .blog-post-content h3 {
            font-size: 1.2rem;
            font-weight: 600;
            color: #333;
        }

        .blog-post-content p {
            font-size: 0.9rem;
        }

        .read-more {
            font-weight: bold;
            color: #0056b3;
            text-decoration: none;
        }

        .read-more:hover {
            text-decoration: underline;
        }

        /* Cải thiện giao diện phân trang */
        .pagination-section .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .pagination-section .pagination .page-item a {
            color: #0056b3;
            font-size: 1rem;
            padding: 8px 16px;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .pagination-section .pagination .page-item a:hover {
            background: #0056b3;
            color: #fff;
        }

        .pagination-section .pagination .page-item.active a {
            background: #0056b3;
            color: #fff;
        }
    </style>
@endsection
