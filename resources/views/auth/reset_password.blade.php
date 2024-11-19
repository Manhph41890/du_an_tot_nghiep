@extends('auth.layout')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <img class="decoration-back" src="http://127.0.0.1:8000/assets/client/images/banner/banner_0.jpg" alt="">
    <div id="snow-container"></div>
    <div class="form-contain">
        <div class="overlay">
            <img class="decoration" src="http://127.0.0.1:8000/assets/client/images/logo/logo_art.png" alt="Logo Art">
            <div class="forgot-password">
                <h2>Đặt lại mật khẩu mới</h2>

            </div>
        </div>
        <div class="form-list"></div>
        <div class="form-list mb-3 ">
            <!-- Form gửi mã xác thực -->
            <form action="{{ route('auth.update_password') }}" method="POST" id="reset-password-form">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                <div class="input-group mb-3">

                    <input type="password" name="password" value="{{ old('password') }}" id="new_password"
                        placeholder="Nhập mật khẩu mới" class="form-control form-control-lg bg-light fs-6" required>
                </div>
                <div class="input-group mb-3">

                    <input type="password" name="password_confirmation" id="confirm_password"
                        placeholder="Xác nhận mật khẩu mới" class="form-control form-control-lg bg-light fs-6" required>
                </div>
                <div class="nut-button">
                    <button type="submit"> Đặt lại mật khẩu</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Load jQuery first -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Then load Bootstrap Bundle JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        // Wait for the document to be ready
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


        });
        // Chỉ hiển thị Swal.fire nếu có session('status')
        @if (session('status'))
            Swal.fire({
                icon: 'success',
                title: 'Thành công',
                text: '{{ session('status') }}',
                confirmButtonText: 'OK'
            });
        @endif

        // Hiển thị lỗi nếu có $errors
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: '{{ $errors->first() }}',
                confirmButtonText: 'Thử lại'
            });
        @endif
    </script>
@endsection
