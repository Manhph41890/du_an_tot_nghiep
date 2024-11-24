@extends('client.layout')

@section('content')
<!-- breadcrumb-section start -->
<nav class="breadcrumb-section theme1 bg-lighten2 pt-110 pb-110">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center">
                    <h2 class="title pb-4 text-dark text-capitalize" style=" color: #fff !important">HƯỚNG DẪN MUA HÀNG</h2>
                </div>
            </div>
            <div class="col-12">
                <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
                    <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Hướng dẫn mua hàng</li>
                </ol>
            </div>
        </div>
    </div>
</nav>
<section class="contact-section pt-80 pb-50">
    <div class="container">
        <h3>HƯỚNG DẪN ĐẶT HÀNG</h3>
        <div class="row">
            <div>
                <p><strong>Bước 1: </strong> Vào trang Cửa hàng và chọn sản phẩm mình muốn nua</p>
                <img src="{{asset('assets/client/images/hdmuahang/buoc1.png')}}" alt="">
            </div>
            <div>
                <p><strong>Bước 2: </strong> Chọn size, màu sắc và số lượng sản phẩm muốn mua và thêm vào giỏ hàng</p>
                <img src="{{asset('assets/client/images/hdmuahang/buoc2.png')}}" alt="">
            </div>
            <div>
                <p><strong>Bước 3: </strong> Chọn sản phẩm muốn mua rồi "Thanh toán ngay"</p>
                <img src="{{asset('assets/client/images/hdmuahang/buoc3.png')}}" alt="">
            </div>
            <div>
                <p><strong>Bước 4: </strong> Điền thông tin nhận hàng và phương thức thanh toán. Cuối cùng là click vào "Đặt hàng" là bạn đã mua hàng thành công ạ.</p>
                <img src="{{asset('assets/client/images/hdmuahang/buoc4.png')}}" alt="">
            </div>
            <div class="text-thank">
                Chúc các bạn có trải nghiệm tốt nhất tại Articraft!
            </div>



        </div>
    </div>
</section>
<!-- contact-section end -->
@endsection
<style>
    .row div {
        text-align: center;
        /* Căn giữa nội dung trong div */
    }

    .row div p {
        text-align: left;
        font-size: 18px;
        margin: 16px 0;
        /* Căn giữa nội dung trong div */
    }

    .text-thank {
        font-size: 22px;
        font-weight: 600;
        color: #5a5a9c;
        font-style: italic;
    }

    .row div img {
        display: inline-block;
        /* Đảm bảo ảnh là inline-block để căn giữa */
        margin: 0 auto;
        /* Căn giữa ảnh */
    }

    p {
        font-size: 18px;
        margin-top: 20px;
        margin-bottom: 20px;

    }

    img {
        width: 800px !important;


    }
</style>