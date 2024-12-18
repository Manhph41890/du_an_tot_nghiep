@extends('admin.layout')

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-xxl">
                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <form action="{{ route('thong_ke_chung') }}" method="post">
                            @csrf
                            @method('GET')
                            <div class="row justify-content-end">
                                <div class="col-md-4">
                                    <h4 class="fw-semibold">{{ $title }}</h4>
                                </div>
                                <div class="col-md-2">
                                    <input type="date" class="form-control @error('ngay_bat_dau') is-invalid @enderror"
                                        id="ngay_bat_dau" name="ngay_bat_dau"
                                        value="{{ old('ngay_bat_dau', request('ngay_bat_dau')) }}">
                                    @error('ngay_bat_dau')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-1 d-flex align-items-center justify-content-center">Tới</div>
                                <div class="col-md-2">
                                    <input type="date" class="form-control @error('ngay_ket_thuc') is-invalid @enderror"
                                        id="ngay_ket_thuc" name="ngay_ket_thuc"
                                        value="{{ old('ngay_bat_dau', request('ngay_ket_thuc')) }}">
                                    @error('ngay_ket_thuc')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <select class="form-select" name="loc_ngay_thang_quy_nam">
                                        <option value="today"
                                            {{ request('loc_ngay_thang_quy_nam') == 'today' ? 'selected' : '' }}>Hôm nay
                                        </option>
                                        <option value="last_7_days"
                                            {{ request('loc_ngay_thang_quy_nam') == 'last_7_days' ? 'selected' : '' }}>7
                                            Ngày</option>
                                        <option value="month"
                                            {{ request('loc_ngay_thang_quy_nam') == 'month' ? 'selected' : '' }}>Tháng
                                        </option>
                                        <option value="year"
                                            {{ request('loc_ngay_thang_quy_nam') == 'year' ? 'selected' : '' }}>Năm</option>
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <input type="submit" value="Tìm kiếm" class="btn btn-primary w-100 text-center">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- start row -->
                <div class="row">
                    <div class="col-md-12 col-xl-12">
                        <div class="row g-3">
                            <div class="col-md-2 col-xl-2">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="fs-15 mb-1 "> <i
                                                    class="fa-solid fa-truck-fast me-2 text-success"></i>Tất cả đơn hàng
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <p class="fs-10 mt-3 mb-1">Tổng tiền</p>
                                                <div class="d-flex align-items-baseline">
                                                    <div class="fs-17 mb-0 me-2 fw-semibold text-success">
                                                        {{ $tong_tien }}
                                                    </div>
                                                    <div class="me-auto text-success">
                                                        đ
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <p class="fs-10 mt-3 mb-1">Số lượng</p>
                                                <div class="d-flex align-items-baseline">
                                                    <div class="fs-17 mb-0 me-2 fw-semibold ">
                                                        {{ $soluong_donhangs }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-xl-2">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="fs-15 mb-1 "> <i
                                                    class="fa-solid fa-truck-fast me-2 text-success"></i>Đơn hàng mới</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <p class="fs-10 mt-3 mb-1">Tổng tiền</p>
                                                <div class="d-flex align-items-baseline">
                                                    <div class="fs-17 mb-0 me-2 fw-semibold text-success">
                                                        {{ $tongtien_donhangs_moi }}
                                                    </div>
                                                    <div class="me-auto text-success">
                                                        đ
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <p class="fs-10 mt-3 mb-1">Số lượng</p>
                                                <div class="d-flex align-items-baseline">
                                                    <div class="fs-17 mb-0 me-2 fw-semibold ">
                                                        {{ $soluong_donhangs_new }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 col-xl-8">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="fs-17 mb-1 "> <i
                                                    class="fa-solid fa-truck-fast me-2 text-success"></i>Số
                                                lượng từng trạng
                                                thái đơn hàng</div>
                                            <span class="text-primary d-inline-flex align-items-center">
                                            </span>
                                        </div>
                                        <div class="row flex-warp">
                                            <div class="col-3">
                                                <p class="fs-10 mt-3 mb-1">Đã xác nhận</p>
                                                <div class="d-flex align-items-baseline">
                                                    <div class="fs-17 mb-0 me-2 fw-semibold">
                                                        {{ $donhangs_daxacnhan }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <p class="fs-10 mt-3 mb-1">Đang chuẩn bị hàng</p>
                                                <div class="d-flex align-items-baseline">
                                                    <div class="fs-17 mb-0 me-2 fw-semibold ">
                                                        {{ $donhangs_dangchuanbihang }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <p class="fs-10 mt-3 mb-1">Đang vận chuyển</p>
                                                <div class="d-flex align-items-baseline">
                                                    <div class="fs-17 mb-0 me-2 fw-semibold">
                                                        {{ $donhangs_dangvanchuyen }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <p class="fs-10 mt-3 mb-1">Đã giao</p>
                                                <div class="d-flex align-items-baseline">
                                                    <div class="fs-17 mb-0 me-2 fw-semibold ">
                                                        {{ $donhangs_dagiao }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <p class="fs-10 mt-3 mb-1">Thành công</p>
                                                <div class="d-flex align-items-baseline">
                                                    <div class="fs-17 mb-0 me-2 fw-semibold">
                                                        {{ $donhangs_thanhcong }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <p class="fs-10 mt-3 mb-1">Đã hủy</p>
                                                <div class="d-flex align-items-baseline">
                                                    <div class="fs-17 mb-0 me-2 fw-semibold ">
                                                        {{ $donhangs_dahuy }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <p class="fs-10 mt-3 mb-1">Thất bại</p>
                                                <div class="d-flex align-items-baseline">
                                                    <div class="fs-17 mb-0 me-2 fw-semibold ">
                                                        {{ $donhangs_thatbai }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div> <!-- end sales -->
                </div> <!-- end row -->


                <div class="row">
                    <div class="col-md-12 col-xl-12">

                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                                        <i data-feather="minus-square" class="widgets-icons"></i>
                                    </div>
                                    <h5 class="card-title mb-0">Biểu đồ</h5>
                                    <div class="d-flex m-auto">
                                        <div class="me-3">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="radio1"
                                                    name="optradio" value="option1" checked
                                                    onclick="showTab('home');hideMonthInput();">Doanh
                                                thu & lợi nhuận
                                                <label class="form-check-label" for="radio1"></label>
                                            </div>
                                        </div>
                                        <div class="me-0">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="radio3"
                                                    name="optradio" value="option3"
                                                    onclick="showTab('menu2'); showMonthInput()">
                                                <label class="form-check-label" for="radio3">Tỉ lệ % đơn hàng</label>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="{{ route('thong_ke_chung') }}" method="post">
                                        @csrf
                                        @method('GET')
                                        <div class="row justify-content-end">
                                            <div class="col-md-4">
                                                <input type="date"
                                                    class="form-control  @error('ngay_bat_dau_bieudo') is-invalid @enderror"
                                                    id="ngay_bat_dau_bieudo" name="ngay_bat_dau_bieudo"
                                                    value="{{ old('ngay_bat_dau_bieudo', request('ngay_bat_dau_bieudo')) }}">
                                                @error('ngay_bat_dau_bieudo')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-1 d-flex align-items-center justify-content-center">Tới
                                            </div>
                                            <div class="col-md-4">
                                                <input type="date"
                                                    class="form-control @error('ngay_ket_thuc_bieudo') is-invalid @enderror"
                                                    id="ngay_ket_thuc_bieudo" name="ngay_ket_thuc_bieudo"
                                                    value="{{ old('ngay_ket_thuc_bieudo', request('ngay_ket_thuc_bieudo')) }}">
                                                @error('ngay_ket_thuc_bieudo')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-1">
                                                <input type="month" class="form-control" id="monthInput"
                                                    style="display: none;" name="loc_ngay_thang_quy_nam_bieudo"
                                                    value="{{ old('loc_ngay_thang_quy_nam_bieudo', request('loc_ngay_thang_quy_nam_bieudo')) }}">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="submit" value="Tìm"
                                                    class="btn btn-primary w-100 text-center">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="home" style="opacity: 1;">
                                    <div class="row">
                                        <div class="col-6 container">
                                            <div class="card-body">
                                                <canvas id="myChart1"></canvas>
                                                <script>
                                                    var ctx = document.getElementById('myChart1').getContext('2d');
                                                    var myChart = new Chart(ctx, {
                                                        type: 'bar',
                                                        data: {
                                                            labels: [
                                                                @foreach ($labels as $label)
                                                                    '{{ $label }}',
                                                                @endforeach
                                                            ],
                                                            datasets: [{
                                                                label: 'Doanh thu',
                                                                data: [
                                                                    @foreach ($tongTienThang as $tongTien)
                                                                        {{ $tongTien }},
                                                                    @endforeach
                                                                ],
                                                                backgroundColor: [
                                                                    '#00FF00'
                                                                ],
                                                                borderColor: [
                                                                    '#00FF00'
                                                                ],
                                                                borderWidth: 2,
                                                                fill: false
                                                            }]
                                                        },
                                                        options: {
                                                            scales: {
                                                                y: {
                                                                    beginAtZero: true
                                                                }
                                                            }
                                                        }
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                        <div class="col-6 container">
                                            <div class="card-body">
                                                <canvas id="myChart3"></canvas>

                                                <script>
                                                    var ctx = document.getElementById('myChart3').getContext('2d');

                                                    var profitData = [
                                                        @foreach ($loi_nhuan_theo_thang as $ln)
                                                            {{ $ln }}{{ !$loop->last ? ',' : '' }}
                                                        @endforeach
                                                    ];

                                                    var labels = [
                                                        @foreach ($labels as $label)
                                                            '{{ $label }}',
                                                        @endforeach
                                                    ];

                                                    var myChart = new Chart(ctx, {
                                                        type: 'line',
                                                        data: {
                                                            labels: labels,
                                                            datasets: [{
                                                                label: function(context) {
                                                                    let data = context.raw;
                                                                    return data >= 0 ? 'Lãi' : 'Âm';
                                                                },
                                                                data: profitData,
                                                                borderWidth: 2,
                                                                fill: false,
                                                                pointBackgroundColor: function(context) {
                                                                    var value = context.dataset.data[context.dataIndex];
                                                                    return value >= 0 ? '#00FF00' :
                                                                        '#FF0000';
                                                                },
                                                                pointBorderColor: function(context) {
                                                                    var value = context.dataset.data[context.dataIndex];
                                                                    return value >= 0 ? '#00FF00' :
                                                                        '#FF0000';
                                                                },
                                                                pointRadius: 5,
                                                                pointHoverRadius: 7,
                                                                borderColor: function(context) {
                                                                    var value = context.dataset.data[context.dataIndex];
                                                                    return value >= 0 ? '#00FF00' :
                                                                        '#FF0000';
                                                                },
                                                                segment: {
                                                                    borderColor: ctx => {
                                                                        const index = ctx.p0DataIndex;
                                                                        const value = ctx.chart.data.datasets[0].data[index];
                                                                        return value >= 0 ? '#00FF00' : '#FF0000';
                                                                    }
                                                                }
                                                            }]
                                                        },
                                                        options: {
                                                            scales: {
                                                                y: {
                                                                    beginAtZero: true
                                                                }
                                                            },
                                                            elements: {
                                                                point: {
                                                                    radius: 5
                                                                }
                                                            },
                                                            plugins: {
                                                                tooltip: {
                                                                    callbacks: {
                                                                        label: function(context) {
                                                                            let value = context.raw;
                                                                            return value >= 0 ? `Lãi: ${value}` : `Âm: ${value}`;
                                                                        }
                                                                    }
                                                                },
                                                                legend: {
                                                                    display: true,
                                                                    labels: {
                                                                        generateLabels: function(chart) {
                                                                            return [{
                                                                                text: 'Lãi',
                                                                                fillStyle: '#00FF00',
                                                                                strokeStyle: '#00FF00'
                                                                            }, {
                                                                                text: 'Âm',
                                                                                fillStyle: '#FF0000',
                                                                                strokeStyle: '#FF0000'
                                                                            }];
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    });
                                                </script>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane container fade p-3" id="menu2" style="opacity: 1;">
                                    <canvas id="myChart2"></canvas>
                                    <script>
                                        var ctx2 = document.getElementById('myChart2').getContext('2d');
                                        var data = [
                                            @foreach ($phantramdonhang as $count)
                                                {{ $count }}{{ !$loop->last ? ',' : '' }}
                                            @endforeach
                                        ];
                                        var myChart = new Chart(ctx2, {
                                            type: 'doughnut',
                                            data: {
                                                labels: [
                                                    @foreach ($labels_phantram as $label)
                                                        '{{ $label }}',
                                                    @endforeach
                                                ],
                                                datasets: [{
                                                    label: 'My First Dataset',
                                                    data: data,
                                                    backgroundColor: [
                                                        '#023cba',
                                                        '#00FFFF',
                                                        '#FF00FF',
                                                        '#f5f52c',
                                                        '#0e9104',
                                                        '#f20c0c',
                                                        '#808080'
                                                    ],
                                                    hoverOffset: 4
                                                }]
                                            },
                                            options: {
                                                responsive: true,
                                                maintainAspectRatio: false,
                                                plugins: {
                                                    tooltip: {
                                                        callbacks: {
                                                            label: function(tooltipItem) {
                                                                // Tính phần trăm
                                                                var total = data.reduce((a, b) => a + b, 0);
                                                                var currentValue = tooltipItem.raw;
                                                                var percentage = ((currentValue / total) * 100).toFixed(2);
                                                                return tooltipItem.label + ': ' + percentage + '%';
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        });
                                    </script>
                                </div>
                            </div>

                        </div>
                    </div>
                </div> <!-- container-fluid -->

                <!-- Start Monthly Sales -->
                <div class="row">
                    <div class="col-md-12 col-xl-12">
                        <div class="card overflow-hidden">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                                        <i data-feather="tablet" class="widgets-icons"></i>
                                    </div>
                                    <h5 class="card-title mb-0">Đơn hàng mới nhất hôm nay</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">Mã đơn hàng</th>
                                                <th scope="col">Người đặt</th>
                                                <th scope="col">Số điện thoại</th>
                                                <th scope="col">Địa chỉ giao hàng</th>
                                                <th scope="col">Ngày tạo đơn hàng</th>
                                                <th scope="col">Tổng tiền</th>
                                                <th scope="col">Trạng thái</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($donhangs->count() > 0)
                                                @foreach ($donhangs as $item)
                                                    <tr>
                                                        <td>{{ $item->id }}</td>
                                                        <td>{{ $item->user?->ho_ten }}</td>
                                                        <td>{{ $item->so_dien_thoai }}</td>
                                                        <td>{{ $item->dia_chi }}</td>
                                                        <td>{{ $item->ngay_tao }}
                                                        </td>
                                                        <td>
                                                            {{ $item->tong_tien }}
                                                            VNĐ
                                                        </td>
                                                        <td> @php
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
                                                                $statusClasses[$item->trang_thai_don_hang] ??
                                                                'bg-secondary';
                                                        @endphp

                                                            <span class="badge {{ $class }}">
                                                                {{ $item->trang_thai_don_hang }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="8" class="text-center">Chưa có đơn hàng nào</td>
                                                </tr>
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{ $donhangs->links() }}
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                                        <i data-feather="bar-chart" class="widgets-icons"></i>
                                    </div>
                                    <h5 class="card-title mb-0">Top 5 sản phẩm được xem nhiều</h5>
                                </div>
                            </div>

                            <div class="card-body">
                                <table class="table table-traffic mb-0">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Ảnh</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Giá gốc</th>
                                            <th>Giá khuyến mãi</th>
                                            <th>Lượt xem</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($views_product as $index => $item)
                                            <tr>
                                                <th scope="row">{{ $index + 1 }}</th>
                                                <td>
                                                    @if ($item->anh_san_pham)
                                                        <img src="{{ asset('storage/' . $item->anh_san_pham) }}"
                                                            alt="Hình ảnh sản phẩm" width="50px">
                                                    @else
                                                        <img src="{{ asset('images/placeholder.png') }}"
                                                            alt="Không có ảnh" width="50px">
                                                    @endif
                                                </td>
                                                {{-- <td>{{ $item->danh_muc?->ten_danh_muc }}</td> --}}
                                                <td>{{ $item->ten_san_pham }}</td>
                                                <td>{{ number_format($item->gia_goc, 0, ',', '.') }} VND</td>
                                                <td>{{ number_format($item->gia_km, 0, ',', '.') }} VND</td>
                                                <td>{{ $item->views ?? 0 }}</td>

                                                <td>
                                                    {!! $item->is_active
                                                        ? '<span class="badge bg-primary">Hiển Thị</span>'
                                                        : '<span class="badge bg-danger">Ẩn</span>' !!}
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- {{ $views_product->links() }} --}}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Monthly Sales -->
                <div class="row">
                    <div class="col-md-12 col-xl-12">
                        <div class="card">

                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                                        <i data-feather="bar-chart" class="widgets-icons"></i>
                                    </div>
                                    <h5 class="card-title mb-0">Sản phẩm sắp hết hàng</h5>
                                </div>
                            </div>

                            <div class="card-body">
                                <table class="table table-traffic mb-0">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Ảnh</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Giá gốc</th>
                                            <th>Giá khuyến mãi</th>
                                            <th>Số lượng</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sanphams_saphet as $index => $item)
                                            <tr>
                                                <th scope="row">{{ $index + 1 }}</th>
                                                <td>
                                                    @if ($item->anh_san_pham)
                                                        <img src="{{ asset('storage/' . $item->anh_san_pham) }}"
                                                            alt="Hình ảnh sản phẩm" width="50px">
                                                    @else
                                                        <img src="{{ asset('images/placeholder.png') }}"
                                                            alt="Không có ảnh" width="50px">
                                                    @endif
                                                </td>
                                                {{-- <td>{{ $item->danh_muc?->ten_danh_muc }}</td> --}}
                                                <td>{{ $item->ten_san_pham }}</td>
                                                <td>{{ number_format($item->gia_goc, 0, ',', '.') }} VND</td>
                                                <td>{{ number_format($item->gia_km, 0, ',', '.') }} VND</td>
                                                <td>{{ $item->so_luong }} </td>


                                                <td>
                                                    {!! $item->is_active
                                                        ? '<span class="badge bg-primary">Hiển Thị</span>'
                                                        : '<span class="badge bg-danger">Ẩn</span>' !!}
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $sanphams_saphet->links() }}
                        </div>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-md-12 col-xl-12">
                        <div class="card">

                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                                        <i data-feather="bar-chart" class="widgets-icons"></i>
                                    </div>
                                    <h5 class="card-title mb-0">Quản lý xuất và nhập sản phẩm</h5>
                                </div>
                            </div>

                            <div class="card-body">
                                <table class="table table-traffic mb-0">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Ảnh</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Giá nhập</th>
                                            <th>Số lượng nhập</th>
                                            <th>Số lượng xuất</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sanphams_saphet as $index => $item)
                                            <tr>
                                                <th scope="row">{{ $index + 1 }}</th>
                                                <td>
                                                    @if ($item->anh_san_pham)
                                                        <img src="{{ asset('storage/' . $item->anh_san_pham) }}"
                                                            alt="Hình ảnh sản phẩm" width="50px">
                                                    @else
                                                        <img src="{{ asset('images/placeholder.png') }}"
                                                            alt="Không có ảnh" width="50px">
                                                    @endif
                                                </td>
                                                <td>{{ $item->ten_san_pham }}</td>
                                                <td>{{ number_format($item->gia_goc, 0, ',', '.') }} VND</td>
                                                <td>{{ number_format($item->gia_km, 0, ',', '.') }} VND</td>
                                                <td>{{ number_format($item->gia_km, 0, ',', '.') }} VND</td>

                                                <td>
                                                    {!! $item->is_active
                                                        ? '<span class="badge bg-primary">Hiển Thị</span>'
                                                        : '<span class="badge bg-danger">Ẩn</span>' !!}
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $sanphams_saphet->links() }}
                        </div>
                    </div>
                </div> --}}
            </div> <!-- content -->
        </div>
    </div>
    <script>
        function showTab(tabId) {
            // Ẩn tất cả các tab
            const tabs = document.querySelectorAll('.tab-pane');
            tabs.forEach(tab => {
                tab.classList.remove('active', 'fade');
            });

            // Hiện tab được chọn
            const activeTab = document.getElementById(tabId);
            activeTab.classList.add('active', 'fade');
        }

        function showMonthInput() {
            document.getElementById('monthInput').style.display = 'block';
        }

        function hideMonthInput() {
            document.getElementById('monthInput').style.display = 'none';
        }
    </script>
@endsection
