@extends('admin.layout')

@section('content')
    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-xxl">

                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0">Dashboard</h4>
                    </div>
                </div>

                <!-- start row -->
                <div class="row">
                    <div class="col-md-12 col-xl-12">
                        <div class="row g-3">

                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="fs-14 mb-1">Tổng sản phẩm trong kho</div>
                                        </div>

                                        <div class="d-flex align-items-baseline mb-2">
                                            <div class="fs-22 mb-0 me-2 fw-semibold text-black">{{ $totalProducts }}</div>
                                            <div class="me-auto">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--  --}}
                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="fs-14 mb-1">Người dùng</div>
                                        </div>

                                        <div class="d-flex align-items-baseline mb-2">
                                            <div class="fs-22 mb-0 me-2 fw-semibold text-black">{{ $totalUsers }}</div>
                                            <div class="me-auto">
                                                <span class="text-primary d-inline-flex align-items-center">
                                                    <a href="{{ route('user.index') }}"> Quản lý người dùng </a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--  --}}
                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="fs-14 mb-1">Sản phẩm có nhiều lượt xem nhất</div>
                                        </div>

                                        <div class="d-flex align-items-baseline mb-2">
                                            @if ($mostViewedProduct)
                                                <div class="fs-22 mb-0 me-2 fw-semibold text-black">
                                                    <a href="{{ route('sanphams.show', $mostViewedProduct->id) }}">
                                                        {{ $mostViewedProduct->ten_san_pham }}
                                                    </a>
                                                </div>
                                                <div class="me-auto">
                                                    <span class="text-muted">Lượt xem:
                                                        {{ $mostViewedProduct->views }}</span>
                                                </div>
                                            @else
                                                <div class="fs-22 mb-0 me-2 fw-semibold text-black">Không có sản phẩm</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div> <!-- end sales -->
                </div> <!-- end row -->

                <!-- Start Monthly Sales -->
                <div class="row">
                    <div class="col-md-6 col-xl-8">
                        <div class="card">

                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                                        <i data-feather="bar-chart" class="widgets-icons"></i>
                                    </div>
                                    <h5 class="card-title mb-0">Doanh thu</h5>
                                </div>
                            </div>

                            <div class="card-body">
                                <div id="monthly-sales" class="apex-charts"></div>
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
                                                <th>Ngày tạo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($latestProducts as $product)
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset('storage/' . $product->anh_san_pham) }}"
                                                            alt="{{ $product->ten_san_pham }}"
                                                            style="width: 50px; height: 50px;">
                                                    </td>
                                                    <td>{{ $product->ten_san_pham }}</td>
                                                    <td>{{ number_format($product->gia_goc, 0, ',', '.') }} VND</td>
                                                    <td>{{ $product->created_at->format('d/m/Y') }}</td>
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

                <div class="row">
                    <div class="col-md-6 col-xl-6">
                        <div class="card">

                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                                        <i data-feather="minus-square" class="widgets-icons"></i>
                                    </div>
                                    <h5 class="card-title mb-0">Audiences By Time Of Day</h5>
                                </div>
                            </div>

                            <div class="card-body">
                                <div id="audiences-daily" class="apex-charts mt-n3"></div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6 col-xl-6">
                        <div class="card overflow-hidden">

                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                                        <i data-feather="table" class="widgets-icons"></i>
                                    </div>
                                    <h5 class="card-title mb-0">Most Visited Pages</h5>
                                </div>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-traffic mb-0">
                                        <tbody>

                                            <thead>
                                                <tr>
                                                    <th>Page name</th>
                                                    <th>Visitors</th>
                                                    <th>Unique</th>
                                                    <th colspan="2">Bounce rate</th>
                                                </tr>
                                            </thead>

                                            <tr>
                                                <td>
                                                    /home
                                                    <a href="#" class="ms-1" aria-label="Open website">
                                                        <i data-feather="link" class="ms-1 text-primary"
                                                            style="height: 15px; width: 15px;"></i>
                                                    </a>
                                                </td>
                                                <td>5,896</td>
                                                <td>3,654</td>
                                                <td>82.54%</td>
                                                <td class="w-25">
                                                    <div id="sparkline-bounce-1" class="apex-charts"></div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    /about.html
                                                    <a href="#" class="ms-1" aria-label="Open website">
                                                        <i data-feather="link" class="ms-1 text-primary"
                                                            style="height: 15px; width: 15px;"></i>
                                                    </a>
                                                </td>
                                                <td>3,898</td>
                                                <td>3,450</td>
                                                <td>76.29%</td>
                                                <td class="w-25">
                                                    <div id="sparkline-bounce-2" class="apex-charts"></div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    /index.html
                                                    <a href="#" class="ms-1" aria-label="Open website">
                                                        <i data-feather="link" class="ms-1 text-primary"
                                                            style="height: 15px; width: 15px;"></i>
                                                    </a>
                                                </td>
                                                <td>3,057</td>
                                                <td>2,589</td>
                                                <td>72.68%</td>
                                                <td class="w-25">
                                                    <div id="sparkline-bounce-3" class="apex-charts"></div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    /invoice.html
                                                    <a href="#" class="ms-1" aria-label="Open website">
                                                        <i data-feather="link" class="ms-1 text-primary"
                                                            style="height: 15px; width: 15px;"></i>
                                                    </a>
                                                </td>
                                                <td>867</td>
                                                <td>795</td>
                                                <td>44.78%</td>
                                                <td class="w-25">
                                                    <div id="sparkline-bounce-4" class="apex-charts"></div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    /docs/
                                                    <a href="#" class="ms-1" aria-label="Open website">
                                                        <i data-feather="link" class="ms-1 text-primary"
                                                            style="height: 15px; width: 15px;"></i>
                                                    </a>
                                                </td>
                                                <td>958</td>
                                                <td>801</td>
                                                <td>41.15%</td>
                                                <td class="w-25">
                                                    <div id="sparkline-bounce-5" class="apex-charts"></div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    /service.html
                                                    <a href="#" class="ms-1" aria-label="Open website">
                                                        <i data-feather="link" class="ms-1 text-primary"
                                                            style="height: 15px; width: 15px;"></i>
                                                    </a>
                                                </td>
                                                <td>658</td>
                                                <td>589</td>
                                                <td>32.65%</td>
                                                <td class="w-25">
                                                    <div id="sparkline-bounce-6" class="apex-charts"></div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    /analytical.html
                                                    <a href="#" class="ms-1" aria-label="Open website">
                                                        <i data-feather="link" class="ms-1 text-primary"
                                                            style="height: 15px; width: 15px;"></i>
                                                    </a>
                                                </td>
                                                <td>457</td>
                                                <td>859</td>
                                                <td>32.65%</td>
                                                <td class="w-25">
                                                    <div id="sparkline-bounce-7" class="apex-charts"></div>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div> <!-- container-fluid -->
        </div> <!-- content -->
    </div>
@endsection
