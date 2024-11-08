@extends('client.layout')

@section('content')
    <!-- breadcrumb-section start -->
    <nav class="breadcrumb-section theme1 bg-lighten2 pt-110 pb-110">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title pb-4 text-dark text-capitalize">Thông tin tài khoản</h2>
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
                <div class="col-12">
                    <h3 class="title text-capitalize mb-30 pb-25">Thông tin tài khoản</h3>
                </div>
                <!-- My Account Tab Menu Start -->
                <div class="col-lg-3 col-12 mb-30">
                    <div class="myaccount-tab-menu nav" role="tablist">
                        <a href="#account-info" data-bs-toggle="tab" class="active"><i class="fa fa-user"></i> Chi tiết tài
                            khoản</a>
                        @if ($user->chuc_vu_id === 1 || $user->chuc_vu_id === 3)
                            <a href="#dashboad" data-bs-toggle="tab"><i class="fas fa-tachometer-alt"></i> Vào trang quản
                                trị</a>
                        @endif
                        <a href="#orders" data-bs-toggle="tab"><i class="fa fa-cart-arrow-down"></i> Đơn hàng của bạn</a>

                        <a href="#payment-method" data-bs-toggle="tab"><i class="fa fa-credit-card"></i> Phương thức thanh
                            toán</a>

                        <a href="login.html"><i class="fa fa-sign-out"></i> Logout</a>
                    </div>
                </div>
                <!-- My Account Tab Menu End -->

                <!-- My Account Tab Content Start -->
                <div class="col-lg-9 col-12 mb-30">
                    <div class="tab-content" id="myaccountContent">
                        <!-- Single Tab Content Start -->
                        <div class="tab-pane fade" id="dashboad" role="tabpanel">
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

                        <!-- Single Tab Content Start -->
                        <div class="tab-pane fade" id="orders" role="tabpanel">
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
                                                    <td>{{ $myOrder->tong_tien }}</td>
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
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('taikhoan.myorder', $myOrder->id) }}"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#allmyModalfororder{{ $myOrder->id }}">
                                                            <i
                                                                class="mdi mdi-eye text-muted fs-18 rounded-2 border p-1 me-1"></i>
                                                        </a>

                                                        <!-- The Modal -->
                                                        <div class="modal" id="allmyModalfororder{{ $myOrder->id }}">
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
                        <!-- Single Tab Content Start -->
                        <div class="tab-pane fade" id="payment-method" role="tabpanel">
                            <div class="myaccount-content">
                                <h3 class="text-center mb-4">Thông tin thẻ ngân hàng</h3>
                                <div class="card-container">
                                    <!-- Logo của ngân hàng -->
                                    <div class="bank-logo">
                                        <img src="" width="50px" alt="NCB Logo">
                                    </div>

                                    <!-- Chip thẻ -->
                                    <div class="chip"></div>

                                    <!-- Số thẻ -->
                                    <div class="card-number">
                                        9704 1985 2619 1432 198
                                    </div>

                                    <!-- Thông tin khác của thẻ -->
                                    <div class="card-info">
                                        <div>
                                            <div> NGUYEN VAN A</div>
                                        </div>
                                        <div>
                                            <div>07/15</div>
                                        </div>
                                    </div>
                                    <!-- Logo Visa -->
                                    <div class="visa-logo">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg"
                                            alt="Visa Logo">
                                    </div>
                                </div>

                                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                            </div>
                        </div>
                        <!-- Single Tab Content End -->

                        <!-- Single Tab Content Start -->
                        <div class="tab-pane fade active show" id="account-info" role="tabpanel">
                            <div class="myaccount-content">
                                <h3>{{ $title }}</h3>
                                <div class="align-items-center">
                                    <div class="d-flex align-items-center">

                                        <img src="{{ asset('storage/' . Auth::user()->anh_dai_dien) }}"
                                            class="rounded-circle img-thumbnail float-start" alt="Profile Image"
                                            style="width: 100px; height: 100px; object-fit: cover;">


                                        <div class="overflow-hidden ms-4">
                                            <h4 class="m-0 text-dark fs-20"> {{ Auth::user()->name }}</h4>

                                            <a href="{{ route('taikhoan.dashboard', ['showForm' => 'true']) }}"
                                                class="ml-4 font-semibold text-primary hover:text-blue-700 
                                                           dark:text-gray-400 dark:hover:text-white focus:outline 
                                                           focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                                Thay đổi ảnh đại diện
                                            </a>

                                            @if ($showForm)
                                                <div id="change-avatar-form">
                                                    <form action="{{ route('taikhoan.dashboard.avatar') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="anh_dai_dien">Hình đại diện</label>
                                                            <input type="file" class="form-control" id="anh_dai_dien"
                                                                name="anh_dai_dien">
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Cập
                                                            nhật</button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>



                                <div class="account-details-form">

                                    <div class="align-items-center">

                                    </div>
                                    {{-- <form action="#">
                                        <div class="row">

                                            <div class="col-12 mb-30">
                                                <label for="ho_ten" class="mb-2 ">Họ tên</label>
                                                <input id="ho_ten" disabled type="text"
                                                    value="{{ $user->ho_ten }}" />
                                            </div>
                                            <div class="col-12 mb-30">
                                                <label for="email" class="mb-2 ">Email</label>
                                                <input id="email" disabled type="email"
                                                    value="{{ $user->email }}" />
                                            </div>
                                            <div class="col-12 mb-30">
                                                <label for="so_dien_thoai" class="mb-2 ">Số điện thoại</label>
                                                <input id="so_dien_thoai" disabled type="number"
                                                    value="{{ $user->so_dien_thoai }}" />
                                            </div>

                                            <div class="col-lg-6 col-12 mb-30">
                                                <label for="ngay_sinh" class="mb-2 ">Ngày sinh</label>
                                                <input id="ngay_sinh" name="ngay_sinh" placeholder="Ngày sinh"
                                                    type="text" value="{{ $user->ngay_sinh }}" />
                                            </div>

                                            <div class="col-lg-6 col-12 mb-30">
                                                <label for="gioi_tinh" class="mb-2 ">Giới tính</label>
                                                <input id="gioi_tinh" name="gioi_tinh" placeholder="Giới tính"
                                                    type="text" value="{{ $user->gioi_tinh }}" />
                                            </div>

                                            <div class="col-12 mb-30">
                                                <label for="dia_chi" class="mb-2 ">Địa chỉ</label>
                                                <input id="dia_chi" disabled placeholder="Địa chỉ" type="text"
                                                    value="{{ $user->dia_chi }}" />
                                            </div> --}}



                                    {{-- <div class="col-12 mb-30">
                                                <h4>Password change</h4>
                                            </div>

                                            <div class="col-12 mb-30">
                                                <input id="current-pwd" placeholder="Current Password" type="password" />
                                            </div>

                                            <div class="col-lg-6 col-12 mb-30">
                                                <input id="new-pwd" placeholder="New Password" type="password" />
                                            </div>

                                            <div class="col-lg-6 col-12 mb-30">
                                                <input id="confirm-pwd" placeholder="Confirm Password" type="password" />
                                            </div> --}}

                                    {{-- <div class="col-12">
                                                <button class="btn btn-dark btn--md">Cập Nhật</button>
                                            </div>
                                        </div>
                                    </form> --}}


                                    <form action="{{ route('update_thongtin') }}" method="POST" id="user-info-form">
                                        @csrf
                                        @method('POST')

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

                                            {{-- <div class="col-lg-6 col-12 mb-30">
                                                <label for="ngay_sinh" class="mb-2">Ngày sinh</label>
                                                <input id="ngay_sinh" name="ngay_sinh" placeholder="Ngày sinh"
                                                    type="date" value="{{ $user->ngay_sinh }}" disabled  />
                                            </div> --}}
                                            <div class="col-lg-6 col-12 mb-30">
                                                <label for="ngay_sinh" class="mb-2">Ngày sinh</label>
                                                <input id="ngay_sinh" name="ngay_sinh" type="date"
                                                    class="form-control" value="{{ $user->ngay_sinh }}" disabled
                                                    style="background-color: #ffffff; color: #000000; cursor: not-allowed;   " />
                                            </div>


                                            <div class="col-lg-6 col-12 mb-30">
                                                <label for="gioi_tinh" class="mb-2">Giới tính</label>
                                                <input id="gioi_tinh" name="gioi_tinh" placeholder="Giới tính"
                                                    type="text" value="{{ $user->gioi_tinh }}" disabled />
                                            </div>

                                            <div class="col-12 mb-30">
                                                <label for="dia_chi" class="mb-2">Địa chỉ</label>
                                                <input id="dia_chi" name="dia_chi" placeholder="Địa chỉ"
                                                    type="text" value="{{ $user->dia_chi }}" disabled />
                                            </div>

                                            <div class="col-12">
                                                <!-- Initially, this button shows "Cập Nhật" (Update) -->
                                                <button type="button" class="btn btn-dark btn--md" id="toggleEditBtn"
                                                    onclick="toggleEdit()">Cập Nhật</button>
                                                <!-- Hidden "Lưu" (Save) button that will submit the form -->
                                                <button type="submit" class="btn btn-success btn--md" id="saveBtn"
                                                    style="display: none;">Lưu</button>
                                            </div>
                                        </div>
                                    </form>



                                </div>
                            </div>
                        </div>
                        <!-- Single Tab Content End -->
                    </div>
                </div>
                <!-- My Account Tab Content End -->
            </div>
        </div>
    </div>
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
    </script>
@endsection
