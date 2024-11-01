<!-- first modal -->
<div class="modal fade theme1 style1" id="quickview{{ $quickview->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8 mx-auto col-lg-5 mb-5 mb-lg-0">
                        <div class="product-sync-init mb-20">
                            <div class="single-product">
                                <div class="product-thumb">
                                    <img src="assets/img/slider/thumb/1.jpg" alt="product-thumb" />
                                </div>
                            </div>
                            <!-- single-product end -->
                            <div class="single-product">
                                <div class="product-thumb">
                                    <img src="assets/img/slider/thumb/2.jpg" alt="product-thumb" />
                                </div>
                            </div>
                            <!-- single-product end -->
                            <div class="single-product">
                                <div class="product-thumb">
                                    <img src="assets/img/slider/thumb/3.jpg" alt="product-thumb" />
                                </div>
                            </div>
                            <!-- single-product end -->
                            <div class="single-product">
                                <div class="product-thumb">
                                    <img src="assets/img/slider/thumb/4.jpg" alt="product-thumb" />
                                </div>
                            </div>
                            <!-- single-product end -->
                        </div>

                        <div class="product-sync-nav">
                            <div class="single-product">
                                <div class="product-thumb">
                                    <a href="javascript:void(0)">
                                        <img src="assets/img/slider/thumb/1.1.jpg" alt="product-thumb" /></a>
                                </div>
                            </div>
                            <!-- single-product end -->
                            <div class="single-product">
                                <div class="product-thumb">
                                    <a href="javascript:void(0)">
                                        <img src="assets/img/slider/thumb/2.1.jpg" alt="product-thumb" /></a>
                                </div>
                            </div>
                            <!-- single-product end -->
                            <div class="single-product">
                                <div class="product-thumb">
                                    <a href="javascript:void(0)"><img src="assets/img/slider/thumb/3.1.jpg"
                                            alt="product-thumb" /></a>
                                </div>
                            </div>
                            <!-- single-product end -->
                            <div class="single-product">
                                <div class="product-thumb">
                                    <a href="javascript:void(0)"><img src="assets/img/slider/thumb/4.1.jpg"
                                            alt="product-thumb" /></a>
                                </div>
                            </div>
                            <!-- single-product end -->
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="modal-product-info">
                            <div class="product-head">
                                <h2 class="title">
                                    {{ $quickview->ten_san_pham }}
                                </h2>
                                <h4 class="sub-title">Reference: demo_5
                                </h4>
                                <div class="star-content mb-20">
                                    <span class="star-on"><i class="fas fa-star"></i>
                                    </span>
                                    <span class="star-on"><i class="fas fa-star"></i>
                                    </span>
                                    <span class="star-on"><i class="fas fa-star"></i>
                                    </span>
                                    <span class="star-on"><i class="fas fa-star"></i>
                                    </span>
                                    <span class="star-on de-selected"><i class="fas fa-star"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="product-body">
                                <span class="product-price text-center">
                                    <span class="new-price">$29.00</span>
                                </span>
                                <p>
                                    Break old records and make new goals
                                    in the New Balance®
                                    Arishi Sport v1.
                                </p>
                                <ul>
                                    <li>Predecessor: None.</li>
                                    <li>Support Type: Neutral.</li>
                                    <li>Cushioning: High energizing
                                        cushioning.</li>
                                </ul>
                            </div>
                            <div class="d-flex mt-30">
                                <div class="product-size">
                                    <h3 class="title">Dimension</h3>
                                    <select>
                                        <option value="0">40x60cm
                                        </option>
                                        <option value="1">60x90cm
                                        </option>
                                        <option value="2">80x120cm
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="product-footer">
                                <div class="product-count style d-flex flex-column flex-sm-row my-4">
                                    <div class="count d-flex">
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
                                    <div>
                                        <button class="btn btn-dark btn--xl mt-5 mt-sm-0">
                                            <span class="me-2"><i class="ion-android-add"></i></span>
                                            Add to cart
                                        </button>
                                    </div>
                                </div>
                                <div class="addto-whish-list">
                                    <a href="#"><i class="icon-heart"></i> Add
                                        to wishlist</a>
                                    <a href="#"><i class="icon-shuffle"></i>
                                        Add to compare</a>
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
