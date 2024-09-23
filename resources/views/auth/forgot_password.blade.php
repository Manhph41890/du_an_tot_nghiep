@extends('auth.layout')

@section('content')
<div class="container">
    <h1>Quên Mật Khẩu</h1>
    <form action="{{ route('auth.email') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Gửi liên kết đặt lại mật khẩu</button>
    </form>
</div>
@endsection
