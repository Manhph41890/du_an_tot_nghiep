@extends('client.layout')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- breadcrumb-section start -->
    <nav class="breadcrumb-section theme1 bg-lighten2 pt-110 pb-110">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title pb-4 text-dark text-capitalize">Giỏ Hàng</h2>
                    </div>
                </div>
                <div class="col-12">
                    <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
                        <li class="breadcrumb-item"><a href="">Trang Chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Giỏ Hàng</li>
                    </ol>
                </div>
            </div>
        </div>
    </nav>
    <!-- breadcrumb-section end -->

    <!-- product tab start -->
    <section class="whish-list-section theme1 pt-80 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="title mb-30 pb-25 text-capitalize">Sản phẩm của bạn</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center" scope="col">Ảnh sản phẩm</th>
                                    <th class="text-center" scope="col">Tên sản phẩm</th>
                                    <th class="text-center" scope="col">Phân Loại</th>
                                    <th class="text-center" scope="col">Tình trạng</th>
                                    <th class="text-center" scope="col">Số lượng</th>
                                    <th class="text-center" scope="col">Giá</th>
                                    <th class="text-center" scope="col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($cartItems->isNotEmpty())
                                    @foreach ($cartItems as $item)
                                        <tr>
                                            <th class="text-center" scope="row">
                                                <img src="{{ asset('/storage/' . $item->san_pham->anh_san_pham) }}"
                                                    alt="img" />
                                            </th>
                                            <td class="text-center">
                                                <span class="whish-title">{{ $item->san_pham->ten_san_pham }}</span>
                                            </td>
                                            <td class="text-center">
                                                {{-- form cập nhât đây nha --}}
                                                <form action="{{ route('cart.update', $item->id) }}" method="POST"
                                                    class="update-cart-form" data-id="{{ $item->id }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <select name="size_san_pham_id" class="size-select" required>
                                                        @foreach ($item->san_pham->bien_the_san_phams as $variant)
                                                            <option value="{{ $variant->size->id }}"
                                                                {{ $variant->size->id == $item->size_san_pham_id ? 'selected' : '' }}>
                                                                {{ $variant->size->ten_size }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    <select name="color_san_pham_id" class="color-select" required>
                                                        @foreach ($item->san_pham->bien_the_san_phams as $variant)
                                                            <option value="{{ $variant->color->id }}"
                                                                {{ $variant->color->id == $item->color_san_pham_id ? 'selected' : '' }}>
                                                                {{ $variant->color->ten_color }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @php
                                                        // Giới hạn quantity <= số lượng sản phẩm
                                                        $bienThe = $item->san_pham->bien_the_san_phams
                                                            ->where('size_san_pham_id', $item->size_san_pham_id)
                                                            ->where('color_san_pham_id', $item->color_san_pham_id)
                                                            ->first();
                                                        $maxQuantity = $bienThe ? $bienThe->so_luong : 1;
                                                    @endphp
                                                    <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                        min="1" max="{{ $maxQuantity }}" class="quantity-input">

                                                    @if (
                                                        $errors->has('quantity') &&
                                                            $errors->first('quantity') == 'Số lượng không được vượt quá ' . $maxQuantity . ' sản phẩm.')
                                                        <div class="text-danger">{{ $errors->first('quantity') }}</div>
                                                    @endif
                                                    <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
                                                </form>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-danger position-static">Còn hàng</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="whish-title">{{ $item->quantity }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span
                                                    class="whish-list-price">{{ number_format($item->price, 0, ',', '.') }}
                                                    đ</span>
                                            </td>
                                            <td class="text-center">
                                                <form action="{{ route('cart.removeFromCart', $item->id) }}" method="POST"
                                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng không?');">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <span class="trash"><i class="fas fa-trash-alt"></i> Xóa</span>

                                                    </button>

                                                </form>
                                                <button type="submit" class="btn btn-info btn-sm">
                                                    <span class="trash"><i class="fa-solid fa-check"></i> Thanh
                                                        Toán</span>

                                                </button>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product tab end -->

    <div class="check-out-section pb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mt-4 mt-lg-0">
                    <div class="your-order-area">
                        <div class="your-order-wrap gray-bg-4">
                            <div class="your-order-product-info">
                                <div class="your-order-top">
                                    <ul>
                                        <li>Sản Phẩm</li>
                                        <li>Total</li>
                                    </ul>
                                </div>
                                <div class="your-order-total mb-0">
                                    <ul>
                                        <li class="order-total">Tổng cộng</li>
                                        <li>
                                            @php
                                                $totalPrice = 0; // Khởi tạo biến tổng giá
                                                foreach ($cartItems as $item) {
                                                    $totalPrice += $item->price * $item->quantity; // Cộng dồn giá của từng sản phẩm
                                                }
                                            @endphp
                                            {{ number_format($totalPrice, 0, ',', '.') . ' đ' }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="Place-order mt-25">
                            <a class="btn btn--lg btn-primary me-3" href="#">Cập nhật giỏ hàng</a>
                            <a class="btn btn--lg btn-primary my-2 my-sm-0" href="#">Thanh toán</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // 
        $('.remove-cart-item').on('click', function(e) {
            e.preventDefault();
            var cartItemId = $(this).data('id');

            $.ajax({
                url: '/cart/items/' + cartItemId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert(response.message);
                    // Cập nhật giao diện người dùng (xóa item khỏi danh sách)
                },
                error: function(xhr) {
                    alert('Có lỗi xảy ra! ' + xhr.responseJSON.message);
                }
            });
        });
    </script>
@endsection
