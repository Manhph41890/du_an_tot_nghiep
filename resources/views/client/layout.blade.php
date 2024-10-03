<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from htmldemo.net/looki/looki/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Oct 2024 09:35:59 GMT -->
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="" />
    <title>Looki - Beauty & Cosmetics eCommerce Bootstrap 5 Template</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico" />

    <!--********************************** 
        all css files 
    *************************************-->

    <!--*************************************************** 
       fontawesome,bootstrap,plugins and main style css
     ***************************************************-->
    <!-- cdn links -->

    <link rel="stylesheet" href="assets/css/fontawesome.min.css" />
    <link rel="stylesheet" href="assets/css/ionicons.min.css" />
    <link rel="stylesheet" href="assets/css/simple-line-icons.css" />
    <link rel="stylesheet" href="assets/css/plugins/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/plugins.css" />
    <link rel="stylesheet" href="assets/css/style.min.css" />

    <!-- Use the minified version files listed below for better performance and remove the files listed above -->

    <!--**************************** 
         Minified  css 
    ****************************-->

    <!--*********************************************** 
       vendor min css,plugins min css,style min css
     ***********************************************-->
    <!-- <link rel="stylesheet" href="assets/css/vendor/vendor.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/plugins.min.css" />
    <link rel="stylesheet" href="assets/css/style.min.css" /> -->
</head>

<body>
    

@include('client.partials.header')

@yield('content')

@include('client.partials.footer')


<!-- modals start -->
<!-- first modal -->
<div
  class="modal fade theme1 style1"
  id="quick-view"
  tabindex="-1"
  role="dialog"
>
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button
          type="button"
          class="close"
          data-bs-dismiss="modal"
          aria-label="Close"
        >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-8 mx-auto col-lg-5 mb-5 mb-lg-0">
            <div class="product-sync-init mb-20">
              <div class="single-product">
                <div class="product-thumb">
                  <img
                    src="assets/img/slider/thumb/1.jpg"
                    alt="product-thumb"
                  />
                </div>
              </div>
              <!-- single-product end -->
              <div class="single-product">
                <div class="product-thumb">
                  <img
                    src="assets/img/slider/thumb/2.jpg"
                    alt="product-thumb"
                  />
                </div>
              </div>
              <!-- single-product end -->
              <div class="single-product">
                <div class="product-thumb">
                  <img
                    src="assets/img/slider/thumb/3.jpg"
                    alt="product-thumb"
                  />
                </div>
              </div>
              <!-- single-product end -->
              <div class="single-product">
                <div class="product-thumb">
                  <img
                    src="assets/img/slider/thumb/4.jpg"
                    alt="product-thumb"
                  />
                </div>
              </div>
              <!-- single-product end -->
            </div>

            <div class="product-sync-nav">
              <div class="single-product">
                <div class="product-thumb">
                  <a href="javascript:void(0)">
                    <img
                      src="assets/img/slider/thumb/1.1.jpg"
                      alt="product-thumb"
                  /></a>
                </div>
              </div>
              <!-- single-product end -->
              <div class="single-product">
                <div class="product-thumb">
                  <a href="javascript:void(0)">
                    <img
                      src="assets/img/slider/thumb/2.1.jpg"
                      alt="product-thumb"
                  /></a>
                </div>
              </div>
              <!-- single-product end -->
              <div class="single-product">
                <div class="product-thumb">
                  <a href="javascript:void(0)"
                    ><img
                      src="assets/img/slider/thumb/3.1.jpg"
                      alt="product-thumb"
                  /></a>
                </div>
              </div>
              <!-- single-product end -->
              <div class="single-product">
                <div class="product-thumb">
                  <a href="javascript:void(0)"
                    ><img
                      src="assets/img/slider/thumb/4.1.jpg"
                      alt="product-thumb"
                  /></a>
                </div>
              </div>
              <!-- single-product end -->
            </div>
          </div>
          <div class="col-lg-7">
            <div class="modal-product-info">
              <div class="product-head">
                <h2 class="title">
                  New Balance Running Arishi trainers in triple
                </h2>
                <h4 class="sub-title">Reference: demo_5</h4>
                <div class="star-content mb-20">
                  <span class="star-on"><i class="fas fa-star"></i> </span>
                  <span class="star-on"><i class="fas fa-star"></i> </span>
                  <span class="star-on"><i class="fas fa-star"></i> </span>
                  <span class="star-on"><i class="fas fa-star"></i> </span>
                  <span class="star-on de-selected"
                    ><i class="fas fa-star"></i>
                  </span>
                </div>
              </div>
              <div class="product-body">
                <span class="product-price text-center">
                  <span class="new-price">$29.00</span>
                </span>
                <p>
                  Break old records and make new goals in the New Balance®
                  Arishi Sport v1.
                </p>
                <ul>
                  <li>Predecessor: None.</li>
                  <li>Support Type: Neutral.</li>
                  <li>Cushioning: High energizing cushioning.</li>
                </ul>
              </div>
              <div class="d-flex mt-30">
                <div class="product-size">
                  <h3 class="title">Dimension</h3>
                  <select>
                    <option value="0">40x60cm</option>
                    <option value="1">60x90cm</option>
                    <option value="2">80x120cm</option>
                  </select>
                </div>
              </div>
              <div class="product-footer">
                <div
                  class="product-count style d-flex flex-column flex-sm-row my-4"
                >
                  <div class="count d-flex">
                    <input type="number" min="1" max="10" step="1" value="1" />
                    <div class="button-group">
                      <button class="count-btn increment">
                        <i class="fas fa-chevron-up"></i>
                      </button>
                      <button class="count-btn decrement">
                        <i class="fas fa-chevron-down"></i>
                      </button>
                    </div>
                  </div>
                  <div>
                    <button class="btn btn-dark btn--xl mt-5 mt-sm-0">
                      <span class="me-2"><i class="ion-android-add"></i></span>
                      Add to cart
                    </button>
                  </div>
                </div>
                <div class="addto-whish-list">
                  <a href="#"><i class="icon-heart"></i> Add to wishlist</a>
                  <a href="#"><i class="icon-shuffle"></i> Add to compare</a>
                </div>
                <div class="pro-social-links mt-10">
                  <ul class="d-flex align-items-center">
                    <li class="share">Share</li>
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
                      <a href="#"><i class="ion-social-pinterest"></i></a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- second modal -->
