@extends('client.taikhoan.dashboard');

@section('conten-taikhoan')
    <div class="">
        <div class="myaccount-content" id="orders-content">
            <div class="myaccount-content">
                <h3>Đơn hàng của bạn</h3>
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
                                        <div class="d-flex justify-content-center mb-30">
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
                                                $class =
                                                    $statusClasses[$myOrder->trang_thai_don_hang] ?? 'bg-secondary';
                                            @endphp

                                            <span class="badge {{ $class }}">
                                                {{ $myOrder->trang_thai_don_hang }}
                                                @if ($myOrder->trang_thai_don_hang == 'Chờ xác nhận')
                                                    <span class="ms-2 position-relative">
                                                        <span class="notification-dot2"></span>
                                                    </span>
                                                @endif
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('taikhoan.myorder', $myOrder->id) }}" data-bs-toggle="modal"
                                            data-bs-target="#allmyModalfororder{{ $myOrder->id }}">
                                            <i
                                                class="mdi mdi-eye text-muted fs-18 rounded-2 border p-1 me-1 @if ($myOrder->trang_thai_don_hang == 'Thành công') tichs_dg @endif"></i>
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
                                        <!-- The Modal -->
                                        <div class="modal" id="allmyModalfororder{{ $myOrder->id }}">
                                            @include('client.taikhoan.showmyorder', [
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
@endsection