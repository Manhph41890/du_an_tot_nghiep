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
                    <a class="nav-link dropdown-toggle nav-user me-0" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ Auth::user()->anh_dai_dien }}" alt="user-image" class="rounded-circle">
                        <span class="pro-user-name ms-1">
                            {{ Auth::user()->ho_ten }} <i class="mdi mdi-chevron-down"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end profile-dropdown">
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Mừng Trở Lại!</h6>
                        </div>

                        <a class="dropdown-item notify-item" href="#" data-bs-toggle="modal"
                            data-bs-target="#userProfileModal">
                            <i class="mdi mdi-account-circle-outline fs-16 align-middle"></i>
                            <span>Tài khoản</span>
                        </a>

                        <div class="dropdown-divider"></div>

                        <!-- Nút Đăng Xuất -->
                <li class="dropdown-item">
                    <form id="logout-form" action="{{ route('auth.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-link text-decoration-none">
                            <i class="mdi mdi-location-exit fs-16 align-middle"></i>
                            <span>Đăng Xuất</span>
                        </button>
                    </form>
                </li>
        </div>
        </li>
        </ul>


        <!-- Modal -->
        <div class="modal fade" id="userProfileModal" tabindex="-1" role="dialog"
            aria-labelledby="userProfileModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userProfileModalLabel">Thông tin tài khoản</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Họ tên:</strong> {{ Auth::user()->ho_ten }}</p>
                        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                        <p><strong>Số điện thoại:</strong> {{ Auth::user()->so_dien_thoai }}</p>
                        <p><strong>Địa chỉ:</strong> {{ Auth::user()->dia_chi }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        // Tự động đóng menu khác khi mở một menu mới
        $('.collapse').on('show.bs.collapse', function() {
            $(this).parent().find('.collapse').not(this).collapse('hide');
        });
    });
</script>
<!-- end Topbar -->
