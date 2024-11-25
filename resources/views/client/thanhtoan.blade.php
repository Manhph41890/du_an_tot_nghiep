@extends('client.layout')


@section('content')
<!-- breadcrumb-section start -->
<nav class="breadcrumb-section theme1 bg-lighten2 pt-110 pb-110">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="section-title text-center">
            <h2 class="title pb-4 text-dark text-capitalize">Check out</h2>
          </div>
        </div>
        <div class="col-12">
          <ol
            class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center"
          >
            <li class="breadcrumb-item"><a href="index.html">Hoome</a></li>
            <li class="breadcrumb-item active" aria-current="page">check out</li>
          </ol>
        </div>
      </div>
    </div>
  </nav>
  <!-- breadcrumb-section end -->
  
  <!-- checkout area start -->
  <div class="check-out-section pt-80 pb-80">
    <div class="container">
      <div class="row">
        <div class="col-lg-7">
          <div class="billing-info-wrap">
            <h3 class="title">Billing Details</h3>
            <form class="personal-information" action="https://htmldemo.net/looki/looki/assets/php/contact.php">
              <div class="row">
                <div class="col-lg-6 col-md-6">
                  <div class="billing-info mb-20px">
                    <label>First Name</label>
                    <input type="text" />
                  </div>
                </div>
                <div class="col-lg-6 col-md-6">
                  <div class="billing-info mb-20px">
                    <label>Last Name</label>
                    <input type="text" />
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="billing-info mb-20px">
                    <label>Company Name</label>
                    <input type="text" />
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="billing-select mb-20px">
                    <label for="inputState" class="form-label">Country</label>
                    <select id="inputState" class="form-select mb-3">
                      <option>Select a country</option>
                      <option>Azerbaijan</option>
                      <option>Bahamas</option>
                      <option>Bahrain</option>
                      <option>Bangladesh</option>
                      <option>Barbados</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="billing-info mb-20px">
                    <label>Street Address</label>
                    <input
                      class="billing-address mb-3"
                      placeholder="House number and street name"
                      type="text"
                    />
                    <input
                      placeholder="Apartment, suite, unit etc."
                      type="text"
                    />
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="billing-info mb-20px">
                    <label>Town / City</label>
                    <input type="text" />
                  </div>
                </div>
                <div class="col-lg-6 col-md-6">
                  <div class="billing-info mb-20px">
                    <label>State / County</label>
                    <input type="text" />
                  </div>
                </div>
                <div class="col-lg-6 col-md-6">
                  <div class="billing-info mb-20px">
                    <label>Postcode / ZIP</label>
                    <input type="text" />
                  </div>
                </div>
                <div class="col-lg-6 col-md-6">
                  <div class="billing-info mb-20px">
                    <label>Phone</label>
                    <input type="text" />
                  </div>
                </div>
                <div class="col-lg-6 col-md-6">
                  <div class="billing-info mb-20px">
                    <label>Email Address</label>
                    <input type="text" />
                  </div>
                </div>
              </div>
            </form>
  
            <div class="checkout-account mb-5">
              <input id="id2" class="checkout-toggle2" type="checkbox" />
              <label for="id2">Create an account?</label>
            </div>
            <div class="checkout-account-toggle open-toggle2 mb-30">
              <input placeholder="Email address" type="email" />
              <input placeholder="Password" type="password" />
              <button class="btn btn-lg btn-primary" type="submit">
                register
              </button>
            </div>
            <div class="additional-info-wrap">
              <h4 class="title">Additional information</h4>
              <div class="additional-info">
                <label class="mb-2">Order notes</label>
                <textarea
                  placeholder="Notes about your order, e.g. special notes for delivery. "
                  name="message"
                ></textarea>
              </div>
            </div>
            <div class="checkout-account mt-25">
              <input id="ship" class="checkout-toggle" type="checkbox" />
              <label for="ship">Ship to a different address?</label>
            </div>
            <div class="different-address open-toggle mt-30">
              <div class="row">
                <div class="col-lg-6 col-md-6">
                  <div class="billing-info mb-20px">
                    <label>First Name</label>
                    <input type="text" />
                  </div>
                </div>
                <div class="col-lg-6 col-md-6">
                  <div class="billing-info mb-20px">
                    <label>Last Name</label>
                    <input type="text" />
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="billing-info mb-20px">
                    <label>Company Name</label>
                    <input type="text" />
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="billing-select mb-20px">
                    <label for="inputState1" class="form-label">Country</label>
                    <select id="inputState1" class="form-select mb-3">
                      <option>Select a country</option>
                      <option>Azerbaijan</option>
                      <option>Bahamas</option>
                      <option>Bahrain</option>
                      <option>Bangladesh</option>
                      <option>Barbados</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="billing-info mb-20px">
                    <label>Street Address</label>
                    <input
                      class="billing-address mb-3"
                      placeholder="House number and street name"
                      type="text"
                    />
                    <input
                      placeholder="Apartment, suite, unit etc."
                      type="text"
                    />
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="billing-info mb-20px">
                    <label>Town / City</label>
                    <input type="text" />
                  </div>
                </div>
                <div class="col-lg-6 col-md-6">
                  <div class="billing-info mb-20px">
                    <label>State / County</label>
                    <input type="text" />
                  </div>
                </div>
                <div class="col-lg-6 col-md-6">
                  <div class="billing-info mb-20px">
                    <label>Postcode / ZIP</label>
                    <input type="text" />
                  </div>
                </div>
                <div class="col-lg-6 col-md-6">
                  <div class="billing-info mb-20px">
                    <label>Phone</label>
                    <input type="text" />
                  </div>
                </div>
                <div class="col-lg-6 col-md-6">
                  <div class="billing-info mb-20px">
                    <label>Email Address</label>
                    <input type="text" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5 mt-4 mt-lg-0">
          <div class="your-order-area">
            <h3 class="title">Your order</h3>
            <div class="your-order-wrap gray-bg-4">
              <div class="your-order-product-info">
                <div class="your-order-top">
                  <ul>
                    <li>Product</li>
                    <li>Total</li>
                  </ul>
                </div>
                <div class="your-order-middle">
                  <ul>
                    <li>
                      <span class="order-middle-left">Product Name X 1</span>
                      <span class="order-price">$329 </span>
                    </li>
                    <li>
                      <span class="order-middle-left">Product Name X 1</span>
                      <span class="order-price">$329 </span>
                    </li>
                  </ul>
                </div>
                <div class="your-order-bottom">
                  <ul>
                    <li class="your-order-shipping">Shipping</li>
                    <li>Free shipping</li>
                  </ul>
                </div>
                <div class="your-order-total">
                  <ul>
                    <li class="order-total">Total</li>
                    <li>$329</li>
                  </ul>
                </div>
              </div>
              <div class="payment-method">
                <div class="payment-accordion element-mrg">
                  <div class="panel-group" id="accordion">
                    <div class="panel payment-accordion">
                      <div class="panel-heading" id="method-one">
                        <h4 class="panel-title">
                          <a
                            data-bs-toggle="collapse"
                            data-parent="#accordion"
                            href="#method1"
                          >
                            Direct bank transfer
                          </a>
                        </h4>
                      </div>
                      <div id="method1" class="panel-collapse collapse show">
                        <div class="panel-body">
                          <p>
                            Please send a check to Store Name, Store Street, Store
                            Town, Store State / County, Store Postcode.
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="panel payment-accordion">
                      <div class="panel-heading" id="method-two">
                        <h4 class="panel-title">
                          <a
                            class="collapsed"
                            data-bs-toggle="collapse"
                            data-parent="#accordion"
                            href="#method2"
                          >
                            Check payments
                          </a>
                        </h4>
                      </div>
                      <div id="method2" class="panel-collapse collapse">
                        <div class="panel-body">
                          <p>
                            Please send a check to Store Name, Store Street, Store
                            Town, Store State / County, Store Postcode.
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="panel payment-accordion">
                      <div class="panel-heading" id="method-three">
                        <h4 class="panel-title">
                          <a
                            class="collapsed"
                            data-bs-toggle="collapse"
                            data-parent="#accordion"
                            href="#method3"
                          >
                            Cash on delivery
                          </a>
                        </h4>
                      </div>
                      <div id="method3" class="panel-collapse collapse">
                        <div class="panel-body">
                          <p>
                            Please send a check to Store Name, Store Street, Store
                            Town, Store State / County, Store Postcode.
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="Place-order mt-25">
              <a class="btn btn--xl btn-block btn-primary" href="#"
                >Place Order</a
              >
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- checkout area end -->
@endsection