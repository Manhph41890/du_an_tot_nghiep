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
                        <h4 class="fs-18 fw-semibold m-0">Chi tiet don hang</h4>
                    </div>
                </div>
                <div class="modal-dialog modal-lg">
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5>Chi tiết đơn hàng</h5>
                                        <span>Đơn Hàng: <a href="#">fargdhtyjgikuhiljo;p</a></span>
                                        <span>Ngày tạo: 12/10/2024 10:15</span>
                                    </div>
                                    <div class="card-body">
                                        <!-- Danh sách sản phẩm -->
                                        <h6>Tất Cả Sản Phẩm</h6>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Sản phẩm</th>
                                                    <th>Số lượng</th>
                                                    <th>Giá</th>
                                                    <th>Thành tiền</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex">
                                                            <img src="link-to-image.jpg" alt="Product Image"
                                                                class="img-thumbnail"
                                                                style="width: 50px; height: 50px; margin-right: 10px;">
                                                            <div>
                                                                <p>dshhedgsd</p>
                                                                <p>Màu: Đỏ Size: M</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>123</td>
                                                    <td>1,234 VND</td>
                                                    <td>1,111,111 VND</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <!-- Thông tin vận chuyển -->
                                        <div class="mt-3">
                                            <h6>Thông tin vận chuyển</h6>
                                            <div class="d-flex justify-content-between">
                                                <div>Lấy hàng: Hà Nội</div>
                                                <div>Trạng thái vận chuyển: Đang vận chuyển</div>
                                                <div>Mã vận chuyển: 100023874</div>
                                                <div>Tổng khối lượng: 0.00kg</div>
                                                <div>Nhà vận chuyển: Tiền thu hộ</div>
                                            </div>
                                        </div>

                                        <!-- Thông tin đơn hàng -->
                                        <div class="mt-4">
                                            <h6>Đã nhận hàng</h6>
                                            <ul class="list-unstyled">
                                                <li>Số lượng sản phẩm: 123 sản phẩm</li>
                                                <li>Tổng tiền hàng: 1,111,111 VND</li>
                                                <li>Giảm giá: -234,234,522 VND</li>
                                                <li>Vận chuyển: 20,000 VND</li>
                                                <li>Tổng giá trị đơn hàng: 1,143,124 VND</li>
                                            </ul>
                                        </div>

                                        <!-- Các nút hành động -->
                                        <div class="d-flex justify-content-between mt-4">
                                            <button class="btn btn-success">Hoàn tất đơn hàng</button>
                                            <div>
                                                <button class="btn btn-outline-secondary">Xác nhận đơn hàng</button>
                                                <button class="btn btn-success">Hoàn tất đơn hàng</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Thông tin khách hàng -->
                                    <div class="card-footer d-flex justify-content-between">
                                        <div>
                                            <h6>Thông tin khách hàng</h6>
                                            <p>Họ tên: dshhedgsdfg</p>
                                            <p>Số điện thoại: 07678678756</p>
                                            <p>Email: fdsbfedg</p>
                                            <p>Ghi chú của khách hàng: stfgtyhrt</p>
                                        </div>
                                        <div>
                                            <h6>Đánh giá của khách hàng</h6>
                                            <p>Chưa có đánh giá nào.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

@section('js')
    <!-- Include your JS files here -->
@endsection
@endsection
