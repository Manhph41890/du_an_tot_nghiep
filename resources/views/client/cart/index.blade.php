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
            will-change: transform;
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
                @auth
                    <ul>
                        <li>
                            <span>Phí vận chuyển:</span>
                            <span id="shipping">0 đ</span>
                        </li>
                        <li>
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                Danh sách mã
                            </button>

                            <!-- The Modal -->
                            <div class="modal" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header bg-light border-bottom-0">
                                            <h4 class="modal-title text-dark fw-bold">Danh sách mã khuyến mãi</h4>
                                            <button type="button" class="btn-close text-secondary"
                                                data-bs-dismiss="modal"></button>
                                        </div>



                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <div class="discounts-container">
                                                @foreach ($maKhuyenMai as $item)
                                                    <div class="discount-item"
                                                        style="background: repeating-linear-gradient(#ffffff, #ffffff 5px, transparent 0, transparent 9px, #ffffff 0, #ffffff 10px) 0 / 1px 100% no-repeat, radial-gradient(circle at 0 7px, transparent, transparent 2px, #ffffffee 0, #ffffff 3px, #f6f6f6 0) 1px 0 / 100% 10px repeat-y">
                                                        <div class="discount-icon">
                                                            <img src="https://bizweb.dktcdn.net/thumb/medium/100/210/055/themes/941368/assets/coupon_1_img.png?1726708982386"
                                                                alt="Discount Icon">
                                                        </div>
                                                        <div class="discount-content">

                                                            <div class="discount-code zigzag">

                                                                <span class="code">{{ $item->ten_khuyen_mai }}</span>
                                                            </div>


                                                            <div class="discount-description">
                                                                <p>
                                                                    Giảm <span
                                                                        class="text-danger">{{ number_format($item->gia_tri_khuyen_mai, 0, ',', '.') }}</span>
                                                                    VNĐ cho tất cả các sản phẩm.
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <button class="copy-btn"
                                                            onclick="copyCode('{{ $item->ma_khuyen_mai }}')">Sao chép </button>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <!-- Modal -->
                                            <div id="copyModal" class="copy-modal">
                                                <div class="modal-content">
                                                    <p id="copyMessage">Mã giảm giá đã được sao chép!</p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
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
                @endauth

                @guest
                    <a href="{{ route('auth.login') }}" class="btn btn-primary" id="checkout-button">
                        <i class="fas fa-shopping-cart"></i> Đăng nhập
                    </a>
                @endguest
            </div>
        </div>

    </div>

    <script>
        function copyCode(code) {
            var tempInput = document.createElement("input");
            tempInput.value = code;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);
            showCopyModal("Mã giảm giá đã được sao chép: " + code);

        }

        function showCopyModal(message) {
            var modal = document.getElementById("copyModal");
            var modalMessage = document.getElementById("copyMessage");

            modalMessage.textContent = message;

            modal.classList.add("show");

            setTimeout(function() {
                modal.classList.remove("show");
            }, 3000);
        }
    </script>
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
