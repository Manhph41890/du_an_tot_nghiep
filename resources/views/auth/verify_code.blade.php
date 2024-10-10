<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác thực đặt lại mật khẩu</title>
</head>
<body>
    <p>Chào {{ $ho_ten }},</p>
    <p>Mã xác thực để đặt lại mật khẩu của bạn là: <strong>{{ $token }}</strong></p>
    <p>Mã này có hiệu lực trong 30 phút.</p>
    <p>Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua email này.</p>
</body>
</html>
