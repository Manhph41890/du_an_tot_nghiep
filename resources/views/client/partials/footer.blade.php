<!-- footer strat -->

<footer class="bg-light theme1 position-relative">
    <!-- footer bottom sart -->
    <div class="footer-bottom pt-40 pb-30" style="background-color: #5b5bad;">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-3 mb-30">
                    <div class="footer-widget mx-w-400">
                        <div class="footer-logo " style="transform: translateY(-38%);">
                            <a href="{{ route('client.home') }}" class="d-block">
                                <img style="width:200px;" src="{{ asset('assets/client/images/logo/logo_art1.png') }}"
                                    alt="footer logo" />
                            </a>
                        </div>
                        <p class="text " style="transform: translate(5%, -157%);">
                            Vẽ sáng tạo - Tô hạnh phúc
                        </p>
                        <ul class="footer-menu" style="transform: translateY(-14%);">
                            <li>
                                <i class="fa fa-envelope  mx-2" style="color: #fff; "></i>
                                <span class="text hover-left">articraft@gmail.com</span>
                            </li>

                            <li>
                                <i class="fa fa-mobile  mx-2" style="color: #fff; "></i>
                                <a href="#" class="text hover-left"> (024) 8582 0808</a>
                            </li>
                            <li>
                                <i class="fa fa-map-pin  mx-2 " style="color: #fff"></i>
                                <a href="#">Nam Từ Liêm, Hà Nội</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3 mb-30">
                    <div class="footer-widget">
                        <div class="border-bt cbb1 mb-25">
                            <div class="section-title">
                                <h2 class="title" style="color: #fff !important;">CHÍNH SÁCH BÁN HÀNG</h2>
                            </div>
                        </div>
                        <!-- footer-menu start -->
                        <ul class="footer-menu">
                            <li><a href="about-us.html">Chính Sách bảo mật</a></li>
                            <li><a href="#">Hình thức thanh toán</a></li>
                            <li><a href="contact.html">Chính sách giao hàng</a></li>
                            <li><a href="contact.html">Chính sách đổi trả</a></li>
                            <li><a href="#">Điều khoản bán hàng</a></li>
                        </ul>
                        <!-- footer-menu end -->
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3 mb-30">
                    <div class="footer-widget">
                        <div class="border-bt cbb1 mb-25">
                            <div class="section-title">
                                <h2 class="title" style="color: #fff !important;">HỖ TRỢ KHÁCH HÀNG</h2>
                            </div>
                        </div>
                        <!-- footer-menu start -->
                        <ul class="footer-menu">
                            <li><a href="#">Hướng dẫn mua hàng</a></li>
                            <li><a href="#">Phương thức vận chuyển</a></li>
                            <li><a href="login.html">Phương thức thanh toán</a></li>
                        </ul>
                        <!-- footer-menu end -->
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3 mb-30">
                    <!-- <div class="footer-widget">
                        <div class="border-bt cbb1 mb-25">
                            <div class="section-title">
                                <h2 class="title">ĐỊA CHỈ</h2>
                            </div>
                        </div>
                      
                    </div> -->
                    <div class="nletter-form mb-35">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10993.517839725198!2d105.75015105398771!3d21.037658157177084!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313455e940879933%3A0xcf10b34e9f1a03df!2zVHLGsOG7nW5nIENhbyDEkeG6s25nIEZQVCBQb2x5dGVjaG5pYw!5e0!3m2!1sen!2s!4v1730219909258!5m2!1sen!2s"
                            width="300" height="220" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer bottom end -->
    <style>
        .hover-left:hover {
            padding-left: 5px;
            transition: all .3s;
        }

        .border-bt {
            position: relative;
            color: #fff;
        }

        .border-bt::after {
            content: "";
            position: absolute;
            bottom: 0;
            width: 66.67%;
            height: 1px;
            background-color: #fff;
        }
    </style>
</footer>
<!-- footer end -->