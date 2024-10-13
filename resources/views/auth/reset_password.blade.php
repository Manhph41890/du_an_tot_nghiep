@extends('auth.layout')

@section('content')
    <div class="container">
        <h1>Đặt Lại Mật Khẩu </h1>
        <!-- Form nhập mật khẩu mới -->
        <form action="{{ route('auth.update_password') }}" method="POST" id="reset-password-form" >
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="form-group">
                <label for="new_password">Mật khẩu mới:</label>
                <input type="password" name="password" id="new_password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Xác nhận mật khẩu:</label>
                <input type="password" name="password_confirmation" id="confirm_password" class="form-control" required>
            </div>
            <button type="submit">Đặt lại mật khẩu</button>
        </form>

    </div>
@endsection
