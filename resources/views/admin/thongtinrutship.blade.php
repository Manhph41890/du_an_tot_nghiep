@extends('admin.layout')


@section('css')
@endsection

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container">
                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0">{{ $title }}</h4>
                    </div>

                </div>
                <div class="container mt-2">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">Chi tiết giao dịch</h5>
                                </div>
                                <div class="card-body">
                                    <!-- Thông tin Rút từ ví -->
                                    <div class="mb-4">
                                        <h6 class="text-uppercase text-secondary">Rút từ ví</h6>
                                        <table class="table table-bordered table-hover">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Ảnh</th>
                                                    <th>Họ tên</th>
                                                    <th>Số dư ban đầu</th>
                                                    <th>Số tiền rút</th>
                                                    @if ($trangThai == 'Thất bại')
                                                        <th>Trạng thái</th>
                                                    @else
                                                        <th>Số dư mới</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="{{ $viShipper->shipper->anh_dai_dien }}"
                                                            alt="{{ $viShipper->shipper->ho_ten }}" class="img-thumbnail"
                                                            style="width: 50px; height: auto;">
                                                    </td>
                                                    <td>{{ $viShipper->shipper->ho_ten }}</td>
                                                    <td>
                                                        @if ($trangThai == 'Thất bại')
                                                            {{ number_format(intval($so_du_ban_dau) - intval($lsRutVi->tien_rut)) }}
                                                            VND
                                                        @else
                                                            {{ number_format($so_du_ban_dau) }} VND
                                                        @endif
                                                    </td>
                                                    <td>{{ number_format($lsRutVi->tien_rut) }} VND</td>
                                                    <td>
                                                        @if ($trangThai == 'Thất bại')
                                                            <Strong class="text-danger">Thất Bại</Strong>
                                                        @else
                                                            {{ number_format(intval($viShipper->tong_tien)) }} VND
                                                        @endif
                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Thông tin Về ngân hàng -->
                                    <div class="mb-4">
                                        <h6 class="text-uppercase text-secondary">Về ngân hàng</h6>
                                        <table class="table table-bordered table-hover">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Ngân hàng</th>
                                                    <th>Số tài khoản</th>
                                                    <th>Họ tên</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="{{ $bank->img }}" alt="{{ $bank->name }}"
                                                            class="img-thumbnail" style="width: 50px; height: auto;">
                                                        <span class="ms-2">{{ $bank->name }}</span>
                                                    </td>
                                                    <td>{{ $bank->account_number }}</td>
                                                    <td>{{ $bank->account_holder }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Nút Quay lại -->
                                    <div class="text-end">
                                        <a href="{{ route('duyetruttienShipper') }}" class="btn btn-secondary">
                                            <i class="bi bi-arrow-left"></i> Quay lại
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container-fluid -->
@endsection
