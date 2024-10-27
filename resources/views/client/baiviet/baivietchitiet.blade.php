@extends('client.layout')

@section('content')
    <!-- breadcrumb-section start -->
    <nav class="breadcrumb-section theme1 bg-lighten2 pt-110 pb-110">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title pb-4 text-dark text-capitalize">single blog</h2>
                    </div>
                </div>
                <div class="col-12">
                    <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            single blog
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </nav>
    <!-- breadcrumb-section end -->
    <!-- product tab start -->
    <section class="blog-section pt-80 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-10 mx-auto">
                    <div class="blog-posts">
                        <div class="single-blog-post blog-grid-post">
                            <div class="blog-post-media">
                                <div class="blog-image single-blog">
                                    <a href="#"> <img src="{{ asset('/storage/' . $baiViet->anh_bai_viet) }}"></a>
                                </div>
                            </div>
                            <div class="blog-post-content-inner">
                                <h4 class="blog-title">{{ $baiViet->tieu_de_bai_viet }}</h4>
                                <ul class="blog-page-meta">
                                    <li>
                                        <a href="#"><i class="ion-person"></i>{{ $baiViet->user->ho_ten }}</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="ion-calendar"></i> {{ $baiViet->ngay_dang }}</a>
                                    </li>
                                </ul>
                                @php
                                    $length = strlen($baiViet->noi_dung);
                                    $part1 = substr($baiViet->noi_dung, 0, ceil($length / 3));
                                    $part2 = substr($baiViet->noi_dung, ceil($length / 3), ceil($length / 3));
                                    $part3 = substr($baiViet->noi_dung, 2 * ceil($length / 3));
                                @endphp
                                <p>{{ $part1 }}</p>
                            </div>

                            <div class="single-post-content">
                                <p class="quate-speech">
                                    {{ $part2 }}
                                </p>
                                <p>{{ $part3 }}</p>
                            </div>
                        </div>
                        <!-- single blog post -->
                    </div>
                    <div class="blog-single-tags-share d-sm-flex justify-content-between">
                        <div class="blog-single-tags d-flex">
                            <span class="title">Tags: </span>
                            <ul class="tag-list">
                                <li><a href="#">Fashion,</a></li>
                                <li><a href="#">T-shirt,</a></li>
                                <li><a href="#">White</a></li>
                            </ul>
                        </div>
                        <div class="blog-single-share d-flex">
                            <span class="title">Share:</span>
                            <ul class="social">
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
                                    <a href="#"><i class="ion-social-instagram"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="blog-related-post">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <!-- Section Title -->
                                <div class="section-title underline-shape">
                                    <h2>Related Post</h2>
                                </div>
                                <!-- Section Title -->
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($docThem as $item)
                                <div class="col-md-4 mb-4 mb-md-0">
                                    <div class="blog-post-media">
                                        <div class="blog-image single-blog">
                                            <a href="{{ url('client/baivietchitiet', $item->id) }}"> <img
                                                    src="{{ asset('/storage/' . $item->anh_bai_viet) }}"></a>
                                        </div>
                                    </div>
                                    <div class="blog-post-content">

                                        <h3 class="title mb-15">
                                            <a href="single-blog.html">{{ $item->tieu_de_bai_viet }}</a>
                                        </h3>
                                        <p class="sub-title">
                                            Tác giả:
                                            <a class="theme-color d-inline-block mx-1"
                                                href="#">{{ $item->user->ho_ten }}</a>
                                            {{ $item->ngay_dang }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product tab end -->
@endsection
