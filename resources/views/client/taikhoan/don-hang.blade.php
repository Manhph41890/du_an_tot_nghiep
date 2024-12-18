@extends('client.taikhoan.dashboard')

@section('conten-taikhoan')
    <style>
        .border-rounded {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 5px 10px;
            display: inline-block;
        }
    </style>
    <div class="">
        <div class="myaccount-content" id="orders-content">
            <h3>Đơn hàng của bạn</h3>

            <!-- Tabs Navigation -->

            <!-- Tabs Content -->
            <div class="tab-content" id="orderTabsContent">

                <div class="myaccount-table table-responsive text-center">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Ngày tạo đơn hàng</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái đơn hàng</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($myOrders as $myOrder)
                                <tr>
                                    <td>{{ $myOrder->ma_don_hang }}</td>
                                    <td>{{ $myOrder->ngay_tao }}</td>
                                    <td>{{ number_format($myOrder->tong_tien, 0, ',', '.') }} VNĐ</td>
                                    <td>
                                        @php
                                            $statusClasses = [
                                                'Chờ xác nhận' => 'bg-warning',
                                                'Đã xác nhận' => 'bg-info',
                                                'Đang chuẩn bị hàng' => 'bg-info',
                                                'Đang vận chuyển' => 'bg-info',
                                                'Đã giao' => 'bg-success',
                                                'Thành công' => 'bg-success',
                                                'Đã hủy' => 'bg-danger',
                                            ];
                                            $class = $statusClasses[$myOrder->trang_thai_don_hang] ?? 'bg-secondary';
                                        @endphp

                                        <span class=" {{ $class }} border-rounded">
                                            {{ $myOrder->trang_thai_don_hang }}
                                            @if ($myOrder->trang_thai_don_hang == 'Chờ xác nhận')
                                                <span class="ms-2 position-relative">
                                                    <span class="notification-dot2"></span>
                                                </span>
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('taikhoan.myorder', $myOrder->id) }}" data-bs-toggle="modal"
                                            data-bs-target="#allmyModalfororder{{ $myOrder->id }}">
                                            <i class="mdi mdi-eye text-muted fs-18 rounded-2 border p-1 me-1"></i>
                                        </a>

                                        <a href="{{ route('taikhoan.myorder', $myOrder->id) }}" data-bs-toggle="modal"
                                            data-bs-target="#allmyModalforordervc{{ $myOrder->id }}">
                                            <i class="fa fa-truck faa-truck"></i>
                                            <style>
                                                .faa-truck {
                                                    background-color: rgb(254, 254, 254);
                                                    padding: 3px;
                                                    border: 1px solid rgb(114, 114, 114);
                                                    opacity: 0.5;
                                                    border-radius: 20%;
                                                }

                                                .fa :hover {
                                                    background-color: #5f5f5f;
                                                    !important
                                                }
                                            </style>
                                        </a>

                                        <style>
                                            .tichs_dg {
                                                position: relative;
                                                border: 1px solid red !important;
                                            }

                                            .tichs_dg::after {
                                                content: ".";
                                                position: absolute;
                                                top: -55px;
                                                right: -5px;
                                                border-radius: 50%;
                                                font-size: 50px;
                                                color: red;
                                            }
                                        </style>
                                        <script>
                                            document.querySelectorAll('.tichs_dg').forEach(function(element) {
                                                element.addEventListener('click', function() {
                                                    element.classList.remove('tichs_dg');
                                                })
                                            });
                                        </script>
                                        <!-- Modal -->
                                        <div class="modal" id="allmyModalfororder{{ $myOrder->id }}">
                                            @include('client.taikhoan.showmyorder', [
                                                'donhang' => $myOrder,
                                            ])
                                        </div>
                                        <div class="modal" id="allmyModalforordervc{{ $myOrder->id }}">
                                            @include('client.taikhoan.vanchuyen', [
                                                'donhang' => $myOrder,
                                            ])
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $myOrders->links() }}
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection
