<div class="modal-dialog modal-lg">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h3 class="modal-title">Chi tiết bài viết</h3>
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
                                    <label for="anh_bai_viet" class="form-label">Hình ảnh bài viết </label>
                                    <div class="mt-2">
                                        @if ($post->anh_bai_viet)
                                            <img id="imagePreview" src="{{ asset('storage/' . $post->anh_bai_viet) }}"
                                                alt="Hình ảnh" style="width: 200px;">
                                        @else
                                            <img id="imagePreview" src="#" alt="Hình ảnh"
                                                style="display: none; width: 200px;">
                                        @endif
                                    </div>

                                </div>

                                <div class="form-group mb-3">
                                    <label for="tieu_de_bai_viet">Tiêu đề bài viết</label>
                                    <input type="text" name="tieu_de_bai_viet" value="{{ $post->tieu_de_bai_viet }}"
                                        class="form-control" readonly>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="noi_dung">Nội dung</label>
                                    <textarea type="text" name="noi_dung" class="form-control" readonly>{{ $post->noi_dung }}</textarea>

                                    <div class="mb-3">
                                        <label for="user_id" class="form-label">Tác giả</label>
                                        <input type="text" name="user_id" value="{{ $baiviet->user?->ho_ten }}"
                                            class="form-control" readonly>
                                    </div>

                                    <div class="form-group  mb-3">
                                        <label for="ngay_dang">Ngày Đăng:</label>
                                        <input type="date" name="ngay_dang" value="{{ $post->ngay_dang }}"
                                            class="form-control" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label for="is_active" class="form-label ">Trạng thái</label>
                                        <input
                                            class="{{ $post->is_active == 0 ? 'text-success' : 'text-danger' }} form-control"
                                            value="{{ $post->is_active == 0 ? 'Hiển Thị' : 'Ẩn' }}" readonly>
                                    </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
