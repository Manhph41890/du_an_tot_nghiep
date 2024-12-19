<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header w-100">
            <h3 class="modal-title">Chi tiết đơn hàng</h3>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">

            <div class="row">
                {{-- @php
                    $status = $donhang->shipper->status;
                    dd($status);
                @endphp --}}

                <div class="col-12">
                    <div class="container mt-2">
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="card mb-3">
                                    <div class="card-header d-flex justify-content-between">
                                        {{-- ----------- --}}
                                        <div class="">
                                            <h5>Mã Đơn Hàng: {{ $donhang->ma_don_hang }}</h5>
                                            <p>Ngày tạo: {{ $donhang->ngay_tao }}</p>
                                        </div>
                                        <div class="">
                                            <div class="d-flex justify-content-end">
                                                <p class="me-5 pe-5">Trạng thái đơn hàng:</p>
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
                                                        $statusClasses[$donhang->trang_thai_don_hang] ?? 'bg-secondary';
                                                @endphp
                                                <span class="badge {{ $class }}">
                                                    {{ $donhang->trang_thai_don_hang }}
                                                </span>
                                            </div>
                                            <div class="mt-3 d-flex justify-content-end">
                                                <p class="me-5 pe-5">Trạng thái Thanh toán:</p>
                                                @php
                                                    $statusClasses = [
                                                        'Đã thanh toán' => 'bg-success',
                                                        'Chưa thanh toán' => 'bg-danger',
                                                    ];
                                                    $class =
                                                        $statusClasses[$donhang->trang_thai_thanh_toan] ??
                                                        'bg-secondary';
                                                @endphp

                                                <span class="badge {{ $class }}">
                                                    {{ $donhang->trang_thai_thanh_toan }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <h5 class="order-summary mb-1">Tất Cả Sản Phẩm</h5>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Hình ảnh</th>
                                                        <th>Sản phẩm</th>
                                                        <th>Giá sản phẩm</th>
                                                        <th>Giá phân loại</th>
                                                        <th>Số Lượng</th>
                                                        <th>Thành Tiền</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($donhang->chi_tiet_don_hangs as $chi_tiet)
                                                        @php
                                                            $san_pham = $chi_tiet->san_pham;
                                                            $bien_the = $san_pham->bien_the_san_phams
                                                                ->where(
                                                                    'color_san_pham_id',
                                                                    $chi_tiet->color_san_pham_id,
                                                                )
                                                                ->where('size_san_pham_id', $chi_tiet->size_san_pham_id)
                                                                ->first();
                                                            // dd($bien_the->gia);
                                                        @endphp
                                                        <tr>
                                                            <td>
                                                                <img src="{{ asset('/storage/' . optional($chi_tiet->san_pham)->anh_san_pham) }}"
                                                                    width="50px" alt="Product Image">
                                                            </td>
                                                            <td>
                                                                <a class="ct-sanpham hover-effect"
                                                                    href="{{ route('sanpham.chitiet', $chi_tiet->san_pham?->id) }}">
                                                                    {{ optional($chi_tiet->san_pham)->ten_san_pham ?? 'N/A' }}<br>
                                                                    Màu:
                                                                    {{ optional($chi_tiet->color_san_pham)->ten_color ?? 'N/A' }}<br>
                                                                    Size:
                                                                    {{ optional($chi_tiet->size_san_pham)->ten_size ?? 'N/A' }}
                                                                </a>

                                                            </td>
                                                            <td> {{ number_format($chi_tiet->san_pham->gia_km ?? $chi_tiet->san_pham->gia_goc, 0, ',', '.') }}
                                                                VND </td>
                                                            <td> {{ number_format($bien_the->gia, 0, ',', '.') }}
                                                                VND </td>
                                                            <td>{{ $chi_tiet->so_luong }}</td>
                                                            <td>{{ number_format($chi_tiet->thanh_tien, 0, ',', '.') }}
                                                                VND</td>
                                                            <td>

                                                                @if (
                                                                    $donhang->trang_thai_don_hang == 'Thành công' &&
                                                                        !$chi_tiet->san_pham->danh_gias()->where('user_id', auth()->user()->id)->exists())
                                                                    <div class="col-lg-12">
                                                                        <!-- Nút Viết Đánh Giá -->
                                                                        <a class="btn danhgia"
                                                                            id="openReviewForm{{ $chi_tiet->san_pham->id }}">
                                                                            @if ($donhang->trang_thai_don_hang == 'Thành công')
                                                                                Viết đánh giá
                                                                            @endif
                                                                        </a>

                                                                        <!-- Form Đánh Giá Sản Phẩm -->
                                                                        @if (!$chi_tiet->san_pham->danh_gias()->where('user_id', auth()->user()->id)->exists())
                                                                            <div class="ratting-form-wrapper"
                                                                                id="reviewForm{{ $chi_tiet->san_pham->id }}">
                                                                                <span class="close-btn"
                                                                                    id="closeReviewForm{{ $chi_tiet->san_pham->id }}">&times;</span>
                                                                                <h3>Viết đánh giá</h3>
                                                                                <div class="ratting-form">
                                                                                    <form
                                                                                        action="{{ route('danhgia.store', ['sanPhamid' => $chi_tiet->san_pham->id]) }}"
                                                                                        method="post"
                                                                                        enctype="multipart/form-data">
                                                                                        @csrf
                                                                                        <div class="star-box dg m-0">
                                                                                            <span>Đánh giá </span>
                                                                                            <input type="hidden"
                                                                                                id="san_pham_id"
                                                                                                name="san_pham_id"
                                                                                                value="{{ $chi_tiet->san_pham->id }}">
                                                                                            <select name="diem_so"
                                                                                                id="diem_so{{ $chi_tiet->san_pham->id }}"
                                                                                                style="display: none;">
                                                                                                <option value="1">1
                                                                                                </option>
                                                                                                <option value="2">2
                                                                                                </option>
                                                                                                <option value="3">3
                                                                                                </option>
                                                                                                <option value="4">4
                                                                                                </option>
                                                                                                <option value="5">5
                                                                                                </option>
                                                                                            </select>
                                                                                            <div class="rating-product">
                                                                                                <i class="ion-android-star"
                                                                                                    data-value="1"></i>
                                                                                                <i class="ion-android-star"
                                                                                                    data-value="2"></i>
                                                                                                <i class="ion-android-star"
                                                                                                    data-value="3"></i>
                                                                                                <i class="ion-android-star"
                                                                                                    data-value="4"></i>
                                                                                                <i class="ion-android-star"
                                                                                                    data-value="5"></i>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12">
                                                                                                <div
                                                                                                    class="rating-form-style form-submit">
                                                                                                    <div>
                                                                                                        <input
                                                                                                            type="file"
                                                                                                            name="img"
                                                                                                            class="imgdh"
                                                                                                            title="Thêm ảnh đánh giá">
                                                                                                    </div>
                                                                                                    <textarea id="review{{ $chi_tiet->san_pham->id }}" name="binh_luan" placeholder="Viết đánh giá" maxlength="100"></textarea>
                                                                                                    <p
                                                                                                        id="charCount{{ $chi_tiet->san_pham->id }}">
                                                                                                        0/100</p>
                                                                                                    <input
                                                                                                        type="submit"
                                                                                                        value="Gửi" />
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                @endif


                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mb-3 text-start">
                                            <p><strong>Mã khuyến mãi</strong>:
                                                {{ $donhang->khuyen_mai?->ten_khuyen_mai }}
                                                {{ $donhang->khuyen_mai?->ma_khuyen_mai }}</p>
                                            <p><strong>Phương thức vận chuyển</strong>:
                                                {{ $donhang->phuong_thuc_van_chuyen?->kieu_van_chuyen }}</p>
                                            <p><strong>Phương thức thanh toán</strong>:
                                                {{ $donhang->phuong_thuc_thanh_toan?->kieu_thanh_toan }}</p>
                                        </div>
                                    </div>

                                </div>

                                <div class="card">
                                    <div class="card-body text-start">
                                        <p><strong class="pe-1">Tổng tiền sản phẩm</strong>
                                            {{ number_format($donhang->chi_tiet_don_hangs->sum('thanh_tien'), 0, ',', '.') }}
                                            VND
                                        </p>
                                        <p><strong class="pe-1">Giảm
                                                giá:</strong>
                                            {{ number_format($donhang->khuyen_mai?->gia_tri_khuyen_mai ?? 0, 0, ',', '.') }}VND
                                        </p>
                                        <p><strong class="pe-1">Vận
                                                chuyển:</strong>
                                            {{ number_format($donhang->phuong_thuc_van_chuyen?->gia_ship ?? 0, 0, ',', '.') }}VND
                                        </p>

                                        <p class="order-summary pe-1">Tổng giá trị đơn hàng:
                                            {{ number_format($donhang->tong_tien, 0, ',', '.') }} VND</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                @if ($donhang->trang_thai_don_hang == 'Đã giao')
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5>Xác nhận đơn hàng</h5>
                                            <p>Xác nhận bạn đã nhận hàng đơn hàng</p>
                                            <form action="{{ route('donhangs.success', $donhang->id) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="complete-button btn btn-primary">Xác
                                                    nhận
                                                    đã nhận hàng</button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                                <div class="card mb-3 text-start">
                                    <div class="card-body">
                                        <h5>Thông tin khách hàng</h5>
                                        <br>
                                        <h6>Khách hàng:</h6> {{ $donhang->user?->ho_ten }}
                                        <br>
                                        <p><strong>Tên người nhận:</strong> {{ $donhang->ho_ten }}</p>
                                        <p><strong>Email:</strong> {{ $donhang->email }}</p>
                                        <p><strong>Số điện thoại:</strong> {{ $donhang->so_dien_thoai }}</p>
                                        <p style="text-wrap: auto"><strong>Địa chỉ giao hàng:</strong>
                                            {{ $donhang->dia_chi }}</p>
                                        <p style="text-wrap: auto"><strong>Địa chỉ giao hàng:</strong>
                                            {{ $donhang->dia_chi }}</p>
                                    </div>
                                </div>

                                {{-- ------------------------------------------------------------------------------------------ --}}
                                @if ($donhang->trang_thai_don_hang == 'Chờ xác nhận')

                                    <div class="col-lg-12">
                                        <!-- Kiểm tra trạng thái hủy -->
                                        @if ($donhang->huy_don_hang && $donhang->huy_don_hang->trang_thai == 'Từ chối hủy')
                                            <div class="alert alert-warning mt-3">
                                                Đơn hàng bị từ chối hủy.
                                            </div>
                                        @else
                                            <!-- Nút Hủy Nhận Hàng -->
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <h5>Hủy nhận đơn hàng này</h5> <button type="button"
                                                        id="openReviewFormdh{{ $donhang->id }}"
                                                        class="btn btn-secondary mt-2"
                                                        onclick="toggleReviewForm({{ $donhang->id }})"> Hủy nhận hàng
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Form Hủy Đơn Hàng -->
                                            <div class="ratting-form-wrapper" id="reviewFormdh{{ $donhang->id }}">
                                                <span class="close-btn"
                                                    id="closeReviewFormdh{{ $donhang->id }}">&times;</span>
                                                <h3>Lý do hủy đơn hàng</h3>
                                                <span class="close-btn"
                                                    id="closeReviewFormdh{{ $donhang->id }}">&times;</span>
                                                <div class="ratting-form">
                                                    <form id="huyDonHangForm{{ $donhang->id }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="don_hang_id"
                                                            value="{{ $donhang->id }}">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="rating-form-style form-submit">
                                                                    <select name="ly_do_huy" class="form-select"
                                                                        required>
                                                                        <option value="" disabled selected>Chọn
                                                                            lý do hủy</option>
                                                                        <option
                                                                            value="Tôi muốn cập nhật địa chỉ/sđt nhận hàng">
                                                                            Tôi muốn cập nhật địa chỉ/sđt nhận hàng
                                                                        </option>
                                                                        <option
                                                                            value="Tôi muốn thêm/thay đổi Mã giảm giá">
                                                                            Tôi muốn thêm/thay đổi Mã giảm giá</option>
                                                                        <option
                                                                            value="Tôi muốn thay đổi sản phẩm (kích thước, màu sắc, số lượng…)">
                                                                            Tôi muốn thay đổi sản phẩm (kích thước, màu
                                                                            sắc, số lượng…)</option>
                                                                        <option value="Thủ tục thanh toán rắc rối">Thủ
                                                                            tục thanh toán rắc rối</option>
                                                                        <option
                                                                            value="Tôi tìm thấy chỗ mua khác tốt hơn (Rẻ hơn, uy tín hơn, giao nhanh hơn…)">
                                                                            Tôi tìm thấy chỗ mua khác tốt hơn (Rẻ hơn,
                                                                            uy tín hơn, giao nhanh hơn…)</option>
                                                                        <option value="Tôi không có nhu cầu mua nữa">
                                                                            Tôi không có nhu cầu mua nữa</option>
                                                                        <option
                                                                            value="Tôi không tìm thấy lý do hủy phù hợp">
                                                                            Tôi không tìm thấy lý do hủy phù hợp
                                                                        </option>
                                                                    </select>
                                                                    <button type="button" class="btn btn-dark mt-3"
                                                                        onclick="submitHuyDonHang({{ $donhang->id }})">Gửi</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endif

                                {{-- @php
                                    dd($donhang->trang_thai_thanh_toan);
                                @endphp --}}

                                <!-- Kiểm tra nếu trạng thái đơn hàng là 'Thành công' -->
                                @if ($donhang->trang_thai_thanh_toan == 'Đã thanh toán')
                                    @if ($donhang->lich_su_thanh_toans->isNotEmpty())
                                        <div class="card">
                                            <div class="card-body">
                                                <h5>Lịch sử giao dịch</h5>
                                                @foreach ($donhang->lich_su_thanh_toans as $history)
                                                    <p>Mã giao dịch: {{ $history->ma_giao_dich }}</p>
                                                    <a href="{{ route('taikhoan.lichsugd', $history->id) }}">

                                                        <button class="btn btn-info btn-sm">
                                                            <i class="fas fa-eye"></i> Xem
                                                        </button>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                    @endif
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                <div class="mt-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

</div>
<style>
    .img-dg {
        height: auto !important;
        padding: 10px 10px 10px 20px !important;
    }

    .rating-product i {
        font-size: 30px;
        color: #ccc;
    }

    .dg {
        align-items: center;
    }

    .rating-product i.active {
        color: gold;
    }

    .ratting-form-wrapper {
        z-index: 100;
        display: none;
        position: fixed;
        z-index: 100;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border: 1px solid #ddd;
        padding: 20px;
        background-color: #f9f9f9;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .danhgia {
        background-color: #ff5722;
        color: white;
        padding: 5px 10px;
        font-weight: bold;
        cursor: pointer;
        text-decoration: none;
        border-radius: 5px;
    }


    .danhgia:hover {
        background-color: #ff5722;
        background-color: #ff5722;
        color: white;
    }


    /* CSS cho nút đóng */
    .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
        color: #333;
        cursor: pointer;
        font-weight: bold;
    }

    .complete-button {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 5px;
        cursor: pointer;
    }

    .imgdh {
        height: auto !important;
    }

    .complete-button:hover {
        background-color: #218838;
    }

    .hover-effect {
        background-color: #f5f5f5;
        transition: background-color 0.3s ease;
    }

    .hover-effect:hover {
        background-color: #e0e0e0;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var openReviewBtn = document.getElementById('openReviewFormdh{{ $donhang->id }}');
        var reviewFormdh = document.getElementById('reviewFormdh{{ $donhang->id }}');
        const closeReviewFormdh = document.getElementById("closeReviewFormdh{{ $donhang->id }}");

        openReviewBtn.addEventListener('click', function() {
            // Kiểm tra nếu form đang ẩn thì hiển thị, nếu đang hiển thị thì ẩn đi
            reviewFormdh.style.display = 'block';

        });
        // clcik button clóe đóng form
        closeReviewFormdh.addEventListener("click", function() {
            reviewFormdh.style.display = "none";
        });

        @foreach ($donhang->chi_tiet_don_hangs as $chi_tiet)
            (function() {
                const productId = "{{ $chi_tiet->san_pham->id }}";
                const openReviewForm = document.getElementById("openReviewForm" + productId);
                const reviewForm = document.getElementById("reviewForm" + productId);
                const closeReviewForm = document.getElementById("closeReviewForm" + productId);
                const ratingStars = document.querySelectorAll(`#reviewForm${productId} .rating-product i`);
                const ratingInput = document.getElementById("diem_so" + productId);
                const reviewInput = document.getElementById("review" + productId);
                const charCountDisplay = document.getElementById("charCount" + productId);

                // hiển thị form khi clcik vào viết đán giá 
                openReviewForm.addEventListener("click", function(event) {
                    event.preventDefault();
                    reviewForm.style.display = "block";
                });

                // clcik button clóe đóng form
                closeReviewForm.addEventListener("click", function() {
                    reviewForm.style.display = "none";
                });

                // click ra ngoài đóng form
                window.addEventListener("click", function(event) {
                    if (event.target === reviewForm) {
                        reviewForm.style.display = "none";
                    }
                });

                // click ngôi sao
                ratingStars.forEach(star => {
                    star.addEventListener("click", function() {
                        const rating = this.getAttribute("data-value");
                        ratingInput.value = rating;
                        ratingStars.forEach(s => s.classList.remove("active"));
                        this.classList.add("active");
                        let prevSibling = this.previousElementSibling;
                        while (prevSibling) {
                            prevSibling.classList.add("active");
                            prevSibling = prevSibling.previousElementSibling;
                        }
                    });
                });

                // hiển thị số lượng từ theo số lần nhập
                reviewInput.addEventListener("input", function() {
                    const currentLength = reviewInput.value.length;
                    charCountDisplay.textContent = `${currentLength}/100`;

                    // giới hạn 100 từ
                    if (currentLength > 100) {
                        reviewInput.value = reviewInput.value.substring(0, 100);
                    }
                });
            })();
        @endforeach
    });
</script>
<script>
    function toggleReviewForm(donHangId) {
        const reviewForm = document.getElementById(`reviewForm${donHangId}`);
        reviewForm.style.display = reviewForm.style.display === 'none' ? 'block' : 'none';
    }

    function submitHuyDonHang(donHangId) {
        const form = document.querySelector(`#huyDonHangForm${donHangId}`);
        const formData = new FormData(form);

        fetch("{{ route('huydonhang.store') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                },
                body: formData,
            })
            .then((response) => response.json())
            .then((data) => {
                if (data.error) {
                    toastr.error(data.error); // Hiển thị thông báo lỗi
                } else {
                    toastr.success(data.success); // Hiển thị thông báo thành công
                }
                location.reload(); // Reload lại trang
            })
            .catch((error) => {
                console.error("Error:", error);
                toastr.error("Đã xảy ra lỗi, vui lòng thử lại.");
            });
    }
</script>
