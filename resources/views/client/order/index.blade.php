@extends('client.layout')

@section('content')
    <style>
        .payment-text {
            font-size: 1rem;
            font-weight: 500;
        }

        .icon-image {
            height: 24px;
            width: auto;
        }

        .icon-size {
            font-size: 20px;
        }

        .container_radio {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }

        .payment-text {
            font-size: 16px;
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

        #apply-coupon {
            color: #5a5ac9;
            background: #fff;
            border-color: #5a5ac9;
        }

        #apply-coupon:hover {
            color: #fff;
            background: #5a5ac9;
            border-color: #5a5ac9;
        }

        .box_general.summary ul {
            border-bottom: none !important;
        }

        .input-group {
            padding: 0 !important;
        }

        .container_radio {
            font-size: 16px !important;
        }

        .box_general.summary ul li {
            font-size: 16px !important;
        }

        #tab_1 {
            font-size: 16px !important;
        }
    </style>
    <!-- breadcrumb-section start -->
    <nav class="breadcrumb-section theme1 bg-lighten2 pt-110 pb-110">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title pb-4 text-dark text-capitalize" style=" color: #fff !important">THANH TOÁN</h2>
                    </div>
                </div>
                <div class="col-12">
                    <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
                        <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
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
                    <h1 style="text-align: center;font-weight: 600;">THÔNG TIN ĐƠN HÀNG</h1>
                </div>
                <table class="table table-hover cart-list">
                    <thead class="table-light custom-thead">
                        <tr>
                            <th class="text-center" style="width: 15%; font-size:18px">Ảnh sản phẩm</th>
                            <th class="text-center" style="width: 30%; font-size:18px">Tên sản phẩm</th>
                            <th class="text-center" style="width: 15%; font-size:18px">Giá</th>
                            <th class="text-center" style="width: 20%; font-size:18px">Phân loại</th>
                            <th class="text-center" style="width: 20%; font-size:18px">Giá biến thể</th>
                            <th class="text-center" style="width: 10%; font-size:18px">Số lượng</th>
                            <th class="text-center" style="width: 15%; font-size:18px">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart->cartItems as $item)
                            <tr>
                                <td class="text-center" style="font-size:16px;">
                                    <img src="{{ asset('/storage/' . $item->san_pham->anh_san_pham) }}" alt="Ảnh sản phẩm"
                                        class="img-fluid" style="max-width: 80px; max-height: 80px;">
                                </td>
                                <td class="text-center" style="font-size:16px;">{{ $item->san_pham->ten_san_pham }}</td>
                                <td class="text-center" style="font-size:16px;">
                                    {{ number_format($item->san_pham->gia_km ?? $item->san_pham->gia_ban) }}
                                    đ</td>
                                <td class="text-center" style="font-size:16px;">
                                    @if ($item->size && $item->color)
                                        <span>Size: {{ $item->size->ten_size }}</span>
                                        <br>
                                        <span>Color: {{ $item->color->ten_color }}</span>
                                    @else
                                        <span class="text-muted">Không có thông tin kích thước hoặc màu sắc</span>
                                    @endif
                                </td>
                                <td class="text-center" style="font-size:16px;">
                                    @php
                                        // Tìm biến thể dựa trên size và color của item
                                        $variant = $item->san_pham->bien_the_san_phams->firstWhere(function (
                                            $variant,
                                        ) use ($item) {
                                            return $variant->size_san_pham_id == $item->size_san_pham_id &&
                                                $variant->color_san_pham_id == $item->color_san_pham_id;
                                        });
                                    @endphp
                                    @if ($variant)
                                        {{ number_format($variant->gia, 0, ',', '.') }} đ
                                    @else
                                        <span>Chưa có giá biến thể</span>
                                    @endif
                                </td>
                                <td class="text-center" style="font-size:16px;">{{ $item->quantity }}</td>
                                <td class="text-center" style="font-size:16px;">
                                    <span>{{ number_format($item->price, 0, ',', '.') }}₫</span>
                                </td>
                                {{--  --}}
                                <input type="hidden" name="cart_items[{{ $item->id }}][san_pham_id]"
                                    value="{{ $item->san_pham->id }}">
                                <input type="hidden" name="cart_items[{{ $item->id }}][variant_id]"
                                    value="{{ $item->variant_id }}">
                                <input type="hidden" name="cart_items[{{ $item->id }}][size_id]"
                                    value="{{ $item->size_san_pham_id }}">
                                <input type="hidden" name="cart_items[{{ $item->id }}][color_id]"
                                    value="{{ $item->color_san_pham_id }}">
                                <input type="hidden" name="cart_items[{{ $item->id }}][quantity]"
                                    value="{{ $item->quantity }}">
                                <input type="hidden" name="cart_items[{{ $item->id }}][price]"
                                    value="{{ $item->price }}">
                                <input type="hidden" name="cart_items[{{ $item->id }}][gia_tien]"
                                    value="{{ $item->san_pham->gia_km ?? $item->san_pham->gia_ban }}">


                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- /page_header -->
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="step first">
                            <h3 style="font-size:18px">1. Thông tin nhận hàng</h3>

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
                            <h3 style="font-size:18px">2. Thông tin thanh toán</h3>
                            <ul>
                                @if ($phuongThucThanhToans->isEmpty())
                                    <p>Không có phương thức thanh toán nào!</p>
                                @else
                                    @foreach ($phuongThucThanhToans as $phuongThucThanhToan)
                                        <li>
                                            <label
                                                class="container_radio d-flex align-items-center justify-content-between">
                                                <!-- Kiểu thanh toán và icon -->
                                                <div class="d-flex align-items-center">
                                                    <!-- Kiểu thanh toán -->
                                                    <span
                                                        class="payment-text me-3">{{ $phuongThucThanhToan->kieu_thanh_toan }}</span>

                                                    <!-- Icon hoặc hình ảnh -->
                                                    @if ($phuongThucThanhToan->kieu_thanh_toan == 'Thanh toán bằng Vnpay')
                                                        <div class="payment-method d-flex align-items-center">
                                                            <img src="/assets/client/img/logo/logo-vector-vi-vnpay-mien-phi.png"
                                                                alt="VNPay Logo" class="icon-image me-2">
                                                        </div>
                                                    @elseif ($phuongThucThanhToan->kieu_thanh_toan == 'Thanh toán bằng Ví')
                                                        <div class="payment-method d-flex align-items-center">
                                                            <i class="fas fa-wallet text-success icon-size me-2"></i>
                                                            <div>
                                                                <p class="mb-0 wallet-balance">Số dư:
                                                                    {{ number_format($tongTienVi->tong_tien, 0, ',', '.') }}
                                                                    VNĐ</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>

                                                <!-- Input Radio -->
                                                <input type="radio" id="payment-{{ $phuongThucThanhToan->id }}"
                                                    name="phuong_thuc_thanh_toan" class="form-check-input"
                                                    value="{{ $phuongThucThanhToan->id }}"
                                                    {{ old('phuong_thuc_thanh_toan') == $phuongThucThanhToan->id ? 'checked' : '' }}
                                                    onchange="toggleOrderButton('{{ $phuongThucThanhToan->kieu_thanh_toan }}')">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                        <!-- /step -->

                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="step last">
                            <h3 style="font-size:18px">3. Thanh toán</h3>
                            <div class="box_general summary">
                                <ul>
                                    <li class="clearfix"><em><strong>Tiền sản phẩm</strong></em>
                                        <span>{{ number_format($total, 0, ',', '.') }}₫</span>
                                    </li>
                                    <input type="hidden" name="total" id="hidden_total" value="{{ $total }}">
                                </ul>

                                <ul>
                                    <li>
                                        <div class="row">
                                            <div class="input-group">
                                                <input type="text" id="coupon-code" name="khuyen_mai"
                                                    class="form-control" placeholder="Nhập mã giảm giá">
                                                <button class="btn btn-outline-success" id="apply-coupon"
                                                    type="button">Áp
                                                    dụng</button>
                                            </div>
                                        </div>
                                    </li>
                                    {{-- <li class="clearfix"><em><strong>Số tiền được giảm</strong></em> <span> 0</span> --}}
                                </ul>
                                <ul style="border-bottom: 1px solid #ededed !important;">
                                    <li class="clearfix"><em><strong>Tiền vận chuyển</strong></em> <span> 30.000 đ</span>
                                    </li>
                                    <li class="clearfix"><em><strong>Tiền giảm giá khuyến mại</strong></em> <span
                                            id="discount-amount">0₫</span></li>
                                </ul>

                                <div class="total clearfix">Tổng cộng <span id="total_amount"
                                        data-total="{{ $totall }}">{{ number_format($totall) }}₫</span>
                                    <input type="hidden" name="totall" id="hidden_totall"
                                        value="{{ $totall }}">

                                </div>

                                <!-- Nút Đặt hàng cho phương thức "Thanh toán khi nhận hàng" -->
                                <div class="place-order mt-10" id="place-order-cod" style="display: none;">
                                    <button type="submit" class="btn_1 full-width btn-block btn-primary">Đặt
                                        Hàng</button>
                                </div>

                                <!-- Nút Thanh toán ngay cho phương thức "Thanh toán bằng Vnpay" -->
                                <div class="place-order mt-10" id="place-order-online" style="display: none;">
                                    <button type="submit" class="btn_1 full-width btn-block btn-danger"
                                        name="redirect">Thanh toán ngay</button>
                                </div>

                                <!-- Nút Thanh toán ngay cho phương thức "Thanh toán bằng Ví" -->
                                <div class="place-order mt-10" id="place-order-wallet" style="display: none;">
                                    <button type="submit" class="btn_1 full-width btn-block btn-success"
                                        name="wallet-redirect">Thanh toán ngay với Ví</button>
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
            .payment-method {
                display: flex;
                align-items: center;
                margin-bottom: 10px;
            }

            .icon-image {
                width: 60px;
                height: auto;
            }

            .payment-label {
                font-weight: bold;
                font-size: 16px;
            }

            .wallet-balance {
                font-size: 14px;
                color: #6c757d;
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
                const walletButton = document.getElementById('place-order-wallet'); // Thêm phần tử nút ví

                // Kiểm tra loại thanh toán để hiển thị nút tương ứng
                if (paymentType === 'Thanh toán khi nhận hàng') {
                    codButton.style.display = 'block';
                    onlineButton.style.display = 'none';
                    walletButton.style.display = 'none'; // Ẩn nút ví
                } else if (paymentType === 'Thanh toán bằng Vnpay') {
                    codButton.style.display = 'none';
                    onlineButton.style.display = 'block';
                    walletButton.style.display = 'none'; // Ẩn nút ví
                } else if (paymentType === 'Thanh toán bằng Ví') {
                    codButton.style.display = 'none';
                    onlineButton.style.display = 'none';
                    walletButton.style.display = 'block'; // Hiển thị nút ví
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
