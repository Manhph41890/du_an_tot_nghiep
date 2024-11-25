@extends('auth.layout')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (session('status'))
        <div class="modal" style="width:200px">
            <div class="modal-content">
                <span class="close-btn">&times;</span>
                <p>{{ session('status') }}</p>
            </div>
        </div>
    @endif


    <img style="filter: blur(2.5px);" class="decoration-back" src="{{asset('assets/client/images/banner/Banner2.jpg')}}" alt="">
    <div id="snow-container"></div>
    <div class="form-contain">
        <div class="overlay">
            <img class="decoration" src="{{asset('assets/client/images/logo/logo_art.png')}}" alt="Logo Art">
            <div class="forgot-password">
                <h2  style="font-family: Arial;">Quên mật khẩu</h2>
                <p  style="font-family: Arial;">Vui lòng nhập đúng địa chỉ email !</p>
            </div>
        </div>
        <div class="form-list"></div>
        <div class="form-list mb-3 ">

            <!-- Form gửi mã xác thực -->
            <form action="{{ route('auth.email') }}" method="POST" id="forgot-password-form">
                @csrf
                <div class="input-group mb-3">

                    <input type="email" name="email" id="email" class="form-control form-control-lg bg-light fs-6"
                        placeholder="Email" value="{{ old('email') }}" required>
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
        </div>
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
@endsection
