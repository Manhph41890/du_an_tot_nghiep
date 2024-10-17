<div class="modal-dialog modal-lg">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h3 class="modal-title">Chi tiết user</h3>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        {{-- <div class="card-header">
                            <h5 class="card-title mb-0"></h5>
                        </div><!-- end card header --> --}}

                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <p><strong>Chức vụ:</strong> {{ $post->chuc_vu?->ten_chuc_vu }}</p>
                                </div>
                                <div class="mb-3">
                                    <p><strong>Họ và tên:</strong> {{ $post->ho_ten }}</p>
                                </div>
                                <div class="mb-3">
                                    <p><strong>Ảnh đại diện:</strong> {{ $post->anh_dai_dien }}</p>
                                </div>
                                <div class="mb-3">
                                    <p><strong>Email:</strong> {{ $post->email }}</p>
                                </div>
                                <div class="mb-3">
                                    <p><strong>Số Điện Thoại:</strong> {{ $post->so_dien_thoai }}</p>
                                </div>
                                <div class="mb-3">
                                    <p><strong>Ngày sinh:</strong> {{ $post->ngay_sinh }}</p>
                                </div>
                                <div class="mb-3">
                                    <p><strong>Địa chỉ:</strong> {{ $post->dia_chi }}</p>
                                </div>
                                <div class="mb-3">
                                    <p><strong>Giới tính:</strong> {{ $post->gioi_tinh }}</p>
                                </div>
                                <div class="mb-3">
                                    {{-- <p><strong>Mật khẩu:</strong> {{ $post->password }}</p> --}}
                                    <p><strong>Mật khẩu:</strong> {{ str_repeat('*', 8) }}</p>
                                </div>
                                <div class="mb-3">
                                    <p><strong>Trạng thái:</strong> {{ $post->is_active }}</p>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
