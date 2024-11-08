@extends('client.layout')

@section('content')
    <!-- phần breadcrumb bắt đầu -->
    <nav class="breadcrumb-section theme1 bg-lighten2 pt-110 pb-110">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title pb-4 text-dark text-capitalize">Thanh Toán</h2>
                    </div>
                </div>
                <div class="col-12">
                    <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
                        <li class="breadcrumb-item"><a href="#">Trang Chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Thanh Toán</li>
                    </ol>
                </div>
            </div>
        </div>
    </nav>
    <!-- phần breadcrumb kết thúc -->

    <!-- khu vực thanh toán bắt đầu -->
    <div class="check-out-section pt-80 pb-80">
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-7">
                    <div class="billing-info-wrap">
                        <h3 class="title">Thông Tin Thanh Toán</h3>
                        <form action="{{ route('order.add') }}" class="personal-information" method="POST">
                            @csrf
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center">Ảnh sản phẩm</th>
                                            <th class="text-center">Tên sản phẩm</th>
                                            <th class="text-center">Biến thể</th>
                                            <th class="text-center">Số lượng</th>
                                            <th class="text-center">Giá</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cart->cartItems as $item)
                                            <tr>
                                                <td class="text-center"><img scope="row"
                                                        src="{{ asset('/storage/' . $item->san_pham->anh_san_pham) }}"
                                                        alt=" anh_san_pham" style="width: 50" height="50"></td>
                                                <td class="text-center">{{ $item->san_pham->ten_san_pham }}</td>
                                                <td class="text-center">
                                                    @if ($item->size && $item->color)
                                                        <span>{{ $item->size->ten_size }}
                                                        </span>
                                                        <span class="ms-3">
                                                            {{ $item->color->ten_color }}</span>
                                                    @else
                                                        <span>Không có thông tin kích thước hoặc màu sắc</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">{{ $item->quantity }}</td>
                                                <td class="text-center">${{ $item->price }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Thông tin khách hàng -->
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="billing-info mb-20px">
                                        <label>Tên</label>
                                        <input type="text" name="ho_ten" class="form-control" required
                                            value="{{ old('ho_ten', Auth::user()->ho_ten ?? '') }}" />
                                        @error('ho_ten')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="billing-info mb-20px">
                                        <label>Số điện thoại</label>
                                        <input type="text" name="so_dien_thoai" class="form-control" required
                                            value="{{ old('so_dien_thoai', Auth::user()->so_dien_thoai ?? '') }}" />
                                        @error('so_dien_thoai')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="billing-info mb-20px">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" required
                                            value="{{ old('email', Auth::user()->email ?? '') }}" />
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="billing-info mb-20px">
                                        <label>Địa chỉ</label>
                                        <input type="text" name="dia_chi" class="form-control" required
                                            value="{{ old('dia_chi', Auth::user()->dia_chi ?? '') }}" />
                                        @error('dia_chi')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="p-4" style="background-color: #f8f9fa;">
                                <!-- Mã giảm giá -->
                                <label for="coupon-code" class="">Nhập mã giảm giá</label>
                                <div class="col-lg-6 col-md-6 d-flex">
                                    <input type="text" id="coupon-code" name="khuyen_mai" class="form-control"
                                        placeholder="Nhập mã giảm giá">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-success ms-3" id="apply-coupon" type="button">Áp
                                            dụng</button>
                                    </div>
                                </div>

                                <!-- Phương thức thanh toán -->
                                <div class="d-flex mt-25">
                                    <div class="">
                                        <h6 class="font-weight-bold">Phương thức thanh toán</h6>
                                        @foreach ($phuongThucThanhToans as $phuongThucThanhToan)
                                            <div class="form-check">
                                                <input type="radio" id="payment-{{ $phuongThucThanhToan->id }}"
                                                    name="phuong_thuc_thanh_toan" class="form-check-input"
                                                    value="{{ $phuongThucThanhToan->id }}"
                                                    {{ old('phuong_thuc_thanh_toan') == $phuongThucThanhToan->id ? 'checked' : '' }}
                                                    onchange="toggleOrderButton('{{ $phuongThucThanhToan->kieu_thanh_toan }}')">
                                                <label for="payment-{{ $phuongThucThanhToan->id }}"
                                                    class="form-check-label">
                                                    {{ $phuongThucThanhToan->kieu_thanh_toan }}
                                                </label>
                                                {{-- Hiển thị logo VNPay nếu kieu_thanh_toan là "thanh toán online" --}}
                                                @if ($phuongThucThanhToan->kieu_thanh_toan == 'Thanh toán online')
                                                    <div class="vnpay-logo ms-2">
                                                        <img src="/assets/client/img/logo/logo-vector-vi-vnpay-mien-phi.png"
                                                            alt="VNPay Logo">
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="ms-5">

                                    </div>
                                </div>
                            </div>
                            {{-- <div class="place-order mt-25">
                                <button type="submit" class="btn btn--xl btn-block btn-primary">Đặt Hàng</button>
                            </div> --}}
                            <div class="place-order mt-25" id="place-order-cod" style="display: none;">
                                <button type="submit" class="btn btn--xl btn-block btn-primary">Đặt Hàng</button>
                            </div>
                            <div class="place-order mt-25" id="place-order-online" style="display: none;">
                                <button type="submit" class="btn btn--xl btn-block btn-danger" name="redirect">Thanh
                                    toán ngay</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Tóm tắt đơn hàng -->
                <div class="col-lg-5 mt-4 mt-lg-0">
                    <div class="your-order-area">
                        <h3 class="title">Đơn hàng của bạn</h3>
                        <div class="your-order-wrap gray-bg-4">
                            <div class="your-order-product-info">
                                <ul class="d-flex justify-content-between">
                                    <li class="your-order-shipping">Tiền sản phẩm</li>
                                    <li>{{ $total }}</li>
                                </ul>

                                <hr>
                                <ul class="d-flex justify-content-between">
                                    <li class="your-order-shipping">Tiền vận chuyển</li>
                                    <li>
                                        30.000
                                    </li>
                                </ul>
                                <ul class="d-flex justify-content-between">
                                    <li class="your-order-shipping">Tiền giảm giá khuyến mại</li>
                                    <li>
                                        <span id="discount-amount">0₫</span>
                                    </li>
                                </ul>
                                <div class="your-order-total">
                                    <ul class="d-flex justify-content-between">
                                        <li class="order-total font-weight-bold">Tổng cộng</li>
                                        <li class="font-weight-bold"><span id="total_amount"
                                                data-total="{{ $totall }}">{{ number_format($totall, 2) }}₫</span>
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
    <!-- khu vực thanh toán kết thúc -->
@endsection
