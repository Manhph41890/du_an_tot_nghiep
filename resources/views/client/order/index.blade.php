@extends('client.layout')


@section('content')
    <!-- breadcrumb-section start -->
    <nav class="breadcrumb-section theme1 bg-lighten2 pt-110 pb-110">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title pb-4 text-dark text-capitalize">check out</h2>
                    </div>
                </div>
                <div class="col-12">
                    <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">check out</li>
                    </ol>
                </div>
            </div>
        </div>
    </nav>
    <!-- breadcrumb-section end -->

    <!-- checkout area start -->
    <div class="container my-4">
        <h3>Địa Chỉ Nhận Hàng</h3>
        <div class="d-flex align-items-center mb-3">
            <span>Nguyễn Hồng An</span>
            <button class="btn btn-outline-danger btn-sm ms-2">Mặc định</button>
            <a href="#" class="ms-auto text-decoration-none">Thay Đổi</a>
        </div>

        <!-- Sản phẩm -->
        <div class="col-12">
            <h3 class="title mb-30 pb-10 text-capitalize">Sản phẩm của bạn</h3>
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center" scope="col">Ảnh sản phẩm</th>
                            <th class="text-center" scope="col">Tên sản phẩm</th>
                            <th class="text-center" scope="col">Màu sắc</th>
                            <th class="text-center" scope="col">Kích thước</th>
                            <th class="text-center" scope="col">Giá</th>
                            <th class="text-center" scope="col">Số lượng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="text-center" scope="row">
                                <img src="assets/img/product/4.png" alt="img" />
                            </th>
                            <td class="text-center">
                                <span class="whish-title">Originals Kaval nail polish</span>
                            </td>
                            <td class="text-center">
                                <!-- Thêm Màu sắc -->
                                <span class="badge badge-primary">Xanh dương</span>
                            </td>
                            <td class="text-center">
                                <!-- Thêm Kích thước -->
                                <span>Medium</span>
                            </td>
                            <td class="text-center">
                                <span class="whish-list-price"> $38.24 </span>
                            </td>
                            <td class="text-center">
                                <input type="number" min="1" max="10" step="1" value="1" /readonly>
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Ghi chú và đơn vị vận chuyển -->
        <div class="order-summary mt-4">
            <div class="d-flex justify-content-between">
                <h6>Phương thức vận chuyển:</h6>
                <select name="" id="">
                    <option value="">Chọn phương thức vận chuyển</option>
                </select>
            </div>
        </div>

        <!-- Shopee Voucher và Shopee Xu -->
        <div class="order-summary mt-4">
            <div class="d-flex justify-content-between">
                <h6>Voucher giảm giá</h6>
                <select name="" id="">
                    <option value="">Chọn voucher giảm giá</option>
                </select>
            </div>
        </div>

        <!-- Phương thức thanh toán -->
        <div class="order-summary mt-4">
            <div class="d-flex justify-content-between">
                <h6>Phương thức thanh toán</h6>
                <select name="" id="">
                    <option value="">Chọn phương thức thanh toán</option>
                </select>
            </div>
        </div>

        <!-- Tổng cộng -->
        <div class="order-summary mt-4">
            <div class="d-flex justify-content-between">
                <span>Tổng tiền hàng:</span>
                <span>44,390,000₫</span>
            </div>
            <div class="d-flex justify-content-between">
                <span>Voucher giảm giá:</span>
                <span>107,999₫</span>
            </div>
            <div class="d-flex justify-content-between">
                <span>Phí vận chuyển:</span>
                <span>22,200₫</span>
            </div>
            <hr>
            <div class="d-flex justify-content-between order-total">
                <span>Tổng thanh toán:</span>
                <span>44,520,199₫</span>
            </div>
        </div>

        <!-- Nút Đặt hàng -->
        <div class="text-center mt-4">
            <button class="btn btn-place-order w-100">Đặt Hàng</button>
        </div>
    </div>
    <style>
        .order-summary {
            background-color: #f5f5f5;
            padding: 20px;
            margin-top: 20px;
            border-radius: 5px;
        }

        .order-total {
            font-size: 1.5rem;
            color: #ee4d2d;
            font-weight: bold;
        }

        .btn-place-order {
            background-color: #ee4d2d;
            color: #fff;
            border: none;
            font-weight: bold;
            padding: 10px 20px;
        }

        .btn-place-order:hover {
            background-color: #d03925;
        }
    </style>
    <!-- checkout area end -->
@endsection
