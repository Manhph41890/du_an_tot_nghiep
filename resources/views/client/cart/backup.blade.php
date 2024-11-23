@extends('client.layout')

@section('content')
    <style>
        .cart-wrapper {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
            font-family: system-ui, -apple-system, sans-serif;
        }

        .cart-table {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table thead {
            background: #f8fafc;
        }

        .table th {
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: #64748b;
            border-bottom: 1px solid #e2e8f0;
        }

        .table td {
            padding: 1rem;
            vertical-align: top;
            border-bottom: 1px solid #e2e8f0;
        }

        .thumb_cart {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .thumb_cart img {
            border-radius: 0.5rem;
            transition: transform 0.2s;
        }

        .thumb_cart img:hover {
            transform: scale(1.05);
        }

        .thumb_cart h5 {
            margin: 0;
            font-size: 1rem;
            color: #1e293b;
        }

        .quantity-input {
            width: 70px;
            padding: 0.5rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.375rem;
            margin-right: 0.5rem;
        }

        .update-cart-btn {
            padding: 0.5rem 1rem;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: background 0.2s;
        }

        .update-cart-btn:hover {
            background: #2563eb;
        }

        .cart-summary {
            background: white;
            padding: 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .cart-summary ul {
            list-style: none;
            padding: 0;
            margin: 0 0 1.5rem 0;
        }

        .cart-summary li {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            color: #64748b;
        }

        .cart-summary li:last-child {
            font-size: 1.25rem;
            color: #1e293b;
            border-top: 1px solid #e2e8f0;
            padding-top: 1rem;
        }

        #checkout-button {
            width: 100%;
            padding: 1rem;
            background: #22c55e;
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        #checkout-button:hover {
            background: #16a34a;
        }

        #remove-selected-items {
            margin: 1rem;
            padding: 0.5rem 1rem;
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: background 0.2s;
        }

        #remove-selected-items:hover {
            background: #dc2626;
        }

        .checkbox-wrapper {
            display: inline-block;
            position: relative;
            padding-left: 25px;
            cursor: pointer;
        }

        .checkbox-wrapper input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 18px;
            width: 18px;
            background-color: #fff;
            border: 2px solid #e2e8f0;
            border-radius: 4px;
        }

        .checkbox-wrapper input:checked~.checkmark {
            background-color: #3b82f6;
            border-color: #3b82f6;
        }

        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        .checkbox-wrapper input:checked~.checkmark:after {
            display: block;
        }

        .checkbox-wrapper .checkmark:after {
            left: 5px;
            top: 2px;
            width: 4px;
            height: 8px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .price-tag {
            color: #ef4444;
            font-weight: 600;
        }

        .variant-price {
            color: #64748b;
            font-size: 0.9rem;
        }

        .empty-cart {
            text-align: center;
            padding: 3rem;
            color: #64748b;
        }

        .empty-cart i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #e2e8f0;
        }

        @media (max-width: 768px) {
            .thumb_cart {
                flex-direction: column;
                text-align: center;
            }

            .table th:nth-child(3),
            .table td:nth-child(3),
            .table th:nth-child(5),
            .table td:nth-child(5) {
                display: none;
            }

            .cart-summary {
                margin-top: 2rem;
            }
        }
    </style>
    <div class="container margin_30">
        <!-- <div class="page_header">                                                                   <h1 style="color: #5a5ac9; margin-bottom: 30px">Giỏ Hàng</h1>                                                                </div> -->
        <nav style="margin-bottom:8vh" class="breadcrumb-section theme1 bg-primary pt-110 pb-110">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title text-center">
                            <h2 class="title pb-4 text-white text-capitalize" style=" color: #fff !important">
                                GIỎ HÀNG
                            </h2>
                        </div>
                    </div>
                    <div class="col-12">
                        <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('client.home') }}">Trang chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Giỏ hàng
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </nav>
        <div class="cart-wrapper">
            <form action="{{ route('cart.removeMultiple') }}" method="POST" id="remove-multiple-form">
                @csrf
                <div class="cart-table">
                    <table class="table cart-list">
                        <thead>
                            <tr>
                                <th>
                                    <label class="checkbox-wrapper">
                                        <input type="checkbox" id="select-all">
                                        <span class="checkmark"></span>
                                    </label>
                                </th>
                                <th>Sản phẩm</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Giá phân loại</th>
                                <th>Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($cartItems))
                                @foreach ($cartItems as $item)
                                    <tr>
                                        <td>
                                            <label class="checkbox-wrapper">
                                                <input type="checkbox" class="item-checkbox"
                                                    data-price="{{ $item->price }}" data-id="{{ $item->id }}">
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <div class="thumb_cart">
                                                <img src="{{ asset('/storage/' . $item->san_pham->anh_san_pham) }}"
                                                    alt="img" height="90px" width="90px" style="object-fit: cover">
                                                <div>
                                                    <h5>{{ $item->san_pham->ten_san_pham }}</h5>
                                                    <p class="small mb-0">
                                                        Phân loại: {{ $item->size->ten_size }}-{{ $item->color->ten_color }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="price-tag">
                                                {{ number_format($item->san_pham->gia_km, 0, ',', '.') }} đ
                                            </span>
                                        </td>
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                                <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                    min="1" max="100" class="quantity-input"
                                                    data-item-id="{{ $item->id }}">
                                                <button type="button" class="update-cart-btn"
                                                    data-id="{{ $item->id }}">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="variant-price">
                                                @php
                                                    $variant = $item->san_pham->bien_the_san_phams->firstWhere(
                                                        function ($variant) use ($item) {
                                                            return $variant->size_san_pham_id ==
                                                                $item->size_san_pham_id &&
                                                                $variant->color_san_pham_id == $item->color_san_pham_id;
                                                        },
                                                    );
                                                @endphp
                                                @if ($variant)
                                                    {{ number_format($variant->gia, 0, ',', '.') }} đ
                                                @else
                                                    Chưa có giá biến thể
                                                @endif
                                            </span>
                                        </td>
                                        <td>
                                            <span class="price-tag">
                                                {{ number_format($item->price) }} đ
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="empty-cart">
                                        <i class="fas fa-shopping-cart"></i>
                                        <p>Giỏ hàng trống!</p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-danger btn-sm" id="remove-selected-items" style="display: none;">
                        <i class="fas fa-trash"></i> Xóa Sản Phẩm Đã Chọn
                    </button>
                </div>
            </form>

            <div class="cart-summary">
                <ul>
                    <li>
                        <span>Phí vận chuyển:</span>
                        <span id="shipping">0 đ</span>
                    </li>
                    <li>
                        <span>Tổng tiền cần thanh toán:</span>
                        <span class="price-tag" id="total-price">0 đ</span>
                    </li>
                </ul>
                <form action="{{ route('cart.checkout') }}" method="POST" id="checkout-form">
                    @csrf
                    <input type="hidden" name="checkout_items[]" id="selected-items">
                    <button id="checkout-button" type="submit">
                        <i class="fas fa-shopping-cart"></i> Thanh toán ngay
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
            const selectAllButton = document.getElementById('select-all');

            // Chọn hoặc bỏ chọn tất cả checkbox
            selectAllButton.addEventListener('click', function() {
                const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);
                checkboxes.forEach(checkbox => checkbox.checked = !allChecked);
                calculateTotal(); // Tính toán lại tổng giỏ hàng
            });
            // Hàm tính tổng giá trị giỏ hàng
            function calculateTotal() {
                let totalPrice = 0;
                let shipping = 0;
                const selectedItems = [];

                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        const price = parseInt(checkbox.getAttribute('data-price'));
                        selectedItems.push(checkbox.getAttribute('data-id'));
                        totalPrice += price;
                    }
                });
                // Nếu có ít nhất 1 sản phẩm được chọn, cộng phí vận chuyển một lần
                if (selectedItems.length > 0) {
                    shipping = 30000; // Cộng phí vận chuyển chỉ một lần
                }
                totalPrice += shipping; // Cộng phí vận chuyển vào tổng giá trị
                totalPriceEl.textContent = totalPrice.toLocaleString() + ' đ';
                shippingEl.textContent = shipping.toLocaleString() + ' đ';
                removeButton.style.display = selectedItems.length > 0 ? 'inline-block' :
                    'none'; // Hiển thị/ẩn nút xóa

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
                    const quantityInput = document.querySelector(
                        `input.quantity-input[data-item-id="${itemId}"]`);

                    // Kiểm tra số lượng hợp lệ trước khi gửi
                    if (checkMaxQuantity(itemId, quantityInput)) {
                        const data = {
                            quantity: quantityInput.value, // Chỉ gửi số lượng
                            _token: '{{ csrf_token() }}' // CSRF token để bảo mật
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
                                    calculateTotal(); // Tính toán lại tổng giỏ hàng
                                    location.reload(); // Làm mới trang để cập nhật thông tin
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
