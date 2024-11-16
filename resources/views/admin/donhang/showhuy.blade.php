<div class="row">
    <div class="col-12">
        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-9">
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between">
                            <div class="">
                                <h5>Mã Đơn Hàng: {{ $huyDat->don_hang->ma_don_hang }}</h5>
                                <p>Ngày tạo: {{ $huyDat->don_hang->ngay_tao }}</p>
                                <div class="">
                                    <div class="d-flex align-items-center">
                                        <p class="mb-0 me-2">Trạng thái đơn hàng:</p>
                                        @php
                                            $statusClasses = [
                                                'Chờ xác nhận' => 'bg-warning',
                                                'Đã xác nhận' => 'bg-info',
                                                'Đang chuẩn bị hàng' => 'bg-info',
                                                'Đang vận chuyển' => 'bg-info',
                                                'Đã giao' => 'bg-success',
                                                'Thành công' => 'bg-success',
                                                'Đã hủy' => 'bg-danger',
                                            ];
                                            $class =
                                                $statusClasses[$huyDat->don_hang->trang_thai_don_hang] ??
                                                'bg-secondary';
                                        @endphp

                                        <span class="badge {{ $class }}">
                                            {{ $huyDat->don_hang->trang_thai_don_hang }}
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center mt-3">
                                        <p class="mb-0 me-2">Trạng thái Thanh toán:</p>
                                        @php
                                            $statusClasses = [
                                                'Đã thanh toán' => 'bg-success',
                                                'Chưa thanh toán' => 'bg-danger',
                                            ];
                                            $class =
                                                $statusClasses[$huyDat->don_hang->trang_thai_thanh_toan] ??
                                                'bg-secondary';
                                        @endphp

                                        <span class="badge {{ $class }}">
                                            {{ $huyDat->don_hang->trang_thai_thanh_toan }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="me-5">
                                <h5>Lý do hủy của khách hàng:</h5>
                                <textarea name="" class="form-control" id="" cols="30" rows="3" readonly>{{ $huyDat->ly_do_huy }}</textarea>
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
                                        @if ($huyDat->don_hang->chi_tiet_don_hangs->isNotEmpty())
                                            @foreach ($huyDat->don_hang->chi_tiet_don_hangs as $chi_tiet)
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset('/storage/' . optional($chi_tiet->san_pham)->anh_san_pham) }}"
                                                            width="50px" alt="Product Image">
                                                    </td>
                                                    <td>
                                                        {{ optional($chi_tiet->san_pham)->ten_san_pham ?? 'N/A' }}<br>
                                                        Màu:
                                                        {{ optional($chi_tiet->color_san_pham)->ten_color ?? 'N/A' }}<br>
                                                        Size:
                                                        {{ optional($chi_tiet->size_san_pham)->ten_size ?? 'N/A' }}
                                                    </td>
                                                    <td>{{ number_format($chi_tiet->gia_tien, 0, ',', '.') }}
                                                        VND</td>
                                                    <td>{{ $chi_tiet->so_luong }}</td>
                                                    <td>{{ number_format($chi_tiet->thanh_tien, 0, ',', '.') }}
                                                        VND</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <div class="mb-3">
                                <p><strong>Mã khuyến mãi</strong>:
                                    {{ $huyDat->don_hang->khuyen_mai?->ten_khuyen_mai }} -
                                    {{ $huyDat->don_hang->khuyen_mai?->ma_khuyen_mai }}</p>
                                <p><strong>Phương thức vận chuyển</strong>:
                                    {{ $huyDat->don_hang->phuong_thuc_van_chuyen?->kieu_van_chuyen }}</p>
                                <p><strong>Phương thức thanh toán</strong>:
                                    {{ $huyDat->don_hang->phuong_thuc_thanh_toan?->kieu_thanh_toan }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <p><strong class="pe-1">Tổng tiền sản phẩm</strong>
                                {{ number_format($huyDat->don_hang->chi_tiet_don_hangs->sum('thanh_tien'), 0, ',', '.') }}
                                VND
                            </p>
                            <p><strong class="pe-1">Giảm giá:</strong>
                                {{ number_format($huyDat->don_hang->khuyen_mai?->gia_tri_khuyen_mai ?? 0, 0, ',', '.') }}
                                VND
                            </p>
                            <p><strong class="pe-1">Vận chuyển:</strong>
                                {{ number_format($huyDat->don_hang->phuong_thuc_van_chuyen?->gia_ship ?? 0, 0, ',', '.') }}
                                VND
                            </p>
                            <p class="order-summary pe-1">Tổng giá trị đơn hàng:
                                {{ number_format($huyDat->don_hang->tong_tien, 0, ',', '.') }} VND</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    @if ($huyDon->trang_thai == 'Chờ xác nhận hủy')
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5>Xác nhận hoặc từ chối hủy đơn hàng</h5>
                                <!-- Form xác nhận hủy -->
                                <form action="{{ route('huydonhang.confirm', $huyDon->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Xác nhận hủy</button>
                                </form><br>
                                <!-- Form từ chối hủy -->
                                <form action="{{ route('huydonhang.reject', $huyDon->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Từ chối hủy</button>
                                </form>
                            </div>
                        </div>
                    @elseif ($huyDon->trang_thai == 'Xác nhận hủy' || $huyDon->trang_thai == 'Từ chối hủy')
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5>Đã duyệt</h5>
                                <p>{{ $huyDon->trang_thai }}</p>
                            </div>
                        </div>
                    @else
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5>Trạng thái không hợp lệ</h5>
                            </div>
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const badge = document.querySelector('.badge.bg-danger');
        if (badge) {
            badge.style.display = "none";
            // Gửi AJAX để lưu trạng thái đã xem
            fetch("{{ route('markPendingAsViewed') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json",
                },
            });
        }
    });
</script>

<style>
    .modal-backdrop.show.nested-modal {
        z-index: 1055;
    }

    .modal.nested-modal {
        z-index: 1060;
    }

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
