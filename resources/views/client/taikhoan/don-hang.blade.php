@extends('client.taikhoan.dashboard');

@section('conten-taikhoan')
    <div class="">
        <div class="myaccount-content" id="orders-content">
            <h3>Đơn hàng của bạn</h3>

            <!-- Tabs Navigation -->
            <ul class="nav nav-tabs" id="orderTabs" role="tablist">
                @php
                    $statuses = [
                        'Tất cả' => 'all',
                        'Chờ xác nhận' => 'pending',
                        'Đã xác nhận' => 'confirmed',
                        'Đang chuẩn bị hàng' => 'preparing',
                        'Đang vận chuyển' => 'shipping',
                        'Đã giao' => 'delivered',
                        'Thành công' => 'completed',
                        'Đã hủy' => 'cancelled',
                    ];

                @endphp

                @foreach ($statuses as $status => $key)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link @if ($loop->first) active @endif" id="tab-{{ $key }}"
                            data-bs-toggle="tab" data-bs-target="#tab-content-{{ $key }}" type="button"
                            role="tab" aria-controls="tab-content-{{ $key }}"
                            aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                            {{ $status }}
                        </button>
                    </li>
                @endforeach
            </ul>

            <!-- Tabs Content -->
            <div class="tab-content" id="orderTabsContent">
                @foreach ($statuses as $status => $key)
                    <div class="tab-pane fade @if ($loop->first) show active @endif"
                        id="tab-content-{{ $key }}" role="tabpanel" aria-labelledby="tab-{{ $key }}">

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
                                        @if ($key == 'all' || $myOrder->trang_thai_don_hang === $status)
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
                                                        $class =
                                                            $statusClasses[$myOrder->trang_thai_don_hang] ??
                                                            'bg-secondary';
                                                    @endphp

                                                    <span class="badge {{ $class }}">
                                                        {{ $myOrder->trang_thai_don_hang }}
                                                        @if ($myOrder->trang_thai_don_hang == 'Chờ xác nhận')
                                                            <span class="ms-2 position-relative">
                                                                <span class="notification-dot2"></span>
                                                            </span>
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('taikhoan.myorder', $myOrder->id) }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#allmyModalfororder{{ $myOrder->id }}">
                                                        <i
                                                            class="mdi mdi-eye text-muted fs-18 rounded-2 border p-1 me-1"></i>
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
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($key === 'all')
                                {{ $myOrders->links() }}
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection
