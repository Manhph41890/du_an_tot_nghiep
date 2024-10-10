@extends('client.layout')

@section('content')
 <!-- breadcrumb-section start -->
<nav class="breadcrumb-section theme1 bg-lighten2 pt-110 pb-110">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="section-title text-center">
            <h2 class="title pb-4 text-dark text-capitalize">single blog</h2>
          </div>
        </div>
        <div class="col-12">
          <ol
            class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center"
          >
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">
              single blog
            </li>
          </ol>
        </div>
      </div>
    </div>
  </nav>
  <!-- breadcrumb-section end -->
  <!-- product tab start -->
  <section class="blog-section pt-80 pb-80">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-10 mx-auto">
          <div class="blog-posts">
            <div class="single-blog-post blog-grid-post">
              <div class="blog-post-media">
                <div class="blog-image single-blog">
                  <a href="#"
                    ><img
                      class="object-fit-none"
                      src="assets/img/blog-post/large-blog.jpg"
                      alt="blog-thumb-naile"
                  /></a>
                </div>
              </div>
              <div class="blog-post-content-inner">
                <h4 class="blog-title">This is Third Post For Blog</h4>
                <ul class="blog-page-meta">
                  <li>
                    <a href="#"><i class="ion-person"></i> Admin</a>
                  </li>
                  <li>
                    <a href="#"><i class="ion-calendar"></i> 24 Nov, 2023</a>
                  </li>
                </ul>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, do
                  eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                  enim adminim veniam, quis nostrud exercitation ullamco laboris
                  nisi ut aliquip commodo consequat. Duis aute irure dolor in rep
                  rehenderit. Lorem ipsum dolor sit amet, consectetur adipisicing
                  elit, sed do eiumod tempor incididunt ut labore et dolore magna
                  aliqua. Lorem ipsum dolor sit amet, consectetur adipisicing
                  elit, do eiusmod tempor incididunt ut labore et dolore magna
                  aliqua. Lorem ipsum dolor sit amet, consectetur adipisicing
                  elit, do eiusmod tempor incididunt ut labore et dolore magna
                  aliqua. Ut enim adminim veniam, quis nostrud exercitation
                  ullamco laboris nisi ut aliquip commodo consequat.
                </p>
              </div>
  
              <div class="single-post-content">
                <p class="quate-speech">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, do
                  eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis
                  aute irure dolor in rep rehenderit. Lorem ipsum dolor sit amet,
                  consectetur adipisicing elit, sed do eiumod tempor incididunt ut
                  labore et dolore magna aliqua. Lorem ipsum dolor sit amet,
                  consectetur adipisicing elit, do eiusmod tempor incididunt ut
                  labore et dolore magna aliqua.
                </p>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                  eiumod tempor incididunt ut labore et dolore magna aliqua. Lorem
                  ipsum dolor sit amet, consectetur adipisicing elit, do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum
                  dolor sit amet, consectetur adipisicing elit, do eiusmod tempor
                  incididunt ut labore et dolore magna aliqua. Ut enim adminim
                  veniam, quis nostrud exercitation ullamco laboris nisi ut
                  aliquip commodo consequat. Duis aute irure dolor in rep
                  rehenderit. Lorem ipsum dolor sit amet, consectetur adipisicing
                  elit, sed do eiumod tempor incididunt ut labore et dolore magna
                  aliqua. consectetur adipisicing elit, sed do eiumod tempor
                  incididunt ut labore et dolore magna aliqua.
                </p>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                  eiumod tempor incididunt ut labore et dolore magna aliqua. Lorem
                  ipsum dolor sit amet, consectetur adipisicing elit, do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum
                  dolor sit amet, consectetur adipisicing elit, do eiusmod tempor
                  incididunt ut labore et dolore magna aliqua. Ut enim adminim
                  veniam, quis nostrud exercitation ullamco laboris nisi ut
                  aliquip commodo consequat. Duis aute irure dolor in rep
                  rehenderit. Lorem ipsum dolor sit amet, consectetur adipisicing
                  elit, sed do eiumod tempor incididunt ut labore et dolore magna
                  aliqua.
                </p>
              </div>
            </div>
            <!-- single blog post -->
          </div>
          <div class="blog-single-tags-share d-sm-flex justify-content-between">
            <div class="blog-single-tags d-flex">
              <span class="title">Tags: </span>
              <ul class="tag-list">
                <li><a href="#">Fashion,</a></li>
                <li><a href="#">T-shirt,</a></li>
                <li><a href="#">White</a></li>
              </ul>
            </div>
            <div class="blog-single-share d-flex">
              <span class="title">Share:</span>
              <ul class="social">
                <li>
                  <a href="#"><i class="ion-social-facebook"></i></a>
                </li>
                <li>
                  <a href="#"><i class="ion-social-twitter"></i></a>
                </li>
                <li>
                  <a href="#"><i class="ion-social-google"></i></a>
                </li>
                <li>
                  <a href="#"><i class="ion-social-instagram"></i></a>
                </li>
              </ul>
            </div>
          </div>
          <div class="blog-related-post">
            <div class="row">
              <div class="col-md-12 text-center">
                <!-- Section Title -->
                <div class="section-title underline-shape">
                  <h2>Related Post</h2>
                </div>
                <!-- Section Title -->
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 mb-4 mb-md-0">
                <div class="blog-post-media">
                  <div class="blog-image single-blog">
                    <a href="#"
                      ><img src="assets/img/blog-post/1.png" alt="blog"
                    /></a>
                  </div>
                </div>
                <div class="blog-post-content">
                  <a
                    class="blog-link theme-color d-inline-block mb-10 text-uppercase"
                    href="https://themeforest.net/user/hastech"
                    >Fashion</a
                  >
                  <h3 class="title mb-15">
                    <a href="single-blog.html">This is first Post For Blog</a>
                  </h3>
                  <p class="sub-title">
                    Posted by
                    <a
                      class="theme-color d-inline-block mx-1"
                      href="https://themeforest.net/user/hastech"
                      >HasTech</a
                    >
                    12TH Nov 2023
                  </p>
                </div>
              </div>
              <div class="col-md-4 mb-4 mb-md-0">
                <div class="blog-post-media">
                  <div class="blog-image single-blog">
                    <a href="#"
                      ><img src="assets/img/blog-post/2.png" alt="blog"
                    /></a>
                  </div>
                </div>
                <div class="blog-post-content">
                  <a
                    class="blog-link theme-color d-inline-block mb-10 text-uppercase"
                    href="https://themeforest.net/user/hastech"
                    >Fashion</a
                  >
                  <h3 class="title mb-15">
                    <a href="single-blog.html">This is first Post For Blog</a>
                  </h3>
                  <p class="sub-title">
                    Posted by
                    <a
                      class="theme-color d-inline-block mx-1"
                      href="https://themeforest.net/user/hastech"
                      >HasTech</a
                    >
                    12TH Nov 2023
                  </p>
                </div>
              </div>
              <div class="col-md-4 mb-4 mb-md-0">
                <div class="blog-post-media">
                  <div class="blog-image single-blog">
                    <a href="#"
                      ><img src="assets/img/blog-post/3.png" alt="blog"
                    /></a>
                  </div>
                </div>
                <div class="blog-post-content">
                  <a
                    class="blog-link theme-color d-inline-block mb-10 text-uppercase"
                    href="https://themeforest.net/user/hastech"
                    >Fashion</a
                  >
                  <h3 class="title mb-15">
                    <a href="single-blog.html">This is first Post For Blog</a>
                  </h3>
                  <p class="sub-title">
                    Posted by
                    <a
                      class="theme-color d-inline-block mx-1"
                      href="https://themeforest.net/user/hastech"
                      >HasTech</a
                    >
                    12TH Nov 2023
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="comment-area">
            <h2 class="comment-heading">3 Comments</h2>
            <div class="review-wrapper">
              <div class="single-review">
                <div class="review-img">
                  <img src="assets/img/testimonial-image/1.png" alt="" />
                </div>
                <div class="review-content">
                  <div class="review-top-wrap">
                    <div class="review-left">
                      <div class="review-name">
                        <h4>White Lewis</h4>
                        <span class="date">Nov 16, 2023 at 1:38 am</span>
                      </div>
                    </div>
                    <div class="review-left">
                      <a href="#">Reply</a>
                    </div>
                  </div>
                  <div class="review-bottom">
                    <p>
                      Vestibulum ante ipsum primis aucibus orci luctustrices
                      posuere cubilia Curae Suspendisse viverra ed viverra. Mauris
                      ullarper euismod vehicula. Phasellus quam nisi, congue id
                      nulla.
                    </p>
                  </div>
                </div>
              </div>
              <div class="single-review child-review">
                <div class="review-img">
                  <img src="assets/img/testimonial-image/2.png" alt="" />
                </div>
                <div class="review-content">
                  <div class="review-top-wrap">
                    <div class="review-left">
                      <div class="review-name">
                        <h4>White Lewis</h4>
                        <span class="date">Nov 16, 2023 at 1:38 am</span>
                      </div>
                    </div>
                    <div class="review-left">
                      <a href="#">Reply</a>
                    </div>
                  </div>
                  <div class="review-bottom">
                    <p>
                      Vestibulum ante ipsum primis aucibus orci luctustrices
                      posuere cubilia Curae Sus pen disse viverra ed viverra.
                      Mauris ullarper euismod vehicula.
                    </p>
                  </div>
                </div>
              </div>
              <div class="single-review">
                <div class="review-img">
                  <img src="assets/img/testimonial-image/1.png" alt="" />
                </div>
                <div class="review-content">
                  <div class="review-top-wrap">
                    <div class="review-left">
                      <div class="review-name">
                        <h4>White Lewis</h4>
                        <span class="date">Nov 16, 2023 at 1:38 am</span>
                      </div>
                    </div>
                    <div class="review-left">
                      <a href="#">Reply</a>
                    </div>
                  </div>
                  <div class="review-bottom">
                    <p>
                      Vestibulum ante ipsum primis aucibus orci luctustrices
                      posuere cubilia Curae Suspendisse viverra ed viverra. Mauris
                      ullarper euismod vehicula. Phasellus quam nisi, congue id
                      nulla.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="blog-comment-form">
            <h2 class="comment-heading">Leave a Reply</h2>
            <p>
              Your email address will not be published. Required fields are marked
              *
            </p>
            <div class="row">
              <div class="col-md-12">
                <div class="single-form">
                  <label>Your Review:</label>
                  <textarea placeholder="Write a review"></textarea>
                </div>
              </div>
              <div class="col-md-4">
                <div class="single-form">
                  <label>Name:</label>
                  <input type="text" placeholder="Name" />
                </div>
              </div>
              <div class="col-md-4">
                <div class="single-form">
                  <label>Email:</label>
                  <input type="email" placeholder="Email" />
                </div>
              </div>
              <div class="col-md-4">
                <div class="single-form">
                  <label>Website:</label>
                  <input type="email" placeholder="Website" />
                </div>
              </div>
              <div class="col-md-12">
                <div class="single-form">
                  <input type="submit" value="Submit" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- product tab end -->
@endsection