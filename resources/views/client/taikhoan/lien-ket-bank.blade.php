@extends('client.taikhoan.dashboard')

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
                        @if ($linkedBanksCount >= 3)
                            <div class="alert alert-danger" role="alert">
                                Bạn đã đăng ký liên kết 3 ngân hàng
                                trước đó.
                            </div>
                            <div class="modal-footer d-flex justify-content-around align-content-around">
                                <div>
                                    <a href="{{ route('shipper.profits') }}" class="btn btn-outline-secondary w-10 py-2">
                                        <i class="fas fa-arrow-left me-2"></i>Quay lại
                                    </a>
                                </div>
                                <div class="">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
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
                                        <select name="bank_id" id="bank_id" class="form-select">
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
                                    <input type="text" class="form-control @error('account_number') is-invalid @enderror"
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
                                    <input type="text" class="form-control @error('account_holder') is-invalid @enderror"
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
                                    <input type="text" class="form-control @error('pin') is-invalid @enderror"
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
                        @endif
                    </form>
                </div>

                <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
                <!-- Bootstrap Script -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
                        .replace(/[^A-Z\s]/g, "");

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
                                    <th>Hành động</th>
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
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm"
                                                id="deleteBankBtn{{ $bank->id }}">
                                                Hủy liên kết
                                            </button>
                                        </td>
                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                // Loop through each delete button by the bank ID

                                                const deleteBankBtn{{ $bank->id }} = document.getElementById(
                                                    "deleteBankBtn{{ $bank->id }}");
                                                const deleteBankModal{{ $bank->id }} = new bootstrap.Modal(document.getElementById(
                                                    'deleteBankModal{{ $bank->id }}'));

                                                // Add event listener to show modal when button is clicked
                                                deleteBankBtn{{ $bank->id }}.addEventListener("click", function() {
                                                    deleteBankModal{{ $bank->id }}.show(); // Show the modal
                                                });

                                            });
                                        </script>
                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteBankModal{{ $bank->id }}" tabindex="-1"
                                            aria-labelledby="deleteBankModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteBankModalLabel">Xác nhận hủy
                                                            liên kết</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('banks.delete', $bank->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-body">
                                                            <p>Bạn có chắc chắn muốn hủy liên kết ngân hàng
                                                                <strong>{{ $bank->name }}</strong>?
                                                            </p>
                                                            <div class="mb-3">
                                                                <label for="pin" class="form-label">Nhập mã
                                                                    PIN</label>
                                                                <input type="password" name="pin" id="pin"
                                                                    class="form-control @error('pin') is-invalid @enderror">
                                                                <div class="invalid-feedback" id="account_pin_error">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Hủy</button>
                                                            <button type="submit" class="btn btn-danger">Xác
                                                                nhận</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

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
    </div>
    <!-- Modal xác nhận xóa -->

@endsection
