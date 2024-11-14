@extends('client.layout')

@section('content')
    <style>
        .winter-theme {
            background: linear-gradient(to bottom, #89cff0, #add8e6);
            color: #333;
            padding: 50px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .snowflake {
            position: absolute;
            top: -10px;
            background-color: #fff;
            border-radius: 50%;
            opacity: 0.8;
            animation: snow 10s linear infinite;
        }

        @keyframes snow {
            0% {
                transform: translateY(0) rotate(0deg);
            }

            100% {
                transform: translateY(100vh) rotate(360deg);
            }
        }

        .snowflake:nth-child(1) {
            width: 8px;
            height: 8px;
            animation-duration: 12s;
            left: 10%;
        }

        .snowflake:nth-child(2) {
            width: 10px;
            height: 10px;
            animation-duration: 15s;
            left: 25%;
        }

        .snowflake:nth-child(3) {
            width: 12px;
            height: 12px;
            animation-duration: 14s;
            left: 50%;
        }

        .snowflake:nth-child(4) {
            width: 6px;
            height: 6px;
            animation-duration: 18s;
            left: 75%;
        }

        .snowflake:nth-child(5) {
            width: 10px;
            height: 10px;
            animation-duration: 13s;
            left: 90%;
        }

        .center-content {
            z-index: 1;
            position: relative;
        }

        .thank-you-message {
            font-size: 2.5rem;
            font-weight: bold;
            color: #003366;
            margin-bottom: 20px;
        }

        .success-message {
            font-size: 1.2rem;
            margin-bottom: 30px;
            color: #555;
        }

        .continue-shopping {
            background-color: #0a74da;
            color: white;
            padding: 15px 30px;
            font-size: 1rem;
            text-transform: uppercase;
            border-radius: 50px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            z-index: 2;
        }

        .continue-shopping:hover {
            background-color: #0056b3;
            transform: scale(1.1);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .continue-shopping::before {
            content: '';
            position: absolute;
            background-color: rgba(255, 255, 255, 0.4);
            border-radius: 50%;
            animation: bubble 1s infinite;
            width: 30px;
            height: 30px;
            opacity: 0;
        }

        .continue-shopping:hover::before {
            animation: bubble 1s infinite;
        }

        @keyframes bubble {
            0% {
                transform: scale(0);
                opacity: 0.5;
            }

            50% {
                transform: scale(1);
                opacity: 1;
            }

            100% {
                transform: scale(0);
                opacity: 0;
            }
        }
    </style>

    <div class="winter-theme">
        <div class="container">
            <div class="center-content">
                <h2 class="thank-you-message">Cảm ơn bạn đã đặt hàng!</h2>
                <p class="success-message">Đơn hàng của bạn đã được đặt thành công. Bạn sẽ nhận được email xác nhận trong
                    thời gian sớm nhất.</p>
                <a href="{{ route('client.home') }}" class="btn btn-primary continue-shopping">Tiếp tục mua sắm</a>
            </div>
        </div>

        <div class="snowflake" style="left: 10%; animation-duration: 12s;"></div>
        <div class="snowflake" style="left: 25%; animation-duration: 15s;"></div>
        <div class="snowflake" style="left: 50%; animation-duration: 14s;"></div>
        <div class="snowflake" style="left: 75%; animation-duration: 18s;"></div>
        <div class="snowflake" style="left: 90%; animation-duration: 13s;"></div>
        <div class="snowflake" style="left: 30%; animation-duration: 16s;"></div>
        <div class="snowflake" style="left: 60%; animation-duration: 17s;"></div>
        <div class="snowflake" style="left: 40%; animation-duration: 19s;"></div>
        <div class="snowflake" style="left: 80%; animation-duration: 20s;"></div>
        <div class="snowflake" style="left: 15%; animation-duration: 22s;"></div>
    </div>
@endsection
