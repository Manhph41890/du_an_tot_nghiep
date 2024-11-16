<div class="modal-dialog modal-lg">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h3 class="modal-title">Chi tiết đánh giá</h3>
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
                                    <p><strong>Tên sản phẩm:</strong> {{ $post->san_phams?->ten_san_pham }}</p>
                                </div>
                                <div class="mb-3">
                                    <p><strong>Tên người dùng:</strong> {{ $post->users?->ho_ten }}</p>
                                </div>
                                <div class="mb-3">
                                    <p><strong>Ngày đánh giá:</strong> {{ $post->ngay_danh_gia }}</p>
                                </div>
                                <div class="mb-3">
                                    <p><strong>Đánh giá:</strong>
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $post->diem_so)
                                                <i class="mdi mdi-star text-warning"></i>
                                            @else
                                                <i class="mdi mdi-star-outline text-muted"></i>
                                            @endif
                                        @endfor
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <p><strong>Bình luận:</strong> {{ $post->binh_luan }}</p>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
