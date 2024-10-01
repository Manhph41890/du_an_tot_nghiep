<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <!-- Form gửi mã xác thực -->
    <form action="{{ route('auth.email') }}" method="POST" id="forgot-password-form">
        @csrf
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <button type="button" id="send-code-button" onclick="sendVerificationCode()">Gửi mã xác thực</button>
    </form>

    <p id="verification-message" style="display:none; color: green;">Mã xác thực có hiệu lực trong 30 phút.</p>

    <form action="{{ route('auth.verifycode') }}" method="POST" id="verification-form" style="display:none;">
        @csrf
        <div class="form-group">
            <label>Mã xác thực:</label>
            <input type="number" name="code" required>
        </div>
        <button type="button" id="confirm-code-button" onclick="confirmVerificationCode()">Xác nhận mã</button>
    </form>

    <script>
        function sendVerificationCode() {
            $.ajax({
                url: $('#forgot-password-form').attr('action'),
                method: 'POST',
                data: $('#forgot-password-form').serialize(),
                success: function(response) {
                    // Hiển thị thông báo
                    document.getElementById('verification-message').style.display = 'block';
                    document.getElementById('send-code-button').style.display = 'none';
                    document.getElementById('verification-form').style.display = 'block';
                },
                error: function(xhr) {
                    // Xử lý lỗi nếu cần
                    alert('Có lỗi xảy ra. Vui lòng thử lại.');
                }
            });
        }

        function confirmVerificationCode() {
            $.ajax({
                url: $('#verification-form').attr('action'),
                method: 'POST',
                data: $('#verification-form').serialize(),
                success: function(response) {
                    // Redirect to password reset
                    if (response.redirectUrl) {
                        window.location.href = response.redirectUrl;
                    }
                },
                error: function(xhr) {
                    const errorResponse = xhr.responseJSON;
                    if (errorResponse.error) {
                        alert(errorResponse.error);
                    } else {
                        alert('Có lỗi xảy ra. Vui lòng thử lại.');
                    }
                }
            });
        }
    </script>
</body>

</html>
