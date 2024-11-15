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
          class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
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
      <div class="title mb-30"> Chào mừng bạn đến với Articraft - thiên đường dành cho những người yêu thích mỹ thuật!</div>
      <!-- <div class=""> Tại Articraft, chúng tôi cung cấp đa dạng các loại dụng cụ mỹ thuật chất lượng cao, từ cọ vẽ,
        màu nước, màu acrylic đến giấy vẽ và nhiều sản phẩm khác. Với sứ mệnh mang đến nguồn cảm hứng
        và hỗ trợ tối đa cho các nghệ sĩ, chúng tôi cam kết cung cấp sản phẩm tốt nhất với giá cả hợp lý.

        Hãy khám phá và thỏa sức sáng tạo cùng Articraft! ✨</div> -->
      <div class="col-12 col-lg-5 mx-auto mb-30">
      <img src="{{asset ('assets/client/images/banner/aboutus2.jpg')}}" alt="">
      </div>
      <div class="col-12 col-lg-7 mx-auto mb-30">Text</div>
      <!-- <div class="col-12 col-xl-11 mx-auto mb-30">
        <div class="about-content text-center">
          <div class="about-left-image mb-30">
            <img
              src="{{asset('assets/client/images/blog-post/5.jpg')}}"
              alt="img"
              class="img-responsive" />
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
          </div>
        </div>
      </div> -->
    </div>
    <div class="row">
      <div class="col-12 col-lg-7 mx-auto mb-30">Tại Articraft, chúng tôi cung cấp đa dạng các loại dụng cụ mỹ thuật chất lượng cao, từ cọ vẽ,
              màu nước, màu acrylic đến giấy vẽ và nhiều sản phẩm khác. Với sứ mệnh mang đến nguồn cảm hứng
              và hỗ trợ tối đa cho các nghệ sĩ, chúng tôi cam kết cung cấp sản phẩm tốt nhất với giá cả hợp lý.

              Hãy khám phá và thỏa sức sáng tạo cùng Articraft! ✨</div>
      <div class="col-12 col-lg-5 mx-auto mb-30">
        <img src="{{asset ('assets/client/images/banner/aboutus.png')}}" alt="">
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-lg-5 mx-auto mb-30">
      <img src="{{asset ('assets/client/images/banner/aboutus1.jpg')}}" alt="">
      </div>
      <div class="col-12 col-lg-7 mx-auto mb-30">Text</div>
    </div>
  </div>
</section>
<style>
  /* text-align: justify;  2 le bang nhau*/
  .title {
    font-weight: 600;
    color: #5a5ac9;
    text-transform: capitalize;
    font-size: 30px;
    max-width: 900px;
    margin: 0 auto 20px;
    line-height: 1.4;
    text-align: center;
  }

  @media screen and (max-width:767px) {
    .about-content .title {
      font-size: 25px;
      color: #5a5ac9;
    }
  }
</style>
@endsection