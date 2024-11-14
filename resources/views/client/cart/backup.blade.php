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
                    <form action="{{ route('cart.checkout') }}" method="POST" id="checkout-form">
                        @csrf
                        <input type="hidden" name="checkout_items[]" id="selected-items">
                        <button id="checkout-button" class="btn btn-success">
                            Thanh toán ngay
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.item-checkbox');
            const totalPriceEl = document.getElementById('total-price');
            const removeButton = document.getElementById('remove-selected-items');
            const checkoutForm = document.getElementById('checkout-form');
            const removeMultipleForm = document.getElementById('remove-multiple-form');

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
                removeButton.disabled = selectedItems.length === 0;

                // Xóa các input hidden trước khi thêm mới
                removeMultipleForm.querySelectorAll('input[name="remove_items[]"]').forEach(input => input
            .remove());
                checkoutForm.querySelectorAll('input[name="checkout_items[]"]').forEach(input => input.remove());

                selectedItems.forEach(itemId => {
                    let removeInput = document.createElement('input');
                    removeInput.type = 'hidden';
                    removeInput.name = 'remove_items[]';
                    removeInput.value = itemId;
                    removeMultipleForm.appendChild(removeInput);

                    let checkoutInput = document.createElement('input');
                    checkoutInput.type = 'hidden';
                    checkoutInput.name = 'checkout_items[]';
                    checkoutInput.value = itemId;
                    checkoutForm.appendChild(checkoutInput);
                });
            }

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', calculateTotal);
            });

            calculateTotal();
        });
    </script>
@endsection
