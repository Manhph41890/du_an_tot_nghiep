@extends('admin.layout')

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-xxl">
                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <div class="row justify-content-end">
                            <div class="col-md-4">
                                <h4 class="fw-semibold">{{ $title }}</h4>
                            </div>
                            <div class="col-md-2">
                                <form action="{{ route('thong_ke_don_hang') }}" method="post">
                                    @csrf
                                    @method('GET')
                                    <input type="date" class="form-control" id="ngay_bat_dau" name="ngay_bat_dau">
                                </form>
                            </div>
                            <div class="col-md-1 text-center">Tới</div>
                            <div class="col-md-2">
                                <form action="{{ route('thong_ke_don_hang') }}" method="post">
                                    @csrf
                                    @method('GET')
                                    <input type="date" class="form-control" id="ngay_ket_thuc" name="ngay_ket_thuc">
                                </form>
                            </div>
                            <div class="col-md-2">
                                <form action="{{ route('thong_ke_don_hang') }}" method="post">
                                    @csrf
                                    @method('GET')
                                    <select class="form-select ">
                                        <option>Theo tháng</option>
                                        <option>Theo năm</option>
                                        <option>Theo Qúy</option>
                                    </select>
                                </form>
                            </div>
                            <div class="col-md-1">
                                <form action="{{ route('thong_ke_don_hang') }}" method="post">
                                    @csrf
                                    @method('GET')
                                    <input type="submit" value="Tìm kiếm" class="btn btn-primary w-100 text-center">
                                </form>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                <strong>Thành công</strong> This alert box could indicate a successful or positive
                                action.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- start row -->
                <div class="row">
                    <div class="col-md-12 col-xl-12">
                        <div class="row g-3">
                            <div class="col-md-6 col-xl-3">
                                <div class="card text-bg-success">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="fs-14 mb-1 "> <i class="fa-solid fa-image me-2"></i> Sản phẩm</div>
                                            <span class="text-primary d-inline-flex align-items-center">
                                                <a href="{{ route('sanphams.index') }}" class="text-white"> <i
                                                        class="fa-solid fa-plus"></i> </a>
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-baseline mb-2">
                                            <div class="fs-22 mb-0 me-2 fw-semibold text-white">{{ $sanphams }}</div>
                                            <div class="me-auto">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--  --}}
                            <div class="col-md-6 col-xl-3">
                                <div class="card text-bg-primary">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="fs-14 mb-1 text-white"> <i class="fa-solid fa-truck-fast me-2"></i>
                                                Đơn hàng</div>
                                        </div>
                                        <div class="d-flex align-items-baseline mb-2">
                                            <div class="fs-22 mb-0 me-2 fw-semibold text-white">{{ $donhangs }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--  --}}
                            <div class="col-md-6 col-xl-3">
                                <div class="card text-bg-warning">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="fs-14 mb-1 text-white"> <i
                                                    class="fa-solid fa-money-check-dollar me-2"></i> Doanh thu</div>
                                        </div>
                                        <div class="d-flex align-items-baseline mb-2">
                                            <div class="fs-22 mb-0 me-2 fw-semibold text-white">{{ $tong_tien }}</div>
                                            <div class="me-auto">
                                                <div class="fs-14 mb-1">VNĐ</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--  --}}
                            <div class="col-md-6 col-xl-3">
                                <div class="card text-bg-info">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="fs-14 mb-1 text-white"> <i class="fa-solid fa-user me-2"></i> Tài
                                                khoản</div>
                                            <span class="text-primary d-inline-flex align-items-center">
                                                <a href="{{ route('user.index') }}" class="text-white"> <i
                                                        class="fa-solid fa-plus"></i> </a>
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-baseline mb-2">
                                            <div class="fs-22 mb-0 me-2 fw-semibold text-white">{{ $users }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--  --}}


                        </div>
                    </div> <!-- end sales -->
                </div> <!-- end row -->


                <div class="row">
                    <div class="col-md-6 col-xl-6">
                        <div class="card">
                            <div class="card-header text-bg-dark">
                                <div class="d-flex align-items-center">
                                    <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                                        <i data-feather="minus-square" class="widgets-icons"></i>
                                    </div>
                                    <h5 class="card-title mb-0">Biểu đồ cột doanh thu</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="myChart1" height="200"></canvas>
                                <script>
                                    var ctx = document.getElementById('myChart1').getContext('2d');
                                    var myChart = new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Số tiền'],
                                            datasets: [{
                                                label: '# of Votes',
                                                data: [12, 19, 3, 5, 2, 3],
                                                backgroundColor: [
                                                    'rgba(255, 99, 132, 0.2)',
                                                    'rgba(54, 162, 235, 0.2)',
                                                    'rgba(255, 206, 86, 0.2)',
                                                    'rgba(75, 192, 192, 0.2)',
                                                    'rgba(153, 102, 255, 0.2)',
                                                    'rgba(255, 159, 64, 0.2)'
                                                ],
                                                borderColor: [
                                                    'rgba(255, 99, 132, 1)',
                                                    'rgba(54, 162, 235, 1)',
                                                    'rgba(255, 206, 86, 1)',
                                                    'rgba(75, 192, 192, 1)',
                                                    'rgba(153, 102, 255, 1)',
                                                    'rgba(255, 159, 64, 1)'
                                                ],
                                                borderWidth: 1
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
                    </div>

                    <div class="col-md-6 col-xl-6">
                        <div class="card overflow-hidden">

                            <div class="card-header text-bg-dark">
                                <div class="d-flex align-items-center">
                                    <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                                        <i data-feather="table" class="widgets-icons"></i>
                                    </div>
                                    <h5 class="card-title mb-0">Biểu đồ % đơn hàng</h5>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="container">
                                    <canvas id="myChart2" height="370"></canvas>
                                </div>
                            </div>
                        </div>

                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Thêm thư viện Chart.js nếu chưa có -->
                        <script>
                            var ctx2 = document.getElementById('myChart2').getContext('2d');
                            var data = [300, 50, 100, 234, 45];
                            var myChart = new Chart(ctx2, {
                                type: 'doughnut',
                                data: {
                                    labels: [
                                        'Xác nhận',
                                        'Chờ xử lý',
                                        'Thành công',
                                        'Đã hủy',
                                        'Hoàn'
                                    ],
                                    datasets: [{
                                        label: 'My First Dataset',
                                        data: data,
                                        backgroundColor: [
                                            '#023cba',
                                            '#f5f52c',
                                            '#0e9104',
                                            '#f20c0c',
                                            '#ba6a02'
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



                    <!-- Start Monthly Sales -->
                    <div class="row">
                        <div class="col-md-6 col-xl-8">
                            <div class="card">

                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                                            <i data-feather="bar-chart" class="widgets-icons"></i>
                                        </div>
                                        <h5 class="card-title mb-0">Địa chỉ</h5>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <iframe style="width:100%;"
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.863806019078!2d105.74468687476954!3d21.038134787457476!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313455e940879933%3A0xcf10b34e9f1a03df!2zVHLGsOG7nW5nIENhbyDEkeG6s25nIEZQVCBQb2x5dGVjaG5pYw!5e0!3m2!1svi!2s!4v1728399016270!5m2!1svi!2s"
                                        height="400" style="border:0;" allowfullscreen="" loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6 col-xl-4">
                            <div class="card overflow-hidden">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                                            <i data-feather="tablet" class="widgets-icons"></i>
                                        </div>
                                        <h5 class="card-title mb-0">Sản phẩm mới nhất</h5>
                                    </div>
                                </div>

                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-traffic mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Ảnh</th>
                                                    <th>Tên sản phẩm</th>
                                                    <th>Giá</th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($views_product as $product)
                                                    <tr>
                                                        <td>
                                                            <img src="{{ asset('storage/' . $product->anh_san_pham) }}"
                                                                alt="{{ $product->ten_san_pham }}"
                                                                style="width: 50px; height: 50px;">
                                                        </td>
                                                        <td>{{ $product->ten_san_pham }}</td>
                                                        <td>{{ number_format($product->gia_goc, 0, ',', '.') }}.000 VND
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- End Monthly Sales -->


                </div> <!-- container-fluid -->
            </div> <!-- content -->
        </div>
    </div>
@endsection
