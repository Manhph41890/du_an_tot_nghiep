<div class="modal-dialog modal-lg">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h3 class="modal-title">Chi tiết đơn hàng</h3>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal Body -->
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="container mt-2">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="card mb-3">
                                        <div class="card-header d-flex justify-content-between">
                                            {{-- ----------- --}}
                                            <div class="">
                                                <h5>Đơn Hàng: Fujitora {{ $donhang->id }}</h5>
                                                <p>Ngày tạo: {{ $donhang->ngay_tao }}</p>
                                            </div>
                                            <div class="">
                                                <p>Trạng thái đơn hàng:</p>
                                                <button class="complete-button">{{ $donhang->trang_thai }}</button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="order-summary mb-1">Tất Cả Sản Phẩm</h5>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Hình ảnh</th>
                                                            <th>Sản phẩm</th>
                                                            <th>Số Lượng</th>
                                                            <th>Giá</th>
                                                            <th>Thành Tiền</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><img src="path-to-image.jpg" alt="Product Image"
                                                                    width="50"></td>
                                                            <td> {{ $donhang->san_pham?->ten_san_pham }}<br>Màu: Đỏ
                                                                Size: M</td>
                                                            <td>12</td>
                                                            <td>1,234 VND</td>
                                                            <td>1,111,111 VND</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="mb-3">
                                                {{-- ----------- --}}
                                                <p><strong>Mã khuyến mãi</strong>:
                                                    {{ $donhang->khuyen_mai?->ten_khuyen_mai }}</p>
                                                <p><strong>Phương thức vận chuyển</strong>:
                                                    {{ $donhang->phuong_thuc_van_chuyen?->kieu_van_chuyen }}</p>
                                                <p><strong>Phương thức thanh toán</strong>:
                                                    {{ $donhang->phuong_thuc_thanh_toan?->kieu_thanh_toan }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-body">
                                            <p><strong>Số lượng sản phẩm:</strong> 12</p>
                                            <p><strong>Tổng tiền hàng:</strong> 1,111,111 VND</p>
                                            <p><strong>Giảm giá:</strong> -21,234 VND</p>
                                            <p><strong>Vận chuyển:</strong> 20,000 VND</p>
                                            <p class="order-summary">Tổng giá trị đơn hàng:
                                                {{ number_format($donhang->tong_tien, 0, ',', '.') }} VND</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5>Xác nhận đơn hàng</h5>
                                            <p>Xác nhận đơn hàng để chuẩn bị hàng</p>
                                            <button class="complete-button">Xác nhận đơn hàng</button>
                                        </div>
                                    </div>

                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5>Thông tin khách hàng</h5>
                                            <br>
                                            <h6>Khác hàng:</strong> {{ $donhang->user?->ho_ten }}</h6>
                                            <br>
                                            <p><strong>Tên người nhận:</strong> {{ $donhang->ho_ten }}</p>
                                            <p><strong>Email:</strong> {{ $donhang->email }}</p>
                                            <p><strong>Số điện thoại:</strong> {{ $donhang->so_dien_thoai }}</p>
                                            <p><strong>Địa chỉ giao hàng:</strong> {{ $donhang->dia_chi }}</p>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-body">
                                            <h5>Đánh giá của khách hàng</h5>
                                            <p>Chưa có đánh giá nào.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('donhangs.edit', $donhang->id) }}" class="btn btn-primary">Chỉnh
                            sửa
                            đơn hàng</a>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    .order-status {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        border-radius: 5px;
        padding: 5px 10px;
    }

    .order-summary {
        font-weight: bold;
    }

    .complete-button {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 5px;
        cursor: pointer;
    }

    .complete-button:hover {
        background-color: #218838;
    }
</style>
