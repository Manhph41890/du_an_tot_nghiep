@extends('client.layout')

@section('content')
    <div class="container">
        <div class="page_header">
            <h1>Sign In or Create an Account</h1>
        </div>
        <!-- /page_header -->
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="step first">
                    <h3>1. User Info and Billing address</h3>

                    <div class="tab-content checkout">
                        <div class="tab-pane fade show active" id="tab_1" role="tabpanel" aria-labelledby="tab_1">
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password">
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
                <!-- /step -->
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="step middle payments">
                    <h3>2. Payment and Shipping</h3>
                    <ul>
                        <li>
                            <label class="container_radio">Credit Card<a href="#0" class="info"
                                    data-bs-toggle="modal" data-bs-target="#payments_method"></a>
                                <input type="radio" name="payment" checked>
                                <span class="checkmark"></span>
                            </label>
                        </li>
                        <li>
                            <label class="container_radio">Paypal<a href="#0" class="info" data-bs-toggle="modal"
                                    data-bs-target="#payments_method"></a>
                                <input type="radio" name="payment">
                                <span class="checkmark"></span>
                            </label>
                        </li>
                        <li>
                            <label class="container_radio">Cash on delivery<a href="#0" class="info"
                                    data-bs-toggle="modal" data-bs-target="#payments_method"></a>
                                <input type="radio" name="payment">
                                <span class="checkmark"></span>
                            </label>
                        </li>
                        <li>
                            <label class="container_radio">Bank Transfer<a href="#0" class="info"
                                    data-bs-toggle="modal" data-bs-target="#payments_method"></a>
                                <input type="radio" name="payment">
                                <span class="checkmark"></span>
                            </label>
                        </li>
                    </ul>
                    <div class="payment_info d-none d-sm-block">
                        <figure><img src="img/cards_all.svg" alt=""></figure>
                        <p>Sensibus reformidans interpretaris sit ne, nec errem nostrum et, te nec meliore
                            philosophia.
                            At vix quidam periculis. Solet tritani ad pri, no iisque definitiones sea.</p>
                    </div>

                    <h6 class="pb-2">Shipping Method</h6>


                    <ul>
                        <li>
                            <label class="container_radio">Standard shipping<a href="#0" class="info"
                                    data-bs-toggle="modal" data-bs-target="#payments_method"></a>
                                <input type="radio" name="shipping" checked>
                                <span class="checkmark"></span>
                            </label>
                        </li>
                        <li>
                            <label class="container_radio">Express shipping<a href="#0" class="info"
                                    data-bs-toggle="modal" data-bs-target="#payments_method"></a>
                                <input type="radio" name="shipping">
                                <span class="checkmark"></span>
                            </label>
                        </li>

                    </ul>

                </div>
                <!-- /step -->

            </div>
            <div class="col-lg-4 col-md-6">
                <div class="step last">
                    <h3>3. Order Summary</h3>
                    <div class="box_general summary">
                        <ul>
                            <li class="clearfix"><em>1x Armor Air X Fear</em> <span>$145.00</span></li>
                            <li class="clearfix"><em>2x Armor Air Zoom Alpha</em> <span>$115.00</span></li>
                        </ul>
                        <ul>
                            <li class="clearfix"><em><strong>Subtotal</strong></em> <span>$450.00</span></li>
                            <li class="clearfix"><em><strong>Shipping</strong></em> <span>$0</span></li>

                        </ul>
                        <div class="total clearfix">TOTAL <span>$450.00</span></div>
                        <div class="form-group">
                            <label class="container_check">Register to the Newsletter.
                                <input type="checkbox" checked>
                                <span class="checkmark"></span>
                            </label>
                        </div>

                        <a href="confirm.html" class="btn_1 full-width">Confirm and Pay</a>
                    </div>
                    <!-- /box_general -->
                </div>
                <!-- /step -->
            </div>
        </div>
        <!-- /row -->
    </div>
    <style>
        .vnpay-logo {
            width: 80px;
            display: block;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('#apply-coupon').on('click', function() {
                var couponCode = $('#coupon-code').val(); // Lấy mã khuyến mãi
                var totalAmount = parseFloat($('#total_amount').data(
                    'total')); // Lấy tổng tiền trước khi áp dụng mã khuyến mãi

                $.ajax({
                    url: "{{ route('apply.coupon') }}", // Route xử lý mã giảm giá
                    type: "POST",
                    data: {
                        coupon_code: couponCode,
                        totall: totalAmount,
                        _token: "{{ csrf_token() }}" // CSRF token cho bảo mật
                    },
                    success: function(response) {
                        if (response.success) {
                            // Cập nhật giá trị tổng tiền sau khi áp dụng mã khuyến mãi
                            $('#total_amount').text(response.newTotal + '₫');
                            $('#discount-amount').text(response.discountAmount + '₫');

                        } else {
                            alert(response
                                .message); // Hiển thị thông báo nếu mã khuyến mãi không hợp lệ
                        }
                    },
                    error: function() {
                        alert('Đã xảy ra lỗi. Vui lòng thử lại sau.');
                    }
                });
            });
        });

        function toggleOrderButton(paymentType) {
            const codButton = document.getElementById('place-order-cod');
            const onlineButton = document.getElementById('place-order-online');

            // Kiểm tra loại thanh toán để hiển thị nút tương ứng
            if (paymentType === 'Thanh toán khi nhận hàng') {
                codButton.style.display = 'block';
                onlineButton.style.display = 'none';
            } else if (paymentType === 'Thanh toán online') {
                codButton.style.display = 'none';
                onlineButton.style.display = 'block';
            }
        }

        // Hiển thị nút mặc định nếu đã có lựa chọn trước đó
        document.addEventListener("DOMContentLoaded", function() {
            const selectedPaymentType = document.querySelector('input[name="phuong_thuc_thanh_toan"]:checked');
            if (selectedPaymentType) {
                toggleOrderButton(selectedPaymentType.value);
            }
        });
    </script>
    <link href="{{ asset('assets/client/css/css/checkout.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('assets/client/css/css/style.css') }}?v={{ time() }}" rel="stylesheet">
    <!-- khu vực thanh toán kết thúc -->
@endsection
