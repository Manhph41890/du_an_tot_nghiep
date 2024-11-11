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
                        <a href="#account-info" data-bs-toggle="tab"><i class="fa fa-user"></i> Chi tiết tài
                            khoản</a>
                        @if ($user->chuc_vu_id === 1 || $user->chuc_vu_id === 3)
                            <a href="#dashboad" data-bs-toggle="tab"><i class="fas fa-tachometer-alt"></i> Vào trang quản
                                trị</a>
                        @endif
                        <a href="#orders" data-bs-toggle="tab"><i class="fa fa-cart-arrow-down"></i> Đơn hàng của bạn</a>

                        <a href="#payment-method" data-bs-toggle="tab"><i class="fa fa-credit-card"></i> Phương thức thanh
                            toán</a>

                        <a href="#logout-method" data-bs-toggle="tab"><i class="fa fa-credit-card"></i> Đăng xuất</a>

                    </div>
                </div>
                <!-- My Account Tab Menu End -->

                <!-- My Account Tab Content Start -->
                <div class="col-lg-9 col-12 mb-30">
                    <div class="tab-content" id="myaccountContent">
                        <div class="tab-pane fade active show" id="account-info" role="tabpanel">
                            <div class="myaccount-content">
                                <h3>{{ $title }}</h3>

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
                                                <input id="ngay_sinh" name="ngay_sinh" type="date" class="form-control"
                                                    value="{{ $user->ngay_sinh }}" disabled />
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
        }
    </script>
@endsection
