<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Art</title>

</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Item", cursive;
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


    .mb-3 {
        margin-bottom: 20px;
    }

    /* .form-contain {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 732px;
        height: 557px;
        position: relative;
        background: #d9d9d9;
        border-radius: 27px;
        box-shadow: 18px 25px 29px rgba(0, 0, 0, 0.25);
    } */

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
        padding: 15px 15px;
    }

    .form-list form input::placeholder {
        padding: 8px;
    }

    .form-list form input:focus {
        border: none !important;
    }

    .overlay {
        width: 400px;
        height: 557px;
        /* position: absolute; */
        top: 10;
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
     .banner{
        position: fixed;
     }
    .overlay h2
    {
        text-align: center;
        margin-top: -180px;
        
    }
    .overlay p {
        margin-bottom: 100px;
    }

    .btn-register {
        color: #fff;
        padding: 10px 20px;
        border: none;
        margin-right: 10px;
        display: none;
        background: #1da8ff;
        box-shadow: 0px 4px 4px rgba(97, 178, 228, 0.44);
        border-radius: 37px;
        font-size: 18px;
        font-weight: 600;
    }

    .btn-register:hover {
        background: #1281c7;
    }

    .btn-login {
        color: #fff;
        padding: 10px 20px;
        border: none;
        margin-left: 10px;
        background: #1da8ff;
        box-shadow: 0px 4px 4px rgba(97, 178, 228, 0.44);
        border-radius: 37px;
        font-size: 18px;
        font-weight: 600;
    }

    .btn-login:hover {
        background: #1281c7;
    }

    .decoration {
        position: absolute;
        top: -290px;
        width: 250px;
        align-items: center;
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




    Style the div container
    .nut-button {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 210px;
        /* Add space above the button */
        width: 266px;
        /* Ensure the container stretches to full width */
    }

    .nut-button input {
        font-size: 18px;
        font-weight: 600;
    }

    /* Style the submit button */
    .nut-button button {
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
        width: 226px;
        ma
        /* Make te button fill the container */
        max-width: 300px;
        /* Optional: limit the width */
        transition: background-color 0.3s ease, transform 0.3s ease;
        /* Smooth transitions */

    }

    /* Hover effect for the button */
    .nut-button button:hover {
        background-color: #1658b5;
        /* Darker green on hover */
        transform: scale(1.05);
        /* Slightly grow the button on hover */
    }

    /* Focus effect for better accessibility */
    .nut-button button:active {
        outline: none;
        /* Remove default outline */
        box-shadow: 0 0 5px rgba(15, 47, 255, 0.5);
        /* Green shadow when focused */
    }

    /* .forgot-password {
        margin-top: -150px;
        text-align: center;

    } */

    .input-group {
        margin-top: 20px;

    }

    .forgot-password h2,
    {
    position: absolute;
    margin-top: 0px;
    /* Remove default margins to ensure even spacing */
    padding: 0;
    /* Remove padding if needed */
    }




</style>

<body>


    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (session('status'))
        <div class="modal" style="width:200px">
            <div class="modal-content">
                <span class="close-btn">&times;</span>
                <p>{{ session('status') }}</p>
            </div>
        </div>
    @endif


    <img style="filter: blur(2.5px);" class="decoration-back"
        src="{{ asset('assets/client/images/banner/Banner2.jpg') }}" alt="">
    <div id="snow-container"></div>

    <div class="form-contain">
        <div class="overlay form-list mb-3">
            <div class="banner ">
                <img class="decoration" src="{{ asset('assets/client/images/logo/logo_art.png') }}" alt="Logo Art">
            <h2>Quên mật khẩu</h2>
            <p>Vui lòng nhập đúng địa chỉ email !</p>
            </div>
            <div class="forgot-password">


                <form action="{{ route('auth.email') }}" method="POST" id="forgot-password-form">
                    @csrf
                    <div class="input-group">

                        <input type="email" name="email" id="email"
                            class="form-control form-control-lg bg-light fs-6" placeholder="Email"
                            value="{{ old('email') }}" required>
                    </div>
                    <div class="nut-button">
                        <button type="button" id="send-code-button" class="btn btn-primary">Gửi mã xác thực</button>
                    </div>
                </form>



                <!-- Form nhập mã xác thực -->
                <form action="{{ route('auth.verifycode') }}" method="POST" id="verification-form"
                    style="display:none;">
                    @csrf
                    <input type="hidden" name="email" id="verification-email">
                    <div class="input-group">

                        <input type="text" name="token" class="form-control form-control-lg bg-light fs-6"
                            placeholder="Nhập mã xác thực" required>
                    </div>
                    <div class="nut-button">
                        <button type="submit" id="confirm-code-button" class="btn btn-success">Xác nhận mã</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- <div class="form-list"></div> --}}
        {{-- <div class="form-list mb-3 ">

            <!-- Form gửi mã xác thực -->
            <form action="{{ route('auth.email') }}" method="POST" id="forgot-password-form">
                @csrf
                <div class="input-group mb-3">

                    <input type="email" name="email" id="email"
                        class="form-control form-control-lg bg-light fs-6" placeholder="Email"
                        value="{{ old('email') }}" required>
                </div>
                <div class="nut-button">
                    <button type="button" id="send-code-button" class="btn btn-primary">Gửi mã xác thực</button>
                </div>
            </form>



            <!-- Form nhập mã xác thực -->
            <form action="{{ route('auth.verifycode') }}" method="POST" id="verification-form" style="display:none;">
                @csrf
                <input type="hidden" name="email" id="verification-email">
                <div class="input-group mb-3">

                    <input type="text" name="token" class="form-control form-control-lg bg-light fs-6"
                        placeholder="Nhập mã xác thực" required>
                </div>
                <div class="nut-button">
                    <button type="submit" id="confirm-code-button" class="btn btn-success">Xác nhận mã</button>
                </div>
            </form>
        </div> --}}
    </div>

    <!-- Load jQuery first -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Then load Bootstrap Bundle JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Thiết lập AJAX CSRF token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Xử lý sự kiện bấm phím Enter để gửi mã
            $('#email').on('keydown', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    $('#send-code-button').click(); // Kích hoạt nút gửi mã
                }
            });

            // Gắn sự kiện click cho nút gửi mã xác thực (đảm bảo chỉ đăng ký 1 lần)
            $('#send-code-button').on('click', function() {
                sendVerificationCode();
            });
        });

        function sendVerificationCode() {
            var email = $('#email').val(); // Lấy giá trị email

            // Gọi AJAX để gửi yêu cầu
            $.ajax({
                url: $('#forgot-password-form').attr('action'), // Lấy URL từ form
                method: 'POST',
                data: $('#forgot-password-form').serialize(),
                success: function(response) {
                    // Hiển thị thông báo thành công bằng SweetAlert2
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công',
                        text: response.message, // Sử dụng thông báo từ server
                    });

                    // Hiển thị form nhập mã xác thực
                    $('#verification-message').show();
                    $('#send-code-button').hide();
                    $('#verification-form').show();

                    // Gán email vào input ẩn trong form xác thực   
                    $('#verification-email').val(email);
                },
                error: function(xhr) {
                    if (xhr.status === 404) {
                        // Hiển thị thông báo lỗi nếu email không tồn tại
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi',
                            text: 'Email không tồn tại trên hệ thống.',
                        });
                    } else {
                        // Xử lý các lỗi khác
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi',
                            text: 'Đã xảy ra lỗi, vui lòng thử lại.',
                        });
                    }
                }
            });
        }
        // Xử lý sự kiện bấm xác nhận mã
        $('#confirm-code-button').on('click', function(e) {
            e.preventDefault(); // Ngăn form tự động submit
            const resetPasswordUrl = "{{ route('auth.reset_password', ':token') }}";
            $.ajax({
                url: $('#verification-form').attr('action'), // Lấy URL từ form xác nhận mã
                method: 'POST',
                data: $('#verification-form').serialize(),
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công',
                        text: response.message,
                    });

                    // Chuyển hướng sang trang đặt lại mật khẩu nếu cần
                    const redirectUrl = resetPasswordUrl.replace(':token', $(
                            '#verification-form [name="token"]').val()) +
                        `?email=${encodeURIComponent($('#verification-email').val())}`;

                    // Redirect to the reset password page
                    window.location.href = redirectUrl;
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        // Hiển thị thông báo lỗi nếu mã xác thực không hợp lệ
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi',
                            text: xhr.responseJSON.message, // Sử dụng thông báo từ server
                        });
                    } else {
                        // Xử lý các lỗi khác
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi',
                            text: 'Đã xảy ra lỗi, vui lòng thử lại.',
                        });
                    }
                },
            });
        });
    </script>

    <!-- SweetAlert2 CDN -->
</body>



</html>
