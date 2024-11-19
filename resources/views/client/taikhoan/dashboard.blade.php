@extends('client.layout')

@section('content')
    <style>
        .notification-dot {
            width: 20px;
            /* Điều chỉnh lại kích thước chấm đỏ */
            height: 20px;
            /* Điều chỉnh lại kích thước chấm đỏ */
            background-color: red;
            border-radius: 50%;
            position: absolute;
            top: -60px;
            /* Điều chỉnh vị trí chấm đỏ */
            left: 240px;
            /* Điều chỉnh vị trí chấm đỏ */
            color: white;
            /* Màu chữ trắng */
            display: flex;
            align-items: center;
            /* Căn giữa chữ theo chiều dọc */
            justify-content: center;
            /* Căn giữa chữ theo chiều ngang */
            font-size: 12px;
            /* Kích thước chữ */
            animation: pulse 1s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
                /* Kích thước ban đầu */
            }

            50% {
                transform: scale(0.8);
                /* Thu nhỏ */
            }
        }


        .notification-dot2 {
            width: 10px;
            height: 10px;
            background-color: red;
            border-radius: 50%;
            border: 2px solid white;
            position: absolute;
            top: -22px;
            left: -10px;
            /* animation: pulse 1s infinite; */
        }
    </style>
    <!-- breadcrumb-section start -->
    <nav class="breadcrumb-section theme1 bg-lighten2 pt-110 pb-110">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title pb-4 text-dark text-capitalize" style=" color: #fff !important">Thông tin tài khoản
                        </h2>
                    </div>
                </div>
                <div class="col-12">
                    <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
                        <li class="breadcrumb-item"><a href="{{ route('client.home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Thông tin tài khoản</li>
                    </ol>
                </div>
            </div>
        </div>
    </nav>
    <!-- breadcrumb-section end -->
    <!-- product tab start -->

    <div class="my-account pt-80 pb-50">
        <div class="container">
            <div class="row">
                <!-- <div class="col-12">
                                                <h3 class="title text-capitalize mb-30 pb-25">Thông tin tài khoản</h3>
                                            </div> -->
                <!-- My Account Tab Menu Start -->
                <div class="col-lg-3 col-12 mb-30">
                    <div class="myaccount-tab-menu nav" role="tablist">
                        <a href="#account-info" class="active" data-bs-toggle="tab"><i class="fa fa-user"></i> Chi tiết tài
                            khoản</a>
                        @if ($user->chuc_vu_id === 1 || $user->chuc_vu_id === 3)
                            <a href="#admin-dashboad-qt" data-bs-toggle="tab"><i class="fas fa-tachometer-alt"></i> Vào
                                trang
                                quản
                                trị</a>
                        @endif
                        <a href="#orders" data-bs-toggle="tab"><i class="fa fa-cart-arrow-down"></i> Đơn hàng của bạn</a>
                        @php
                            $tongDonHang = DB::table('don_hangs')
                                ->where('trang_thai_don_hang', 'Chờ xác nhận')
                                ->where('user_id', Auth::id()) // Lọc theo ID người dùng hiện tại
                                ->count();
                        @endphp
                        @if ($tongDonHang > 0)
                            <span class="ms-2 position-relative">
                                <span class="notification-dot">{{ $tongDonHang }}</span>
                            </span>
                        @endif
                        <span class="menu-arrow ms-auto"></span>

                        <a href="#payment-method" data-bs-toggle="tab"><i class="fa fa-credit-card"></i> Ví người dùng </a>

                        <a href="{{ route('auth.logout') }}" data-bs-toggle="tab"><i class="fa fa-credit-card"></i> Đăng
                            xuất</a>

                    </div>
                </div>
                <!-- My Account Tab Menu End -->

                <!-- My Account Tab Content Start -->
                <div class="col-lg-9 col-12 mb-30">
                    <div class="tab-content" id="myaccountContent">
                        <div class="tab-pane fade show active" id="account-info" role="tabpanel">
                            <div class="myaccount-content">
                                <h3 style="font-size: 17px;">{{ $title }}</h3>

                                <form id="user-info-form" action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="align-items-center">
                                        <div class="d-flex align-items-center">
                                            <!-- User Avatar -->
                                            {{-- <img src="{{ asset('storage/' . Auth::user()->anh_dai_dien) }}"
                                                 class="rounded-circle img-thumbnail float-start" alt="Profile Image"
                                                 style="width: 100px; height: 100px; object-fit: cover;"> --}}
                                            <img src="{{ asset('storage/' . Auth::user()->anh_dai_dien) }}?t={{ time() }}"
                                                class="rounded-circle img-thumbnail float-start" alt="Profile Image"
                                                style="width: 100px; height: 100px; object-fit: cover;">

                                            <!-- User Info Section -->
                                            <div class="overflow-hidden ms-4">
                                                <h4 class="m-0 text-dark fs-20">{{ Auth::user()->name }}</h4>
                                                <a href="#"
                                                    class="ml-4 font-semibold text-primary hover:text-blue-700"
                                                    onclick="toggleAvatarForm(event)">
                                                    Thay đổi ảnh đại diện
                                                </a>
                                                <!-- Avatar Form (Initially hidden) -->

                                                <div id="change-avatar-form" style="display: none;">
                                                    <div class="form-group">
                                                        <label for="anh_dai_dien">Hình đại diện</label>
                                                        <input type="file" class="form-control" id="anh_dai_dien"
                                                            name="anh_dai_dien">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Main Form for User Info & Avatar Update -->

                                    <input type="hidden" name="_method" value="POST" />

                                    <!-- User Info Fields -->
                                    <div class="account-details-form">
                                        <div class="row">
                                            <div class="col-12 mb-30">
                                                <label for="ho_ten" class="mb-2">Họ tên</label>
                                                <input id="ho_ten" name="ho_ten" type="text"
                                                    value="{{ $user->ho_ten }}" disabled />
                                            </div>
                                            <div class="col-12 mb-30">
                                                <label for="email" class="mb-2">Email</label>
                                                <input id="email" name="email" type="email"
                                                    value="{{ $user->email }}" disabled />
                                            </div>
                                            <div class="col-12 mb-30">
                                                <label for="so_dien_thoai" class="mb-2">Số điện thoại</label>
                                                <input id="so_dien_thoai" name="so_dien_thoai" type="number"
                                                    value="{{ $user->so_dien_thoai }}" disabled />
                                            </div>
                                            <div class="col-lg-6 col-12 mb-30">
                                                <label for="ngay_sinh" class="mb-2">Ngày sinh</label>
                                                <input id="ngay_sinh" name="ngay_sinh" type="date"
                                                    class="form-control" value="{{ $user->ngay_sinh }}" disabled />
                                            </div>
                                            <div class="col-lg-6 col-12 mb-30">
                                                <label for="gioi_tinh" class="mb-2">Giới tính</label>
                                                <select id="gioi_tinh" name="gioi_tinh" class="form-control"
                                                    {{ $user->gioi_tinh ? '' : 'disabled' }}>
                                                    <option value="Nam"
                                                        {{ $user->gioi_tinh == 'Nam' ? 'selected' : '' }}>Nam</option>
                                                    <option value="Nữ"
                                                        {{ $user->gioi_tinh == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                                                    <option value="Khác"
                                                        {{ $user->gioi_tinh == 'Khác' ? 'selected' : '' }}>Khác</option>
                                                </select>
                                            </div>

                                            <div class="col-12 mb-30">
                                                <label for="dia_chi" class="mb-2">Địa chỉ</label>
                                                <input id="dia_chi" name="dia_chi" type="text"
                                                    value="{{ $user->dia_chi }}" disabled />
                                            </div>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="col-12">
                                            <button type="button" class="btn btn-dark btn--md" id="toggleEditBtn"
                                                onclick="toggleEdit()">Cập Nhật</button>
                                            <button type="submit" class="btn btn-success btn--md" id="saveBtn"
                                                style="display: none;"
                                                onclick="setFormAction('updateThongtin')">Lưu</button>
                                            <button type="submit" class="btn btn-primary btn--md" id="avatarSaveBtn"
                                                style="display: none;" onclick="setFormAction('avatarUpdate')">Cập nhật
                                                ảnh đại diện</button>
                                        </div>
                                    </div>
                                </form>
                            </div>



                        </div>
                        {{-- aa --}}
                        <div class="tab-pane fade" id="admin-dashboad-qt" role="tabpanel">
                            <div class="myaccount-content">
                                <h3>Quản trị</h3>

                                <div class="welcome mb-20 d-flex">
                                    <h5><strong>Vào trang quản trị với chức vụ là:<h4 class="badge bg-primary ms-3 h3">
                                                {{ $user->chuc_vu?->ten_chuc_vu }}</h4></strong></h5>
                                </div>
                                <a href="{{ route('thong_ke_chung') }}" class="btn btn-success">Vào quản trị</a>

                            </div>
                        </div>
                        <!-- Single Tab Content End -->

                        <!-- Single Tab ssss -->
                        <div class="tab-pane fade" id="orders" role="tabpanel">
                            <div class="myaccount-content" id="orders-content">
                                <div class="myaccount-content">
                                    <h3>Đơn hàng của bạn</h3>
                                    <div class="myaccount-table table-responsive text-center">
                                        <table class="table table-hover">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Mã đơn hàng</th>
                                                    <th>Ngày tạo đơn hàng</th>
                                                    <th>Tổng tiền</th>
                                                    <th>Trạng thái đơn hàng</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($myOrders as $myOrder)
                                                    <tr>
                                                        <td>{{ $myOrder->ma_don_hang }}</td>
                                                        <td>{{ $myOrder->ngay_tao }}</td>
                                                        <td>{{ number_format($myOrder->tong_tien, 0, ',', '.') }} VNĐ</td>
                                                        <td>
                                                            <div class="d-flex justify-content-center mb-30">
                                                                @php
                                                                    $statusClasses = [
                                                                        'Chờ xác nhận' => 'bg-warning',
                                                                        'Đã xác nhận' => 'bg-info',
                                                                        'Đang chuẩn bị hàng' => 'bg-info',
                                                                        'Đang vận chuyển' => 'bg-info',
                                                                        'Đã giao' => 'bg-success',
                                                                        'Thành công' => 'bg-success',
                                                                        'Đã hủy' => 'bg-danger',
                                                                    ];
                                                                    $class =
                                                                        $statusClasses[$myOrder->trang_thai_don_hang] ??
                                                                        'bg-secondary';
                                                                @endphp

                                                                <span class="badge {{ $class }}">
                                                                    {{ $myOrder->trang_thai_don_hang }}
                                                                    @if ($myOrder->trang_thai_don_hang == 'Chờ xác nhận')
                                                                        <span class="ms-2 position-relative">
                                                                            <span class="notification-dot2"></span>
                                                                        </span>
                                                                    @endif
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('taikhoan.myorder', $myOrder->id) }}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#allmyModalfororder{{ $myOrder->id }}">
                                                                <i
                                                                    class="mdi mdi-eye text-muted fs-18 rounded-2 border p-1 me-1 @if ($myOrder->trang_thai_don_hang == 'Thành công') tichs_dg @endif"></i>
                                                            </a>

                                                            <style>
                                                                .tichs_dg {
                                                                    position: relative;
                                                                    border: 1px solid red !important;
                                                                }

                                                                .tichs_dg::after {
                                                                    content: ".";
                                                                    position: absolute;
                                                                    top: -55px;
                                                                    right: -5px;
                                                                    border-radius: 50%;
                                                                    font-size: 50px;
                                                                    color: red;
                                                                }
                                                            </style>
                                                            <script>
                                                                document.querySelectorAll('.tichs_dg').forEach(function(element) {
                                                                    element.addEventListener('click', function() {
                                                                        element.classList.remove('tichs_dg');
                                                                    })
                                                                });
                                                            </script>
                                                            <!-- The Modal -->
                                                            <div class="modal"
                                                                id="allmyModalfororder{{ $myOrder->id }}">
                                                                @include('client.taikhoan.showmyorder', [
                                                                    'donhang' => $myOrder,
                                                                ])
                                                            </div>

                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                        {{ $myOrders->links() }}
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Single Tab Content Start -->
                        <div class="tab-pane fade" id="payment-method" role="tabpanel">
                            <div class="myaccount-content">
                                <div class="card mx-auto p-4"
                                    style="max-width: 450px; background-color: #ffffff; border-radius: 15px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
                                    <!-- Header: Logo và tiêu đề -->
                                    <div class="d-flex align-items-center justify-content-center mb-4">
                                        <i class="fas fa-wallet text-success"
                                            style="font-size: 2.5rem; margin-right: 10px;"></i>
                                        <h4 class="mb-0 text-success">Ví người dùng</h4>
                                    </div>

                                    <!-- Thông tin chủ tài khoản -->
                                    <div class="border p-3 mb-4" style="background-color: #f8f9fa;">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <div class="text-muted">Chủ tài khoản</div>
                                                <div class="fw-bold">{{ $user->ho_ten }}</div>
                                            </div>
                                            <button class="btn btn-outline-success" data-bs-toggle="modal"
                                                data-bs-target="#historyModal">
                                                <i class="fas fa-history me-2"></i>Lịch sử
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Tổng tiền trong ví -->
                                    <div class="text-center mb-4">
                                        <div class="text-muted">Tổng tiền trong ví</div>
                                        <div class="fw-bold text-success" style="font-size: 2rem;">
                                            <i class="fas fa-money-bill-wave me-2"></i>
                                            @if ($viNguoiDung)
                                                {{ number_format($viNguoiDung->tong_tien, 0, ',', '.') }} đ
                                            @else
                                                0 đ
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Thao tác bổ sung -->
                                    <div class="d-grid">
                                        <a href="{{ route('taikhoan.rut-tien') }}" class="btn btn-success btn-lg">
                                            <i class="fas fa-plus-circle me-2"></i>Rút tiền
                                        </a>
                                    </div>
                                </div>
                                <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
                                <!-- Bootstrap Script -->
                                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                            </div>
                        </div>
                        <div class="modal fade " id="historyModal" tabindex="-1" aria-labelledby="historyModalLabel"
                            style="--bs-modal-width: 800px;" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="historyModalLabel">Lịch sử Giao Dịch</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="nav nav-tabs" id="transactionTabs" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="hoan-tab" data-bs-toggle="tab"
                                                    data-bs-target="#hoan" type="button" role="tab"
                                                    aria-controls="hoan" aria-selected="true">
                                                    Tiền hoàn
                                                </button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="thanh-toan-tab" data-bs-toggle="tab"
                                                    data-bs-target="#thanh-toan" type="button" role="tab"
                                                    aria-controls="thanh-toan" aria-selected="false">
                                                    Tiền thanh toán
                                                </button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="rut-tab" data-bs-toggle="tab"
                                                    data-bs-target="#rut" type="button" role="tab"
                                                    aria-controls="rut" aria-selected="false">
                                                    Tiền rút
                                                </button>
                                            </li>
                                        </ul>

                                        <div class="tab-content" id="transactionTabsContent">
                                            <!-- Tab 1: Tiền hoàn -->
                                            <div class="tab-pane fade show active" id="hoan" role="tabpanel"
                                                aria-labelledby="hoan-tab">
                                                @foreach ($chiTietVi as $item)
                                                    <div class="d-flex justify-content-between">
                                                        <div class="d-flex justify-content-start">
                                                            <p class="">Tiền hoàn</p>
                                                        </div>
                                                        <p class="">{{ $item->thoi_gian_hoan }}</p>
                                                        <div class="transaction-amount negative">
                                                            {{ number_format($item->tien_hoan, 0, ',', '.') }} VNĐ
                                                        </div>
                                                    </div>
                                                    <hr class="custom-hr">
                                                @endforeach
                                            </div>

                                            <!-- Tab 2: Tiền thanh toán -->
                                            <div class="tab-pane fade" id="thanh-toan" role="tabpanel"
                                                aria-labelledby="thanh-toan-tab">
                                                @foreach ($lsThanhToanVi as $item)
                                                    <div class="d-flex justify-content-between">
                                                        <div class="d-flex justify-content-start">
                                                            <p class="">Tiền thanh toán</p>
                                                        </div>
                                                        <p class="">{{ $item->thoi_gian_thanh_toan }}</p>
                                                        <div class="transaction-amount negative">
                                                            {{ number_format($item->tien_thanh_toan, 0, ',', '.') }} VNĐ
                                                        </div>
                                                    </div>
                                                    <hr class="custom-hr">
                                                @endforeach
                                            </div>

                                            <!-- Tab 3: Tiền rút -->
                                            <div class="tab-pane fade" id="rut" role="tabpanel"
                                                aria-labelledby="rut-tab">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        @foreach ($lsRutVi as $item)
                                                            <tr>
                                                                <td>{{ $item->bank?->name }}</td>
                                                                <td>{{ $item->bank?->account_number }}</td>
                                                                <td>{{ $item->bank?->account_holder }}</td>
                                                                <td>{{ date('d-m-Y H:i:s', strtotime($item->thoi_gian_rut)) }}
                                                                </td>
                                                                <td class="transaction-amount negative">
                                                                    {{ number_format($item->tien_rut, 0, ',', '.') }} VNĐ
                                                                </td>
                                                                <td>
                                                                    @php
                                                                        $statusClasses = [
                                                                            'Thành công' => 'bg-success',
                                                                            'Chờ duyệt' => 'bg-warning',
                                                                        ];
                                                                        $class =
                                                                            $statusClasses[
                                                                                $item->trang_thai
                                                                            ] ?? 'bg-secondary';
                                                                    @endphp

                                                                    <span class="badge position-static {{ $class }}">
                                                                     {{ $item->trang_thai }} 
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                                <hr class="custom-hr">
                                            </div>
                                        </div>
                                    </div>

                                    <style>
                                        .custom-hr {
                                            border: none;
                                            border-top: 1px solid #ccc;
                                            margin: 10px 0;
                                        }

                                        .transaction-amount {
                                            font-weight: bold;
                                        }
                                    </style>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Đóng</button>
                                        <button type="button" class="btn btn-primary">Xem chi tiết</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Single Tab Content End -->
                </div>

                {{-- aa a --}}

                <!-- My Account Tab Content End -->
            </div>
        </div>
    </div>

    {{-- ssssss --}}





    {{-- enddd sssss --}}
    <!-- product tab end -->
