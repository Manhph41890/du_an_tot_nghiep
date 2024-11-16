@extends('client.layout')

@section('content')
    <style>
        .update-cart-form input,
        .update-cart-form select {
            height: 40px;
            padding: 5px;
            font-size: 14px;
        }

        table {
            width: 100%;
            border: 1px;
        }

        th {
            align-items: center;
            justify-content: center;
        }

        td {
            align-items: center;
        }

        td select,
        td input,
        td button {
            height: 35px;
            margin-right: 10px;
            padding: 5px;
            font-size: 14px;
        }

        td select {
            width: auto;
        }

        td input[type="number"] {
            width: 60px;
        }

        table th {}

        table.cart-list {
            width: 100%;
            border-collapse: collapse;
        }

        table.cart-list th,
        table.cart-list td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        table.cart-list th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        .btn {
            border-radius: 5px;
        }

        .cart-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
        }

        .cart-table {
            flex: 2;
        }

        .cart-summary {
            flex: 1;
            /* border: 1px solid #ddd; */
            padding: 20px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .cart-summary ul {
            list-style: none;
            padding: 0;
        }

        .cart-summary li {
            margin-bottom: 10px;
        }

        .cart-summary button {
            width: 100%;
        }
    </style>
    <div class="container margin_30">
        <div class="page_header">
            <h1>Giỏ Hàng</h1>
        </div>
        <div class="cart-wrapper">
            <form action="{{ route('cart.removeMultiple') }}" method="POST" id="remove-multiple-form">
                @csrf
                <div class="cart-table">
                    <table class="table cart-list">
                        <thead>
                            <tr>
                                <th>Chọn</th>
                                <th>Sản Phẩm</th>
                                <th>Giá</th>
                                <th>Phân loại</th>
                                <th>Tổng Tiền</th>
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
                                                <img src="{{ asset('/storage/' . $item->san_pham->anh_san_pham) }}"
                                                    alt="img" height="150px" width="150px"
                                                    style="object-fit: cover" />
                                            </div>
                                            <span class="item_cart">{{ $item->san_pham->ten_san_pham }}</span>
                                        </td>
                                        <td>
                                            <strong>{{ number_format($item->san_pham->gia_km ?? $item->san_pham->gia_ban) }}
                                                đ</strong>
                                        </td>
                                        <td>
                                            <span>Size:</span>
                                            <select name="size_san_pham_id" class="size-select"
                                                data-item-id="{{ $item->id }}">
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
                                            <span>Số lượng:</span>
                                            <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                min="1" max="100" class="quantity-input"
                                                data-item-id="{{ $item->id }}">
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
                </div>
            </form>
            <div class="cart-summary">
                <ul>
                    <li style="font-size: 16px">
                        <strong><span>Phí vận chuyển: </span><span id="shipping">0</span></strong>
                    </li>

                    <li style="font-size: 20px">
                        <strong><span>Tổng Tiền: </span><span class="text-danger" id="total-price">0</span></strong>
                    </li>
                </ul>
                <form action="{{ route('cart.checkout') }}" method="POST" id="checkout-form">
                    @csrf
                    <input type="hidden" name="checkout_items[]" id="selected-items">
                    <button id="checkout-button" class="btn btn-primary">
                        Thanh toán ngay
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const updateButtons = document.querySelectorAll('.update-cart-btn');
            const checkboxes = document.querySelectorAll('.item-checkbox');
            const totalPriceEl = document.getElementById('total-price');
            const shippingEl = document.getElementById('shipping');
            const removeButton = document.getElementById('remove-selected-items');
            const checkoutForm = document.getElementById('checkout-form');
            const removeMultipleForm = document.getElementById('remove-multiple-form');

            // Hàm tính tổng giá trị giỏ hàng
            function calculateTotal() {
                let totalPrice = 0;
                let shipping = 0;
                const selectedItems = [];

                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        const price = parseInt(checkbox.getAttribute('data-price'));
                        selectedItems.push(checkbox.getAttribute('data-id'));
                        shipping = 30000; // 
                        totalPrice += price + shipping;
                    }
                });

                totalPriceEl.textContent = totalPrice.toLocaleString() + ' đ';
                shippingEl.textContent = shipping.toLocaleString() + ' đ';
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

            // Kiểm tra số lượng sản phẩm không vượt quá tồn kho
            function checkMaxQuantity(itemId, inputQuantity) {
                const itemElement = document.querySelector(`.item-checkbox[data-id="${itemId}"]`);
                const maxQuantity = parseInt(itemElement.getAttribute('data-max-quantity'));
                const quantity = parseInt(inputQuantity.value);

                if (quantity > maxQuantity) {
                    toastr.error(`Số lượng tối đa cho sản phẩm này là ${maxQuantity}`);
                    inputQuantity.value = maxQuantity; // Cập nhật giá trị lại về số lượng tối đa
                    return false;
                }
                return true;
            }

            // Sự kiện cập nhật giỏ hàng khi người dùng bấm "Cập nhật"
            updateButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const itemId = this.getAttribute('data-id');
                    const sizeSelect = document.querySelector(
                        `select.size-select[data-item-id="${itemId}"]`);
                    const colorSelect = document.querySelector(
                        `select.color-select[data-item-id="${itemId}"]`);
                    const quantityInput = document.querySelector(
                        `input.quantity-input[data-item-id="${itemId}"]`);

                    if (checkMaxQuantity(itemId, quantityInput)) {
                        const data = {
                            size_san_pham_id: sizeSelect.value,
                            color_san_pham_id: colorSelect.value,
                            quantity: quantityInput.value,
                            _token: '{{ csrf_token() }}'
                        };

                        fetch(`/cart/update/${itemId}`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify(data)
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    toastr.success('Cập nhật thành công');
                                    calculateTotal();
                                    location.reload();
                                } else {
                                    toastr.error(data.message); // Hiển thị thông báo lỗi nếu có
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                toastr.error('Có lỗi xảy ra, vui lòng thử lại.');
                            });


                    }
                });
            });

            // Sự kiện thay đổi khi chọn các checkbox
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', calculateTotal);
            });

            calculateTotal(); // Tính toán giá trị ban đầu của giỏ hàng
        });
    </script>

@endsection
