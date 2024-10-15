<!-- Topbar Start -->
<div class="topbar-custom">
    <div class="container-xxl">
        <div class="d-flex justify-content-between">
            <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">
                <li>
                    <button class="button-toggle-menu nav-link ps-0">
                        <i data-feather="menu" class="noti-icon"></i>
                    </button>
                </li>
                <li class="d-none d-lg-block">
                    <div class="position-relative topbar-search">
                        <input type="text" class="form-control bg-light bg-opacity-75 border-light ps-4"
                            placeholder="Search...">
                        <i
                            class="mdi mdi-magnify fs-16 position-absolute text-muted top-50 translate-middle-y ms-2"></i>
                    </div>
                </li>
            </ul>

            <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">
                <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link dropdown-toggle nav-user me-0" href="#" id="profileDropdown" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('storage/' . Auth::user()->anh_dai_dien) }}" alt="user-image"
                            class="rounded-circle">
                        <span class="pro-user-name ms-1">
                            {{ Auth::user()->ho_ten }} <i class="mdi mdi-chevron-down"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end profile-dropdown">
                        <a class="dropdown-item notify-item" href="#" id="showUserProfile">
                            <i class="mdi mdi-account-circle-outline fs-16 align-middle"></i>
                            <span>Tài khoản</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <form id="logout-form" action="{{ route('auth.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item notify-item">
                                <i class="mdi mdi-location-exit fs-16 align-middle"></i>
                                <span>Đăng Xuất</span>
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Topbar -->

<!-- Form thông tin tài khoản -->
<div id="userProfilePopup" class="user-profile-popup" style="display: none">
    <div class="popup-content">
        <div class="popup-header">
            <h5>Thông tin tài khoản</h5>
            <span class="close-popup" id="closeUserProfile">&times;</span>
        </div>
        <div class="popup-body">
            <p><strong>Họ tên:</strong> {{ Auth::user()->ho_ten }}</p>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p><strong>Số điện thoại:</strong> {{ Auth::user()->so_dien_thoai }}</p>
            <p><strong>Địa chỉ:</strong> {{ Auth::user()->dia_chi }}</p>
        </div>
        <div class="popup-footer">
            <button class="btn btn-primary" id="editUserProfileBtn">Sửa</button>
            <button class="btn btn-secondary" id="closeUserProfileBtn">Đóng</button>
        </div>
    </div>
</div>

<!-- Form chỉnh sửa tài khoản (Ẩn mặc định, hiển thị khi bấm Sửa) -->
<div id="editUserProfilePopup" class="user-profile-popup" style="display: none">
    <div class="popup-content">
        <div class="popup-header">
            <h5>Chỉnh sửa tài khoản</h5>
            <span class="close-popup" id="closeEditUserProfile">&times;</span>
        </div>
        <div class="popup-body">
            <form id="editUserProfileForm" action="{{ route('user.update') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="hoTen" class="form-label">Họ tên</label>
                    <input type="text" class="form-control" id="hoTen" name="ho_ten"
                        value="{{ Auth::user()->ho_ten }}">
                </div>
                <div class="mb-3">
                    <label for="anhDaiDien" class="form-label">Ảnh đại diện</label>
                    <input type="file" class="form-control" id="anhDaiDien" name="anh_dai_dien">
                    @if (Auth::user()->anh_dai_dien)
                        <div class="mt-2">
                            <label>Ảnh hiện tại:</label>
                            <img src="{{ asset('storage/' . Auth::user()->anh_dai_dien) }}" alt="Current User Image"
                                class="rounded-circle" style="width: 100px; height: 100px;">
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="anhDaiDien" class="form-label">Địa Chỉ</label>
                    <input type="text" class="form-control" id="diaChi" value="{{ Auth::user()->dia_chi }}"
                        name="dia_chi">
                </div>
                <button type="submit" class="btn btn-success">Lưu</button>
                <button type="button" class="btn btn-secondary" id="cancelEditProfile">Hủy</button>
            </form>
        </div>
    </div>
