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
                        <input type="hidden" name="checkout_items[]" id="selected-items">
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
            const checkoutButton = document.getElementById('checkout-button');
            const checkboxes = document.querySelectorAll('.item-checkbox');
            const totalPriceEl = document.getElementById('total-price');
            const checkoutForm = document.querySelector('form[action="{{ route('cart.checkout') }}"]');

            // Hàm kiểm tra số lượng
            function checkStock() {
                let isStockSufficient = true;

                document.querySelectorAll('.quantity-input').forEach(input => {
                    const quantity = parseInt(input.value);
                    const maxQuantity = parseInt(input.getAttribute('max'));

                    if (quantity > maxQuantity) {
                        isStockSufficient = false;
                        const errorMsg = document.createElement('span');
                        errorMsg.classList.add('text-danger', 'stock-error');
                        errorMsg.textContent = 'Số lượng không đủ!';

                        if (!input.parentNode.querySelector('.stock-error')) {
                            input.parentNode.appendChild(errorMsg);
                        }
                    } else {
                        const errorMsg = input.parentNode.querySelector('.stock-error');
                        if (errorMsg) errorMsg.remove();
                    }
                });

                checkoutButton.disabled = !isStockSufficient;
            }

            // Hàm tính tổng tiền và cập nhật danh sách sản phẩm được chọn vào `checkout_items[]`
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

                // Cập nhật input hidden `checkout_items[]` trong form thanh toán
                checkoutForm.querySelectorAll('input[name="checkout_items[]"]').forEach(input => input.remove());

                if (selectedItems.length > 0) {
                    selectedItems.forEach(itemId => {
                        let hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = 'checkout_items[]';
                        hiddenInput.value = itemId;
                        checkoutForm.appendChild(hiddenInput);
                    });
                    checkoutButton.disabled = false;
                } else {
                    checkoutButton.disabled = true;
                }
            }

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', calculateTotal);
            });

            calculateTotal();
        });
    </script>
@endsection
