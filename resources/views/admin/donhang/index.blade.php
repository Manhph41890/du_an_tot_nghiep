@extends('admin.layout')

@section('css')
    <!-- Đặt CSS vào đây nếu cần -->
@endsection

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container">
                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0">{{ $title }}</h4>
                    </div>
                </div>

                <!-- Giao diện Tabs -->
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="success-tab" data-bs-toggle="tab"
                                        data-bs-target="#success" type="button" role="tab" aria-controls="success"
                                        aria-selected="true">Đặt hàng thành công</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="preparing-tab" data-bs-toggle="tab"
                                        data-bs-target="#preparing" type="button" role="tab" aria-controls="preparing"
                                        aria-selected="false">Đang chuẩn bị hàng</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="shipping-tab" data-bs-toggle="tab"
                                        data-bs-target="#shipping" type="button" role="tab" aria-controls="shipping"
                                        aria-selected="false">Đang vận chuyển</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="delivered-tab" data-bs-toggle="tab"
                                        data-bs-target="#delivered" type="button" role="tab" aria-controls="delivered"
                                        aria-selected="false">Đã giao</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="completed-tab" data-bs-toggle="tab"
                                        data-bs-target="#completed" type="button" role="tab" aria-controls="completed"
                                        aria-selected="false">Thành công</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="canceled-tab" data-bs-toggle="tab"
                                        data-bs-target="#canceled" type="button" role="tab" aria-controls="canceled"
                                        aria-selected="false">Đã hủy</button>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <div class="tab-content mt-1" id="myTabContent">
                                <div class="tab-pane fade show active" id="success" role="tabpanel"
                                    aria-labelledby="success-tab">
                                    <!-- Nội dung Đặt hàng thành công -->
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
                                                    <th scope="col">Trạng thái đơn hàng</th>
                                                    <th scope="col">Hành Động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($donhangs as $item)
                                                    <tr>
                                                        <td>{{ $item->id }}</td>
                                                        <td>{{ $item->user?->ho_ten }}</td>
                                                        <td>{{ $item->so_dien_thoai }}</td>
                                                        <td>{{ $item->dia_chi }}</td>
                                                        <td>{{ $item->ngay_tao }}</td>
                                                        <td>{{ $item->tong_tien }}</td>
                                                        <td>{{ $item->trang_thai }}</td>
                                                        <td>
                                                            <a href="{{ route('donhangs.show', $item->id) }}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#myModal{{ $item->id }}">
                                                                <i
                                                                    class="mdi mdi-eye text-muted fs-18 rounded-2 border p-1 me-1"></i>
                                                            </a>

                                                            <!-- The Modal -->
                                                            <div class="modal" id="myModal{{ $item->id }}">
                                                                @include('admin.donhang.show', [
                                                                    'donhang' => $item,
                                                                ])
                                                            </div>

                                                            <a href="{{ route('donhangs.edit', $item->id) }}"><i
                                                                    class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="preparing" role="tabpanel" aria-labelledby="preparing-tab">
                                    <h4>Đang chuẩn bị hàng</h4>
                                    <p>Nội dung đang chuẩn bị hàng...</p>
                                </div>
                                <div class="tab-pane fade" id="shipping" role="tabpanel"
                                    aria-labelledby="shipping-tab">
                                    <h4>Đang vận chuyển</h4>
                                    <p>Nội dung đang vận chuyển...</p>
                                </div>
                                <div class="tab-pane fade" id="delivered" role="tabpanel"
                                    aria-labelledby="delivered-tab">
                                    <h4>Đã giao</h4>
                                    <p>Nội dung đã giao...</p>
                                </div>
                                <div class="tab-pane fade" id="completed" role="tabpanel"
                                    aria-labelledby="completed-tab">
                                    <h4>Thành công</h4>
                                    <p>Nội dung thành công...</p>
                                </div>
                                <div class="tab-pane fade" id="canceled" role="tabpanel"
                                    aria-labelledby="canceled-tab">
                                    <h4>Đã hủy</h4>
                                    <p>Nội dung đã hủy...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- container-fluid -->
            </div>
        </div>
    </div>
    <style>
        .nav-tabs .nav-link {
            background-color: #f8f9fa;
            color: #495057;
            margin-right: 2px;
        }

        .nav-tabs .nav-link.active {
            background-color: #007bff;
            color: white;
            border-color: #007bff #007bff transparent;
        }
    </style>
@section('js')
    <!-- Include your JS files here -->
@endsection
@endsection
