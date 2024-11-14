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

    <form action="{{ route('auth.login') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="row border rounded-5 p-3 bg-white shadow box-area">

                <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box"
                    style="">
                    <div class="featured-image mb-3">
                        <img src="{{ asset('assets/client/images/banner/bn1.jpg') }}" class="img-fluid"
                            style="width: 500px;">
                    </div>

                </div>

                <div class="col-md-6 right-box">
                    <div class="row align-items-center">
                        <div
                            class="header-text mb-4 text-center d-flex flex-column justify-content-center align-items-center">
                            <h2>Đăng Nhập</h2>
                        </div>

                        <div class="input-group mb-3">
                            <input type="email"
                                class="form-control form-control-lg bg-light fs-6 @error('email') is-invalid @enderror"
                                name="email" id="email" required placeholder="Email address"
                                value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="input-group mb-1">
                            <input type="password" name="password" id="password" required
                                class="form-control form-control-lg bg-light fs-6 @error('password') is-invalid @enderror"
                                placeholder="Password" value="{{ old('password') }}">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="input-group mb-3 d-flex justify-content-between">
                            <div class="form-check">
                                <input type="checkbox" name="remember" class="form-check-input" id="formCheck">
                                <label for="formCheck" class="form-check-label text-secondary"><small>Ghi nhớ</small></label>
                            </div>

                            <div class="forgot">
                                <small><a href="{{ route('auth.forgot_password') }}">Quên mật khẩu?</a></small>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <button class="btn btn-lg btn-primary w-100 fs-6">ĐĂNG NHẬP</button>
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
                            <small>Bạn chưa có tài khoản? <a href="{{ route('auth.register') }}"> Đăng Kí </a></small>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
@endsection

@section('js')
@endsection
