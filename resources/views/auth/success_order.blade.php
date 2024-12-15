<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
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
            max-width: 80%;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #f8f9fa;
            color: #333;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e9ecef;
        }

        td {
            color: #555;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class=".c">
            <img src="https://i.imgur.com/vPk7lbg.png" alt="Uploaded Image">
        </div>

        <h1>Đặt hàng thành công</h1>
        <p>Chào <strong>{{ $order->user->ho_ten }}</strong>,</p>
        <p>Đơn hàng của bạn với mã <strong>{{ $order->ma_don_hang }}</strong> Đặt hàng thành công. Dưới đây là thông
            tin
            chi tiết:</p>

        <div class="order-info">
            <ul>
                <li><strong>Mã đơn hàng:</strong> {{ $order->ma_don_hang }}</li>
                <li><strong>Ngày đặt:</strong> {{ $order->ngay_tao }}</li>
                <li><strong>Phương thức thanh toán:</strong> {{ $order->phuong_thuc_thanh_toan->kieu_thanh_toan }}</li>
                <li><strong>Phương thức vận chuyển:</strong> {{ $order->phuong_thuc_van_chuyen->kieu_van_chuyen }}</li>
                <li><strong>Tổng tiền:</strong> {{ number_format($order->tong_tien, 0, ',', '.') }} VND</li>
                <li><strong>Số điện thoại:</strong> {{ $order->so_dien_thoai }}</li>
                <li><strong>Địa chỉ nhận hàng:</strong> {{ $order->dia_chi }}</li>
            </ul>
            <h3>Danh sách sản phẩm</h3>
            <table>
                <thead>
                    <tr>
                        <th>Ảnh sản phẩm</th>
                        <th>Sản phẩm</th>
                        <th>Màu sắc</th>
                        <th>Kích thước</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->chi_tiet_don_hangs as $chiTiet)
                        <tr>
                            <td>
                                <img src="{{ url('storage/' . $chiTiet->san_pham->anh_san_pham) }}"
                                    alt="{{ $chiTiet->san_pham->ten_san_pham }}" style="width: 100px; height: auto;">
                            </td>

                            <td>{{ $chiTiet->san_pham->ten_san_pham }}</td>
                            <td>{{ $chiTiet->color_san_pham->ten_color }}</td>
                            <td>{{ $chiTiet->size_san_pham->ten_size }}</td>
                            <td>{{ $chiTiet->so_luong }}</td>
                            <td>{{ number_format($chiTiet->gia_tien, 0, ',', '.') }} VND</td>
                            <td>{{ number_format($chiTiet->thanh_tien, 0, ',', '.') }} VND</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <p>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.</p>
        <p><a href="{{ route('taikhoan.dashboard') }}">Kiểm tra đơn hàng</a></p>
    </div>
    <p>Cảm ơn bạn đã mua hàng tại Articraft!</p>
    <p>Chúc bạn một ngày tốt lành.</p>
</body>

</html>
