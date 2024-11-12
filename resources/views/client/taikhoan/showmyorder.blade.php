<div class="modal-dialog modal-xl">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h3 class="modal-title">Chi tiết đơn hàng</h3>
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
                                            <div class="">
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
                                                        $statusClasses[$donhang->trang_thai_don_hang] ?? 'bg-secondary';
                                                @endphp

                                                <span class="badge {{ $class }}">
                                                    {{ $donhang->trang_thai_don_hang }}
                                                </span>
                                            </div>
                                            <div class="mt-3">
                                                <p class="mb-0 me-2">Trạng thái Thanh toán:</p>
                                                @php
                                                    $statusClasses = [
                                                        'Đã thanh toán' => 'bg-success',
                                                        'Chưa thanh toán' => 'bg-danger',
                                                    ];
                                                    $class =
                                                        $statusClasses[$donhang->trang_thai_thanh_toan] ??
                                                        'bg-secondary';
                                                @endphp

                                                <span class="badge {{ $class }}">
                                                    {{ $donhang->trang_thai_thanh_toan }}
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
                                                    @foreach ($donhang->chi_tiet_don_hangs as $chi_tiet)
                                                        <tr>
                                                            <td>
                                                                <img src="{{ asset('/storage/' . optional($chi_tiet->san_pham)->anh_san_pham) }}"
                                                                    width="50px" alt="Product Image">
                                                            </td>
                                                            <td>
                                                                <a class="ct-sanpham hover-effect"
                                                                    href="{{ route('sanpham.chitiet', $chi_tiet->san_pham?->id) }}">
                                                                    {{ optional($chi_tiet->san_pham)->ten_san_pham ?? 'N/A' }}<br>
                                                                    Màu:
                                                                    {{ optional($chi_tiet->color_san_pham)->ten_color ?? 'N/A' }}<br>
                                                                    Size:
                                                                    {{ optional($chi_tiet->size_san_pham)->ten_size ?? 'N/A' }}
                                                                </a>
                                                            </td>
                                                            <td>{{ $chi_tiet->so_luong }}</td>
                                                            <td>{{ number_format($chi_tiet->gia_tien, 0, ',', '.') }}
                                                                VND</td>
                                                            <td>{{ number_format($chi_tiet->thanh_tien, 0, ',', '.') }}
                                                                VND</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mb-3">
                                            <p><strong>Mã khuyến mãi</strong>:
                                                {{ $donhang->khuyen_mai?->ten_khuyen_mai }}
                                                {{ $donhang->khuyen_mai?->ma_khuyen_mai }}</p>
                                            <p><strong>Phương thức vận chuyển</strong>:
                                                {{ $donhang->phuong_thuc_van_chuyen?->kieu_van_chuyen }}</p>
                                            <p><strong>Phương thức thanh toán</strong>:
                                                {{ $donhang->phuong_thuc_thanh_toan?->kieu_thanh_toan }}</p>
                                        </div>
                                    </div>

                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <p><strong class="pe-1">Tổng tiền sản phẩm</strong>
                                            {{ number_format($donhang->chi_tiet_don_hangs->sum('thanh_tien'), 0, ',', '.') }}
                                            VND
                                        </p>
                                        <p><strong class="pe-1">Giảm
                                                giá:</strong>
                                            {{ number_format($donhang->khuyen_mai?->gia_tri_khuyen_mai ?? 0, 0, ',', '.') }}VND
                                        </p>
                                        <p><strong class="pe-1">Vận
                                                chuyển:</strong>
                                            {{ number_format($donhang->phuong_thuc_van_chuyen?->gia_ship ?? 0, 0, ',', '.') }}VND
                                        </p>
                                        <p class="order-summary pe-1">Tổng giá trị đơn hàng:
                                            {{ number_format($donhang->tong_tien, 0, ',', '.') }} VND</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
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
                                @if ($donhang->trang_thai_thanh_toan == 'Chưa thanh toán' || $donhang->trang_thai_don_hang == 'Chờ xác nhận')
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5>Hủy nhận đơn hàng này</h5>
                                            <form action="{{ route('taikhoan.cancel', $donhang->id) }}" method="POST"
                                                onsubmit="return confirmCancel()">
                                                @csrf
                                                <button type="submit" class="btn btn-secondary mt-2">Hủy
                                                    nhận hàng</button>
                                            </form>

                                            <script>
                                                function confirmCancel() {
                                                    return confirm("Bạn có chắc chắn muốn hủy nhận đơn hàng này không?");
                                                }
                                            </script>
                                        </div>
                                    </div>
                                @endif
                                <!-- Kiểm tra nếu trạng thái đơn hàng là 'Thành công' -->
                                @if ($donhang->trang_thai_don_hang == 'Thành công')
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
        <!-- Nút bật modal mới -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalThongTin">Thông tin
            chi tiết</button>

        <!-- Modal mới -->
        <div class="modal fade" id="modalThongTin" tabindex="-1" aria-labelledby="modalThongTinLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalThongTinLabel">Thông tin thêm</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        nrdgbdfsd fb ktu,mthergwqw
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="button" class="btn btn-primary">Lưu thay đổi</button>
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

    .hover-effect {
        background-color: #f5f5f5;
        transition: background-color 0.3s ease;
    }

    .hover-effect:hover {
        background-color: #e0e0e0;
    }
</style>
