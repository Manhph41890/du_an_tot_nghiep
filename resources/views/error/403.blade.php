@extends('client.layout')

@section('title')
    403 Forbidden
@endsection
@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #721c24;
            text-align: center;
            padding: 50px;
        }

        h1 {
            font-size: 48px;
        }

        p {
            font-size: 18px;
        }

        .error-container {
            text-align: center;
            padding: 100px 0;
            color: #f44336;
            font-family: 'Arial', sans-serif;
        }

        .error-code {
            font-size: 150px;
            font-weight: bold;
            color: #f44336;
            animation: bounce 1s ease infinite;
        }

        .error-message {
            font-size: 30px;
            font-weight: bold;
            margin-top: 20px;
            text-transform: uppercase;
            color: #333;
            letter-spacing: 2px;
        }

        .error-detail {
            font-size: 18px;
            margin-top: 20px;
            color: #555;
            max-width: 500px;
            margin: 20px auto;
        }

        /* Animation for bounce effect */
        @keyframes bounce {

            0%,
            20%,
            40%,
            60%,
            80%,
            100% {
                transform: translateY(0);
            }

            25% {
                transform: translateY(-20px);
            }

            50% {
                transform: translateY(-10px);
            }

            75% {
                transform: translateY(-5px);
            }
        }

        /* Button to redirect to homepage */
        .back-home-button {
            display: inline-block;
            margin-top: 30px;
            padding: 10px 20px;
            background-color: #f44336;
            color: white;
            font-size: 16px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .back-home-button:hover {
            background-color: #e53935;
        }
    </style>

    <body>
        <div class="container">
            <div class="error-container">
                <h1 class="error-code">403</h1>
                <h3 class="error-message">Forbidden</h3>
                <p class="error-detail">Bạn không có quyền truy cập vào trang này.</p>
            </div>
        </div>
    </body>
@endsection
