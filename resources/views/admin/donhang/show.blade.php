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
                        <div class="card-body">
                            <form>
                                <!-- Order Information -->
                                <div class="form-group mb-3">
                                    <label for="order_id">Mã đơn hàng</label>
                                    <input type="text" name="order_id" value="{{ $donhang->id }}"
                                        class="form-control" readonly>
                                </div>
                                <th scope="col">Mã đơn hàng</th>
                                <th scope="col">Người đặt</th>
                                <th scope="col">Ngày tạo đơn hàng</th>
                                <th scope="col">Mã khuyến mại</th>
                                <th scope="col">Phương thức thanh toán</th>
                                <th scope="col">Phương thức vận chuyển</th>
                                <th scope="col">Tổng tiền</th>
                                <th scope="col">Người nhận hàng</th>
                                <th scope="col">Email nhận hàng</th>
                                <th scope="col">Số điện thoại nhận hàng</th>
                                <th scope="col">Địa chỉ nhận hàng</th>
                                <th scope="col">Trạng thái đơn hàng</th>
                                <th scope="col">Hành Động</th>

                                <div class="form-group mb-3">
                                    <label for="customer_name">Người đặt hàng</label>
                                    <input type="text" name="customer_name" value="{{ $donhang->user->ho_ten }}"
                                        class="form-control" readonly>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="created_at">Ngày tạo đơn hàng</label>
                                    <input type="text" name="created_at" value="{{ $donhang->ngay_tao }}"
                                        class="form-control" readonly>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="customer_name">Mã khuyến mại</label>
                                    <input type="text" name="customer_name" value="{{ $donhang->user->ho_ten }}"
                                        class="form-control" readonly>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="customer_name">Người đặt hàng</label>
                                    <input type="text" name="customer_name" value="{{ $donhang->user->ho_ten }}"
                                        class="form-control" readonly>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="phone">Số điện thoại</label>
                                    <input type="text" name="phone" value="{{ $donhang->so_dien_thoai }}"
                                        class="form-control" readonly>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="address">Địa chỉ giao hàng</label>
                                    <input type="text" name="address" value="{{ $donhang->dia_chi }}"
                                        class="form-control" readonly>
                                </div>


                                <div class="form-group mb-3">
                                    <label for="total_amount">Tổng tiền</label>
                                    <input type="text" name="total_amount"
                                        value="{{ number_format($donhang->tong_tien, 0, ',', '.') }} VND"
                                        class="form-control" readonly>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="order_status">Trạng thái đơn hàng</label>
                                    <input type="text" name="order_status" value="{{ $donhang->trang_thai }}"
                                        class="form-control" readonly>
                                </div>

                                <!-- Actions -->
                                <div class="mt-3">
                                    <a href="{{ route('donhangs.edit', $donhang->id) }}" class="btn btn-primary">Chỉnh
                                        sửa
                                        đơn hàng</a>
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Đóng</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
