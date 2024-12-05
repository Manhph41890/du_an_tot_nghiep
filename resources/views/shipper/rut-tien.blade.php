@extends('shipper.layout')
@section('content')
    <div class="content-page">
        <div class="content mt-2">
            <form action="{{ route('shipper.withdraw') }}" method="POST" class="card shadow-lg p-4">
                @csrf
                <div class="text-start mb-4">
                    <a href="{{ route('shipper.profits') }}" class="btn btn-outline-secondary w-10 py-2">
                        <i class="fas fa-arrow-left me-2"></i>Quay lại
                    </a>
                </div>
                <!-- Phần chọn ngân hàng -->
                <div class="mb-4">
                    <label for="bank_id" class="form-label">Chọn ngân hàng:</label>
                    <div class="row row-cols-2 row-cols-md-4 g-3">
                        @foreach ($banks as $bank)
                            <div class="col">
                                <label
                                    class="card bank-card p-3 shadow-sm border d-flex flex-column align-items-center text-center"
                                    style="cursor: pointer;">
                                    <input type="radio" name="bank_id" value="{{ $bank->id }}"
                                        class="form-check-input d-none">
                                    <img src="{{ $bank->img }}" alt="{{ $bank->name }}" class="img-fluid mb-2"
                                        style="height: 50px;">
                                    <span class="fw-bold">{{ $bank->name }}</span>
                                    <small class="text-muted">{{ $bank->account_number }}</small>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Phần nhập số tiền -->
                <div class="mb-4">
                    <label for="amount" class="form-label">Số tiền:</label>
                    <input type="number" class="form-control" style="background-color: #99999e" name="amount"
                        id="amount" placeholder="Nhập số tiền cần rút" required>

                    <!-- Gợi ý số tiền -->
                    <div class="mt-2">
                        <button type="button" class="btn btn-outline-primary btn-suggestion"
                            data-amount="10000">10,000</button>
                        <button type="button" class="btn btn-outline-primary btn-suggestion"
                            data-amount="100000">100,000</button>
                        <button type="button" class="btn btn-outline-primary btn-suggestion"
                            data-amount="500000">500,000</button>
                        <button type="button" class="btn btn-outline-primary btn-suggestion"
                            data-amount="1000000">1,000,000</button>
                        <button type="button" class="btn btn-outline-primary btn-suggestion"
                            data-amount="5000000">5,000,000</button>
                    </div>
                </div>

                <!-- Phần nhập mã PIN -->
                <div class="mb-4">
                    <label for="pin" class="form-label">Mã PIN:</label>
                    <input type="password" name="pin" id="pin" class="form-control" placeholder="Nhập mã PIN"
                        required>
                </div>

                <!-- Nút gửi -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-100 py-2">Rút tiền</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.querySelectorAll('.btn-suggestion').forEach(button => {
            button.addEventListener('click', function() {
                const amount = this.getAttribute('data-amount'); // Lấy số tiền từ data-amount
                document.getElementById('amount').value = amount; // Điền số tiền vào ô nhập
            });
        });
    </script>
    <style>
        .bank-card {
            transition: all 0.3s ease-in-out;
        }

        .bank-card:hover {
            transform: scale(1.05);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        .bank-card input:checked+img,
        .bank-card input:checked+span {
            border: 2px solid #0d6efd;
            color: #0d6efd;
        }

        .input-no-border {
            border: none;
            border-bottom: 2px solid #ced4da;
            /* Tạo đường gạch dưới */
            border-radius: 0;
            /* Loại bỏ góc bo tròn */
            outline: none;
            box-shadow: none;
            /* Xóa hiệu ứng shadow khi focus */
            padding: 8px 12px;
            font-size: 16px;
        }

        .input-no-border:focus {
            border-bottom: 2px solid #0d6efd;
            /* Màu xanh khi focus */
        }

        .input-no-border::placeholder {
            color: #adb5bd;
            /* Màu placeholder */
            font-style: italic;
            /* Làm chữ nghiêng */
        }
    </style>

    </div>
@endsection
