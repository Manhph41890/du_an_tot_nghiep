@extends('client.layout')

@section('content')
    <style>
        /* Container styles */
        .cart-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Table styles */
        .cart-table {
            margin-bottom: 30px;
            overflow-x: auto;
        }

        .cart-list {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            table-layout: fixed;
        }

        /* Header styles */
        .cart-list thead th {
            background-color: #f8f9fa;
            padding: 15px;
            font-weight: 600;
            color: #333;
            border-bottom: 2px solid #dee2e6;
            white-space: nowrap;
        }

        /* Column widths */
        .cart-list th:nth-child(1),
        .cart-list td:nth-child(1) {
            width: 50px;
        }

        .cart-list th:nth-child(2),
        .cart-list td:nth-child(2) {
            width: 35%;
        }

        .cart-list th:nth-child(3),
        .cart-list td:nth-child(3),
        .cart-list th:nth-child(5),
        .cart-list td:nth-child(5),
        .cart-list th:nth-child(6),
        .cart-list td:nth-child(6) {
            width: 15%;
        }

        .cart-list th:nth-child(4),
        .cart-list td:nth-child(4) {
            width: 120px;
        }

        /* Cell styles */
        .cart-list td {
            padding: 15px;
            vertical-align: middle;
            border-bottom: 1px solid #dee2e6;
        }

        /* Product thumbnail styles */
        .thumb_cart {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .thumb_cart img {
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .thumb_cart h5 {
            margin: 0 0 5px 0;
            font-size: 16px;
            color: #333;
        }

        .thumb_cart p {
            color: #666;
            margin: 0;
        }

        /* Quantity input styles */
        .quantity-input {
            width: 60px;
            padding: 5px;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            text-align: center;
        }

        /* Update button styles */
        .update-cart-btn {
            background: none;
            border: none;
            color: #007bff;
            cursor: pointer;
            padding: 5px;
            transition: color 0.2s;
        }

        .update-cart-btn:hover {
            color: #0056b3;
        }

        /* Price styles */
        .price-tag {
            font-weight: 600;
            color: #dc3545;
        }

        .variant-price {
            color: #28a745;
            font-weight: 500;
        }

        /* Empty cart styles */
        .empty-cart {
            text-align: center;
            padding: 40px !important;
            color: #666;
        }

        .empty-cart i {
            font-size: 48px;
            margin-bottom: 15px;
            color: #dee2e6;
        }

        /* Checkbox styles */
        .checkbox-wrapper {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .checkbox-wrapper input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .checkmark {
            position: relative;
            display: inline-block;
            width: 18px;
            height: 18px;
            border: 2px solid #dee2e6;
            border-radius: 3px;
            background-color: #fff;
        }

        .checkbox-wrapper input:checked~.checkmark {
            background-color: #007bff;
            border-color: #007bff;
        }

        .checkmark:after {
            content: '';
            position: absolute;
            display: none;
            left: 5px;
            top: 2px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .checkbox-wrapper input:checked~.checkmark:after {
            display: block;
        }

        /* Cart summary styles */
        .cart-summary {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .cart-summary ul {
            list-style: none;
            padding: 0;
            margin: 0 0 20px 0;
        }

        .cart-summary li {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #dee2e6;
        }

        .cart-summary li:last-child {
            border-bottom: none;
            font-weight: 600;
            font-size: 18px;
        }

        /* Checkout button styles */
        #checkout-button {
            width: 100%;
            padding: 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        #checkout-button:hover {
            background-color: #218838;
        }

        /* Remove selected items button */
        #remove-selected-items {
            margin-top: 15px;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .cart-list {
                font-size: 14px;
            }

            .thumb_cart h5 {
                font-size: 14px;
            }

            .quantity-input {
                width: 50px;
            }

            .cart-summary li {
                font-size: 14px;
            }
        }
    </style>
    <div class="container margin_30">
        <!-- <div class="page_header">                                                                   <h1 style="color: #5a5ac9; margin-bottom: 30px">Giỏ Hàng</h1>                                                                </div> -->
        {{-- <nav style="margin-bottom:8vh" class="breadcrumb-section theme1 bg-primary pt-110 pb-110">
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
        </nav> --}}
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

            // Cache for selected items to avoid frequent DOM manipulation
            let selectedItemsCache = new Set();

            // Debounce function to limit the rate at which calculateTotal runs
            function debounce(func, wait) {
                let timeout;
                return function executedFunction(...args) {
                    const later = () => {
                        clearTimeout(timeout);
                        func(...args);
                    };
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                };
            }

            // Optimized calculate total function
            const calculateTotal = debounce(() => {
                let totalPrice = 0;
                let shipping = 0;
                selectedItemsCache.clear();

                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        const price = parseInt(checkbox.getAttribute('data-price'));
                        const itemId = checkbox.getAttribute('data-id');
                        selectedItemsCache.add(itemId);
                        totalPrice += price;
                    }
                });

                if (selectedItemsCache.size > 0) {
                    shipping = 30000;
                }

                totalPrice += shipping;

                // Update UI
                totalPriceEl.textContent = totalPrice.toLocaleString() + ' đ';
                shippingEl.textContent = shipping.toLocaleString() + ' đ';
                removeButton.style.display = selectedItemsCache.size > 0 ? 'inline-block' : 'none';

                // Batch DOM updates for forms
                updateFormInputs();
            }, 150); // Debounce delay of 150ms

            // Separate function to handle form input updates
            function updateFormInputs() {
                // Remove existing inputs
                removeMultipleForm.querySelectorAll('input[name="remove_items[]"]').forEach(input => input
                    .remove());
                checkoutForm.querySelectorAll('input[name="checkout_items[]"]').forEach(input => input.remove());

                // Create document fragment for better performance
                const removeFragment = document.createDocumentFragment();
                const checkoutFragment = document.createDocumentFragment();

                selectedItemsCache.forEach(itemId => {
                    const removeInput = document.createElement('input');
                    removeInput.type = 'hidden';
                    removeInput.name = 'remove_items[]';
                    removeInput.value = itemId;
                    removeFragment.appendChild(removeInput);

                    const checkoutInput = document.createElement('input');
                    checkoutInput.type = 'hidden';
                    checkoutInput.name = 'checkout_items[]';
                    checkoutInput.value = itemId;
                    checkoutFragment.appendChild(checkoutInput);
                });

                // Batch append
                removeMultipleForm.appendChild(removeFragment);
                checkoutForm.appendChild(checkoutFragment);
            }

            // Select all functionality
            selectAllButton.addEventListener('click', function() {
                const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);
                checkboxes.forEach(checkbox => checkbox.checked = !allChecked);
                calculateTotal();
            });

            // Quantity update handler
            function checkMaxQuantity(itemId, inputQuantity) {
                const itemElement = document.querySelector(`.item-checkbox[data-id="${itemId}"]`);
                const maxQuantity = parseInt(itemElement.getAttribute('data-max-quantity'));
                const quantity = parseInt(inputQuantity.value);

                if (quantity > maxQuantity) {
                    toastr.error(`Số lượng tối đa cho sản phẩm này là ${maxQuantity}`);
                    inputQuantity.value = maxQuantity;
                    return false;
                }
                return true;
            }

            // Update cart event handlers
            updateButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const itemId = this.getAttribute('data-id');
                    const quantityInput = document.querySelector(
                        `input.quantity-input[data-item-id="${itemId}"]`);

                    if (checkMaxQuantity(itemId, quantityInput)) {
                        const data = {
                            quantity: quantityInput.value,
                            _token: document.querySelector('meta[name="csrf-token"]').content
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
                                    toastr.error(data.message);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                toastr.error('Có lỗi xảy ra, vui lòng thử lại.');
                            });
                    }
                });
            });

            // Checkbox change events
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', calculateTotal);
            });

            // Initial calculation
            calculateTotal();
        });
    </script>

@endsection
