@extends('client.layout')

@section('content')
<!-- breadcrumb-section start -->
<nav class="breadcrumb-section theme1 bg-lighten2 pt-110 pb-110">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="section-title text-center">
            <h2 class="title pb-4 text-dark text-capitalize">Giới thiệu</h2>
          </div>
        </div>
        <div class="col-12">
          <ol
            class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center"
          >
            <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Giới thiệu</li>
          </ol>
        </div>
      </div>
    </div>
  </nav>
  <!-- breadcrumb-section end -->
  <!-- product tab start -->
  <section class="about-section pt-80 pb-50">
    <div class="container">
      <div class="row">
        <div class="col-12 col-xl-11 mx-auto mb-30">
          <div class="about-content text-center">
            <div class="about-left-image mb-30">
              <img
                src="{{asset('assets/client/images/blog-post/5.jpg')}}"
                alt="img"
                class="img-responsive"
              />
            </div>
            <div>
              <h2 class="title mb-30">
              Chào mừng bạn đến với Articraft - thiên đường dành cho những người yêu thích mỹ thuật!
              </h2>
              <p class="mb-30">
                  Tại Articraft, chúng tôi cung cấp đa dạng các loại dụng cụ mỹ thuật chất lượng cao, từ cọ vẽ, 
                  màu nước, màu acrylic đến giấy vẽ và nhiều sản phẩm khác. Với sứ mệnh mang đến nguồn cảm hứng 
                  và hỗ trợ tối đa cho các nghệ sĩ, chúng tôi cam kết cung cấp sản phẩm tốt nhất với giá cả hợp lý.

                  Hãy khám phá và thỏa sức sáng tạo cùng Articraft! ✨
              </p>
              <img src="{{asset ('assets/client/images/blog-post/signature.png')}}" alt="" />
              <h3 class="title mb-30">Thành viên</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- product tab end -->
  
  <!-- <section class="static-media-section theme-bg py-45">
    <div class="container">
      <div class="static-media-wrap p-0">
        <div class="row">
          <div class="col-lg-3 col-sm-6 py-3">
            <div class="d-flex static-media2 flex-column flex-sm-row">
              <img
                class="align-self-center mb-2 mb-sm-0 me-auto me-sm-3"
                src="{{asset('assets/client/images/icon/2.png')}}"
                alt="icon"
              />
              <div class="media-body">
                <h4 class="title text-capitalize text-white">Free Shipping</h4>
                <p class="text text-white">On all orders over $75.00</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 py-3">
            <div class="d-flex static-media2 flex-column flex-sm-row">
              <img
                class="align-self-center mb-2 mb-sm-0 me-auto me-sm-3"
                src="{{asset('assets/client/images/icon/3.png')}}"
                alt="icon"
              />
              <div class="media-body">
                <h4 class="title text-capitalize text-white">Free Returns</h4>
                <p class="text text-white">Returns are free within 9 days</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 py-3">
            <div class="d-flex static-media2 flex-column flex-sm-row">
              <img
                class="align-self-center mb-2 mb-sm-0 me-auto me-sm-3"
                src="{{asset('assets/client/images/icon/5.png')}}"
                alt="icon"
              />
              <div class="media-body">
                <h4 class="title text-capitalize text-white">Support 24/7</h4>
                <p class="text text-white">Contact us 24 hours a day</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6 py-3">
            <div class="d-flex static-media2 flex-column flex-sm-row">
              <img
                class="align-self-center mb-2 mb-sm-0 me-auto me-sm-3"
                src="{{asset('assets/client/images/icon/4.png')}}"
                alt="icon"
              />
              <div class="media-body">
                <h4 class="title text-capitalize text-white">
                  100% Payment Secure
                </h4>
                <p class="text text-white">Your payment are safe with us.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> -->
  <section class="service-section pt-80 pb-50">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-lg-4 mb-4">
          <div class="single-blog">
            <div class="single-thumb mb-25 zoom-in d-block overflow-hidden">
              <img src="{{ asset('assets/client/images/service/1.jpg')}}" alt="single-thumb-naile" />
            </div>
            <div class="single-service">
              <h3 class="title text-capitalize mb-20">What do we do?</h3>
              <p>
                Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                accusantium doloremque laudantium, totam rem aperiam, eaque ipsa
                quae ab illo inventore veritatis et quasi architecto
              </p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-4 mb-4">
          <div class="single-blog">
            <div class="single-thumb mb-20 zoom-in d-block overflow-hidden">
              <img src="{{ asset('assets/client/images/service/2.jpg')}}" alt="single-thumb-naile" />
            </div>
            <div class="single-service">
              <h3 class="title text-capitalize mb-20">Sứ mệnh của chúng tôi</h3>
              <p>
                Nhưng để bạn có thể thấy rằng tất cả những sai lầm bẩm sinh này là niềm vui của những người buộc tội và nỗi đau của những người khen ngợi, tôi sẽ kể lại toàn bộ vấn đề, và chính những điều được tạo ra bởi người phát hiện ra sự thật và như nó. là kiến ​​trúc sư
              </p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-4 mb-4">
          <div class="single-blog">
            <div class="single-thumb mb-20 zoom-in d-block overflow-hidden">
              <img src="{{ asset('assets/client/images/service/3.jpg')}}" alt="single-thumb-naile" />
            </div>
            <div class="single-service">
              <h3 class="title text-capitalize mb-20">Giới thiệu</h3>
              <p>
                Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                accusantium doloremque laudantium, totam rem aperiam, eaque ipsa
                quae ab illo inventore veritatis et quasi architecto
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection