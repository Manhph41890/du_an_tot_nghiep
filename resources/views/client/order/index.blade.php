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
            <div class="row">
                <div class="col-lg-7">
                    <div class="billing-info-wrap">
                        <h3 class="title">Thông Tin Thanh Toán</h3>
                        <form class="personal-information" action="{{ route('order.add') }}" method="POST">
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
                                <form action="">
                                    <label for="coupon-code" class="">Nhập mã giảm giá</label>
                                    <div class="col-lg-6 col-md-6 d-flex">
                                        <input type="text" id="coupon-code" name="khuyen_mai" class="form-control"
                                            placeholder="Nhập mã giảm giá">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-success ms-3" id="apply-coupon" type="button">Áp
                                                dụng</button>
                                        </div>
                                    </div>
                                </form>


                                <!-- Phương thức thanh toán -->
                                <div class="d-flex mt-25">
                                    <div class="">
                                        <h6 class="font-weight-bold">Phương thức thanh toán</h6>
                                        @foreach ($phuongThucThanhToans as $phuongThucThanhToan)
                                            <div class="form-check">
                                                <input type="radio" id="payment-{{ $phuongThucThanhToan->id }}"
                                                    name="phuong_thuc_thanh_toan" class="form-check-input" value="">
                                                <label for="payment-{{ $phuongThucThanhToan->id }}"
                                                    class="form-check-label">
                                                    {{ $phuongThucThanhToan->kieu_thanh_toan }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="ms-5">
                                        <h6 class="font-weight-bold">Phương thức vận chuyển</h6>
                                        @foreach ($phuongThucVanChuyens as $phuongThucVanChuyen)
                                            <div class="form-check">
                                                <input type="radio"
                                                    id="shipping-{{ $phuongThucVanChuyen->kieu_van_chuyen }}"
                                                    name="phuong_thuc_van_chuyen" class="form-check-input"
                                                    value="{{ $phuongThucVanChuyen->id }}"
                                                    {{ old('phuong_thuc_van_chuyen') == $phuongThucVanChuyen->id ? 'checked' : '' }}>
                                                <label for="shipping-{{ $phuongThucVanChuyen->kieu_van_chuyen }}"
                                                    class="form-check-label">
                                                    {{ $phuongThucVanChuyen->kieu_van_chuyen }}

                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="place-order mt-25">
                                <button type="submit" class="btn btn--xl btn-block btn-primary">Đặt Hàng</button>
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
                                    <li>0</li>
                                </ul>
                                <ul class="d-flex justify-content-between">
                                    <li class="your-order-shipping">Tiền giảm giá khuyến mại</li>
                                    <li>
                                        {{-- Nơi hiển thị số tiền giảm từ mã giảm --}}
                                    </li>
                                </ul>
                                <div class="your-order-total">
                                    <ul class="d-flex justify-content-between">
                                        <li class="order-total font-weight-bold">Tổng cộng</li>
                                        <li class="font-weight-bold"><span
                                                id="total-price-display">{{ $total }}</span></li>
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
        const couponCodeInput = document.getElementById('coupon-code');
        const applyCouponButton = document.getElementById('apply-coupon');
        const discountMessage = document.getElementById('discount-message');
        const totalPriceValue = document.getElementById('total-price-value');
        const totalPriceHidden = document.getElementById('hidden-total-price');
        const totalPriceDisplay = document.getElementById('total-price-display'); // Thêm phần tử hiển thị tổng tiền

        applyCouponButton.addEventListener('click', function() {
            const couponCode = couponCodeInput.value;
            if (couponCode) {
                fetch('/validate-coupon', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            code: couponCode
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Code is valid!
                            discountMessage.textContent = "Mã giảm giá đã được áp dụng!";
                            discountMessage.classList.add('text-success');

                            // Cập nhật tổng tiền hiển thị và ẩn
                            let totalPrice = parseFloat(totalPriceHidden.value);
                            totalPrice -= parseFloat(data.discount);
                            totalPriceValue.textContent = totalPrice.toFixed(2);
                            totalPriceDisplay.textContent = totalPrice.toFixed(
                                2); // Cập nhật tổng tiền hiển thị trong your-order-area

                            // Cập nhật giá trị ẩn của tổng tiền
                            totalPriceHidden.value = totalPrice;

                        } else {
                            // Invalid code
                            discountMessage.textContent = "Mã giảm giá không hợp lệ!";
                            discountMessage.classList.add('text-danger');
                        }
                    })
                    .catch(error => {
                        console.error("Error fetching coupon data:", error);
                        discountMessage.textContent = "Lỗi xảy ra, vui lòng thử lại!";
                        discountMessage.classList.add('text-danger');
                    });
            } else {
                discountMessage.textContent = "Vui lòng nhập mã giảm giá!";
                discountMessage.classList.add('text-danger');
            }
        });
    </script>
    <!-- khu vực thanh toán kết thúc -->
@endsection
