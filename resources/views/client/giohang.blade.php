@extends('client.layout')

@section('content')
    <!-- breadcrumb-section start -->
    <nav class="breadcrumb-section theme1 bg-lighten2 pt-110 pb-110">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title pb-4 text-dark text-capitalize">cart</h2>
                    </div>
                </div>
                <div class="col-12">
                    <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">cart</li>
                    </ol>
                </div>
            </div>
        </div>
    </nav>
    <!-- breadcrumb-section end -->
    <!-- product tab start -->
    <section class="whish-list-section theme1 pt-80 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="title mb-30 pb-25 text-capitalize">Sản phẩm của bạn</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center" scope="col">Ảnh sản phẩm</th>
                                    <th class="text-center" scope="col">Tên sản phẩm</th>
                                    <th class="text-center" scope="col">Tình trạng</th>
                                    <th class="text-center" scope="col">Màu sắc</th>
                                    <th class="text-center" scope="col">Kích thước</th>
                                    <th class="text-center" scope="col">Số lượng</th>
                                    <th class="text-center" scope="col">Giá</th>
                                    <th class="text-center" scope="col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="text-center" scope="row">
                                        <img src="assets/img/product/4.png" alt="img" />
                                    </th>
                                    <td class="text-center">
                                        <span class="whish-title">Originals Kaval nail polish</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-danger position-static">Còn hàng</span>
                                    </td>
                                    <td class="text-center">
                                        <!-- Thêm Màu sắc -->
                                        <span class="badge badge-primary">Xanh dương</span>
                                    </td>
                                    <td class="text-center">
                                        <!-- Thêm Kích thước -->
                                        <span>Medium</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="product-count style">
                                            <div class="count d-flex justify-content-center">
                                                <input type="number" min="1" max="10" step="1"
                                                    value="1" />
                                                <div class="button-group">
                                                    <button class="count-btn increment">
                                                        <i class="fas fa-chevron-up"></i>
                                                    </button>
                                                    <button class="count-btn decrement">
                                                        <i class="fas fa-chevron-down"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="whish-list-price"> $38 </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="#">
                                            <span class="trash"><i class="fas fa-trash-alt"></i> </span>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="Place-order mt-25 d-flex justify-content-end">
                        <a class="btn btn--lg btn-primary me-3" href="#">Tiếp tục mua hàng</a>
                        <a class="btn btn--lg btn-danger my-2 my-sm-0 ms-2" href="#">Xóa giỏ hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product tab end -->
    <div class="check-out-section pb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="billing-info-wrap">
            <h3 class="title">calculate shipping</h3>
            <form class="personal-information" action="https://htmldemo.net/looki/looki/assets/php/contact.php">
              <div class="row">
                <div class="col-lg-6 col-md-6">
                  <div class="billing-select mb-20px">
                    <select id="inputState" class="form-select mb-3">
                      <option>Select country</option>
                      <option>Azerbaijan</option>
                      <option>Bahamas</option>
                      <option>Bahrain</option>
                      <option>Bangladesh</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6">
                  <div class="billing-select mb-20px">
                    <select id="inputState2" class="form-select mb-3">
                      <option>Select State</option>
                      <option>Azerbaijan</option>
                      <option>Bahamas</option>
                      <option>Bahrain</option>
                      <option>Bangladesh</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="billing-info mb-20px">
                    <input placeholder="Postcode / ZIP" type="text" />
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="billing-select mb-20px">
                    <a href="#" class="btn btn-primary check-out-btn">estimate</a>
                  </div>
                </div>
                <div class="col-12">
                  <h3 class="coupon-title">Mã giảm giá</h3>
                </div>
                <div class="col-lg-6 col-md-6">
                  <div class="billing-info mb-20px">
                    <input placeholder="coupon Code" type="text" />
                  </div>
                </div>
                <div class="col-lg-6 col-md-6">
                  <a href="#" class="btn btn-primary check-out-btn">apply code</a>
                </div>
              </div>
            </form>
          </div>
                </div>
                {{-- ----------------- thanh toan--------------------------- --}}
                <div class="col-lg-5 mt-4 mt-lg-0">
                    <div class="your-order-area">
                        <div class="your-order-wrap gray-bg-4">
                            <div class="your-order-product-info">

                                <div class="your-order-bottom">
                                    <ul>
                                        <li class="your-order-shipping">Thành tiền</li>
                                        <li>100000 VND</li>
                                    </ul>
                                </div>
                                <div class="your-order-total mb-0">
                                    <ul>
                                        <li class="order-total">Tổng thanh toán</li>
                                        <li>??? VND</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="Place-order mt-25">
                            <a class="btn btn--lg btn-primary my-2 my-sm-0 ms-2" href="#">Thanh toán</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
