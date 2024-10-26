<div class="modal-dialog modal-xl">
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
                    <div class="container mt-2">
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="card mb-3">
                                    <div class="card-header d-flex justify-content-between">
                                        {{-- ----------- --}}
                                        <div class="">
                                            <h5>Mã Đơn Hàng: {{ $donhang->ma_don_hang }}</h5>
                                            <p>Ngày tạo: {{ $donhang->ngay_tao }}</p>
                                        </div>
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
                                                    $class = $statusClasses[$donhang->trang_thai] ?? 'bg-secondary';
                                                @endphp

                                                <span class="badge {{ $class }}">
                                                    {{ $donhang->trang_thai }}
                                                </span>
                                            </div>
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
                                                        <td><img src="{{ asset('/storage/' . $donhang->san_phams?->anh_san_pham) }}"
                                                                width="50px"></td>
                                                        <td>
                                                            {{ $donhang->san_phams?->ten_san_pham }}<br>
                                                            Màu:
                                                            {{ $donhang->bien_the_san_pham?->color?->ten_color ?? 'N/A' }}<br>
                                                            Size:
                                                            {{ $donhang->bien_the_san_pham?->size?->ten_size ?? 'N/A' }}
                                                        </td>
                                                        <td>{{ $donhang->chi_tiet_don_hangs->first()?->so_luong ?? 'N/A' }}
                                                        </td>
                                                        <td>{{ number_format($donhang->san_phams?->gia_km ?? 0, 0, ',', '.') }}
                                                            VND</td>
                                                        <td>{{ number_format($donhang->chi_tiet_don_hangs->first()?->thanh_tien ?? 0, 0, ',', '.') }}
                                                            VND</td>
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
                            <div class="col-lg-3">

                                <!-- Kiểm tra nếu trạng thái đơn hàng là 'Chờ xác nhận' -->
                                @if ($donhang->trang_thai == 'Chờ xác nhận')
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5>Xác nhận đơn hàng</h5>
                                            <p>Xác nhận đơn hàng để chuẩn bị hàng</p>
                                            <form action="{{ route('donhangs.confirm', $donhang->id) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="complete-button btn btn-primary">Xác nhận
                                                    đơn hàng</button>
                                            </form>
                                        </div>
                                    </div>
                                @endif

                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h5>Thông tin khách hàng</h5>
                                        <br>
                                        <h6>Khách hàng:</h6> {{ $donhang->user?->ho_ten }}
                                        <br>
                                        <p><strong>Tên người nhận:</strong> {{ $donhang->ho_ten }}</p>
                                        <p><strong>Email:</strong> {{ $donhang->email }}</p>
                                        <p><strong>Số điện thoại:</strong> {{ $donhang->so_dien_thoai }}</p>
                                        <p><strong>Địa chỉ giao hàng:</strong> {{ $donhang->dia_chi }}</p>
                                    </div>
                                </div>

                                <!-- Kiểm tra nếu trạng thái đơn hàng là 'Thành công' -->
                                @if ($donhang->trang_thai == 'Thành công')
                                    <div class="card">
                                        <div class="card-body">
                                            <h5>Đánh giá của khách hàng</h5>
                                            @if ($donhang->san_phams?->danh_gias->isNotEmpty())

                                                @foreach ($donhang->san_phams?->danh_gias as $danhGia)
                                                    <div class="d-flex justify-content-between">
                                                        <h6></h6>
                                                        <strong>{{ $danhGia->user?->ho_ten }}</strong>
                                                        <small><em>Đánh giá:
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    @if ($i <= $danhGia->diem_so)
                                                                        <i class="mdi mdi-star text-warning"></i>
                                                                        <!-- Ngôi sao đầy -->
                                                                    @else
                                                                        <i class="mdi mdi-star-outline text-muted"></i>
                                                                        <!-- Ngôi sao rỗng -->
                                                                    @endif
                                                                @endfor
                                                            </em></small>
                                                    </div>
                                                    <h6>Bình luận:</h6>
                                                    <textarea class="form-control" rows="3" readonly>{{ $danhGia->binh_luan }}</textarea>
                                                    <p class="text-muted">Ngày đánh giá:
                                                        {{ $danhGia->ngay_danh_gia }}</p>
                                                    </li>
                                                @endforeach
                                                </ul>
                                            @else
                                                <p>Chưa có đánh giá nào.</p>
                                            @endif
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
        </div>
    </div>

</div>
</div>

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
