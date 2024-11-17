@extends('client.layout')

@section('content')
    <!-- breadcrumb-section start -->
    <nav class="breadcrumb-section theme1 bg-lighten2 pt-110 pb-110">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title pb-4 text-dark text-capitalize">Liên hệ</h2>
                    </div>
                </div>
                <div class="col-12">
                    <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
                        <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Liên hệ</li>
                    </ol>
                </div>
            </div>
        </div>
    </nav>
    <!-- breadcrumb-section end -->
    <!-- map start -->
    {{-- <div style="margin-top:20px;" class="map">
    <iframe
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.5480490037507!2d90.42897841550803!3d23.76349088458297!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c78ab2187d4d%3A0x4d5f8a6c610c144b!2sHasTech%20Digital%20Item%20%26%20Service%20Provider!5e0!3m2!1sen!2sua!4v1595747193974!5m2!1sen!2sua"
    ></iframe>
  </div> --}}
    <!-- map end -->
    <!-- contact-section satrt -->
    <section class="contact-section pt-80 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12 mb-30">
                    <!--  contact page side content  -->
                    <div class="contact-page-side-content">
                        <h3 class="contact-page-title style_primary" >Liên hệ</h3>
                        <p class="contact-page-message mb-30">
                            ARTICRAFT
                        <p>Vẽ sáng tạo - Tô hạnh phúc</p>
                        </p>
                        <!--  single contact block  -->

                        <div class="single-contact-block ">
                            <h4 class="style_primary"><i class="fa fa-fax" style="margin-right: 8px;"></i> Địa chỉ</h4>
                            <p>Trịnh Văn Bô, Xuân Phương, Nam Từ Liêm, Hà Nội </p>
                        </div>

                        <!--  End of single contact block -->

                        <!--  single contact block -->

                        <div class="single-contact-block">
                            <h4 class="style_primary"><i class="fa fa-phone" style="margin-right: 8px;"></i> SĐT</h4>
                            <p>
                                <a href="tel:123456789">Mobile: 0394338046 </a>
                            </p>
                            <p><a href="tel:1009678456">Hotline: 1009 678 456</a></p>
                        </div>

                        <!-- End of single contact block -->

                        <!--  single contact block -->

                        <div class="single-contact-block">
                            <h4 class="style_primary "><i class="fas fa-envelope " style="margin-right: 8px;"></i> Email</h4>
                            <p>
                                <a href="mailto:yourmail@domain.com">articraft@gmail.com</a>
                            </p>
                        </div>

                        <!--=======  End of single contact block  =======-->
                    </div>

                    <!--=======  End of contact page side content  =======-->
                </div>
                <div class="col-lg-6 col-12 mb-30">
                    <!--  contact form content -->
                    <div class="contact-form-content">
                        <h3 class="contact-page-title style_primary" >Tư Vấn Thêm</h3>
                        <div class="contact-form">
                            <form id="contact-form" action=""
                                method="POST">
                                <div class="form-group">
                                    <label class="style_primary">Họ và tên <span class="required">*</span></label>
                                    <input type="text" name="name" placeholder="Nhập tên của bạn..." id="name" />
                                </div>
                                <div class="form-group">
                                    <label class="style_primary">Email <span class="required">*</span></label>
                                    <input type="email" name="email" placeholder="Nhập email..." id="email" />
                                </div>
                                <div class="form-group">
                                    <label class="style_primary">Đối tượng</label>
                                    <input type="text" name="subject" placeholder="Nhập đối tượng..." id="subject" />
                                </div>
                                <div class="form-group">
                                    <label class="style_primary">Nội dung</label>
                                    <textarea name="contactMessage" class="pb-10" placeholder="Nhập nội dung..." id="contactMessage"></textarea>
                                </div>
                                <div class="form-group my-3">
                                    <button type="submit" value="submit" id="submit" class="btn btn-dark btn--lg button_submit"
                                        name="submit">
                                        submit
                                    </button>
                                </div>
                            </form>
                        </div>
                        <p class="form-message mt-10"></p>
                    </div>
                    <!-- End of contact -->
                </div>
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