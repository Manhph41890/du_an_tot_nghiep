@extends('shipper.layout')


@section('content')
    <style>
        .shipper-dashboard {
            background-color: #f4f6f9;
            padding-top: 20px;
        }

        .nav-pills .nav-link {
            color: #495057;
            transition: all 0.3s ease;
        }

        .nav-pills .nav-link.active {
            background-color: #007bff;
            color: white;
        }

        .nav-pills .nav-link:hover {
            background-color: #e9ecef;
        }

        .table-responsive {
            max-height: 500px;
            overflow-y: auto;
        }

        .status-select {
            width: 130px;
        }
    </style>
    <div class="content-page">
        <div class="content">
            <!-- Nav tabs -->
            <ul class="nav nav-pills nav-fill mb-4" id="shipperTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="tab-da-lay-hang" data-bs-toggle="tab" href="#da-lay-hang" role="tab">
                        <i class="fas fa-box-open me-2"></i>Đã Lấy Hàng
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="tab-dang-giao" data-bs-toggle="tab" href="#dang-giao" role="tab">
                        <i class="fas fa-shipping-fast me-2"></i>Đang Giao
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="tab-da-thanh-cong" data-bs-toggle="tab" href="#da-thanh-cong" role="tab">
                        <i class="fas fa-check-circle me-2"></i>Đã Thành Công
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="tab-da-huy" data-bs-toggle="tab" href="#da-huy" role="tab">
                        <i class="fas fa-times-circle me-2"></i>Đã Hủy
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="tab-giao-lai" data-bs-toggle="tab" href="#giao-lai" role="tab">
                        <i class="fas fa-redo me-2"></i>Giao Lại
                    </a>
                </li>
            </ul>

            <!-- Tab content -->
            <div class="tab-content mt-3" id="shipperTabContent">
                <!-- Đã lấy hàng -->
                <div class="tab-pane fade show active" id="da-lay-hang" role="tabpanel" aria-labelledby="tab-da-lay-hang">
                    <h4>Đơn hàng đã lấy</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Người nhận</th>
                                <th>Địa Chỉ</th>
                                <th>Số điện thoại</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shippers as $shipper)
                                @if ($shipper->status == 'Đã lấy hàng')
                                    <tr>
                                        <td>{{ $shipper->donHang->ma_don_hang }}</td>
                                        <td>{{ $shipper->donHang->user->ho_ten }}</td>
                                        <td>{{ $shipper->donHang->user->dia_chi }}</td>
                                        <td>{{ $shipper->donHang->user->so_dien_thoai }}</td>
                                        <td>{{ number_format($shipper->donHang->tong_tien, 0, ',', '.') }} VND</td>
                                        <td>
                                            <select class="form-select status-select" data-id="{{ $shipper->id }}">
                                                <option value="Đã lấy hàng"
                                                    {{ $shipper->status == 'Đã lấy hàng' ? 'selected' : '' }}>Đã lấy hàng
                                                </option>
                                                <option value="Đang giao"
                                                    {{ $shipper->status == 'Đang giao' ? 'selected' : '' }}>Đang giao
                                                </option>
                                            </select>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- Đang giao --}}
                <div class="tab-pane fade show" id="dang-giao" role="tabpanel" aria-labelledby="tab-dang-giao">
                    <h4>Đơn hàng đang giao</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Người nhận</th>
                                <th>Địa Chỉ</th>
                                <th>Số điện thoại</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shippers as $shipper)
                                @if ($shipper->status == 'Đang giao')
                                    <tr> <!-- Bổ sung thẻ <tr> -->
                                        <td>{{ $shipper->donHang->ma_don_hang }}</td>
                                        <td>{{ $shipper->donHang->user->ho_ten }}</td>
                                        <td>{{ $shipper->donHang->user->dia_chi }}</td>
                                        <td>{{ $shipper->donHang->user->so_dien_thoai }}</td>
                                        <td>{{ number_format($shipper->donHang->tong_tien, 0, ',', '.') }} VND</td>
                                        <td>
                                            <select class="form-select status-select" data-id="{{ $shipper->id }}">
                                                <option value="Đang giao"
                                                    {{ $shipper->status == 'Đang giao' ? 'selected' : '' }}>Đang giao
                                                </option>
                                                <option value="Đã thành công"
                                                    {{ $shipper->status == 'Đã thành công' ? 'selected' : '' }}>Đã thành
                                                    công</option>
                                                <option value="Đã hủy"
                                                    {{ $shipper->status == 'Đã hủy' ? 'selected' : '' }}>Đã hủy</option>
                                                <option value="Giao lại"
                                                    {{ $shipper->status == 'Giao lại' ? 'selected' : '' }}>Giao lại
                                                </option>
                                            </select>
                                        </td>
                                    </tr> <!-- Kết thúc thẻ <tr> -->
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>


                <!-- Đã thành công -->
                <div class="tab-pane fade" id="da-thanh-cong" role="tabpanel" aria-labelledby="tab-da-thanh-cong">
                    <h4>Đơn hàng đã thành công</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Người nhận</th>
                                <th>Địa Chỉ</th>
                                <th>Số điện thoại</th>
                                <th>Tổng tiền</th>
                                <th>Lợi nhuận</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shippers as $shipper)
                                @if ($shipper->status == 'Đã thành công')
                                    <tr>
                                        <td>{{ $shipper->donHang->ma_don_hang }}</td>
                                        <td>{{ $shipper->donHang->user->ho_ten }}</td>
                                        <td>{{ $shipper->donHang->user->dia_chi }}</td>
                                        <td>{{ $shipper->donHang->user->so_dien_thoai }}</td>
                                        <td>{{ number_format($shipper->donHang->tong_tien, 0, ',', '.') }} VND</td>
                                        <td>
                                            {{ number_format($shipper->donHang->tong_tien * 0.04, 0, ',', '.') }} VND
                                        </td>
                                        <td class="text-success">{{ $shipper->status }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Đã hủy -->
                <div class="tab-pane fade" id="da-huy" role="tabpanel" aria-labelledby="tab-da-huy">
                    <h4>Đơn hàng đã hủy</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Ngày tạo</th>
                                <th>Trạng thái</th>
                                <th>Lý do hủy (nếu có)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shippers as $shipper)
                                @if ($shipper->status == 'Đã hủy')
                                    <tr>
                                        <td>{{ $shipper->donHang->ma_don_hang }}</td>
                                        <td>{{ optional($shipper->donHang->created_at)->format('d/m/Y H:i:s') }}</td>
                                        <td class="text-danger">{{ $shipper->status }}</td>
                                        <td class="ly-do-huy">
                                            @if ($shipper->status == 'Đã hủy')
                                                {{ $shipper->ly_do_huy ?? 'Không có lý do' }}
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Giao lại -->
                <div class="tab-pane fade" id="giao-lai" role="tabpanel" aria-labelledby="tab-giao-lai">
                    <h4>Đơn hàng giao lại</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Ngày tạo</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shippers as $shipper)
                                @if ($shipper->status == 'Giao lại')
                                    <tr>
                                        <td>{{ $shipper->donHang->ma_don_hang }}</td>
                                        <td>{{ optional($shipper->donHang->created_at)->format('d/m/Y H:i:s') }}</td>
                                        <td>
                                            <select class="form-select status-select" data-id="{{ $shipper->id }}">
                                                <option value="Giao lại"
                                                    {{ $shipper->status == 'Giao lại' ? 'selected' : '' }}>Giao lại
                                                </option>
                                                <option value="Đã thành công"
                                                    {{ $shipper->status == 'Đã thành công' ? 'selected' : '' }}>Đã thành
                                                    công</option>
                                                <option value="Đã hủy"
                                                    {{ $shipper->status == 'Đã hủy' ? 'selected' : '' }}>Đã hủy</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.status-select').change(function() {
                const shipperId = $(this).data('id');
                const newStatus = $(this).val();
                let cancelReason = null;

                if (newStatus === 'Đã hủy') {
                    cancelReason = prompt("Vui lòng nhập lý do hủy đơn:");
                    if (!cancelReason) {
                        alert("Bạn phải nhập lý do khi hủy đơn!");
                        $(this).val($(this).data('current-status')); // Khôi phục trạng thái ban đầu
                        return;
                    }
                }

                $.ajax({
                    url: `/shipper/update-status/${shipperId}`,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: newStatus,
                        ly_do_huy: cancelReason
                    },
                    success: function(response) {
                        toastr.success('Cập nhật trạng thái thành công!');
                        const row = $(`#order-${shipperId}`);
                        if (newStatus === 'Đã hủy') {
                            row.find('.ly-do-huy').text(cancelReason);
                        }
                        row.find('.status-select').val(newStatus);
                        window.location.reload();
                    },

                    error: function() {
                        alert('Có lỗi xảy ra. Vui lòng thử lại!');
                    }
                });
            });
        });
    </script>
@endsection