<div class="modal fade style2" id="compare" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button
          type="button"
          class="close"
          data-bs-dismiss="modal"
          aria-label="Close"
        >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5 class="title">
          <i class="fa fa-check"></i> Product added to compare.
        </h5>
      </div>
    </div>
  </div>
</div>
<!-- second modal -->
<div class="modal fade style3" id="add-to-cart" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header justify-content-center bg-dark">
        <h5 class="modal-title" id="add-to-cartCenterTitle">
          Product successfully added to your shopping cart
        </h5>
        <button
          type="button"
          class="close"
          data-bs-dismiss="modal"
          aria-label="Close"
        >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-5 divide-right">
            <div class="row">
              <div class="col-md-6">
                <img src="assets/img/modal/1.jpg" alt="img" />
              </div>
              <div class="col-md-6 mb-2 mb-md-0">
                <h4 class="product-name">
                  New Balance Running Arishi trainers in triple
                </h4>
                <h5 class="price">$$29.00</h5>
                <h6 class="color">
                  <strong>Dimension: </strong>: <span class="dmc">40x60cm</span>
                </h6>
                <h6 class="quantity"><strong>Quantity:</strong>&nbsp;1</h6>
              </div>
            </div>
          </div>
          <div class="col-lg-7">
            <div class="modal-cart-content">
              <p class="cart-products-count">There is 1 item in your cart.</p>
              <p><strong>Total products:</strong>&nbsp;$123.72</p>
              <p><strong>Total shipping:</strong>&nbsp;$7.00</p>
              <p><strong>Taxes</strong>&nbsp;$0.00</p>
              <p><strong>Total:</strong>&nbsp;$130.72 (tax excl.)</p>
              <div class="cart-content-btn">
                <button
                  type="button"
                  class="btn btn-dark btn--md mt-4"
                  data-bs-dismiss="modal"
                >
                  Continue shopping
                </button>
                <button class="btn btn-dark btn--md mt-4">
                  Proceed to checkout
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- modals end -->

<!-- search-box and overlay start -->
<div class="overlay">
  <div class="scale"></div>
  <form class="search-box" action="#">
    <input type="text" name="search" placeholder="Search products..." />
    <button id="close" type="submit">
      <i class="ion-ios-search-strong"></i>
    </button>
  </form>
  <button class="close"><i class="ion-android-close"></i></button>
</div>
<!-- search-box and overlay end -->



    <!--*********************** 
        all js files
     ***********************-->

    <!--****************************************************** 
        jquery,modernizr ,poppe,bootstrap,plugins and main js
     ******************************************************-->

    <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="assets/js/vendor/jquery-migrate-3.3.2.min.js"></script>
    <script src="assets/js/vendor/modernizr-3.7.1.min.js"></script>
    <script src="assets/js/plugins/jquery-ui.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/plugins/plugins.js"></script>
    <script src="assets/js/plugins/ajax-contact.js"></script>
    <script src="assets/js/main.js"></script>

    <!-- Use the minified version files listed below for better performance and remove the files listed above -->

    <!--*************************** 
          Minified  js 
     ***************************-->

    <!--*********************************** 
         vendor,plugins and main js
      ***********************************-->

    <!-- <script src="assets/js/vendor/vendor.min.js"></script>
    <script src="assets/js/plugins/plugins.min.js"></script>
    <script src="assets/js/main.js"></script> -->


</body>


<!-- Mirrored from htmldemo.net/looki/looki/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Oct 2024 09:36:00 GMT -->
</html>