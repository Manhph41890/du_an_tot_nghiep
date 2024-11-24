@extends('auth.layout')
@section('content')
    <img style="filter: blur(2.5px);" class="decoration-back" src="{{asset('assets/client/images/banner/Banner2.jpg')}}" alt="">

    <div id="snow-container"></div>

    <div class="form-contain">

        <div class="overlay">

            <img class="decoration" src="{{asset('assets/client/images/logo/logo_art.png')}}" alt="Logo Art">


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
                @if (session('login_error'))
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Đăng nhập thất bại',
                            text: @json(session('login_error')),
                            confirmButtonText: 'OK'
                        });
                    </script>
                @endif
                <div class="input-group mb-3">
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        class="form-control form-control-lg bg-light fs-6 @error('email') is-invalid @enderror"
                        placeholder="Email">

                </div>
                <div class="input-group mb-3">
                    <input type="password" id="password" name="password" value="{{ old('password') }}" required
                        class="form-control form-control-lg bg-light fs-6 @error('password') is-invalid @enderror"
                        placeholder="Mật khẩu">
                    <i class="bi bi-eye" id="togglePasswordIcon"></i>

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
                    <input type="text" id="so_dien_thoai" name="so_dien_thoai" value="{{ old('so_dien_thoai') }}"
                        required
                        class="form-control form-control-lg bg-light  fs-6 @error('so_dien_thoai') is-invalid @enderror"
                        placeholder="Số điện thoại">

                </div>
                @error('so_dien_thoai')
                    <span class="invalid-feedback d-block mt-1">{{ $message }}</span>
                @enderror

                <div class="input-group mb-3">
                    <input type="password" id="password" name="password" required
                        class="form-control form-control-lg bg-light fs-6 @error('password') is-invalid @enderror"
                        placeholder="Mật Khẩu">

                </div>
                @error('password')
                    <span class="invalid-feedback d-block mt-1">{{ $message }}</span>
                @enderror
                <div class="input-group mb-3">
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="form-control form-control-lg bg-light fs-6 @error('password_confirmation') is-invalid @enderror"
                        placeholder="Xác nhận mật khẩu">
                </div>
                @error('password_confirmation')
                    <span class="invalid-feedback d-block mt-1">{{ $message }}</span>
                @enderror
                <div class="nut-button">
                    <input type="submit" value="Đăng Ký">
                </div>
        </div>

        </form>
    </div>


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


        document.querySelector('.toggle-password').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePasswordIcon');

            // Kiểm tra và thay đổi loại input
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        });
    </script>
@endsection
