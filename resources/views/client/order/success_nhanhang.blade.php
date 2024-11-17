@extends('client.layout')

@section('content')
    <div class="winter-theme">
        <div class="container">
            <div class="center-content">
                <h2 class="thank-you-message">Cảm ơn bạn đã đặt hàng!</h2>
                <p class="success-message">Đơn hàng của bạn đã được đặt thành công. Bạn sẽ nhận được email xác nhận trong
                    thời gian sớm nhất.</p>
                <a href="{{ route('client.home') }}" class="btn btn-primary continue-shopping">Tiếp tục mua sắm</a>
            </div>
        </div>
    </div>
@endsection

<style>
    /* Phong cách mùa đông */
    .winter-theme {
        background: linear-gradient(to bottom, #89cff0, #add8e6);
        /* Nền xanh nhẹ kiểu mùa đông */
        color: #333;
        padding: 50px 0;
        text-align: center;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        /* Căn giữa theo chiều dọc */
        justify-content: center;
        /* Căn giữa theo chiều ngang */
        height: 100vh;
        /* Chiều cao của trang */
    }

    /* Hiệu ứng tuyết rơi */
    .winter-theme::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        opacity: 0.2;
        animation: snow 10s linear infinite;
    }

    /* Nội dung chính căn giữa */
    .center-content {
        z-index: 1;
        /* Đảm bảo nội dung hiển thị trên tuyết */
    }

    /* Văn bản cảm ơn */
    .thank-you-message {
        font-size: 2.5rem;
        font-weight: bold;
        color: #003366;
        margin-bottom: 20px;
    }

    /* Thông báo đơn hàng thành công */
    .success-message {
        font-size: 1.2rem;
        margin-bottom: 30px;
        color: #555;
    }

    /* Nút "Tiếp tục mua sắm" */
    .continue-shopping {
        background-color: #0a74da;
        color: white;
        padding: 15px 30px;
        font-size: 1rem;
        text-transform: uppercase;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .continue-shopping:hover {
        background-color: #0056b3;
    }

    /* Hiệu ứng tuyết rơi */
    @keyframes snow {
        0% {
            background-position: 0 0;
        }

        100% {
            background-position: 0 100%;
        }
    }
</style>
