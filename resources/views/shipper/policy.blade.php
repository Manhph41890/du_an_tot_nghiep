@extends('shipper.layout')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container shipper-profits">
            <main class="container">
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
                
        </div>
    </div>
</div>

<style>
    

</style>
@endsection