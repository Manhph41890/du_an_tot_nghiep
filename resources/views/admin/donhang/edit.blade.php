<div class="modal-dialog modal-lg">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h3 class="modal-title">Cập nhật trạng thái đơn hàng</h3>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal Body -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @error('trang_thai_don_hang')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="mt-3">
                            @php
                                // Các trạng thái cố định
                                $allStatuses = [
                                    'Chờ xác nhận',
                                    'Đã xác nhận',
                                    'Đang chuẩn bị hàng',
                                    'Đang vận chuyển',
                                    'Đã giao',
                                    'Thành công',
                                    'Đã hủy',
                                ];

                                // Lấy chỉ số của trạng thái hiện tại
                                $currentIndex = array_search($donhang->trang_thai_don_hang, $allStatuses);
                                $nextStatus =
                                    $currentIndex !== false && $currentIndex < count($allStatuses) - 1
                                        ? $allStatuses[$currentIndex + 1]
                                        : null;
                            @endphp

                            @if ($nextStatus)
                                <form action="{{ route('donhangs.update', $donhang->id) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('PUT')
                                    @if ($donhang->trang_thai_don_hang == 'Đã giao' || $donhang->trang_thai_don_hang == 'Thành công')
                                        <p>Không thể chuyển trạng thái thêm nữa.</p>
                                    @else
                                        <input type="hidden" name="trang_thai_don_hang" value="{{ $nextStatus }}">
                                        <button type="submit" class="btn btn-primary">
                                            Chuyển sang "{{ $nextStatus }}"
                                        </button>
                                    @endif
                                </form>
                            @else
                                <p>Không thể chuyển trạng thái thêm nữa.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
