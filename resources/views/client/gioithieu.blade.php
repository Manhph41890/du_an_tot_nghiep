
@extends('client.layout')

@section('content')
<!-- breadcrumb-section start -->
<nav class="breadcrumb-section theme1 bg-lighten2 pt-110 pb-110 " >
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-title text-center">
          <h2 class="title pb-4 text-dark text-capitalize" style=" color: #fff !important">GIỚI THIỆU</h2>
        </div>
      </div>
      <div class="col-12">
        <ol
          class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
          <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
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
    <div class="row ">
      <div class="title mb-30 "> ✨ Articraft – Nơi Hội Tụ Cảm Hứng Nghệ Thuật Và Sáng Tạo ✨</div>
      <p>Chào mừng bạn đến với Articraft, thế giới của sự sáng tạo và nghệ thuật không giới hạn! Chúng tôi tự hào là thương hiệu chuyên cung cấp các sản phẩm đồ họa cụ chất lượng cao, dành riêng cho những nhà thiết kế, nghệ sĩ, và tất cả những ai yêu thích sáng tạo.</p>
      <div class="col-12 col-lg-5 mx-auto mb-30 mt-5">
        <img src="{{asset ('assets/client/images/banner/aboutus2.jpg')}}" alt="">
      </div>
      <div class="col-12 col-lg-7 mx-auto mb-30 mt-5 ">
        <h3>Articraft – Bạn Đồng Hành Của Người Nghệ Sĩ</h3>
        <p>
          Tại Articraft, chúng tôi hiểu rằng từng nét vẽ, từng ý tưởng đều là một phần quan trọng trong hành trình sáng tạo của bạn. Vì vậy, mỗi sản phẩm mà chúng tôi mang đến không chỉ là công cụ,
          mà còn là nguồn cảm hứng, giúp bạn dễ dàng hiện thực hóa những ý tưởng độc đáo nhất.
        </p>

        <p>
          Không chỉ dừng lại ở việc cung cấp đồ họa cụ, Articraft còn là cầu nối giúp bạn khám phá những xu hướng công nghệ mới nhất trong ngành thiết kế và nghệ thuật.
          Chúng tôi luôn cập nhật những sản phẩm tiên tiến nhất, giúp bạn không ngừng đổi mới và phát triển bản thân.
        </p>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-12 col-lg-7 mx-auto mb-30">
        <h3>Đa Dạng Sản Phẩm – Đáp Ứng Mọi Nhu Cầu</h3>
        <p>Dù bạn là một nhà thiết kế chuyên nghiệp hay chỉ mới bắt đầu hành trình khám phá nghệ thuật, Articraft đều có những sản phẩm phù hợp: </p>

        <p><strong>- Bộ bảng vẽ đồ họa: </strong> Hiện đại, mượt mà, hỗ trợ mọi phần mềm thiết kế.</p>
        <p><strong>- Bút vẽ kỹ thuật số: </strong> Chính xác, nhạy bén, giúp bạn vẽ chi tiết hoàn hảo.</p>
        <p><strong>- Phụ kiện thiết kế: </strong> Đa dạng, tiện lợi, từ giá đỡ bút đến màn hình bảo vệ.</p>
        <p>Chúng tôi cung cấp đa dạng các loại dụng cụ mỹ thuật chất lượng cao, từ cọ vẽ,
          màu nước, màu acrylic đến giấy vẽ và nhiều sản phẩm khác.
        </p>

      </div>
      <div class="col-12 col-lg-5 mx-auto mb-30">
        <img src="{{asset ('assets/client/images/banner/aboutus.png')}}" alt="">
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-12 col-lg-5 mx-auto mb-30">
        <img src="{{asset ('assets/client/images/banner/aboutus1.jpg')}}" alt="">
      </div>
      <div class="col-12 col-lg-7 mx-auto mb-30">
        <h3>Chất Lượng Là Cam Kết</h3>
        <p>Chúng tôi đặt chất lượng lên hàng đầu, từ khâu chọn nguyên liệu đến quy trình sản xuất và kiểm tra sản phẩm. Articraft cam kết mang đến cho bạn những sản phẩm bền bỉ, đáp ứng tiêu chuẩn quốc tế với mức giá cạnh tranh.</p>
        <p>
          Chúng tôi cam kết rằng mỗi sản phẩm của Articraft không chỉ hoạt động tốt trong hiện tại mà còn bền bỉ theo thời gian. Sự bền vững này giúp bạn yên tâm đầu tư vào những công cụ sáng tạo chất lượng cao mà không lo lắng về việc thay thế thường xuyên.
        </p>
      </div>
    </div>
    <strong style="text-align: center;">
    Hãy để Articraft đồng hành cùng bạn trên hành trình sáng tạo vô tận. Ghé thăm chúng tôi tại website <a href="http://du_an_tot_nghiep.test/">Articraft</a> và khám phá ngay bộ sưu tập đồ họa cụ đỉnh cao dành riêng cho bạn!
    </strong>

      
  
  </div>
</section>
<style>
  /* text-align: justify;  2 le bang nhau*/
  .title {
    font-weight: 600;
    color: #5a5ac9;
    text-transform: capitalize;
    font-size: 25px;
    max-width: 900px;
    margin: 0 auto 20px;
    line-height: 1.4;
    text-align: center;
  }
  strong{
    font-size: 17px;
    text-align: center;
  }

  p {
    text-align: justify;
    font-size: 17px;
    margin-bottom: 10px;
    line-height: 35px;
  }

  h3 {
    color: #5a5ac9;
    margin-bottom: 10px;
    font-weight: 600;
    font-size: 20px;
  }

  @media screen and (max-width:767px) {
    .about-content .title {
      font-size: 25px;
      color: #5a5ac9;
    }
  }
</style>
@endsection