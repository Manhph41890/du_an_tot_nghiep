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
                                                <th scope="col">Id</th>
                                                <th scope="col">ID Chức vụ</th>
                                                <th scope="col">Họ và tên</th>
                                                <th scope="col">Ảnh đại diện</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Số điện thoại</th>
                                                <th scope="col">Ngày sinh</th>
                                                <th scope="col">Địa chỉ</th>
                                                <th scope="col">Giới tính</th>
                                                <th scope="col">Mật khẩu</th>
                                                <th scope="col">Trạng thái</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($list as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>{{ $item->chuc_vus?->ten_chuc_vu }}</td>
                                                    <td>{{ $item->ho_ten }}</td>
                                                    <td><img src="{{ asset('storage/' . $item->anh_dai_dien) }}"
                                                            alt="Hình ảnh bài viết" width="150px"></td>
                                                    <td>{{ $item->email }}</td>
                                                    <td>{{ $item->so_dien_thoai }}</td>
                                                    <td>{{ $item->ngay_sinh }}</td>
                                                    <td>{{ $item->dia_chi }}</td>
                                                    <td>{{ $item->gioi_tinh }}</td>
                                                    <td>{{ $item->mat_khau }}</td>
                                                    <td>{{ $item->is_active }}</td>

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
