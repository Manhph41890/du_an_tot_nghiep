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
                        <a href="#dashboad" data-bs-toggle="tab"><i class="fas fa-tachometer-alt"></i> Dashboard</a>

                        <a href="#orders" data-bs-toggle="tab"><i class="fa fa-cart-arrow-down"></i> Orders</a>

                        <a href="#download" data-bs-toggle="tab"><i class="fas fa-cloud-download-alt"></i> Download</a>

                        <a href="#payment-method" data-bs-toggle="tab"><i class="fa fa-credit-card"></i> Payment Method</a>

                        <a href="#address-edit" data-bs-toggle="tab"><i class="fa fa-map-marker"></i> address</a>



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
                                <h3>Dashboard</h3>

                                <div class="welcome mb-20">
                                    <p>
                                        Hello, <strong>Alex Tuntuni</strong> (If Not
                                        <strong>Tuntuni !</strong><a href="login-register.html" class="logout"> Logout</a>)
                                    </p>
                                </div>

                                <p class="mb-0">
                                    From your account dashboard. you can easily check &amp; view
                                    your recent orders, manage your shipping and billing addresses
                                    and edit your password and account details.
                                </p>
                            </div>
                        </div>
                        <!-- Single Tab Content End -->

                        <!-- Single Tab Content Start -->
                        <div class="tab-pane fade" id="orders" role="tabpanel">
                            <div class="myaccount-content">
                                <h3>Orders</h3>

                                <div class="myaccount-table table-responsive text-center">
                                    <table class="table table-bordered">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Mostarizing Oil</td>
                                                <td>Aug 22, 2023</td>
                                                <td>Pending</td>
                                                <td>$45</td>
                                                <td>
                                                    <a href="shopping-cart.html" class="ht-btn black-btn">View</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Katopeno Altuni</td>
                                                <td>July 22, 2023</td>
                                                <td>Approved</td>
                                                <td>$100</td>
                                                <td>
                                                    <a href="shopping-cart.html" class="ht-btn black-btn">View</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Murikhete Paris</td>
                                                <td>June 12, 2023</td>
                                                <td>On Hold</td>
                                                <td>$99</td>
                                                <td>
                                                    <a href="shopping-cart.html" class="ht-btn black-btn">View</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Single Tab Content End -->

                        <!-- Single Tab Content Start -->
                        <div class="tab-pane fade" id="download" role="tabpanel">
                            <div class="myaccount-content">
                                <h3>Downloads</h3>

                                <div class="myaccount-table table-responsive text-center">
                                    <table class="table table-bordered">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Product</th>
                                                <th>Date</th>
                                                <th>Expire</th>
                                                <th>Download</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>Mostarizing Oil</td>
                                                <td>Aug 22, 2023</td>
                                                <td>Yes</td>
                                                <td>
                                                    <a href="#" class="ht-btn black-btn">Download File</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Katopeno Altuni</td>
                                                <td>Sep 12, 2023</td>
                                                <td>Never</td>
                                                <td>
                                                    <a href="#" class="ht-btn black-btn">Download File</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Single Tab Content End -->

                        <!-- Single Tab Content Start -->
                        <div class="tab-pane fade" id="payment-method" role="tabpanel">
                            <div class="myaccount-content">
                                <h3>Payment Method</h3>

                                <p class="saved-message">
                                    You Can't Saved Your Payment Method yet.
                                </p>
                            </div>
                        </div>
                        <!-- Single Tab Content End -->

                        <!-- Single Tab Content Start -->
                        <div class="tab-pane fade" id="address-edit" role="tabpanel">
                            <div class="myaccount-content">
                                <h3>Billing Address</h3>

                                <address>
                                    <p><strong>Alex Tuntuni</strong></p>
                                    <p>
                                        1355 Market St, Suite 900 <br />
                                        San Francisco, CA 94103
                                    </p>
                                    <p>Mobile: (123) 456-7890</p>
                                </address>

                                <a href="#" class="ht-btn black-btn d-inline-block edit-address-btn"><i
                                        class="fa fa-edit"></i>Edit Address</a>
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
                                                <input 
                                                    id="ngay_sinh" 
                                                    name="ngay_sinh" 
                                                    type="date" 
                                                    class="form-control" 
                                                    value="{{ $user->ngay_sinh }}" 
                                                    disabled 
                                                    style="background-color: #ffffff; color: #000000; cursor: not-allowed;   "
                                                />
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
