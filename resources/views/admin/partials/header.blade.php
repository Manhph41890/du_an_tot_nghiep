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
                        <img src="{{ asset('storage/' . Auth::user()->anh_dai_dien) }}" alt="Ảnh đại diện"
                            width="50" height="50" class="rounded-circle">
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

<!-- Popup thông tin tài khoản -->
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

<!-- Popup chỉnh sửa tài khoản -->
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
                        value="{{ Auth::user()->ho_ten }}" required>
                </div>
                <div class="mb-3">
                    <label for="anhDaiDien" class="form-label">Ảnh đại diện</label>
                    <input type="file" class="form-control" id="anhDaiDien" name="anh_dai_dien">
                    @if (Auth::user()->anh_dai_dien)
                        <div class="mt-2">
                            <label>Ảnh hiện tại:</label>
                            <img src="{{ asset('storage/' . Auth::user()->anh_dai_dien) }}" alt="Ảnh hiện tại"
                                class="rounded-circle" style="width: 100px; height: 100px;">
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="diaChi" class="form-label">Địa Chỉ</label>
                    <input type="text" class="form-control" id="diaChi" name="dia_chi"
                        value="{{ Auth::user()->dia_chi }}">
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
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
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

    .close-popup {
        cursor: pointer;
        font-size: 24px;
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
        // Hiển thị popup thông tin người dùng
        $('#showUserProfile').click(function(e) {
            e.preventDefault();
            $('#userProfilePopup').fadeIn();
        });

        // Ẩn popup thông tin người dùng
        $('#closeUserProfile, #closeUserProfileBtn').click(function() {
            $('#userProfilePopup').fadeOut();
        });

        // Hiển thị popup chỉnh sửa tài khoản
        $('#editUserProfileBtn').click(function() {
            $('#userProfilePopup').fadeOut();
            $('#editUserProfilePopup').fadeIn();
        });

        // Ẩn popup chỉnh sửa tài khoản
        $('#closeEditUserProfile, #cancelEditProfile').click(function() {
            $('#editUserProfilePopup').fadeOut();
        });

        // Đóng popup khi click bên ngoài popup
        $(window).click(function(e) {
            if ($(e.target).is('#userProfilePopup')) {
                $('#userProfilePopup').fadeOut();
            }
            if ($(e.target).is('#editUserProfilePopup')) {
                $('#editUserProfilePopup').fadeOut();
            }
        });

        // Gửi form chỉnh sửa qua AJAX
        $('#editUserProfileForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    alert('Cập nhật thông tin thành công!');
                    $('#editUserProfilePopup').fadeOut();
                },
                error: function(xhr) {
                    alert('Có lỗi xảy ra. Vui lòng thử lại.');
                }
            });
        });
        $(document).ready(function() {
            // Lắng nghe sự kiện click trên nút toggle
            $('.toggle-footer-btn').on('click', function() {
                // Thêm hoặc xóa class 'hidden' vào phần tử cùng cấp với '.footer-sibar'
                $('.footer-sibar').siblings('.hidden').toggleClass('hidden');
            });
        });
    });
</script>
