@extends('client.layout')

@section('content')
    <!-- breadcrumb-section start -->
    <nav class="breadcrumb-section theme1 bg-lighten2 pt-80 pb-80">
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
            <form action="{{ route('order.add') }}" class="personal-information" method="POST">
                @csrf
                <div class="page_header">
                    <h1>Thông tin đơn hàng</h1>
                </div>
                <table class="table table-hover cart-list mb-45">
                    <thead class="table-light custom-thead">
                        <tr>
                            <th class="text-center" style="width: 15%;">Ảnh sản phẩm</th>
                            <th class="text-center" style="width: 30%;">Tên sản phẩm</th>
                            <th class="text-center" style="width: 20%;">Phân loại</th>
                            <th class="text-center" style="width: 10%;">Số lượng</th>
                            <th class="text-center" style="width: 15%;">Giá</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart->cartItems as $item)
                            <tr>
                                <td class="text-center">
                                    <img src="{{ asset('/storage/' . $item->san_pham->anh_san_pham) }}" alt="Ảnh sản phẩm"
                                        class="img-fluid" style="max-width: 80px; max-height: 80px;">
                                </td>
                                <td class="text-center">{{ $item->san_pham->ten_san_pham }}</td>
                                <td class="text-center">
                                    @if ($item->size && $item->color)
                                        <span>Size: {{ $item->size->ten_size }}</span>
                                        <br>
                                        <span>Color: {{ $item->color->ten_color }}</span>
                                    @else
                                        <span class="text-muted">Không có thông tin kích thước hoặc màu sắc</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-center"><strong>{{ number_format($item->price, 2) }}đ</strong></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- /page_header -->
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="step first">
                            <h3>1. Thông tin nhận hàng</h3>

                            <div class="tab-content checkout">
                                <div class="tab-pane fade show active" id="tab_1" role="tabpanel"
                                    aria-labelledby="tab_1">
                                    <label>Tên</label>
                                    <input type="text" name="ho_ten" class="form-control" required
                                        value="{{ old('ho_ten', Auth::user()->ho_ten ?? '') }}" />
                                    @error('ho_ten')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <label>Số điện thoại</label>
                                    <input type="text" name="so_dien_thoai" class="form-control" required
                                        value="{{ old('so_dien_thoai', Auth::user()->so_dien_thoai ?? '') }}" />
                                    @error('so_dien_thoai')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" required
                                        value="{{ old('email', Auth::user()->email ?? '') }}" />
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <label>Địa chỉ</label>
                                    <input type="text" name="dia_chi" class="form-control" required
                                        value="{{ old('dia_chi', Auth::user()->dia_chi ?? '') }}" />
                                    @error('dia_chi')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- /step -->
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="step middle payments">
                            <h3>2. Thông tin thanh toán</h3>
                            <ul>
                                @foreach ($phuongThucThanhToans as $phuongThucThanhToan)
                                    <li>
                                        <label class="container_radio">
                                            {{ $phuongThucThanhToan->kieu_thanh_toan }}
                                            <a href="#0" class="info" data-bs-toggle="modal"
                                                data-bs-target="#payments_method"></a>
                                            <input type="radio" id="payment-{{ $phuongThucThanhToan->id }}"
                                                name="phuong_thuc_thanh_toan" class="form-check-input"
                                                value="{{ $phuongThucThanhToan->id }}"
                                                {{ old('phuong_thuc_thanh_toan') == $phuongThucThanhToan->id ? 'checked' : '' }}
                                                onchange="toggleOrderButton('{{ $phuongThucThanhToan->kieu_thanh_toan }}')">
                                            <span class="checkmark"></span>
                                        </label>
                                        {{-- Hiển thị logo VNPay nếu kieu_thanh_toan là "Thanh toán online" --}}
                                        @if ($phuongThucThanhToan->kieu_thanh_toan == 'Thanh toán online')
                                            <div class="vnpay-logo ms-2">
                                                <img src="/assets/client/img/logo/logo-vector-vi-vnpay-mien-phi.png"
                                                    alt="VNPay Logo" height="auto">
                                            </div>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                            <div class="">
                                <div class="row">

                                </div>
                            </div>

                        </div>
                        <!-- /step -->

                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="step last">
                            <h3>3. Thanh toán</h3>
                            <div class="box_general summary">
                                <div class="input-group mb-15">
                                    <input type="text" id="coupon-code" name="khuyen_mai" class="form-control"
                                        placeholder="Nhập mã giảm giá">
                                    <button class="btn btn-outline-success" id="apply-coupon" type="button">Áp
                                        dụng</button>
                                </div>
                                <ul>
                                    <li class="clearfix"><em><strong>Tiền sản phẩm</strong></em>
                                        <span>{{ $total }}</span>
                                    </li>
                                </ul>
                                <ul>
                                    <li class="clearfix"><em><strong>Tiền vận chuyển</strong></em> <span> 30.000</span>
                                    </li>
                                    <li class="clearfix"><em><strong>Tiền giảm giá khuyến mại</strong></em> <span
                                            id="discount-amount">0₫</span></li>
                                </ul>

                                <div class="total clearfix">Tổng cộng <span id="total_amount"
                                        data-total="{{ $totall }}">{{ number_format($totall, 2) }}₫</span>
                                </div>

                                <div class="place-order mt-10" id="place-order-cod" style="display: none;">
                                    <button type="submit" class="btn_1 full-width btn-block btn-primary">Đặt
                                        Hàng</button>
                                </div>
                                <div class="place-order mt-10" id="place-order-online" style="display: none;">
                                    <button type="submit" class="btn_1 full-width btn-block btn-danger"
                                        name="redirect">Thanh
                                        toán ngay</button>
                                </div>
                            </div>
                            <!-- /box_general -->
                        </div>
                        <!-- /step -->
                    </div>
                </div>
                <!-- /row -->
            </form>
        </div>
        <style>
            .vnpay-logo {
                width: 200px;
                display: block;
            }

            .vnpay-logo img {
                width: 190px;

            }

            .custom-thead {
                background-color: #333 !important;
                /* Màu nền */
            }

            /* Thay đổi màu chữ của các thẻ <th> */
            .custom-thead th {
                color: white !important;
                /* Màu chữ */
            }

            /* Nếu bạn muốn thay đổi cả màu nền cho các ô thẻ <th> */
            .custom-thead th {
                background-color: #5a5ac9 !important;
                /* Nền của các thẻ <th> */
                color: #fff !important;
                /* Màu chữ của các thẻ <th> */
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
                                toastr.success('Mã giảm giá đã được áp dụng thành công!');
                            } else {
                                toastr.error(response
                                    .message); // Hiển thị thông báo nếu mã khuyến mãi không hợp lệ
                            }
                        },
                        error: function() {
                            toastr.error('Đã xảy ra lỗi. Vui lòng thử lại sau.');
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
    </section>
@endsection
