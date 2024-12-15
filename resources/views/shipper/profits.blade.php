@extends('shipper.layout')

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container shipper-profits">
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h3 class="mb-0">
                                    <i class="fas fa-wallet me-2"></i>Thông Tin Lợi Nhuận
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row d-flex justify-content-between">
                                    <div class="col-md-4">
                                        <div class="card profit-card shadow-lg">
                                            <div class="card-body text-center">
                                                <div class="icon-wrapper mb-3">
                                                    <i class="fas fa-wallet"></i>
                                                </div>
                                                {{-- @php
                                                    dd($profitHistory);
                                                @endphp --}}
                                                {{-- @php
                                                    dd($viShipper);
                                                @endphp --}}
                                                <h5 class="card-title text-uppercase">Tổng Lợi Nhuận</h5>
                                                <p class="card-text profit-amount">
                                                    {{ number_format($viShipper->tong_tien, 0, ',', '.') }} VND
                                                </p>
                                            </div>
                                        </div>
                                        <div class="text-center mb-4">
                                            <a class="btn btn-outline-primary" href="{{ route('shipper.createbank') }}">
                                                <i class="fas fa-university me-2"></i>Thêm ngân hàng
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card profit-card shadow-lg">
                                            <div class="text-center pt-2">
                                                <h5>Lịch sử hoa hồng</h5>
                                            </div>
                                            <div class="card-body" style="background-color: white !important">
                                                <table class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Mã đơn hàng</th>
                                                            <th>Người nhận</th>
                                                            <th>Địa Chỉ</th>
                                                            <th>Số điện thoại</th>
                                                            <th>Tổng tiền</th>
                                                            <th>Lợi nhuận</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($shippers as $shipper)
                                                            <tr>
                                                                <td>{{ $shipper->donHang->ma_don_hang }}</td>
                                                                <td>{{ $shipper->donHang->ho_ten }}</td>
                                                                <td>{{ $shipper->donHang->dia_chi }}</td>
                                                                <td>{{ $shipper->donHang->so_dien_thoai }}</td>
                                                                <td>{{ number_format($shipper->donHang->tong_tien, 0, ',', '.') }}
                                                                    VND</td>
                                                                <td>
                                                                    {{ number_format(30000 * 0.2, 0, ',', '.') }}
                                                                    VND
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <div>
                                                        {{ $shippers->links() }}
                                                    </div>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

        .icon-wrapper {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            font-size: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .icon-wrapper i {
            color: #fff;
        }

        .profit-amount {
            font-size: 2rem;
            font-weight: bold;
            margin-top: 10px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        .card-title {
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }
    </style>
@endsection