</div>



<!-- CSS -->
<style>
    .user-profile-popup {
        display: none;
        /* Ẩn mặc định */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Màu nền tối */
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .popup-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        width: 400px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        position: relative;
    }

    .popup-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .popup-header h5 {
        margin: 0;
    }

    .close-popup {
        cursor: pointer;
        font-size: 24px;
        position: absolute;
        top: 10px;
        right: 10px;
    }

    .popup-body p,
    .popup-body .form-label {
        margin: 10px 0;
    }

    .popup-footer {
        text-align: right;
    }
</style>

<!-- JavaScript -->
<script>
    $(document).ready(function() {
        // Ẩn tất cả các popup khi trang được tải
        $('#userProfilePopup').hide();
        $('#editUserProfilePopup').hide();

        // Hiển thị form thông tin khi click vào "Tài khoản"
        $('#showUserProfile').click(function(e) {
            e.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
            console.log("Đang hiển thị popup thông tin người dùng.");
            $('#userProfilePopup').fadeIn(); // Hiển thị khung thông tin
        });

        // Ẩn form thông tin khi click vào nút đóng hoặc biểu tượng "x"
        $('#closeUserProfile, #closeUserProfileBtn').click(function() {
            console.log("Đang ẩn popup thông tin người dùng.");
            $('#userProfilePopup').fadeOut(); // Ẩn khung thông tin
        });

        // Hiển thị form chỉnh sửa khi click vào "Sửa"
        $('#editUserProfileBtn').click(function() {
            console.log("Đang hiển thị popup chỉnh sửa thông tin người dùng.");
            $('#userProfilePopup').fadeOut(); // Ẩn khung thông tin
            $('#editUserProfilePopup').fadeIn(); // Hiển thị khung chỉnh sửa
        });

        // Ẩn form chỉnh sửa khi click vào nút hủy hoặc biểu tượng "x"
        $('#closeEditUserProfile, #cancelEditProfile').click(function() {
            console.log("Đang ẩn popup chỉnh sửa thông tin người dùng.");
            $('#editUserProfilePopup').fadeOut(); // Ẩn khung chỉnh sửa
        });

        // Đóng popup khi nhấn vào bất kỳ đâu bên ngoài popup
        $(window).click(function(e) {
            if ($(e.target).is('#userProfilePopup')) {
                console.log("Đang ẩn popup thông tin người dùng do click bên ngoài.");
                $('#userProfilePopup').fadeOut(); // Ẩn khung thông tin
            }
            if ($(e.target).is('#editUserProfilePopup')) {
                console.log("Đang ẩn popup chỉnh sửa thông tin người dùng do click bên ngoài.");
                $('#editUserProfilePopup').fadeOut(); // Ẩn khung chỉnh sửa
            }
        });

        // Ngăn form tự động gửi
        $('#editUserProfileForm').on('submit', function(e) {
            e.preventDefault(); // Ngăn không cho form tự động gửi

            // Gửi form qua AJAX
            $.ajax({
                url: $(this).attr('action'), // Lấy URL từ thuộc tính action của form
                type: $(this).attr('method'), // Lấy phương thức từ thuộc tính method của form
                data: new FormData(this), // Lấy dữ liệu từ form
                processData: false, // Không xử lý dữ liệu
                contentType: false, // Không định dạng nội dung
                success: function(response) {
                    // Hiển thị thông báo thành công
                    console.log("Form chỉnh sửa tài khoản đã được gửi.");
                    // Có thể hiển thị thông báo bằng alert hoặc thêm một thông báo trên giao diện
                    alert('Cập nhật thông tin thành công!');
                    // Đóng popup sau khi lưu
                    $('#editUserProfilePopup').fadeOut();
                },
                error: function(xhr) {
                    // Xử lý lỗi nếu có
                    console.log("Có lỗi xảy ra:", xhr.responseText);
                    alert('Có lỗi xảy ra. Vui lòng thử lại.');
                }
            });
        });

    });
</script>
