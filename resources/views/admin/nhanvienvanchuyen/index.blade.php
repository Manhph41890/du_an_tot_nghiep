@extends('admin.layout')

@section('title')
    {{-- {{ $title }} --}}
@endsection

@section('css')
@endsection

@section('content')

    <div class="content-page">

        <div class="content">

            <!-- Start Content-->
            <div class="container-xxl">

                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0"> {{ $title }} </h4>
                    </div>
                </div>

                <!-- Striped Rows -->
                <div class="col-xl-12">
                    <div class="card">

                        <div class="card-header ">
                            <div class="row">
                                {{-- <div class="col-6">
                                    <form action="{{ route('baiviets.index') }}" method="GET" id="filter-form-km">
                                        <div class="d-flex gap-3 align-items-baseline">
                                            <div class=" mb-3 d-flex align-items-center gap-3">
                                                <div
                                                    class = "form-group d-flex align-items-center justify-content-center gap-3">
                                                    <label for="">Từ:</label>
                                                    <input class="form-control" type="date" name="start_date"
                                                        id="start_date" value="{{ request()->start_date }}">

                                                </div>
                                                <div div
                                                    class = "form-group d-flex align-items-center justify-content-center gap-3">
                                                    <label for="">Đến:</label>
                                                    <input class="form-control" type="date" name="end_date"
                                                        id="end_date" value="{{ request()->end_date }}">

                                                </div>
                                            </div>
                                            <button class="btn btn-success" type="submit">Lọc</button>
                                        </div>

                                    </form>
                                </div> --}}
                            </div>
                        </div>

                        <div class="row">
                            <div class="card-body">
                                <div class="table-responsive">

                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Họ tên</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Ngày sinh</th>
                                                <th scope="col">Giới tính</th>
                                                <th scope="col">Địa chỉ</th>
                                                <th scope="col">Trạng thái</th>
                                                <th scope="col">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($shippers as $key => $shipper)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $shipper->name }}</td>
                                                    <td>{{ $shipper->email }}</td>
                                                    <td>{{ $shipper->ngay_sinh }}</td>
                                                    <td>{{ $shipper->gioi_tinh }}</td>
                                                    <td>{{ $shipper->dia_chi }}</td>
                                                    <td
                                                        class="{{ $shipper->is_active == 0 ? 'text-danger' : 'text-success' }}">
                                                        {{ $shipper->is_active == 1 ? 'Hoạt động' : 'Ẩn' }}
                                                    </td>
                                                    <td>
                                                        <a href="#" 
                                                           class="view-details" 
                                                           data-cccd="{{ $shipper->cccd }}" 
                                                           data-bang-lai-xe="{{ $shipper->bang_lai_xe }}" 
                                                           data-phone="{{ $shipper->phone }}" 
                                                           data-bs-toggle="modal" 
                                                           data-bs-target="#modalDetail">
                                                            <i class="fas fa-eye" style="cursor: pointer;"></i>
                                                        </a>
                                                    </td>
                                                    
                                                    
                                                </tr>
                                            @endforeach
                                            <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalDetailLabel">Thông tin chi tiết</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Nội dung chi tiết hiển thị ở đây -->
                                                            <p id="modalContent">Đang tải thông tin...</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </tbody>
                                    </table>
                                </div><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- container-fluid -->

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modalDetail = document.getElementById('modalDetail');
            const modalContent = modalDetail.querySelector('#modalContent');

            document.querySelectorAll('.view-details').forEach(button => {
                button.addEventListener('click', function () {
                    // Lấy dữ liệu từ data-attributes
                    const cccd = this.getAttribute('data-cccd');
                    const bangLaiXe = this.getAttribute('data-bang-lai-xe');
                    const phone = this.getAttribute('data-phone');

                    // Render nội dung vào modal
                    modalContent.innerHTML = `
                        <p><strong>Số CCCD:</strong> ${cccd}</p>
                        <p><strong>Bằng lái xe:</strong> ${bangLaiXe}</p>
                        <p><strong>Số điện thoại:</strong> ${phone}</p>
                    `;
                });
            });
        });
    </script>
@endsection
