@extends('admin.layout')

@section('css')
@endsection

@section('content')

    <div class="content-page">

        <div class="content">

            <!-- Start Content-->
            <div class="container">

                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0">Danh sách người dùng</h4>
                    </div>
                </div>

                <!-- Striped Rows -->
                <div class="col-xl-12">
                    <div class="card">

                        <div class="d-flex justify-content-between">
                            <div class="row">
                                <div class="col-12">
                                    <form action="{{ route('user.index') }}" method="POST">
                                        @csrf
                                        @method('GET')
                                        <input type="text" id="search_product_name" name="search_product_name"
                                            placeholder="Tìm kiếm" value="{{ request('search_product_name') }}"
                                            class="form-control" onchange="this.form.submit();">
                                    </form>
                                </div>
                             
                            </div>

                            <div class="col-3">
                                <form action="{{ route('user.index') }}" method="POST" id="filter-form">
                                    @csrf
                                    @method('GET')
                                    <select class="form-select" name="search_dm"
                                        onchange="document.getElementById('filter-form').submit();">
                                        <option value="">Hiển thị tất cả</option>
                                        <option value="1" {{ request('search_dm') == '1' ? 'selected' : '' }}>Hiển
                                            thị</option>
                                        <option value="0" {{ request('search_dm') == '0' ? 'selected' : '' }}>Ẩn
                                        </option>
                                    </select>
                                </form>
                            </div>



                            <!-- Hiển thị thông báo thành công -->
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissable fade show " role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close justify-content-center" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        </div><!-- end card header -->

                        <div class="row">
                            <div class="card-body">
                                <div class="table-responsive">

                                    <table class="table table-striped mb-0">

                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Chức vụ</th>
                                                <th scope="col">Họ và tên</th>
                                                {{-- <th scope="col">Ảnh đại diện</th> --}}
                                                <th scope="col">Email</th>
                                                <th scope="col">Số điện thoại</th>
                                                {{-- <th scope="col">Ngày sinh</th>
                                                <th scope="col">Địa chỉ</th>
                                                <th scope="col">Giới tính</th>
                                                <th scope="col">Mật khẩu</th> --}}
                                                <th scope="col">Trạng thái</th>
                                                <th scope="col">Thao tác</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($list as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>{{ $item->chuc_vu?->ten_chuc_vu }}</td> <!-- Hiển thị tên chức vụ -->
                                                    <td>{{ $item->ho_ten }}</td>
                                                    {{-- <td><img src="{{ asset('storage/' . $item->anh_dai_dien) }}"
                                                            alt="Hình ảnh" width="150px"></td> --}}
                                                    <td>{{ $item->email }}</td>
                                                    <td>{{ $item->so_dien_thoai }}</td>
                                                    {{-- <td>{{ $item->ngay_sinh }}</td>
                                                    <td>{{ $item->dia_chi }}</td>
                                                    <td>{{ $item->gioi_tinh }}</td>
                                                    <td>{{ $item->mat_khau }}</td> --}}
                                                    <td>{!! $item->is_active
                                                        ? '<span class="badge bg-primary">Hiển Thị</span>'
                                                        : '<span class="badge bg-danger">Ẩn</span>' !!}</td>
                                                    <td>
                                                        <div>
                                                            <!-- Thay đổi data-bs-target để tương ứng với ID của item -->
                                                            <a href="{{ route('user.show', $item->id) }}" data-bs-toggle="modal" data-bs-target="#myModal{{ $item->id }}">
                                                                <i class="mdi mdi-eye text-muted fs-18 rounded-2 border p-1 me-1"></i>
                                                            </a>
                                            
                                                            <!-- Đảm bảo mỗi modal có ID riêng -->
                                                            <div class="modal fade" id="myModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $item->id }}" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        {{-- <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel{{ $item->id }}">Chi tiết đánh giá</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div> --}}
                                                                        <div class="modal-body">
                                                                            @include('admin.user.show', ['post' => $item])
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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


            </div> <!-- container-fluid -->

        </div>
    </div>

@section('js')
    <!-- Include your JS files here -->
@endsection
@endsection
