@extends('client.taikhoan.dashboard');

@section('conten-taikhoan')
    <!-- Single Tab Content Start -->
    <div class="">
        <div class="myaccount-content">
            <div class="card mx-auto p-4"
                style="max-width: 450px; background-color: #ffffff; border-radius: 15px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
                <!-- Header: Logo và tiêu đề -->
                <div class="d-flex align-items-center justify-content-center mb-4">
                    <i class="fas fa-wallet text-success" style="font-size: 2.5rem; margin-right: 10px;"></i>
                    <h4 class="mb-0 text-success">Ví người dùng</h4>
                </div>

                <!-- Thông tin chủ tài khoản -->
                <div class="border p-3 mb-4" style="background-color: #f8f9fa;">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="text-muted">Chủ tài khoản</div>
                            <div class="fw-bold">{{ $user->ho_ten }}</div>
                        </div>
                        <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#historyModal">
                            <i class="fas fa-history me-2"></i>Lịch sử
                        </button>
                    </div>
                </div>
                <!-- Liên kết ngân hàng -->
                <div class="text-center mb-4">
                    <div class="text-muted">Liên kết ngân hàng</div>
                    <a class="btn btn-outline-primary" href="{{ route('banks.create') }}">
                        <i class="fas fa-university me-2"></i>Thêm ngân hàng
                    </a>
                </div>
                <!-- Tổng tiền trong ví -->
                <div class="text-center mb-4">
                    <div class="text-muted">Tổng tiền trong ví</div>
                    <div class="fw-bold text-success" style="font-size: 2rem;">
                        <i class="fas fa-money-bill-wave me-2"></i>
                        @if ($viNguoiDung)
                            {{ number_format($viNguoiDung->tong_tien, 0, ',', '.') }} đ
                        @else
                            0 đ
                        @endif
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <a href="{{ route('taikhoan.rut-tien') }}" class="btn btn-success btn-lg">
                        <i class="fas fa-minus-circle me-2"></i>Rút tiền
                    </a>
                    <a href="{{ route('taikhoan.nap-tien') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus-circle me-2"></i>Nạp tiền
                    </a>
                </div>
            </div>
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <!-- Bootstrap Script -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        </div>
    </div>
    <div class="modal fade " id="historyModal" tabindex="-1" aria-labelledby="historyModalLabel"
        style="--bs-modal-width: 800px;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="historyModalLabel">Lịch sử Giao Dịch</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs" id="transactionTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="hoan-tab" data-bs-toggle="tab" data-bs-target="#hoan"
                                type="button" role="tab" aria-controls="hoan" aria-selected="true">
                                Tiền hoàn
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="thanh-toan-tab" data-bs-toggle="tab" data-bs-target="#thanh-toan"
                                type="button" role="tab" aria-controls="thanh-toan" aria-selected="false">
                                Tiền thanh toán
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="rut-tab" data-bs-toggle="tab" data-bs-target="#rut"
                                type="button" role="tab" aria-controls="rut" aria-selected="false">
                                Tiền rút
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nap-tab" data-bs-toggle="tab" data-bs-target="#nap"
                                type="button" role="tab" aria-controls="nap" aria-selected="false">
                                Tiền nạp
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="transactionTabsContent">
                        <!-- Tab 1: Tiền hoàn -->
                        <div class="tab-pane fade show active" id="hoan" role="tabpanel" aria-labelledby="hoan-tab">
                            @foreach ($chiTietVi as $item)
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex justify-content-start">
                                        <p class="">Tiền hoàn</p>
                                    </div>
                                    <p class="">{{ $item->thoi_gian_hoan }}</p>
                                    <div class="transaction-amount negative">
                                        {{ number_format($item->tien_hoan, 0, ',', '.') }} VNĐ
                                    </div>
                                </div>
                                <hr class="custom-hr">
                            @endforeach
                        </div>

                        <!-- Tab 2: Tiền thanh toán -->
                        <div class="tab-pane fade" id="thanh-toan" role="tabpanel" aria-labelledby="thanh-toan-tab">
                            @foreach ($lsThanhToanVi as $item)
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex justify-content-start">
                                        <p class="">Tiền thanh toán</p>
                                    </div>
                                    <p class="">{{ $item->thoi_gian_thanh_toan }}</p>
                                    <div class="transaction-amount negative">
                                        {{ number_format($item->tien_thanh_toan, 0, ',', '.') }} VNĐ
                                    </div>
                                </div>
                                <hr class="custom-hr">
                            @endforeach
                        </div>

                        <!-- Tab 3: Tiền nạp -->
                        <div class="tab-pane fade" id="nap" role="tabpanel" aria-labelledby="nap-tab">
                            @foreach ($lsNapVi as $item)
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex justify-content-start">
                                        {{ $item->bank?->name }}
                                    </div>
                                    <p class="">{{ $item->thoi_gian_nap }}</p>
                                    <div class="transaction-amount negative">
                                        + {{ number_format($item->tien_nap, 0, ',', '.') }} VNĐ
                                    </div>
                                    <p>{{ $item->trang_thai }}</p>
                                </div>
                                <hr class="custom-hr">
                            @endforeach
                        </div>

                        <!-- Tab 3: Tiền rút -->
                        <div class="tab-pane fade" id="rut" role="tabpanel" aria-labelledby="rut-tab">

                            <!-- Nav tabs -->
                            <ul class="nav nav-pills mt-3 mb-3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="pill" href="#tabchoduyet">Chờ duyệt</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="pill" href="#tabthanhcong">Thành công</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="pill" href="#tabthatbai">Thất
                                        bại</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane container active p-0" id="tabchoduyet">
                                    <table class="table table-bordered">
                                        <tbody>
                                            @foreach ($lsRutVi_choduyet as $item)
                                                <tr>
                                                    <td>{{ $item->bank?->name }}</td>
                                                    <td>{{ $item->bank?->account_number }}</td>
                                                    <td>{{ $item->bank?->account_holder }}</td>
                                                    <td>{{ date('d-m-Y H:i:s', strtotime($item->thoi_gian_rut)) }}
                                                    </td>
                                                    <td class="transaction-amount negative">
                                                        {{ number_format($item->tien_rut, 0, ',', '.') }}
                                                        VNĐ
                                                    </td>
                                                    <td>
                                                        <span class="badge position-static bg-warning">
                                                            {{ $item->trang_thai }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane container fade" id="tabthanhcong">
                                    <table class="table table-bordered">
                                        <tbody>
                                            @foreach ($lsRutVi_thanhcong as $item)
                                                <tr>
                                                    <td>{{ $item->bank?->name }}</td>
                                                    <td>{{ $item->bank?->account_number }}</td>
                                                    <td>{{ $item->bank?->account_holder }}</td>
                                                    <td>{{ $item->updated_at ? $item->updated_at->format('d-m-Y H:i:s') : 'Chưa có thời gian' }}
                                                    </td> <!-- Hiển thị thời gian -->
                                                    <td class="transaction-amount negative">
                                                        {{ number_format($item->tien_rut, 0, ',', '.') }}
                                                        VNĐ
                                                    </td>
                                                    <td>
                                                        <span class="badge position-static bg-success">
                                                            {{ $item->trang_thai }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane container fade" id="tabthatbai">
                                    <table class="table table-bordered">

                                        @foreach ($lsRutVi_thatbai as $item)
                                            <tr>
                                                <td>{{ $item->bank?->name }}</td>
                                                <td>{{ $item->bank?->account_number }}</td>
                                                <td>{{ $item->bank?->account_holder }}</td>
                                                <td>{{ date('d-m-Y H:i:s', strtotime($item->updated_at)) }}
                                                </td>
                                                <td class="transaction-amount negative">
                                                    {{ number_format($item->tien_rut, 0, ',', '.') }}
                                                    VNĐ
                                                </td>
                                                <td>
                                                    <button type="button" class=" badge position-static bg-danger"
                                                        data-bs-toggle="popover" title="Lý do"
                                                        data-bs-content="{{ $item->noi_dung_tu_choi }}">
                                                        {{ $item->trang_thai }}
                                                    </button>
                                                    <script>
                                                        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
                                                        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                                                            return new bootstrap.Popover(popoverTriggerEl);
                                                        });
                                                    </script>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <style>
                    .custom-hr {
                        border: none;
                        border-top: 1px solid #ccc;
                        margin: 10px 0;
                    }

                    .transaction-amount {
                        font-weight: bold;
                    }
                </style>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    {{-- <button type="button" class="btn btn-primary">Xem chi tiết</button> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Thêm Ngân Hàng -->
@endsection
