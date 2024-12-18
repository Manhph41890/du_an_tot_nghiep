@extends('shipper.layout')

@section('content')
<div class="content-page">
    <div class="content">
        <h1 class="text-center mt-5">Chính sách vận chuyển</h1>
        <div class="container shipper-profits">
            <!-- Phạm vi vận chuyển -->
            <section class="policy">
                <h2>1. Phạm vi vận chuyển</h2>
                <p>Chúng tôi hỗ trợ vận chuyển đến hầu hết các tỉnh và thành phố trên toàn quốc. Đối với các khu vực vùng sâu, vùng xa hoặc địa chỉ đặc biệt, thời gian giao hàng có thể lâu hơn và phí vận chuyển có thể được điều chỉnh.</p>
                <p>Trước khi đặt hàng, khách hàng nên kiểm tra xem khu vực của mình có nằm trong phạm vi giao hàng của chúng tôi hay không.</p>
            </section>
            <!-- Thời gian giao hàng -->
            <section class="policy">
                <h2>2. Thời gian giao hàng</h2>
                <p>Thời gian giao hàng dự kiến được tính từ thời điểm đơn hàng được xác nhận thành công:</p>
                <ul>
                    <li><strong>Khu vực nội thành:</strong> Giao hàng trong vòng 1-2 ngày làm việc.</li>
                    <li><strong>Khu vực ngoại thành:</strong> Giao hàng trong vòng 2-5 ngày làm việc.</li>
                    <li><strong>Khu vực vùng sâu, vùng xa:</strong> Thời gian giao hàng có thể kéo dài từ 5-7 ngày làm việc.</li>
                </ul>
                <p>Thời gian giao hàng có thể thay đổi tùy vào tình hình thời tiết, lễ Tết, hoặc các sự kiện bất khả kháng.</p>
            </section>
            <!-- Chi phí vận chuyển -->
            <section class="policy">
                <h2>3. Chi phí vận chuyển</h2>
                <p>Chi phí vận chuyển sẽ được tính dựa trên địa điểm giao hàng và giá trị đơn hàng:</p>
                <table class="shipping-table">
                    <thead>
                        <tr>
                            <th>Khu vực</th>
                            <th>Chi phí</th>
                            <th>Điều kiện miễn phí</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Nội thành</td>
                            <td>20,000 VND</td>
                            <td>Miễn phí cho đơn hàng từ 500,000 VND</td>
                        </tr>
                        <tr>
                            <td>Ngoại thành</td>
                            <td>50,000 VND</td>
                            <td>Miễn phí cho đơn hàng từ 1,000,000 VND</td>
                        </tr>
                        <tr>
                            <td>Vùng sâu, vùng xa</td>
                            <td>100,000 VND</td>
                            <td>Không áp dụng miễn phí</td>
                        </tr>
                    </tbody>
                </table>
            </section>
            <!-- Quy định đóng gói -->
            <section class="policy">
                <h2>4. Quy định đóng gói</h2>
                <p>Hàng hóa sẽ được đóng gói cẩn thận để đảm bảo an toàn trong quá trình vận chuyển. Các mặt hàng dễ vỡ sẽ được bọc thêm lớp chống sốc để tránh hư hại.</p>
                <p>Trong trường hợp khách hàng nhận được kiện hàng bị móp méo hoặc hư hỏng, vui lòng chụp ảnh và liên hệ với chúng tôi trong vòng 24 giờ kể từ khi nhận hàng.</p>
            </section>
            <!-- Chính sách đổi trả -->
            <section class="policy">
                <h2>5. Chính sách đổi trả hàng hóa</h2>
                <p>Chúng tôi chấp nhận đổi trả hàng trong các trường hợp sau:</p>
                <ul>
                    <li>Hàng hóa bị lỗi sản xuất.</li>
                    <li>Hàng hóa bị hư hỏng trong quá trình vận chuyển.</li>
                    <li>Hàng hóa không đúng với đơn đặt hàng.</li>
                </ul>
                <p>Khách hàng cần liên hệ bộ phận chăm sóc khách hàng trong vòng 7 ngày kể từ khi nhận hàng để được hỗ trợ đổi trả.</p>
            </section>
            <!-- Liên hệ hỗ trợ -->
            <section class="policy">
                <h2>6. Liên hệ hỗ trợ</h2>
                <p>Để được hỗ trợ thêm thông tin hoặc giải đáp thắc mắc, vui lòng liên hệ:</p>
                <ul>
                    <li>Hotline: 0394338046</li>
                    <li>Email: articraft@gmail.com</li>
                    <li>Thời gian hỗ trợ: 8:00 - 18:00 (Thứ 2 đến Thứ 7)</li>
                </ul>
            </section>
        </div>
    </div>
</div>

<style>
    .profit-card {
        background: linear-gradient(135deg, #28a745, #4caf50);
        /* Gradient xanh lá */
        color: #fff;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .profit-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    }

    /* Reset cơ bản */
    body,
    h1,
    h2,
    p,
    ul,
    li,
    table,
    th,
    td,
    a {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        background-color: #f8f9fa;
        color: #333;
        margin: 0;
    }
    .content h1{

        text-transform: uppercase;
        color: #007bff;
        font-weight: 600;
        font-size: 22px;
    }
    .header {
        background-color: #007bff;
        color: #fff;
        text-align: center;
        padding: 20px 0;
    }

    .container {
        max-width: 900px;
        margin: 20px auto;
        padding: 20px;
        background: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .policy {
        margin-bottom: 30px;
    }

    .policy h2 {
        color: #007bff;
        margin-bottom: 15px;
        font-weight: 600;
        font-size: 18px;
    }

    .policy p,
    .policy ul {
        margin-bottom: 15px;
    }

    .policy ul {
        list-style-type: disc;
        padding-left: 20px;
    }

    .shipping-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .shipping-table th,
    .shipping-table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    .shipping-table th {
        background-color: #007bff;
        color: #fff;
    }

    .shipping-table td {
        background-color: #f9f9f9;
    }

    .footer {
        text-align: center;
        padding: 10px;
        background-color: #f1f1f1;
        margin-top: 20px;
        font-size: 14px;
    }

    .footer a {
        color: #007bff;
        text-decoration: none;
    }
</style>
@endsection