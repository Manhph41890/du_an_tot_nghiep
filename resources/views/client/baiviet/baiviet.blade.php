@extends('client.layout')
@section('content')
    <!-- header end -->
    <!-- breadcrumb-section start -->
    <nav class="breadcrumb-section theme1 bg-lighten2 pt-110 pb-110">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title pb-4 text-white text-capitalize">
                            Blog
                        </h2>
                    </div>
                </div>
                <div class="col-12">
                    <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Blog
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </nav>
    <!-- breadcrumb-section end -->
    <!-- product tab start -->
    <section class="blog-section py-80">
        <div class="container">
            <div class="row">
                @foreach ($baiviets as $baiviet)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-30">
                        <div class="single-blog text-start">
                            <a class="blog-thumb mb-20 zoom-in d-block overflow-hidden"
                                href="{{ url('client/baivietchitiet', $baiviet->id) }}">

                                <img src="{{ asset('/storage/' . $baiviet->anh_bai_viet) }}">
                            </a>
                            <div class="blog-post-content">
                                <div class="d-flex justify-content-between">
                                    <p>Tác giả:
                                        <a class="text-secondary"
                                            href="{{ url('client/baivietchitiet', $baiviet->id) }}">{{ $baiviet->user->ho_ten }}</a>
                                    </p>
                                    <p>Xuất bản: {{ $baiviet->ngay_dang }}</p>
                                </div>
                                <h3 class="title mb-15 mt-15">
                                    <a
                                        style='color: #5a5ac9;'  href="{{ url('client/baivietchitiet', $baiviet->id) }}">{{ $baiviet->tieu_de_bai_viet }}</a>
                                </h3>
                                <p class="text">
                                    {{ Str::limit($baiviet->noi_dung, 100, '...') }}
                                </p>
                                <a class="read-more" href="{{ url('client/baivietchitiet', $baiviet->id) }}">Đọc thêm</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-12">
                    <nav class="pagination-section mt-30">
                        <ul class="pagination justify-content-center">
                            {{ $baiviets->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- product tab end -->
@endsection
