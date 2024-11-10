@extends('auth.layout')

@section('css')
@import url('https://fonts.googleapis.com/css2?family=Itim&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,300;1,500;1,700&display=swap'); 

    body {
    font-family: "Itim", cursive;
    background: #ececec;
    }

    .box-area {
    width: 930px;
    }

    .right-box {
    padding: 40px 30px 40px 40px;
    }

    ::placeholder {
    font-size: 16px;
    }

    .rounded-4 {
    border-radius: 20px;
    }

    .rounded-5 {
    border-radius: 30px;
    }

    @media only screen and (max-width: 768px) {
    .box-area {
    margin: 0 10px;
    }
    .left-box {
    height: 100px;
    overflow: hidden;
    }
    .right-box {
    padding: 20px;
    }
    }
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('auth.register') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container d-flex justify-content-center align-items-center min-vh-100">

            <div class="row border rounded-5 p-3 bg-white shadow box-area">

                <div class="col-md-6 right-box">
                    <div class="row align-items-center">
                        <div
                            class="header-text mb-4 text-center d-flex flex-column justify-content-center align-items-center">
                            <h2>Đăng Kí</h2>
                        </div>

                        <div class="input-group mb-3">
                            <input type="text" id="ho_ten" name="ho_ten" value="{{ old('ho_ten') }}" required
                                class="form-control form-control-lg bg-light fs-6 @error('ho_ten') is-invalid @enderror"
                                placeholder="Họ Tên">
                            @error('ho_ten')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                class="form-control form-control-lg bg-light fs-6 @error('email') is-invalid @enderror"
                                placeholder="Email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="number" id="so_dien_thoai" name="so_dien_thoai" value="{{ old('so_dien_thoai') }}"
                                required
                                class="form-control form-control-lg bg-  fs-6 @error('so_dien_thoai') is-invalid @enderror"
                                placeholder="Số điện thoại">
                            @error('so_dien_thoai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" id="password" name="password" required
                                class="form-control form-control-lg bg-light fs-6 @error('password') is-invalid @enderror"
                                placeholder="Mật Khẩu">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                class="form-control form-control-lg bg-light fs-6 @error('password_confirmation') is-invalid @enderror"
                                placeholder="Xác nhận mật khẩu">
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="input-group mb-5 d-flex justify-content-between">
                            <div class="form-check">
                                <input type="checkbox" name="remember" class="form-check-input" id="formCheck">
                                <label for="formCheck" class="form-check-label text-secondary"><small>Remember
                                        Me</small></label>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <button class="btn btn-lg btn-primary w-100 fs-6">Đăng Kí</button>
                        </div>

                        <div class="input-group d-flex mb-3">
                            <button class="btn btn-lg btn-light me-2 fs-6">
                                <img src="{{ asset('images/google.png') }}" style="width: 20px;" class="me-2">
                                Sign In with Google
                            </button>

                            <button class="btn btn-lg btn-light ms-2 fs-6">
                                <img src="{{ asset('images/facebook.png') }}" style="width: 20px;" class="me-2">
                                Sign In with Facebook
                            </button>
                        </div>

                        <div class="row">
                            <small>Bạn đã có tài khoản? <a href="{{ route('auth.login') }}"> Đăng Nhập </a></small>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box"
                    style="">
                    <div class="featured-image mb-3">
                        <img src="{{ asset('assets/client/images/banner/bn1.jpg') }}" class="img-fluid"
                            style="width: 500px;">
                    </div>
                    <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">Be
                        Verified</p>
                    <small class="text-white text-wrap text-center"
                        style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Join experienced Designers on
                        this platform.</small>
                </div>

            </div>
        </div>
    </form>
@endsection

@section('js')
@endsection
