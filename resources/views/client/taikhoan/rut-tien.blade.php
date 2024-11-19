@extends('client.layout')

@section('content')
    <div class="container my-5">
        <h2 class="text-center mb-4">Rút tiền</h2>
        <form action="{{ route('withdraw') }}" method="POST" class="card shadow-lg p-4">
            @csrf

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
                <input type="number" class="form-control" name="amount" id="amount" placeholder="Nhập số tiền cần rút"
                    required>
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
        </style>

    </div>
@endsection
