@extends('client.layout')


@section('content')
    <!-- breadcrumb-section start -->
    <nav class="breadcrumb-section theme1 bg-lighten2 pt-110 pb-110">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title pb-4 text-dark text-capitalize">check out</h2>
                    </div>
                </div>
                <div class="col-12">
                    <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
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
                                        <label> Name</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="billing-info mb-20px">
                                        <label>Phone</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-6">
                                    <div class="billing-info mb-20px">
                                        <label>Email Address</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-6">
                                    <div class="billing-info mb-20px">
                                        <label>Địa chỉ</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <h3 class="title">Ma giam gia</h3>
                                <div class="col-lg-12">
                                    <div class="billing-select mb-20px">
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
                            </div>
                        </form>
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
                                                    <a data-bs-toggle="collapse" data-parent="#accordion" href="#method1">
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
                                                    <a class="collapsed" data-bs-toggle="collapse" data-parent="#accordion"
                                                        href="#method2">
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
                                                    <a class="collapsed" data-bs-toggle="collapse" data-parent="#accordion"
                                                        href="#method3">
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
                            <a class="btn btn--xl btn-block btn-primary" href="#">Place Order</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- checkout area end -->
@endsection
