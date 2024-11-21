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
                <div class="d-flex justify-content-between">
                    <form method="GET" action="{{ route('donhangs.index') }}" class="d-flex mb-3">
                        <input type="date" name="start_date" class="form-control me-2"
                            value="{{ request('start_date') }}">
                        <input type="date" name="end_date" class="form-control me-2" value="{{ request('end_date') }}">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                    <form method="GET" action="{{ route('donhangs.index') }}" class="d-flex mb-3">
                        <input type="text" name="user_name" class="form-control me-2" placeholder="Tên người đặt hàng"
                            value="{{ request('user_name') }}">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>


                <!-- Giao diện Tabs -->
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link {{ !request('status') ? 'active' : '' }}"
                                        href="{{ route('donhangs.index') }}">Tất cả</a>
                                </li>
                                @foreach (['Chờ xác nhận', 'Đã xác nhận', 'Đang chuẩn bị hàng', 'Đang vận chuyển', 'Đã giao', 'Thành công', 'Đã hủy'] as $status)
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link {{ request('status') == $status ? 'active' : '' }}"
                                            href="{{ route('donhangs.index', ['status' => $status]) }}">{{ $status }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Mã đơn hàng</th>
                                            <th scope="col">Người đặt</th>
                                            <th scope="col">Số điện thoại</th>
                                            <th scope="col">Ngày tạo đơn hàng</th>
                                            <th scope="col">Tổng tiền</th>
                                            <th scope="col">Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($donhangs as $item)
                                            <tr>
                                                <td>{{ $item->ma_don_hang }}</td>
                                                <td>{{ $item->user->ho_ten }}</td>
                                                <td>{{ $item->user->so_dien_thoai }}</td>
                                                <td>{{ $item->ngay_tao }}</td>

                                                <td>{{ number_format($item->tong_tien, 0, ',', '.') }} VND</td>
                                                <td>
                                                    <a href="{{ route('donhangs.show', $item->id) }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#allmyModal{{ $item->id }}">
                                                        <i
                                                            class="mdi mdi-eye text-muted fs-18 rounded-2 border p-1 me-1"></i>
                                                    </a>

                                                    <!-- The Modal -->
                                                    <div class="modal" id="allmyModal{{ $item->id }}">
                                                        @include('admin.donhang.show', [
                                                            'donhang' => $item,
                                                        ])
                                                    </div>

                                                    <a href="{{ route('donhangs.edit', $item->id) }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#allmyModalEdit{{ $item->id }}">
                                                        <i
                                                            class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i>
                                                    </a>

                                                    <!-- The Modal -->
                                                    <div class="modal" id="allmyModalEdit{{ $item->id }}">
                                                        @include('admin.donhang.edit', [
                                                            'donhang' => $item,
                                                        ])
                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="page mt-3">
                                {{ $donhangs->links() }}
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
