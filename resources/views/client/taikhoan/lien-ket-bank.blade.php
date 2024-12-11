@extends('client.taikhoan.dashboard');

@section('conten-taikhoan')
    <!-- Single Tab Content Start -->
    <div class="">
        <div class="myaccount-content">
            <div class="card mx-auto p-4"
                style="max-width: 450px; background-color: #ffffff; border-radius: 15px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
                <!-- Header: Logo và tiêu đề -->
                <div class="d-flex align-items-center justify-content-center mb-4">
                    <i class="fas fa-university me-2" style="font-size: 2.5rem; margin-right: 10px;"></i>
                    <h4 class="mb-0 text-success">Thêm liên kết ngân hàng</h4>
                </div>
                <div class="">
                    <form action="{{ route('banks.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="">
                                <div class="form-group">
                                    <label for="bank_id" class="form-label">Chọn ngân hàng để liên kết</label>
                                    <select name="bank_id" id="bank_id" class="form-select">
                                        <option value="" disabled selected>-- Chọn ngân hàng để liên kết --</option>
                                        @foreach ($banks as $bank)
                                            <option value="{{ $bank['name'] }}">
                                                {{ $bank['shortName'] }} - {{ $bank['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="account_number" class="form-label">Số tài khoản</label>
                                <input type="text" class="form-control @error('account_number') is-invalid @enderror"
                                    id="account_number" name="account_number">
                                @error('account_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="account_holder" class="form-label">Chủ tài khoản</label>
                                <input type="text" class="form-control @error('account_holder') is-invalid @enderror"
                                    id="account_holder" name="account_holder">
                                @error('account_holder')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="pin" class="form-label">Mã Pin</label>
                                <input type="text" class="form-control @error('pin') is-invalid @enderror" id="pin"
                                    name="pin">
                                @error('pin')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-around align-content-around">
                            <div>
                                <a href="{{ route('taikhoan.vitien') }}" class="btn btn-outline-secondary w-10 py-2">
                                    <i class="fas fa-arrow-left me-2"></i>Quay lại
                                </a>
                            </div>
                            <div class="">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#listBankModal">
                                    Xem danh sách Ngân hàng
                                </button>
                            </div>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </form>
                </div>

                <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
                <!-- Bootstrap Script -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            </div>
        </div>
        <style>
            table img {
                border-radius: 5px;
                object-fit: cover;
            }
        </style>
        <!-- Modal Thêm Ngân Hàng -->
        <div class="modal fade" id="listBankModal" tabindex="-1" aria-labelledby="listBankModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="listBankModalLabel">Danh sách Ngân hàng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Hình ảnh</th>
                                    <th>Tên ngân hàng</th>
                                    <th>Số tài khoản</th>
                                    <th>Chủ tài khoản</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listBank as $bank)
                                    <tr>
                                        <td>
                                            <img src="{{ $bank['img'] }}" alt="{{ $bank['name'] }}"
                                                style="width: 50px; height: auto;">
                                        </td>
                                        <td>{{ $bank['name'] }}</td>
                                        <td>{{ $bank['account_number'] }}</td>
                                        <td>{{ $bank['account_holder'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Đóng
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endsection
