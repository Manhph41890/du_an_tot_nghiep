 {{-- Đây là trang sau khi click vào quên pass nó sẽ gửi về mail    --}}
   {{-- form nha  --}}
<p>Chào {{ $user->ho_ten }},</p>
<p>Mã xác thực để đặt lại mật khẩu của bạn là: <strong>{{ $code }}</strong></p>
<p>Mã này có hiệu lực trong 30 phút.</p>
