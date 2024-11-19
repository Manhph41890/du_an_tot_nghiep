<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận hủy đơn hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .container {
            max-width: 100%;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #e63946;
            font-size: 24px;
            text-align: center;
        }

        p {
            margin: 15px 0;
            font-size: 16px;
        }

        .order-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }

        .order-info ul {
            list-style: none;
            padding: 0;
        }

        .order-info li {
            margin: 10px 0;
            font-size: 14px;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #555;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        img.logo {
            max-width: 150px;
            margin: 0 auto 20px;
            display: block;
        }

        .c {
            display: flex;
            justify-content: center
        }
    </style>
</head>

<body>

    <div class="container">
        <div class=".c">
            <img src="https://i.imgur.com/vPk7lbg.png" alt="Uploaded Image">
        </div>

        <h1>Xác nhận hủy đơn hàng</h1>
        <p>Chào <strong>{{ $order->user->ho_ten }}</strong>,</p>
        <p>Đơn hàng của bạn với mã <strong>{{ $order->ma_don_hang }}</strong> đã được hủy thành công.
            @if ($order->trang_thai_thanh_toan == 'Đã thanh toán')
                Tiền thanh toán đơn hàng của bạn sẽ được hoàn trong 24h tới
            @endif
            Dưới đây là thông
            tin
            chi tiết:
        </p>

        <div class="order-info">
            <ul>
                <li><strong>Mã đơn hàng:</strong> {{ $order->ma_don_hang }}</li>
                <li><strong>Ngày đặt hàng:</strong> {{ $order->ngay_tao }}</li>
                <li><strong>Trạng thái:</strong> {{ $order->trang_thai_don_hang }}</li>
                <li><strong>Phương thức thanh toán:</strong> {{ $order->phuong_thuc_thanh_toan->kieu_thanh_toan }}</li>
                <li><strong>Phương thức vận chuyển:</strong> {{ $order->phuong_thuc_van_chuyen->kieu_van_chuyen }}</li>
                <li><strong>Tổng tiền:</strong> {{ number_format($order->tong_tien, 0, ',', '.') }} VND</li>
            </ul>
        </div>
        <p>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.</p>
        <p><a href="{{ route('taikhoan.dashboard') }}">Kiểm tra đơn hàng</a></p>
    </div>
    </div>
</body>

</html>
