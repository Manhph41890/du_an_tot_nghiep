@extends('shipper.layout')

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container shipper-profits">
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h3 class="mb-0">
                                    <i class="fas fa-wallet me-2"></i>Thêm liên kết ngân hàng
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row d-flex justify-content-between">
                                    <div class="">
                                        <div class="myaccount-content">
                                            <div class="card mx-auto p-4"
                                                style="max-width: 450px; background-color: #ffffff; border-radius: 15px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
                                                <!-- Header: Logo và tiêu đề -->
                                                <div class="d-flex align-items-center justify-content-center mb-4">
                                                    <i class="fas fa-university me-2"
                                                        style="font-size: 2.5rem; margin-right: 10px;"></i>
                                                    <h4 class="mb-0 text-success">Thêm liên kết ngân hàng</h4>
                                                </div>
                                                <div class="">
                                                    <form action="{{ route('banks.store') }}" method="POST">
                                                        @csrf
                                                        @if ($linkedBanksCount >= 3)
                                                            <div class="alert alert-danger" role="alert">
                                                                Bạn đã đăng ký liên kết 3 ngân hàng
                                                                trước đó.
                                                            </div>
                                                            <div
                                                                class="modal-footer d-flex justify-content-around align-content-around">
                                                                <div>
                                                                    <a href="{{ route('shipper.profits') }}"
                                                                        class="btn btn-outline-secondary w-10 py-2">
                                                                        <i class="fas fa-arrow-left me-2"></i>Quay lại
                                                                    </a>
                                                                </div>
                                                                <div class="">
                                                                    <button type="button" class="btn btn-success"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#listBankModal">
                                                                        Xem danh sách Ngân hàng
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="modal-body">
                                                                <div class="">
                                                                    <div class="form-group">
                                                                        <label for="bank_id" class="form-label">Chọn ngân
                                                                            hàng
                                                                            để liên kết</label>
                                                                        <select name="bank_id" id="bank_id"
                                                                            class="form-select">
                                                                            <option value="" disabled selected>-- Chọn
                                                                                ngân hàng để liên kết --</option>
                                                                            @foreach ($banks as $bank)
                                                                                <option value="{{ $bank['name'] }}">
                                                                                    {{ $bank['shortName'] }} -
                                                                                    {{ $bank['name'] }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="account_number" class="form-label">Số tài
                                                                        khoản</label>
                                                                    <input type="text"
                                                                        class="form-control @error('account_number') is-invalid @enderror"
                                                                        id="account_number" name="account_number">
                                                                    @error('account_number')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                    <div class="invalid-feedback" id="account_number_error">
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="account_holder" class="form-label">Chủ tài
                                                                        khoản</label>
                                                                    <input type="text"
                                                                        class="form-control @error('account_holder') is-invalid @enderror"
                                                                        id="account_holder" name="account_holder">
                                                                    @error('account_holder')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                    <div class="invalid-feedback" id="account_holder_error">
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="pin" class="form-label">Mã Pin</label>
                                                                    <input type="text"
                                                                        class="form-control @error('pin') is-invalid @enderror"
                                                                        id="pin" name="pin">
                                                                    @error('pin')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                    <div class="invalid-feedback" id="account_pin_error">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="modal-footer d-flex justify-content-around align-content-around">
                                                                <div>
                                                                    <a href="{{ route('shipper.profits') }}"
                                                                        class="btn btn-outline-secondary w-10 py-2">
                                                                        <i class="fas fa-arrow-left me-2"></i>Quay lại
                                                                    </a>
                                                                </div>
                                                                <div class="">
                                                                    <button type="button" class="btn btn-success"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#listBankModal">
                                                                        Xem danh sách Ngân hàng
                                                                    </button>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Lưu</button>
                                                            </div>
                                                        @endif
                                                    </form>
                                                </div>

                                                <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
                                                    rel="stylesheet">
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
                                        <div class="modal fade" id="listBankModal" tabindex="-1"
                                            aria-labelledby="listBankModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="listBankModalLabel">Danh sách Ngân hàng
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
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
                                                                            <img src="{{ $bank['img'] }}"
                                                                                alt="{{ $bank['name'] }}"
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
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                            Đóng
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const accountHolderInput = document.getElementById('account_holder');
            const accountNumberInput = document.getElementById('account_number');
            const pinInput = document.getElementById('pin');

            accountHolderInput.addEventListener('input', function() {
                let value = accountHolderInput.value;

                value = value
                    .normalize("NFD")
                    .replace(/[\u0300-\u036f]/g, "")
                    .toUpperCase()
                    .replace(/[^A-Z0-9\s]/g, "");

                accountHolderInput.value = value;

                // Kiểm tra nếu có lỗi không hợp lệ
                if (!/^[A-Z0-9\s]+$/.test(value)) {
                    accountHolderInput.classList.add('is-invalid');
                    document.getElementById('account_holder_error').innerText =
                        'Chỉ cho phép chữ cái in hoa, số và khoảng trắng.';
                } else {
                    accountHolderInput.classList.remove('is-invalid');
                    document.getElementById('account_holder_error').innerText = '';
                }
            });
            accountNumberInput.addEventListener('input', function() {
                let value = accountNumberInput.value;

                value = value
                    .normalize("NFD")
                    .replace(/[\u0300-\u036f]/g, "")
                    .replace(/[^0-9]/g, "");

                accountNumberInput.value = value;

                // Kiểm tra nếu có lỗi không hợp lệ
                if (!/^[A-Z0-9\s]+$/.test(value)) {
                    accountNumberInput.classList.add('is-invalid');
                    document.getElementById('account_number_error').innerText =
                        'Chỉ cho phép số.';
                } else {
                    accountNumberInput.classList.remove('is-invalid');
                    document.getElementById('account_number_error').innerText = '';
                }
            });
            pinInput.addEventListener('input', function() {
                let value = pinInput.value;

                value = value
                    .normalize("NFD")
                    .replace(/[\u0300-\u036f]/g, "")
                    .replace(/[^0-9]/g, "");

                pinInput.value = value;

                // Kiểm tra nếu có lỗi không hợp lệ
                if (!/^[A-Z0-9\s]+$/.test(value)) {
                    pinInput.classList.add('is-invalid');
                    document.getElementById('account_pin_error').innerText =
                        'Chỉ cho phép số.';
                } else {
                    pinInput.classList.remove('is-invalid');
                    document.getElementById('account_pin_error').innerText = '';
                }
            });
        });
    </script>
    <style>
        .profit-card {
            background: linear-gradient(135deg, #28a745, #4caf50);
            /* Gradient xanh lá */
            color: #fff;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .profit-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .icon-wrapper {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            font-size: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .icon-wrapper i {
            color: #fff;
        }

        .profit-amount {
            font-size: 2rem;
            font-weight: bold;
            margin-top: 10px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        .card-title {
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }
    </style>
@endsection
