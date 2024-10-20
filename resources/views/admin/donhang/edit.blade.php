<div class="modal-dialog modal-lg">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h3 class="modal-title">Cập nhật trạng thái đơn hàng</h3>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal Body -->
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('donhangs.update', $donhang->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group mb-3">
                                    <label for="trang_thai">Trạng thái đơn hàng</label>
                                    <select name="trang_thai" class="form-control" id="trang_thai">
                                        <option value="Chờ xác nhận"
                                            {{ $donhang->trang_thai == 'Chờ xác nhận' ? 'selected' : '' }}>Chờ xác nhận
                                        </option>
                                        <option value="Đã xác nhận"
                                            {{ $donhang->trang_thai == 'Đã xác nhận' ? 'selected' : '' }}>Đã xác nhận
                                        </option>
                                        <option value="Đang chuẩn bị hàng"
                                            {{ $donhang->trang_thai == 'Đang chuẩn bị hàng' ? 'selected' : '' }}>Đang
                                            chuẩn bị hàng</option>
                                        <option value="Đang vận chuyển"
                                            {{ $donhang->trang_thai == 'Đang vận chuyển' ? 'selected' : '' }}>Đang vận
                                            chuyển</option>
                                        <option value="Đã giao"
                                            {{ $donhang->trang_thai == 'Đã giao' ? 'selected' : '' }}>Đã giao</option>
                                        <option value="Thành công"
                                            {{ $donhang->trang_thai == 'Thành công' ? 'selected' : '' }}>Thành công
                                        </option>
                                        <option value="Đã hủy" {{ $donhang->trang_thai == 'Đã hủy' ? 'selected' : '' }}>
                                            Đã hủy</option>
                                    </select>
                                </div>

                                <!-- Actions -->
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
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
