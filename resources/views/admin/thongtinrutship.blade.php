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
                                                    <th>Số dư</th>
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
                                                    <td>{{ number_format($viShipper->tong_tien) }} VND</td>
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
                                        <a href="{{ route('duyetruttienAdmin') }}" class="btn btn-secondary">
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
