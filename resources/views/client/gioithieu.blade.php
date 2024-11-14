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
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection