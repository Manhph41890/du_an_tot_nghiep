<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    ::after,
    ::before {
        box-sizing: border-box;
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        position: relative;
    }



    .form-contain {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 732px;
        height: 557px;
        position: relative;
        background: #d9d9d9;
        border-radius: 27px;
        box-shadow: 18px 25px 29px rgba(0, 0, 0, 0.25);
    }

    .form-list {
        position: relative;
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .form-list form {
        gap: 17px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    .form-list form input {
        border: none;
        width: 226px;
        height: 45.73px;
        background: #ffffff;
        box-shadow: 0px 8px 4px rgba(97, 178, 228, 0.44);
        border-radius: 37px;
    }

    .form-list form input::placeholder {
        padding: 18px;
    }

    .overlay {
        width: 50%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: all 0.5s ease-in-out;
        z-index: 1;
        border-radius: 27px;
        box-shadow: 10px 4px 7px rgba(0, 0, 0, 0.24);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .overlay .titre-login {
        gap: 45px;
        flex-direction: column;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        display: none;
    }

    .overlay .titre-register {
        gap: 45px;
        flex-direction: column;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .btn-register {
        color: #000;
        padding: 10px 20px;
        border: none;
        margin-right: 10px;
        display: none;
        background: #cccccc;
        box-shadow: 0px 4px 4px rgba(97, 178, 228, 0.44);
        border-radius: 37px;
        font-size: 20px;
    }

    .btn-login {
        color: black;
        padding: 10px 20px;
        border: none;
        margin-left: 10px;
        background: #cccccc;
        box-shadow: 0px 4px 4px rgba(97, 178, 228, 0.44);
        border-radius: 37px;
        font-size: 20px;
    }

    .decoration {
        position: absolute;
        top: 35px;
        width: 100%;
        border: none;
    }

    .wave-svg {
        position: absolute;
        bottom: 0px;
        width: 100%;
    }

    #snow-container {
        position: absolute;
        width: 100%;
        height: 100vh;
        overflow: hidden;
        background-color: rgba(0, 0, 0, 0.04);
    }

    .snowflake {
        position: absolute;
        top: -10px;
        display: block;
        width: 10px;
        height: 10px;
        border: 1px solid #000000;
        background-color: #fff;
        border-radius: 50%;
        opacity: 0.7;
        animation: fall linear infinite;
    }

    @keyframes fall {
        0% {
            transform: translateY(-50px);
        }

        100% {
            transform: translateY(100vh);
        }
    }

    .decoration-back {
        position: absolute;
        bottom: 0;
        width: 100%;
    }

    .decoration-back .carpet-snow {
        height: 20%;
        width: 100%;
        z-index: 2;
    }

    .decoration-back .tree {
        position: relative;
        top: 100px;
    }

    .is-invalid {
        border-color: red;
    }

    .invalid-feedback {
        color: red;
        font-size: 12px;
        margin-top: 5px;
    }

    /* Style the div container */
    .nut-button {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
        /* Add space above the button */
        width: 100%;
        /* Ensure the container stretches to full width */
    }

    /* Style the submit button */
    .nut-button input[type="submit"] {
        padding: 12px 25px;
        /* Add padding inside the button */
        background-color: #1da8ff;
        /* Green color for the button */
        color: white;
        border: none;
        border-radius: 30px;
        /* Rounded corners */
        font-size: 16px;
        /* Set font size for button text */
        cursor: pointer;
        width: 100%;
        /* Make the button fill the container */
        max-width: 300px;
        /* Optional: limit the width */
        transition: background-color 0.3s ease, transform 0.3s ease;
        /* Smooth transitions */
    }

    /* Hover effect for the button */
    .nut-button input[type="submit"]:hover {
        background-color: #1658b5;
        /* Darker green on hover */
        transform: scale(1.05);
        /* Slightly grow the button on hover */
    }

    /* Focus effect for better accessibility */
    .nut-button input[type="submit"]:focus {
        outline: none;
        /* Remove default outline */
        box-shadow: 0 0 5px rgba(15, 47, 255, 0.5);
        /* Green shadow when focused */
    }
</style>

<body>
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
                    <a href="" style=" margin-right: 40px;  text-decoration: none;">
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
</body>
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
</script>
