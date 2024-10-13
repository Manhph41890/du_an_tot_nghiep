<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Quên mật khẩu</title>

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center">Quên mật khẩu</h2>

        <!-- Form gửi mã xác thực -->
        <form action="{{ route('auth.email') }}" method="POST" id="forgot-password-form">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <button type="button" id="send-code-button" class="btn btn-primary" onclick="sendVerificationCode()">Gửi mã xác thực</button>
        </form>

        <p id="verification-message" style="display:none; color: green;" class="mt-3">Mã xác thực có hiệu lực trong 30 phút.</p>

        <!-- Form nhập mã xác thực -->
        <form action="{{ route('auth.verifycode') }}" method="POST" id="verification-form" style="display:none;">
            @csrf
            <input type="hidden" name="email" id="verification-email">
            <div class="mb-3">
                <label class="form-label">Mã xác thực:</label>
                <input type="text" name="token" class="form-control" required>
            </div>
            <button type="button" id="confirm-code-button" class="btn btn-success" onclick="confirmVerificationCode()">Xác nhận mã</button>
        </form>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
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
                    $('#verification-message').show();
                    $('#send-code-button').hide();
                    $('#verification-form').show();

                    // Set the email in the hidden input for the verification form
                    $('#verification-email').val(email);
                },
                error: function(xhr) {
                    alert('Lỗi: ' + xhr.responseJSON.message);
                }
            });
        }

        function confirmVerificationCode() {
            $.ajax({
                url: $('#verification-form').attr('action'),
                method: 'POST',
                data: $('#verification-form').serialize(),
                success: function(response) {
                    if (response.redirectUrl) {
                        $('#verification-form').hide();
                        $('#reset-password-form').show(); // Ensure you have this form defined elsewhere
                    }
                },
                error: function(xhr) {
                    alert('Lỗi mã xác thực: ' + xhr.responseJSON.message);
                }
            });
        }
    </script>
</body>

</html>
