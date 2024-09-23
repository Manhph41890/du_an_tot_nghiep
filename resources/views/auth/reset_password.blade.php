@extends('auth.layout')

@section('content')
<div class="container">
    <h1>Đặt Lại Mật Khẩu</h1>
    <form action="{{ route('auth.update_password') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu mới:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Xác nhận mật khẩu mới:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Đặt lại mật khẩu</button>
    </form>
</div>
@endsection
