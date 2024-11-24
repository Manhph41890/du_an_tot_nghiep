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
                <img src="{{asset('assets/client/images/hdmuahang/buoc1.png')}}" alt="">
                <img src="{{asset('assets/client/images/hdmuahang/buoc2.png')}}" alt="">
                <img src="{{asset('assets/client/images/hdmuahang/buoc3.png')}}" alt="">
                <img src="{{asset('assets/client/images/hdmuahang/buoc4.png')}}" alt="">
                
            </div>
        </div>
    </section>
    <!-- contact-section end -->
@endsection
<style>
    .style_primary{
        color: #5a5ac9 !important;
    }
    .form-group{
        height: auto !important;
        margin-bottom: 0px !important;
    }
    .button_submit{
        color: #5a5ac9 !important;
        background: #fff !important;
        border-color: #5a5ac9 !important;
        border-radius: 4px !important;
        padding: 12px 28px !important;
    }
    .button_submit:hover{
        color: #fff !important;
        background: #5a5ac9 !important;
       
    }
</style>