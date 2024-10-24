@extends('admin.layout')

@section('content')
    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-xxl">

                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <form action="{{ route('thong_ke_doanh_thu') }}" method="post">
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
                            <div class="col-md-6 col-xl-6">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="fs-15 mb-1 "> <i
                                                    class="fa-solid fa-truck-fast me-2 text-success"></i>Tổng doanh thu
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <p class="fs-10 mt-3 mb-1">Tổng tiền</p>
                                                <div class="d-flex align-items-baseline">
                                                    <div class="fs-17 mb-0 me-2 fw-semibold text-success">
                                                        Tổng doanh thu
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
                                                        Tổng doanh thu
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-6">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="fs-15 mb-1 "> <i
                                                    class="fa-solid fa-truck-fast me-2 text-success"></i>Tổng lợi nhuận
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <p class="fs-10 mt-3 mb-1">Tổng tiền</p>
                                                <div class="d-flex align-items-baseline">
                                                    <div class="fs-17 mb-0 me-2 fw-semibold text-success">
                                                        Tổng lợi nhuận
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
                                                        Tổng lợi nhuận
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


                </div> <!-- container-fluid -->
            </div> <!-- content -->
        </div>
    </div>
@endsection
