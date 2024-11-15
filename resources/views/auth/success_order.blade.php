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
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
        }

        img.logo {
            max-width: 150px;
            margin: 0 auto 20px;
            display: block;
        }

        h3 {
            color: #0056b3;
        }

        ul {
            list-style: none;
            padding: 0;
            text-align: left;
            margin: 0 auto;
            display: inline-block;
        }

        ul li {
            margin-bottom: 8px;
        }

        h3 {
            color: #0056b3;
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
    <img src="https://i.imgur.com/vPk7lbg.png" alt="Uploaded Image">
    <p>Chào <strong>{{ $ho_ten }}</strong>,</p>

    <h3>Thông tin đơn hàng</h3>
    <ul>
        <li><strong>Mã đơn hàng:</strong> {{ $order->id }}</li>
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

    <p>Cảm ơn bạn đã mua hàng tại Articraft!</p>
    <p>Chúc bạn một ngày tốt lành.</p>
</body>

</html>
