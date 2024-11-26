@extends('client.layout')

@section('content')
    <!-- breadcrumb-section start -->
    <nav class="breadcrumb-section theme1 bg-lighten2 pt-110 pb-110">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title pb-4 text-dark text-capitalize" style=" color: #fff !important">LIÊN HỆ</h2>
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
    <section class="contact-section pt-80 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-12 mb-30">
                    <!--  contact form content -->
                    <div class="contact-form-content">
                        <h3 class="contact-page-title">Tư Vấn Thêm</h3>
                        <div class="contact-form">
                            <form id="contact-form" action="" method="POST">
                                <div class="form-group">
                                    <label for="name">Họ và Tên <span class="required text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Nhập họ và tên" required />
                                </div>
                                <div class="form-group">
                                    <label for="email">Email <span class="required text-danger">*</span></label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="Nhập địa chỉ email" required />
                                </div>
                                <div class="form-group">
                                    <label for="email">Số điện thoại <span class="required text-danger">*</span></label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="Nhập số điện thoại" required />
                                </div>
                             
                                <div class="form-group ">
                                    <label for="subject" class="form-label">Tiêu Đề</label>
                                    <select id="subject" class="form-select" name="subject">
                                        <option value="support">Hỗ trợ sản phẩm</option>
                                        <option value="order">Thắc mắc đơn hàng</option>
                                        <option value="feedback">Góp ý</option>
                                        <option value="complaint">Khiếu nại</option>
                                        <option value="other">Khác</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="contactMessage">Nội Dung Tin Nhắn</label>
                                    <textarea name="contactMessage" id="contactMessage" class="form-control" rows="5"
                                        placeholder="Nhập nội dung tin nhắn"></textarea>
                                </div>
                                <div class="form-group mb-0 mt-3">
                                    <button type="submit" value="submit" id="submit" class="btn btn-primary btn-lg"
                                        name="submit">
                                        Gửi Tin Nhắn
                                    </button>
                                </div>
                            </form>
                        </div>
                        <p class="form-message mt-10"></p>
                    </div>
                    <!-- End of contact -->
                </div>
                <div class="col-lg-5 col-12 mb-30">
                    <!--  contact page side content  -->
                    <div class="contact-page-side-content">
                        <!-- <h3 class="contact-page-title style_primary" >Liên hệ</h3> -->
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
                            <h4 class="style_primary "><i class="fas fa-envelope " style="margin-right: 8px;"></i> Email
                            </h4>
                            <p>
                                <a href="mailto:yourmail@domain.com">articraft@gmail.com</a>
                            </p>
                        </div>

                        <!--=======  End of single contact block  =======-->
                    </div>

                    <!--=======  End of contact page side content  =======-->
                </div>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10993.517839725198!2d105.75015105398771!3d21.037658157177084!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313455e940879933%3A0xcf10b34e9f1a03df!2zVHLGsOG7nW5nIENhbyDEkeG6s25nIEZQVCBQb2x5dGVjaG5pYw!5e0!3m2!1sen!2s!4v1730219909258!5m2!1sen!2s"
                    width="500" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

    </section>

    <!-- contact-section end -->
@endsection
<style>
    .style_primary {
        color: #5a5ac9 !important;
    }

    .form-group {
        height: auto !important;
        margin-bottom: 0px !important;
    }

    .button_submit {
        color: #5a5ac9 !important;
        background: #fff !important;
        border-color: #5a5ac9 !important;
        border-radius: 4px !important;
        padding: 12px 28px !important;
    }

    .button_submit:hover {
        color: #fff !important;
        background: #5a5ac9 !important;

    }
</style>
