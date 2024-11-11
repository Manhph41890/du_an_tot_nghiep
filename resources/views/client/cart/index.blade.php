@extends('client.layout')

@section('content')
    <style>
        .update-cart-form input,
        .update-cart-form select {
            height: 40px;
            padding: 5px;
            font-size: 14px;
        }
    </style>
    <div class="container margin_30">
        <div class="page_header">
            <h1 class="text-center my-3" style="color:#5a5ac9">Giỏ Hàng</h1>
        </div>

        <form action="{{ route('cart.removeMultiple') }}" method="POST" id="remove-multiple-form">
            @csrf
            <table class="table table-striped cart-list">
                <thead>
                    <tr>
                        <th>Chọn</th>
                        <th>Sản Phẩm</th>
                        <th>Giá</th>
                        <th>Phân loại</th>
                        <th>Tổng Tiền</th>
                        {{-- <th>Hành Động</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($cartItems))
                        @foreach ($cartItems as $item)
                            <tr>
                                <td>
                                    <input type="checkbox" class="item-checkbox" data-price="{{ $item->price }}"
                                        data-id="{{ $item->id }}" />
                                </td>
                                <td>
                                    <div class="thumb_cart">
                                        <img src="{{ asset('/storage/' . $item->san_pham->anh_san_pham) }}" alt="img"
                                            height="150px" width="150px" style="object-fit: cover" />
                                    </div>
                                    <span class="item_cart">{{ $item->san_pham->ten_san_pham }}</span>
                                </td>
                                <td>
                                    <strong>{{ number_format($item->san_pham->gia_km ?? $item->san_pham->gia_ban) }}
                                        đ</strong>
                                </td>
                                <td>
                                    <span>Size:</span>
                                    <select name="size_san_pham_id" class="size-select" data-item-id="{{ $item->id }}">
                                        @foreach ($item->san_pham->bien_the_san_phams as $variant)
                                            <option value="{{ $variant->size->id }}"
                                                {{ $variant->size->id == $item->size_san_pham_id ? 'selected' : '' }}>
                                                {{ $variant->size->ten_size }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span>Màu:</span>
                                    <select name="color_san_pham_id" class="color-select"
                                        data-item-id="{{ $item->id }}">
                                        @foreach ($item->san_pham->bien_the_san_phams as $variant)
                                            <option value="{{ $variant->color->id }}"
                                                {{ $variant->color->id == $item->color_san_pham_id ? 'selected' : '' }}>
                                                {{ $variant->color->ten_color }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span>Số Lượng:</span>

                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                                        max="{{ $variant->so_luong }}" class="quantity-input"
                                        data-item-id="{{ $item->id }}">
                                    @if (isset($insufficientStockItems[$item->id]))
                                        <span class="alert-warning" style="color: red;">
                                            Chỉ còn {{ $insufficientStockItems[$item->id]['quantity'] }} sản phẩm.
                                        </span>
                                    @endif
                                    <button type="button" class="btn btn-primary btn-sm update-cart-btn"
                                        data-id="{{ $item->id }}">
                                        Cập nhật
                                    </button>
                                </td>
                                <td>
                                    <strong><span class="whish-list-price">{{ number_format($item->price) }}
                                            đ</span></strong>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center">Giỏ hàng trống!</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <button type="submit" class="btn btn-danger btn-sm" id="remove-selected-items" disabled>Xóa Sản Phẩm Đã
                Chọn</button>
        </form>

    </div>

    <div class="box_cart">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <ul>
                        <li style="font-size: 20px">
                            <strong><span>Tổng Tiền: </span><span id="total-price">0</span></strong>
                        </li>
                    </ul>
                    <form action="{{ route('cart.checkout') }}" method="GET">
                        <input type="hidden" name="remove_items[]" id="selected-items">
                        <button id="checkout-button" class="btn btn-success"
                            @if (
                                !empty($cartItems) &&
                                    collect($cartItems)->contains(fn($item) => $item->quantity >
                                            optional(
                                                $item->san_pham->bien_the_san_phams->firstWhere('size_san_pham_id', $item->size_san_pham_id)->firstWhere('color_san_pham_id', $item->color_san_pham_id))->so_luong)) disabled @endif>
                            Thanh toán ngay
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const updateBtns = document.querySelectorAll('.update-cart-btn');
            const checkboxes = document.querySelectorAll('.item-checkbox');
            const totalPriceEl = document.getElementById('total-price');
            const removeButton = document.getElementById('remove-selected-items');
            const removeMultipleForm = document.getElementById('remove-multiple-form');
            // Hàm kiểm tra số lượng
            function checkStock() {
                let isStockSufficient = true;

                document.querySelectorAll('.quantity-input').forEach(input => {
                    const itemId = input.getAttribute('data-item-id');
                    const quantity = parseInt(input.value);
                    const maxQuantity = parseInt(input.getAttribute('max'));

                    // Kiểm tra nếu số lượng đặt hàng vượt quá số lượng tối đa
                    if (quantity > maxQuantity) {
                        isStockSufficient = false;
                        const errorMsg = document.createElement('span');
                        errorMsg.classList.add('text-danger', 'stock-error');
                        errorMsg.textContent = 'Số lượng không đủ!';

                        // Hiển thị thông báo lỗi nếu chưa có
                        if (!input.parentNode.querySelector('.stock-error')) {
                            input.parentNode.appendChild(errorMsg);
                        }
                    } else {
                        // Xóa thông báo lỗi nếu số lượng hợp lệ
                        const errorMsg = input.parentNode.querySelector('.stock-error');
                        if (errorMsg) errorMsg.remove();
                    }
                });

                // Vô hiệu hóa nút thanh toán nếu không đủ hàng
                checkoutButton.disabled = !isStockSufficient;
            }
            // Hàm tính tổng tiền và cập nhật form xóa
            function calculateTotal() {
                let totalPrice = 0;
                const selectedItems = [];

                // Lặp qua các checkbox và tính tổng tiền cho sản phẩm được chọn
                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        const price = parseInt(checkbox.getAttribute('data-price'));
                        selectedItems.push(checkbox.getAttribute('data-id'));
                        totalPrice += price;
                    }
                });

                // Hiển thị tổng tiền
                totalPriceEl.textContent = totalPrice.toLocaleString() + ' đ';

                // Cập nhật form xóa nếu có sản phẩm được chọn
                if (selectedItems.length > 0) {
                    selectedItems.forEach(itemId => {
                        let hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = 'remove_items[]';
                        hiddenInput.value = itemId;
                        removeMultipleForm.appendChild(hiddenInput);
                    });
                    removeButton.disabled = false;
                } else {
                    removeButton.disabled = true;
                    // Loại bỏ các input ẩn khi không có sản phẩm nào được chọn
                    document.querySelectorAll('input[name="remove_items[]"]').forEach(input => input.remove());
                }
            }

            // Xử lý sự kiện nhấn nút cập nhật giỏ hàng
            updateBtns.forEach(button => {
                button.addEventListener('click', function(e) {
                    const itemId = this.getAttribute('data-id'); // Lấy giá trị data-id

                    // Kiểm tra nếu data-id không tồn tại
                    if (!itemId) {
                        console.error("Không tìm thấy data-id của button.");
                        return;
                    }

                    // Kiểm tra sự tồn tại của các phần tử trước khi lấy giá trị
                    const sizeSelect = document.querySelector(
                        `select[name="size_san_pham_id"][data-item-id="${itemId}"]`);
                    const colorSelect = document.querySelector(
                        `select[name="color_san_pham_id"][data-item-id="${itemId}"]`);
                    const quantityInput = document.querySelector(
                        `input[name="quantity"][data-item-id="${itemId}"]`);

                    // Kiểm tra nếu các phần tử không tồn tại
                    if (!sizeSelect || !colorSelect || !quantityInput) {
                        console.error("Không thể tìm thấy các phần tử của sản phẩm với ID:",
                            itemId);
                        return;
                    }

                    const sizeId = sizeSelect.value;
                    const colorId = colorSelect.value;
                    const quantity = quantityInput.value;

                    // Gửi yêu cầu AJAX để cập nhật giỏ hàng
                    fetch(`/cart/update/${itemId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                size_san_pham_id: sizeId,
                                color_san_pham_id: colorId,
                                quantity: quantity
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                toastr.success(data.message);
                                location.reload(); // reload trang để cập nhật lại giỏ hàng
                            } else {
                                toastr.error(data.message); // thông báo lỗi nếu có
                            }
                        })
                        .catch(error => {
                            toastr.error(
                                'Có lỗi xảy ra khi cập nhật giỏ hàng. Vui lòng thử lại.');
                            console.error('Error:', error);
                        });
                });
            });

            // Sự kiện thay đổi trạng thái checkbox
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', calculateTotal);
            });

            // Tính tổng tiền ban đầu
            calculateTotal();
        });
    </script>
@endsection
