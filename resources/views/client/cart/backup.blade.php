@extends('client.layout')

@section('content')
    <style>
        .cart-wrapper {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin: 20px auto;
            max-width: 1200px;
        }

        .cart-table {
            overflow-x: auto;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .cart-list {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            table-layout: fixed;
        }

        .cart-list th,
        .cart-list td {
            padding: 15px;
            border: 1px solid #ddd;
        }



        .cart-list th:nth-child(3),
        .cart-list td:nth-child(3) {
            width: 10%;
            word-wrap: break-word;
            text-align: left;
        }

        .cart-list th:nth-child(5),
        .cart-list td:nth-child(5) {
            width: 16%;
            word-wrap: break-word;
            text-align: left;
        }

        .cart-list th:nth-child(6),
        .cart-list td:nth-child(6) {
            width: 10%;
            word-wrap: break-word;
            text-align: left;
        }




        .cart-list th:nth-child(1),
        /* Header của cột "Chọn" */
        .cart-list td:nth-child(1) {
            /* Dữ liệu của cột "Chọn" */
            width: 5%;
            /* Đặt độ rộng nhỏ */
            text-align: center;
            /* Căn giữa nội dung */
            padding: 5px;
            /* Giảm padding để nhỏ gọn hơn */
        }

        cart-list th:nth-child(2),
        /* Header của cột "Chọn" */
        .cart-list td:nth-child(2) {
            /* Dữ liệu của cột "Chọn" */
            width: 40%;
            /* Đặt độ rộng nhỏ */
            text-align: center;
            /* Căn giữa nội dung */
            /* Giảm padding để nhỏ gọn hơn */
        }


        .cart-list th {
            background-color: #f8f8f8;
            color: #333;
            font-weight: bold;
            text-transform: uppercase;
        }

        .cart-list tbody tr:hover {
            background-color: #f2f2f2;
        }

        .thumb_cart {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .thumb_cart img {
            border-radius: 8px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .cart-summary {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            background-color: #fff;
            max-width: 400px;
            margin-left: auto;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .cart-summary ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .cart-summary li {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .cart-summary button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .cart-summary button:hover {
            background-color: #0056b3;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .cart-wrapper {
                flex-direction: column;
                gap: 15px;
            }

            .cart-summary {
                max-width: 100%;
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
                                    <!-- Nút Chọn Tất Cả -->
                                    <button type="button" style="background-color: none;" id="select-all"><input
                                            type="checkbox"></button>
                                </th>
                                <th>Sản phẩm</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Giá biến thể</th>
                                <th>Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($cartItems))
                                @foreach ($cartItems as $item)
                                    <tr>
                                        <td style="padding-top: 30px">
                                            <input type="checkbox" class="item-checkbox" data-price="{{ $item->price }}"
                                                data-id="{{ $item->id }}" />
                                        </td>
                                        <td>
                                            <div class="thumb_cart" style="text-align: center;">
                                                <img src="{{ asset('/storage/' . $item->san_pham->anh_san_pham) }}"
                                                    alt="img" height="90px" width="90px"
                                                    style="object-fit: cover" />
                                                <div class="ms-3">
                                                    <h5> {{ $item->san_pham->ten_san_pham }}</h5>
                                                    <p class="small mb-0">
                                                        {{ $item->size->ten_size }}-{{ $item->color->ten_color }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="padding-top: 30px">
                                            <strong>{{ number_format($item->san_pham->gia_km, 0, ',', '.') }} đ</strong>
                                        </td>
                                        <td style="padding-top: 30px">
                                            <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                min="1" max="100" class="quantity-input"
                                                data-item-id="{{ $item->id }}" style="width: 60px; height: 30px;">
                                            <button style="height: 30px; margin-bottom: 4px" type="button"
                                                class="btn btn-primary btn-sm update-cart-btn"
                                                data-id="{{ $item->id }}">
                                                Cập nhật
                                            </button>
                                        </td>
                                        <td style="padding-top: 30px">
                                            <span>
                                                @php
                                                    // Tìm biến thể dựa trên size và color của item
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
                                                    <span>Chưa có giá biến thể</span>
                                                @endif
                                            </span>
                                        </td>
                                        <td style="padding-top: 30px">
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
                    <!-- Nút Xóa Sản Phẩm Đã Chọn -->
                    <button type="submit" class="btn btn-danger btn-sm" id="remove-selected-items"
                        style="display: none;">Xóa Sản Phẩm Đã Chọn</button> <!-- Ẩn mặc định -->

                </div>
            </form>
            <div class="cart-summary">
                <ul>
                    <li style="font-size: 16px">
                        <strong><span>Phí vận chuyển: </span><span id="shipping">0</span></strong>
                    </li>
                    <li style="font-size: 20px">
                        <strong><span>Tổng tiền cần thanh toán: </span><span class="text-danger"
                                id="total-price">0</span></strong>
                    </li>
                </ul>
                <form action="{{ route('cart.checkout') }}" method="POST" id="checkout-form">
                    @csrf
                    <input type="hidden" name="checkout_items[]" id="selected-items">
                    <button id="checkout-button" class="btn btn-primary ripple">Thanh toán ngay</button>
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
                        shipping = 30000; // 
                        totalPrice += price + shipping;
                    }
                });

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
