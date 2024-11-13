<div class="modal-dialog modal-xl">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header w-100">
            <h3 class="modal-title">Chi tiết đơn hàng</h3>

        </div>

        <!-- Modal Body -->
        <div class="modal-body">
            <div class="row">
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
                                            <div class="">
                                                <p class="mb-0 me-2">Trạng thái đơn hàng:</p>
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
                                            <div class="mt-3">
                                                <p class="mb-0 me-2">Trạng thái Thanh toán:</p>
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
                                                        <th>Số Lượng</th>
                                                        <th>Giá</th>
                                                        <th>Thành Tiền</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($donhang->chi_tiet_don_hangs as $chi_tiet)
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
                                                            <td>{{ $chi_tiet->so_luong }}</td>
                                                            <td>{{ number_format($chi_tiet->gia_tien, 0, ',', '.') }}
                                                                VND</td>
                                                            <td>{{ number_format($chi_tiet->thanh_tien, 0, ',', '.') }}
                                                                VND</td>
                                                            <td>
                                                                @if ($donhang->trang_thai_don_hang == 'Thành công' && !$chi_tiet->san_pham->danh_gias()->where('user_id', auth()->user()->id)->exists())
                                                                    <div class="col-lg-12">
                                                                        <!-- Nút Viết Đánh Giá -->
                                                                        <a class="btn danhgia"
                                                                            id="openReviewForm{{ $chi_tiet->san_pham->id }}">
                                                                            @if ($donhang->trang_thai_don_hang == 'Thành công')
                                                                                Viết đánh giá
                                                                            @endif
                                                                        </a>

                                                                        <!-- Form Đánh Giá -->
                                                                        <div class="ratting-form-wrapper"
                                                                            id="reviewForm{{ $chi_tiet->san_pham->id }}">
                                                                            <span class="close-btn"
                                                                                id="closeReviewForm{{ $chi_tiet->san_pham->id }}">&times;</span>
                                                                            <h3>Thêm đánh giá</h3>
                                                                            <div class="ratting-form">
                                                                                <form
                                                                                    action="{{ route('danhgia.store', ['sanPhamid' => $chi_tiet->san_pham->id]) }}"
                                                                                    method="post">
                                                                                    @csrf
                                                                                    <div class="star-box">
                                                                                        <span>Đánh giá của bạn:</span>
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
                                                                                                <textarea id="review{{ $chi_tiet->san_pham->id }}" name="binh_luan" placeholder="Viết đánh giá" maxlength="100"></textarea>
                                                                                                <p
                                                                                                    id="charCount{{ $chi_tiet->san_pham->id }}">
                                                                                                    0/100
                                                                                                </p>
                                                                                                <input type="submit"
                                                                                                    value="Gửi" />
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mb-3">
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
                                    <div class="card-body">
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
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h5>Thông tin khách hàng</h5>
                                        <br>
                                        <h6>Khách hàng:</h6> {{ $donhang->user?->ho_ten }}
                                        <br>
                                        <p><strong>Tên người nhận:</strong> {{ $donhang->ho_ten }}</p>
                                        <p><strong>Email:</strong> {{ $donhang->email }}</p>
                                        <p><strong>Số điện thoại:</strong> {{ $donhang->so_dien_thoai }}</p>
                                        <p><strong>Địa chỉ giao hàng:</strong> {{ $donhang->dia_chi }}</p>
                                    </div>
                                </div>
                                @if ($donhang->trang_thai_thanh_toan == 'Chưa thanh toán' || $donhang->trang_thai_don_hang == 'Chờ xác nhận')
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5>Hủy nhận đơn hàng này</h5>
                                            <form action="{{ route('taikhoan.cancel', $donhang->id) }}" method="POST"
                                                onsubmit="return confirmCancel()">
                                                @csrf
                                                <button type="submit" class="btn btn-secondary mt-2">Hủy
                                                    nhận hàng</button>
                                            </form>

                                            <script>
                                                function confirmCancel() {
                                                    return confirm("Bạn có chắc chắn muốn hủy nhận đơn hàng này không?");
                                                }
                                            </script>

                                        </div>
                                    </div>
                                @endif

                                <!-- Kiểm tra nếu trạng thái đơn hàng là 'Thành công' -->
                                @if ($donhang->phuong_thuc_thanh_toan->kieu_thanh_toan == 'Thanh toán online')
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
                                        <p>Không có lịch sử giao dịch cho đơn hàng này.</p>
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
</div>
<style>
    .rating-product i {
        font-size: 30px;
        color: #ccc;
    }

    .rating-product i.active {
        color: gold;
    }

    .ratting-form-wrapper {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border: 1px solid #ddd;
        padding: 20px;
        background-color: #f9f9f9;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        z-index: 1000;
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

    .order-status {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        border-radius: 5px;
        padding: 5px 10px;
    }

    .order-summary {
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

                        // console.log("Selected rating for product", productId, ":", rating);
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
