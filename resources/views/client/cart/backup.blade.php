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
            <h1>Giỏ Hàng</h1>
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
                        <th>Hành Động</th>
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
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                                        max="100" class="quantity-input" data-item-id="{{ $item->id }}">
                                    <button type="button" class="btn btn-primary btn-sm update-cart-btn"
                                        data-id="{{ $item->id }}">
                                        Cập nhật
                                    </button>
                                </td>
                                <td>
                                    <strong><span class="whish-list-price">{{ number_format($item->price) }}
                                            đ</span></strong>
                                </td>
                                <td class="options">
                                    <form action="{{ route('cart.removeFromCart', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng không?');">
                                        @csrf
                                        <button type="submit" class="btn btn-secondary btn-sm">
                                            <span class="trash"><i class="fas fa-trash-alt"></i> Xóa</span>
                                        </button>
                                    </form>
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
                    <a href="{{ route('cart.checkout') }}" class="btn_1 full-width cart"
                        style="color: rgb(82, 82, 225); font-size: 20px">Thanh toán ngay</a>
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

            // Hàm tính tổng tiền và cập nhật form xóa
            function calculateTotal() {
                let totalPrice = 0;
                const selectedItems = [];

                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        const price = parseInt(checkbox.getAttribute('data-price'));
                        selectedItems.push(checkbox.getAttribute('data-id'));
                        totalPrice += price;
                    }
                });

                totalPriceEl.textContent = totalPrice.toLocaleString() + ' đ';

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
                    document.querySelectorAll('input[name="remove_items[]"]').forEach(input => input.remove());
                }
            }

            updateBtns.forEach(button => {
                button.addEventListener('click', function(e) {
                    const itemId = this.getAttribute('data-id'); // Lấy giá trị data-id

                    // Kiểm tra nếu data-id không tồn tại
                    if (!itemId) {
                        console.error("Không tìm thấy data-id của button.");
                        return; // Nếu không có data-id, dừng lại
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

                    // Gửi yêu cầu AJAX
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
                                alert(data.message);
                                location.reload(); // reload trang để cập nhật lại giỏ hàng
                            } else {
                                alert(data.message);
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });

            // Lắng nghe sự kiện thay đổi trạng thái checkbox
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', calculateTotal);
            });

            // Tính tổng tiền ban đầu
            calculateTotal();
        });
    </script>
@endsection
