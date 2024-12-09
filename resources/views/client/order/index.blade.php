@extends('client.layout')

@section('content')
    <!-- product tab start -->
    <section class="whish-list-section theme1  pb-80">
        <div class="container py-5">
            <form action="{{ route('order.add') }}" class="personal-information" method="POST">
                @csrf
                <div class="page_header mb-4">
                    <h1 class="text-center fw-bold text-success">THÔNG TIN ĐƠN HÀNG</h1>
                </div>

                <!-- Cart Table -->
                <div class="card shadow-sm mb-4">
                    <div class="table-responsive">
                        <table class="table table-hover cart-list mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-center py-3" style="width: 15%">Ảnh sản phẩm</th>
                                    <th class="text-center py-3" style="width: 30%">Tên sản phẩm</th>
                                    <th class="text-center py-3" style="width: 15%">Giá</th>
                                    <th class="text-center py-3" style="width: 20%">Phân loại</th>
                                    <th class="text-center py-3" style="width: 20%">Giá phân loại</th>
                                    <th class="text-center py-3" style="width: 10%">Số lượng</th>
                                    <th class="text-center py-3" style="width: 15%">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart->cartItems as $item)
                                    <tr>
                                        <td class="text-center align-middle">
                                            <img src="{{ asset('/storage/' . $item->san_pham->anh_san_pham) }}"
                                                alt="Ảnh sản phẩm" class="img-thumbnail" style="max-width: 80px;">
                                        </td>
                                        <td class="text-center align-middle">{{ $item->san_pham->ten_san_pham }}</td>
                                        <td class="text-center align-middle">
                                            {{ number_format($item->san_pham->gia_km ?? $item->san_pham->gia_ban) }} đ
                                        </td>
                                        <td class="text-center align-middle">
                                            @if ($item->size && $item->color)
                                                <span class="d-block">Size: {{ $item->size->ten_size }}</span>
                                                <span class="d-block mt-1">Màu: {{ $item->color->ten_color }}</span>
                                            @else
                                                <span class="text-muted">Không có thông tin kích thước hoặc màu sắc</span>
                                            @endif
                                        </td>
                                        <td class="text-center align-middle">
                                            @php
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
                                                <span class="text-muted">Chưa có giá biến thể</span>
                                            @endif
                                        </td>
                                        <td class="text-center align-middle">{{ $item->quantity }}</td>
                                        <td class="text-center align-middle fw-bold">
                                            {{ number_format($item->price, 0, ',', '.') }}₫
                                        </td>

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
                    </div>
                </div>

                <!-- Order Information -->
                <div class="row g-4">
                    <!-- Customer Information -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card shadow-sm h-100">
                            <div class="card-header bg-success">
                                <h3 class="h5 mb-0" style="color: #fff">1. Thông tin nhận hàng</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Họ và tên</label>
                                    <input type="text" name="ho_ten" class="form-control" required
                                        value="{{ old('ho_ten', Auth::user()->ho_ten ?? '') }}">
                                    @error('ho_ten')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Số điện thoại</label>
                                    <input type="text" name="so_dien_thoai" class="form-control" required
                                        value="{{ old('so_dien_thoai', Auth::user()->so_dien_thoai ?? '') }}">
                                    @error('so_dien_thoai')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" required
                                        value="{{ old('email', Auth::user()->email ?? '') }}">
                                    @error('email')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Địa chỉ</label>
                                    <input type="text" id="dia_chi" name="dia_chi" class="form-control" required
                                        value="{{ old('dia_chi', Auth::user()->dia_chi ?? '') }}">
                                    @error('dia_chi')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                    <div id="suggestions"></div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Payment Methods -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card shadow-sm h-100">
                            <div class="card-header bg-success">
                                <h3 class="h5 mb-0" style="color: #fff">2. Phương thức thanh toán</h3>
                            </div>
                            <div class="card-body">
                                @if ($phuongThucThanhToans->isEmpty())
                                    <p class="text-muted">Không có phương thức thanh toán nào!</p>
                                @else
                                    <div class="payment-methods">
                                        @foreach ($phuongThucThanhToans as $phuongThucThanhToan)
                                            <div class="payment-method mb-3">
                                                <label class="d-flex align-items-center p-3 border rounded cursor-pointer">
                                                    <input type="radio" name="phuong_thuc_thanh_toan"
                                                        class="form-check-input me-3"
                                                        value="{{ $phuongThucThanhToan->id }}"
                                                        {{ old('phuong_thuc_thanh_toan') == $phuongThucThanhToan->id ? 'checked' : '' }}
                                                        onchange="toggleOrderButton('{{ $phuongThucThanhToan->kieu_thanh_toan }}')">

                                                    <div class="flex-grow-1">
                                                        <div class="d-flex align-items-center">
                                                            @if ($phuongThucThanhToan->kieu_thanh_toan == 'Thanh toán bằng Vnpay')
                                                                <img src="/assets/client/img/logo/logo-vector-vi-vnpay-mien-phi.png"
                                                                    alt="VNPay Logo" class="me-2"
                                                                    style="height: 30px;">
                                                            @elseif ($phuongThucThanhToan->kieu_thanh_toan == 'Thanh toán bằng Ví')
                                                                <i class="fas fa-wallet text-success me-2 fs-4"></i>
                                                            @endif
                                                            <span>{{ $phuongThucThanhToan->kieu_thanh_toan }}</span>
                                                        </div>

                                                        @if ($phuongThucThanhToan->kieu_thanh_toan == 'Thanh toán bằng Ví')
                                                            <div class="text-success mt-2">
                                                                Số dư:
                                                                {{ number_format($tongTienVi->tong_tien, 0, ',', '.') }}
                                                                VNĐ
                                                            </div>
                                                        @endif
                                                    </div>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card shadow-sm h-100">
                            <div class="card-header bg-success">
                                <h3 class="h5 mb-0" style="color: #fff">3. Tổng quan đơn hàng</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Tiền sản phẩm</span>
                                        <span class="fw-bold">{{ number_format($total, 0, ',', '.') }}₫</span>
                                    </div>
                                    <input type="hidden" name="total" id="hidden_total" value="{{ $total }}">

                                    <!-- Coupon Input -->
                                    <div class="input-group mb-3">
                                        <input type="text" id="coupon-code" name="khuyen_mai" class="form-control"
                                            placeholder="Mã giảm giá">
                                        <button class="btn btn-outline-primary" id="apply-coupon" type="button">Áp
                                            dụng</button>
                                    </div>

                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Phí vận chuyển</span>
                                        <span>30.000₫</span>
                                    </div>

                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Giảm giá</span>
                                        <span id="discount-amount">0₫</span>
                                    </div>

                                    <hr>

                                    <div class="d-flex justify-content-between mb-4">
                                        <span class="fw-bold">Tổng cộng</span>
                                        <span class="fw-bold fs-5 text-primary" id="total_amount">
                                            {{ number_format($totall) }}₫
                                        </span>
                                    </div>
                                    <input type="hidden" name="totall" id="hidden_totall"
                                        value="{{ $totall }}">

                                    <!-- Payment Buttons -->
                                    <div id="place-order-cod" style="display: none;">
                                        <button type="submit" class="btn btn-primary w-100">
                                            Đặt hàng
                                        </button>
                                    </div>

                                    <div id="place-order-online" style="display: none;">
                                        <button type="submit" name="redirect" class="btn btn-danger w-100">
                                            Thanh toán VNPAY
                                        </button>
                                    </div>

                                    <div id="place-order-wallet" style="display: none;">
                                        <button type="submit" name="wallet-redirect" class="btn btn-success w-100">
                                            Thanh toán bằng Ví
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <style>
            .card {
                border: none;
                transition: transform 0.2s ease-in-out;
            }

            .card:hover {
                transform: translateY(-5px);
            }

            .payment-method label {
                transition: all 0.2s ease-in-out;
            }

            .payment-method label:hover {
                background-color: #f8f9fa;
            }

            .payment-method input[type="radio"]:checked+div {
                font-weight: bold;
            }

            .table th {
                font-weight: 600;
                text-transform: uppercase;
                font-size: 0.875rem;
            }

            .table td {
                font-size: 0.875rem;
            }

            .img-thumbnail {
                padding: 0.5rem;
                background-color: #fff;
                border: 1px solid #dee2e6;
                border-radius: 0.25rem;
                max-width: 100%;
                height: auto;
            }

            .form-control:focus {
                border-color: #80bdff;
                box-shadow: 0 0 0 0.2rem 198754(0, 123, 255, .25);
            }

            .btn {
                padding: 0.75rem 1.5rem;
                font-weight: 500;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                transition: all 0.3s ease;
            }

            .btn-primary {
                background-color: #0d6efd;
                border: none;
            }

            .btn-primary:hover {
                background-color: #0b5ed7;
                transform: translateY(-1px);
            }

            .btn-danger {
                background-color: #dc3545;
                border: none;
            }

            .btn-danger:hover {
                background-color: #bb2d3b;
                transform: translateY(-1px);
            }

            .btn-success {
                background-color: #22c55e;
                border: none;
            }

            .btn-success:hover {
                background-color: #129642;
                transform: translateY(-1px);
            }

            .card-header {
                border-bottom: none;
                padding: 1.25rem;
            }

            .card-body {
                padding: 1.5rem;
            }

            .form-label {
                font-weight: 500;
                color: #495057;
                margin-bottom: 0.5rem;
            }

            .form-control {
                padding: 0.75rem 1rem;
                border-radius: 0.375rem;
                border: 1px solid #ced4da;
            }

            .input-group {
                position: relative;
            }

            .input-group .btn {
                padding: 0.75rem 1.5rem;
            }

            .text-danger {
                font-size: 0.875rem;
                margin-top: 0.25rem;
            }

            .page_header h1 {
                font-size: 2rem;
                margin-bottom: 2rem;
                color: #16a34a;
                position: relative;
                padding-bottom: 1rem;
            }

            .page_header h1::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 50%;
                transform: translateX(-50%);
                width: 100px;
                height: 3px;
                background-color: #198754;
            }

            /* Cart table styles */
            .table-responsive {
                border-radius: 0.5rem;
                overflow: hidden;
            }

            .cart-list thead th {
                background-color: #f8f9fa;
                border-bottom: 2px solid #dee2e6;
            }

            .cart-list tbody tr {
                transition: background-color 0.2s ease;
            }

            .cart-list tbody tr:hover {
                background-color: #f8f9fa;
            }

            /* Payment method styles */
            .payment-methods {
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }

            .payment-method label {
                margin: 0;
                cursor: pointer;
                border: 1px solid #dee2e6;
                border-radius: 0.5rem;
            }

            .payment-method input[type="radio"]:checked+div {
                color: #198754;
            }

            .payment-method input[type="radio"]:checked+label {
                border-color: #198754;
                background-color: #f8f9fa;
            }

            /* Summary card styles */
            #total_amount {
                font-size: 1.25rem;
                color: #198754;
            }

            .discount-badge {
                background-color: #28a745;
                color: white;
                padding: 0.25rem 0.5rem;
                border-radius: 0.25rem;
                font-size: 0.875rem;
            }

            /* Responsive adjustments */
            @media (max-width: 768px) {
                .card {
                    margin-bottom: 1.5rem;
                }

                .page_header h1 {
                    font-size: 1.5rem;
                }

                .cart-list {
                    font-size: 0.875rem;
                }

                .btn {
                    padding: 0.625rem 1.25rem;
                }
            }

            /* Animation for success messages */
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(-10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .alert {
                animation: fadeIn 0.3s ease-in-out;
            }

            /* Custom scrollbar */
            ::-webkit-scrollbar {
                width: 8px;
                height: 8px;
            }

            ::-webkit-scrollbar-track {
                background: #f1f1f1;
                border-radius: 4px;
            }

            ::-webkit-scrollbar-thumb {
                background: #888;
                border-radius: 4px;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: #555;
            }

            /* Loading spinner for coupon verification */
            .spinner-border-sm {
                width: 1rem;
                height: 1rem;
                border-width: 0.2em;
            }

            /* Enhanced focus states for accessibility */
            .form-control:focus,
            .btn:focus,
            input[type="radio"]:focus+label {
                outline: none;
                box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
            }

            /* Tooltip styles */
            .tooltip {
                position: absolute;
                background-color: #000;
                color: #fff;
                padding: 0.5rem;
                border-radius: 0.25rem;
                font-size: 0.875rem;
                z-index: 1000;
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .tooltip.show {
                opacity: 1;
            }

            /* Print styles */
            @media print {
                .no-print {
                    display: none !important;
                }

                .card {
                    box-shadow: none !important;
                    border: 1px solid #dee2e6 !important;
                }

                .page_header h1::after {
                    display: none;
                }
            }
        </style>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            // api maps
            $(document).ready(function() {
                $('#dia_chi').on('input', function() {
                    const input = $(this).val();
                    if (input.length > 2) {
                        $.ajax({
                            url: 'https://rsapi.goong.io/place/autocomplete',
                            data: {
                                input: input,
                                location: '10.700920276971795,106.73296613898738',
                                limit: 10,
                                radius: 10,
                                api_key: '22Wn63woi41PWQdNMN9kaVUsgC9VFKEp1ZzjmQm5'
                            },
                            success: function(data) {
                                const suggestions = data.predictions.map(prediction =>
                                    `<div>${prediction.description}</div>`).join('');
                                $('#suggestions').html(suggestions);
                            },
                            error: function(error) {
                                console.error('Error fetching autocomplete results:', error);
                            }
                        });
                    } else {
                        $('#suggestions').empty();
                    }
                });

                // 
                $('#suggestions').on('click', 'div', function() {
                    const selectedAddress = $(this).text();
                    $('#dia_chi').val(selectedAddress);
                    $('#suggestions').empty();

                    // Kiểm tra khả năng phục vụ của shipper
                    $.ajax({
                        url: '/check-shipper-availability',
                        type: 'POST',
                        data: {
                            address: selectedAddress,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (!response.available) {
                                alert(
                                    'Hiện tại không có shipper nào phục vụ khu vực của bạn. Vui lòng thử lại sau hoặc chọn phương thức vận chuyển khác.');
                            }
                        },
                        error: function(error) {
                            console.error('Error checking shipper availability:', error);
                        }
                    });
                });
            });

            $(document).ready(function() {
                $('#apply-coupon').on('click', function() {
                    var couponCode = $('#coupon-code').val();
                    // Thay đổi cách lấy tổng tiền
                    var totalAmount = parseFloat($('#hidden_totall').val().replace(/\./g, ''));

                    console.log("Coupon Code:", couponCode);
                    console.log("Total Amount:", totalAmount);

                    $.ajax({
                        url: "{{ route('apply.coupon') }}",
                        type: "POST",
                        data: {
                            coupon_code: couponCode,
                            totall: totalAmount,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            console.log(response);
                            if (response.success) {
                                $('#total_amount').text(response.newTotal.replace(/\₫/g, '') + '₫');
                                $('#discount-amount').text(response.discountAmount + '₫');
                                toastr.success(response.message);
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error:", xhr.responseText);
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
            document.querySelector('form').addEventListener('submit', function(e) {
                const requiredFields = this.querySelectorAll('[required]');
                let isValid = true;

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.classList.add('is-invalid');
                    } else {
                        field.classList.remove('is-invalid');
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    alert('Vui lòng điền đầy đủ thông tin bắt buộc');
                }
            });
        </script>
        <link href="{{ asset('assets/client/css/css/checkout.css') }}?v={{ time() }}" rel="stylesheet">
        <link href="{{ asset('assets/client/css/css/style.css') }}?v={{ time() }}" rel="stylesheet">
        <!-- khu vực thanh toán kết thúc -->
    </section>
@endsection
