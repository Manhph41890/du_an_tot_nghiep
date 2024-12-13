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
                                            @if ($donhang->shipper->status == 'Thất bại')
                                                <h5 style="color: red">Lý do hủy: {{ $donhang->shipper->ly_do_huy }}
                                                </h5>
                                            @endif
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
                                                    $class =
                                                        $statusClasses[$donhang->trang_thai_don_hang] ?? 'bg-secondary';
                                                @endphp

                                                <span class="badge {{ $class }}">
                                                    {{ $donhang->trang_thai_don_hang }}
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
                                                        <th>Giá</th>
                                                        <th>Số Lượng</th>

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
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mb-3">
                                            <p><strong>Mã khuyến mãi</strong>:
                                                {{ $donhang->khuyen_mai?->ten_khuyen_mai }} -
                                                {{ $donhang->khuyen_mai?->ma_khuyen_mai }}</p>
                                            <p><strong>Phương thức vận chuyển</strong>:
                                                {{ $donhang->phuong_thuc_van_chuyen?->kieu_van_chuyen }}</p>
                                            <p><strong>Phương thức thanh toán</strong>:
                                                {{ $donhang->phuong_thuc_thanh_toan?->kieu_thanh_toan }}</p>
                                        </div>
                                    </div>

                                </div>
                                @php
                                    $tongGiaSp = $donhang->chi_tiet_don_hangs->sum('thanh_tien');
                                @endphp

                                <div class="card">
                                    <div class="card-body">
                                        <p><strong class="pe-1">Tổng tiền sản phẩm</strong>
                                            {{ number_format($tongGiaSp, 0, ',', '.') }} VND
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

                                <!-- Kiểm tra nếu trạng thái đơn hàng là 'Chờ xác nhận' -->
                                @if ($donhang->trang_thai_don_hang == 'Chờ xác nhận')
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
                                        <h6>Khách hàng: {{ $donhang->user?->ho_ten }}</h6> 
                                        <br>
                                        <p><strong>Tên người nhận:</strong> {{ $donhang->ho_ten }}</p>
                                        <p><strong>Email:</strong> {{ $donhang->email }}</p>
                                        <p><strong>Số điện thoại:</strong> {{ $donhang->so_dien_thoai }}</p>
                                        <p class="shipping-address"><strong>Địa chỉ giao hàng:</strong> {{ $donhang->dia_chi }}</p>

                                    </div>
                                </div>

                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h5>Ảnh xác thực giao</h5>
                                        <br>
                                        {{-- @php
                                            dd($donhang->shipper->image_path);
                                        @endphp --}}
                                        {{-- <img src="{{ asset('/storage/' . $donhang->shipper->image_path) }}"
                                            width="50px"> --}}

                                        @if (isset($donhang->shipper) && $donhang->shipper->image_path)
                                            <img src="{{ asset('storage/' . $donhang->shipper->image_path) }}"
                                                alt="Hình ảnh sản phẩm" width="100px">
                                        @else
                                            <img src="{{ asset('images/placeholder.png') }}" alt="Không có ảnh"
                                                width="100px">
                                        @endif
                                    </div>
                                </div>

                                <!-- Kiểm tra nếu trạng thái đơn hàng là 'Thành công' -->
                                @if ($donhang->trang_thai_don_hang == 'Thành công')
                                    <div class="card">
                                        <div class="card-body">
                                            <h5>Đánh giá của khách hàng</h5>
                                            @if ($donhang->chi_tiet_don_hangs->isNotEmpty())
                                                @php
                                                    $hasRatings = false;
                                                @endphp

                                                @foreach ($donhang->chi_tiet_don_hangs as $chiTiet)
                                                    @if ($chiTiet->san_pham && $chiTiet->san_pham->danh_gias->isNotEmpty())
                                                        @foreach ($chiTiet->san_pham->danh_gias as $danhGia)
                                                            @php
                                                                $hasRatings = true;
                                                            @endphp
                                                            <div class="d-flex justify-content-between">
                                                                <strong> <img
                                                                        src="{{ asset('/storage/' . $danhGia->users?->anh_dai_dien) }}"
                                                                        width="50px"></strong>
                                                                <small><em>Đánh giá:
                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                            @if ($i <= $danhGia->diem_so)
                                                                                <i
                                                                                    class="mdi mdi-star text-warning"></i>
                                                                            @else
                                                                                <i
                                                                                    class="mdi mdi-star-outline text-muted"></i>
                                                                            @endif
                                                                        @endfor
                                                                    </em></small>
                                                            </div>
                                                            <div class="d-flex justify-content-between">
                                                                <h6 class="me-3">{{ $danhGia->users?->ho_ten }}</h6>
                                                                <textarea class="form-control" rows="2" readonly>{{ $danhGia->binh_luan }}</textarea>
                                                            </div>
                                                            <p class="text-muted text-end">
                                                                {{ date('d/m/Y', strtotime($danhGia->ngay_danh_gia)) }}
                                                            </p>
                                                        @endforeach
                                                    @endif
                                                @endforeach

                                                @if (!$hasRatings)
                                                    <p>Chưa có đánh giá nào.</p>
                                                @endif
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
    .shipping-address {
    word-wrap: break-word !important;
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