@endsection


@section('js')
    <script>
        document.getElementById('change-avatar-form').addEventListener('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            fetch('{{ route('taikhoan.dashboard.avatar') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update the image src without reloading
                        document.querySelector('img[alt="Profile Image"]').src = data.newAvatarUrl;
                        // Hide the form
                        document.getElementById('change-avatar-form').style.display = 'none';
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
    <script>
        function toggleEdit() {
            const inputs = document.querySelectorAll('#user-info-form input');
            const toggleEditBtn = document.getElementById('toggleEditBtn');
            const saveBtn = document.getElementById('saveBtn');

            // Toggle input disabled state
            inputs.forEach(input => input.disabled = !input.disabled);

            // Switch button visibility
            if (saveBtn.style.display === 'none') {
                saveBtn.style.display = 'inline-block';
                toggleEditBtn.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const accountInfoTab = document.querySelector('[href="#account-info"]');
            const ordersTab = document.querySelector('[href="#orders"]');
            const paymentMethodTab = document.querySelector('[href="#payment-method"]');

            accountInfoTab.addEventListener('click', function() {
                document.getElementById('account-info').style.display = 'block';
                document.getElementById('orders').style.display = 'none';
                document.getElementById('payment-method').style.display = 'none';
            });

            ordersTab.addEventListener('click', function() {
                document.getElementById('account-info').style.display = 'none';
                document.getElementById('orders').style.display = 'block';
                document.getElementById('payment-method').style.display = 'none';
            });

            paymentMethodTab.addEventListener('click', function() {
                document.getElementById('account-info').style.display = 'none';
                document.getElementById('orders').style.display = 'none';
                document.getElementById('payment-method').style.display = 'block';
            });
        });
    </script>
    {{-- xử lý ảnh + thông tin --}}
    <script>
        // Define routes in a JavaScript object
        const routes = {
            taikhoanDashboard: "{{ route('taikhoan.dashboard') }}",
            updateThongtin: "{{ route('update_thongtin') }}",
            avatarUpdate: "{{ route('taikhoan.dashboard.avatar') }}"
        };

        // Function to toggle edit mode
        function toggleEdit() {
            document.querySelectorAll(
                '#user-info-form input[type="text"], #user-info-form input[type="email"], #user-info-form input[type="number"], #user-info-form input[type="date"]'
            ).forEach(field => {

                field.disabled = !field.disabled;
            });
            document.getElementById('toggleEditBtn').style.display = 'none';
            document.getElementById('saveBtn').style.display = 'inline-block';
        }


        // Function to show avatar change form
        function toggleAvatarForm(event) {
            event.preventDefault();
            document.getElementById('change-avatar-form').style.display = 'block';
            document.getElementById('avatarSaveBtn').style.display = 'inline-block';
        }

        // Function to set the form action dynamically
        function setFormAction(routeName) {
            if (routes[routeName]) {
                document.getElementById('user-info-form').action = routes[routeName];
            } else {
                console.error(`Route [${routeName}] is not defined.`);
            }
        } <
    </script>
@endsection
