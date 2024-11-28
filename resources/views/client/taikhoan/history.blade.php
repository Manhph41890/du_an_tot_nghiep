    <style>
        .container {
            font-family: Arial;
            margin: 0;
            padding: 0;
            width: 330px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .h2 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #333;
        }

        .item {
            margin-bottom: 20px;
        }

        .item span {
            display: block;
            color: #0067d5;
        }

        .item .value {
            font-size: 18px;
            color: #00070f;
        }

        .fvvalue {
            font-size: 26px;
            color: #00070f;
        }

        .center {
            display: flex;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .center a {
            font-size: 16px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            /* Khoảng cách giữa icon và chữ */
        }
    </style>

    <div class="container">
        <span class="h2">Phiếu giao dịch</span>
        <hr>
        <br>
        <div class="item">
            <span for="total">Mã giao dịch</span>
            <span class=" fvvalue">{{ $history->ma_giao_dich }}</span>
        </div>

        <div class="item">
            <span for="total">Số tiền thanh toán:</span>
            <span class="value">
                {{ number_format($history->vnp_tong_tien, 0, ',', '.') }} VND</p>
            </span>
        </div>

        <div class="item">
            <span for="shipping">Ngày giao dịch</span>
            <span class="value">{{ $history->vnp_ngay_tao }}</span>
        </div>

        <div class="item">
            <span for="order_id">Mã đơn hàng:</span>
            <span class="value">{{ $donhang->ma_don_hang }}</span>
        </div>

        <div class="item">
            <span for="price">Trạng thái </span>
            <span class="value">{{ $history->trang_thai }}</span>
        </div>
        <div class="center">
            <a href="{{ route('taikhoan.donhang') }}" class="btn btn-secondary mb-3">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>
    </div>
