<!-- Modal Header -->
<div class="modal-header">
    <h3 class="modal-title">Chi tiết đánh giá</h3>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<!-- Modal body -->
<div class="modal-body">
    <div class="row">
        <div class="col-12">

            <div class="mb-4">
                <p class="mb-1 fw-bold">Ảnh đánh giá:</p>
                @if ($danhgia->img)
                    <img src="{{ asset('storage/uploads/danhgias/' . $danhgia->img) }}" class="img-fluid rounded"
                        alt="Ảnh đánh giá" style="max-width: 250px;">
                @else
                    <p class="text-muted fst-italic">Không có ảnh</p>
                @endif
            </div>

            <div class="mb-4">
                <p class="mb-1 fw-bold">Đánh giá:</p>
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $danhgia->diem_so)
                        <i class="mdi mdi-star text-warning fs-5"></i>
                    @else
                        <i class="mdi mdi-star-outline text-muted fs-5"></i>
                    @endif
                @endfor
            </div>

            <div class="mb-4">
                <p class="mb-1 fw-bold">Bình luận:</p>
                <p class="text-secondary border rounded p-2 bg-light">{{ $danhgia->binh_luan }}</p>
            </div>
            <div class="mb-4">
                <p class="mb-1 fw-bold">Ngày đánh giá:</p>
                <p class="text-secondary">{{ $danhgia->ngay_danh_gia }}</p>
            </div>
            <div class="mb-4">
                <p class="mb-1 fw-bold">Tên sản phẩm:</p>
                <a href="{{ route('sanpham.chitiet', $danhgia->san_phams->id) }}"
                    class="text-primary text-decoration-underline">
                    {{ $danhgia->san_phams?->ten_san_pham }}
                </a>
            </div>

            <div class="mb-4">
                <p class="mb-1 fw-bold">Tên người dùng:</p>
                <p class="text-secondary">{{ $danhgia->users?->ho_ten }}</p>
            </div>

        </div>
    </div>
</div>
