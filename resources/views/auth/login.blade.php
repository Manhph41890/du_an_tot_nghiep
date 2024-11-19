

@extends('auth.layout')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <img class="decoration-back" src="http://127.0.0.1:8000/assets/client/images/banner/banner_0.jpg" alt="">

    <div id="snow-container"></div>

    <div class="form-contain">

        <div class="overlay">

            <img class="decoration" src="http://127.0.0.1:8000/assets/client/images/logo/logo_art.png" alt="Logo Art">


            <div class="titre-register" style="margin-top: 30px">
                <h2>Đăng Ký</h2>
                <p>Chào mừng bạn đến với Articaft</p>
                <button class="btn-login">Đăng Nhập</button>
            </div>

            <div class="titre-login" style="margin-top: 50px">

                <p>Chào mừng bạn đến với Articaft. Hãy Đăng Nhập ngay !</p>
                <button class="btn-register">Đăng Ký</button>
            </div>

        </div>

        <div class="form-list">
            <form class="login" action="{{ route('auth.login') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h2>Đăng Nhập</h2>
                <div class="input-group mb-3">
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        class="form-control form-control-lg bg-light fs-6 @error('email') is-invalid @enderror"
                        placeholder="Email">

                </div>
                <div class="input-group mb-3">
                    <input type="password" id="password" name="password" value="{{ old('password') }}" required
                        class="form-control form-control-lg bg-light fs-6 @error('password') is-invalid @enderror"
                        placeholder="Mật khẩu">
                    @if (session('login_error'))
                        <div class="alert alert-danger">
                            {{ session('login_error') }}
                        </div>
                    @endif

                </div>

                <div class="nut-button">
                    <input type="submit" value="Đăng Nhập">
                </div>
                <div class="row">
                    <small> <a href="{{ route('auth.forgot_password') }}"> Quên mật khẩu </a></small>
                </div>
                <div class="input-group d-flex mb-3 ">
                    <a href="{{ route('auth.google') }}" style=" margin-right: 40px;  text-decoration: none;">
                        <img src="{{ asset('assets/client/images/icon/icons8-google-48.png') }}" class="social-icon">
                    </a>

                    <a href="" style=" margin-left: 0px;  text-decoration: none;">
                        <img src="{{ asset('assets/client/images/icon/icons8-facebook-48.png') }}" class="social-icon">
                    </a>
                </div>

            </form>
        </div>

        <div class="form-list">
            <form class="register" action="{{ route('auth.register') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" id="ho_ten" name="ho_ten" value="{{ old('ho_ten') }}" required
                        class="form-control form-control-lg bg-light fs-6 @error('ho_ten') is-invalid @enderror"
                        placeholder="Họ Tên">
                    @error('ho_ten')
                        <span class="invalid-feedback d-block mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        class="form-control form-control-lg bg-light fs-6 @error('email') is-invalid @enderror"
                        placeholder="Email">
                    @error('email')
                        <span class="invalid-feedback d-block mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="number" id="so_dien_thoai" name="so_dien_thoai" value="{{ old('so_dien_thoai') }}"
                        required
                        class="form-control form-control-lg bg-light  fs-6 @error('so_dien_thoai') is-invalid @enderror"
                        placeholder="Số điện thoại">
                    @error('so_dien_thoai')
                        <span class="invalid-feedback d-block mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="password" id="password" name="password" required
                        class="form-control form-control-lg bg-light fs-6 @error('password') is-invalid @enderror"
                        placeholder="Mật Khẩu">
                    @error('password')
                        <span class="invalid-feedback d-block mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="form-control form-control-lg bg-light fs-6 @error('password_confirmation') is-invalid @enderror"
                        placeholder="Xác nhận mật khẩu">
                    @error('password_confirmation')
                        <span class="invalid-feedback d-block mt-1">{{ $message }}</span>
                    @enderror




                </div>
                <div class="nut-button">
                    <input type="submit" value="Đăng Ký">
                </div>
        </div>

        </form>
    </div>

    <svg class="wave-svg" width="732" height="136" viewBox="0 0 732 136" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path
            d="M0 8.45888V109C0 123.912 12.0883 136 27 136H704.938C726.424 136 739.186 112.207 726.912 94.5719C712.116 73.3129 694.835 49.4713 683.965 37.7334C661.789 13.7871 602.805 -0.265669 539.433 15.6257C476.061 31.517 439.194 53.2459 393.889 69.1733C336.766 89.2556 288.703 90.1814 232.182 69.1733C191.945 54.2179 191.297 22.9896 150.781 8.45888C97.7137 -10.5736 0 8.45888 0 8.45888Z"
            fill="white" />
    </svg>
    </div>


    <script>
        const registerBtn = document.querySelector(".btn-register");
        const loginBtn = document.querySelector(".btn-login");
        const overlayDiv = document.querySelector(".overlay");
        const titreregister = document.querySelector(".titre-register");
        const titrelogin = document.querySelector(".titre-login");
        const shadow = document.querySelector(".overlay");

        registerBtn.addEventListener("click", () => {
            overlayDiv.style.transform = "translateX(0)";
            registerBtn.style.display = "none";
            loginBtn.style.display = "block";
            titreregister.style.display = "flex";
            titrelogin.style.display = "none";
            shadow.style.boxShadow = "10px 4px 7px rgba(0, 0, 0, 0.24)";
        });

        loginBtn.addEventListener("click", () => {
            overlayDiv.style.transform = "translateX(100%)";
            registerBtn.style.display = "block";
            loginBtn.style.display = "none";
            titreregister.style.display = "none";
            titrelogin.style.display = "flex";
            shadow.style.boxShadow = "-10px 4px 7px rgba(0, 0, 0, 0.24)";
        });

        var NUMBER_OF_SNOWFLAKES = 30;

        function createSnowflake() {
            var snowflake = document.createElement("div");
            snowflake.classList.add("snowflake");

            snowflake.style.left = Math.random() * 100 + "vw";

            snowflake.style.animationDuration = Math.random() * 3 + 2 + "s";
            snowflake.style.animationDelay = Math.random() * 5 + "s";

            document.getElementById("snow-container").appendChild(snowflake);
        }

        for (let i = 0; i < NUMBER_OF_SNOWFLAKES; i++) {
            createSnowflake();
        }


        document.addEventListener("click", function(event) {
            createSnowflake();
        });

        @if (session('status'))
            Swal.fire({
                icon: 'success',
                title: 'Thành công',
                text: '{{ session('status') }}',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
@endsection
