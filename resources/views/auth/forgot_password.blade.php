@extends('auth.layout')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (session('status'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('status') }}',
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ $errors->first() }}',
            });
        </script>
    @endif

    {{-- @if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
@endif --}}
    @if (session('status'))
        <div class="modal" style="200px">
            <div class="modal-content">
                <span class="close-btn">&times;</span>
                <p>{{ session('status') }}</p>
            </div>
        </div>
    @endif


    <img class="decoration-back" src="http://127.0.0.1:8000/assets/client/images/banner/banner_0.jpg" alt="">
    <div id="snow-container"></div>
    <div class="form-contain">
        <div class="overlay">
            <img class="decoration" src="http://127.0.0.1:8000/assets/client/images/logo/logo_art.png" alt="Logo Art">
            <div class="forgot-password">
                <h2>Quên mật khẩu</h2>
                <p>Vui lòng nhập đúng địa chỉ email !</p>
            </div>
        </div>
        <div class="form-list"></div>
        <div class="form-list mb-3 ">
            {{-- <p id="verification-message" style="display:none; color: green; margin:20px" class="mt-3">Mã xác thực có
            hiệu lực
            trong 30 phút.</p> --}}
            <!-- Form gửi mã xác thực -->
            <form action="{{ route('auth.email') }}" method="POST" id="forgot-password-form">
                @csrf
                <div class="input-group mb-3">

                    <input type="email" name="email" id="email" class="form-control form-control-lg bg-light fs-6"
                        placeholder="Email" value="{{ old('email') }}" required>
                </div>
                <div class="nut-button">
                    <button type="button" id="send-code-button" class="btn btn-primary"
                        onclick="sendVerificationCode()">Gửi mã xác thực</button>
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
        // Wait for the document to be ready
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });



        function sendVerificationCode() {
            var email = $('#email').val(); // Get the email value

            $.ajax({
                url: $('#forgot-password-form').attr('action'),
                method: 'POST',
                data: $('#forgot-password-form').serialize(),
                success: function(response) {
                    // Show a success SweetAlert2 message
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công',
                        text: 'Mã xác thực đã được gửi đến email của bạn.',
                    });

                    // Show the verification form
                    $('#verification-message').show();
                    $('#send-code-button').hide();
                    $('#verification-form').show();

                    // Set the email in the hidden input for the verification form
                    $('#verification-email').val(email);
                },
                error: function(xhr) {
                    // Show an error SweetAlert2 message if the email doesn't exist
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi',
                        text: 'Email không tồn tại trên hệ thống.',
                    });
                }

            });
        }

        // Function to confirm the verification code
        function confirmVerificationCode() {
            $.ajax({
                url: $('#verification-form').attr('action'),
                method: 'POST',
                data: $('#verification-form').serialize(),
                success: function(response) {


                    if (response.redirectUrl) {
                        $('#verification-form').hide();
                        window.location.href = response.redirectUrl; // Redirect to reset password page
                    }
                },
                error: function(xhr) {
                    alert('Lỗi mã xác thực: ' + xhr.responseJSON.message);
                }
            });



        }
    </script>
@endsection
