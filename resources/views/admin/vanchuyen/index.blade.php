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
                                    <a class="nav-link {{ !request('status') ? 'active' : '' }}"
                                        href="{{ route('vanchuyen.index') }}">Tất cả</a>
                                </li>
                                @foreach (['Đã lấy hàng', 'Đang vận chuyển', 'Đã giao', 'Thành công', 'Giao lại', 'Thất bại'] as $status)
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link {{ request('status') == $status ? 'active' : '' }}"
                                            href="{{ route('vanchuyen.index', ['status' => $status]) }}">{{ $status }}</a>
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
                                            <th scope="col">Người vận chuyển</th>
                                            <th scope="col">Số điện thoại</th>
                                            <th scope="col">Địa chỉ giao hàng</th>
                                            <th scope="col">Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vanchuyens as $item)
                                            <tr>
                                                <td>{{ $item->donHang->ma_don_hang }}</td>
                                                <td>{{ $item->user->ho_ten }}</td>
                                                <td>{{ $item->donHang->so_dien_thoai }}</td>
                                                <td>{{ $item->donHang->dia_chi }}</td>
                                                <td><a href="{{ route('vanchuyen.show', $item->donHang->id) }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#allmyModalvc{{ $item->donHang->id }}">
                                                        <i
                                                            class="mdi mdi-eye text-muted fs-18 rounded-2 border p-1 me-1"></i>
                                                    </a>

                                                    <!-- The Modal -->
                                                    <div class="modal" id="allmyModalvc{{ $item->donHang->id }}">
                                                        @include('admin.vanchuyen.show', [
                                                            'donhang' => $item->donHang,
                                                        ])
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="page mt-3">
                                {{ $vanchuyens->links() }}
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
