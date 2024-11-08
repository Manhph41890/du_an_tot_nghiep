@extends('client.layout')

@section('content')
    <!-- breadcrumb-section start -->
    <nav class="breadcrumb-section theme1 bg-lighten2 pt-110 pb-110">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title pb-4 text-dark text-capitalize">
                            Beauty & Cosmetics
                        </h2>
                    </div>
                </div>
                <div class="col-12">
                    <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Beauty & Cosmetics
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </nav>

    <!-- breadcrumb-section end -->
    <!-- product-single start -->
    <section class="product-single theme1 pt-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div>
                        <div class="position-relative">
                            <span class="badge badge-danger top-right">Mới</span>
                        </div>
                        <div class="product-sync-init mb-20">
                            <!-- Ảnh sản phẩm chính -->
                            <div class="single-product main-product">
                                <div class="product-thumb">
                                    <img src="{{ asset('/storage/' . $sanPhamCT->anh_san_pham) }}" alt="Ảnh sản phẩm chính">
                                </div>
                            </div>

                            <!-- Ảnh các biến thể sản phẩm -->
                            @foreach ($sanPhamCT->bien_the_san_phams as $bienThe)
                                <div class="single-product variant-product">
                                    <div class="product-thumb">
                                        <img src="{{ asset('/storage/' . $bienThe->anh_bien_the) }}"
                                            alt="Ảnh biến thể sản phẩm">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Thanh điều hướng ảnh (thumbnail) -->
                    <div class="product-sync-nav single-product">
                        <!-- Ảnh sản phẩm chính -->
                        <div class="single-product thumbnail">
                            <div class="product-thumb">
                                <a href="javascript:void(0)"
                                    onclick="showMainImage('{{ asset('/storage/' . $sanPhamCT->anh_san_pham) }}')">
                                    <img src="{{ asset('/storage/' . $sanPhamCT->anh_san_pham) }}"
                                        alt="Thumbnail sản phẩm chính">
                                </a>
                            </div>
                        </div>

                        <!-- Thumbnail ảnh biến thể sản phẩm -->
                        @foreach ($sanPhamCT->bien_the_san_phams as $bienThe)
                            <div class="single-product thumbnail">
                                <div class="product-thumb">
                                    <a href="javascript:void(0)"
                                        onclick="showMainImage('{{ asset('/storage/' . $bienThe->anh_bien_the) }}')">
                                        <img src="{{ asset('/storage/' . $bienThe->anh_bien_the) }}"
                                            alt="Thumbnail biến thể sản phẩm">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
                <div class="col-lg-6">
                    <div class="single-product-info">
                        <div class="single-product-head">
                            <h2 class="title mb-20">{{ $sanPhamCT->ten_san_pham }}</h2>
                            <div class="star-content mb-20">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $sanPhamCT->diem_trung_binh)
                                        <i class="mdi mdi-star text-warning" style="font-size: 2.3em;"></i>
                                    @else
                                        <i class="mdi mdi-star-outline text-muted" style="font-size: 2.3em;"></i>
                                    @endif
                                @endfor
                                <a href="#" id="write-comment"><span class="ms-2"><i
                                            class="far fa-comment-dots"></i></span>
                                    Xem đánh giá <span>( {{ $sanPhamCT->danh_gias->count() }} )</span>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><span
                                            class="edite"><i class="far fa-edit"></i></span>Viết đánh giá</a>
                            </div>
                        </div>
                        <div class="product-body mb-40">
                            <div class="d-flex align-items-center mb-30">
                                <div class="product-price me-2">
                                    <del class="del">{{ $sanPhamCT->gia_goc }}</del>
                                    <span id="new-price" class="onsale">{{ $sanPhamCT->gia_km }}</span>
                                    <!-- Giá cập nhật sẽ được hiển thị ở đây -->
                                </div>
                                <span class="badge position-static bg-dark rounded-0">Giảm
                                    {{ $sanPhamCT->phan_tram_giam_gia }}%</span>
                            </div>
                            <p class="product-summary">
                                {{ $sanPhamCT->mo_ta_ngan }}
                            </p>
                            <div class="short-description">
                                <ul class="product-specs">
                                    <!-- Thêm thông tin chi tiết sản phẩm nếu cần -->
                                </ul>
                            </div>
                        </div>

                        <!-- Hiển thị ảnh sản phẩm -->
                        <div class="product-image mb-30">
                            <img src="{{ asset($sanPhamCT->anh_bien_the) }}" alt="{{ $sanPhamCT->ten_san_pham }}"
                                class="img-fluid" />
                        </div>

                        <form id="add-to-cart-form{{ $sanPhamCT->id }}" action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="san_pham_id" value="{{ $sanPhamCT->id }}">
                            <div class="product-footer">
                                <div class="d-flex">
                                    <div class="product-size me-5">
                                        <h3 class="title">Size</h3>
                                        <select name="size_san_pham_id" id="size_san_pham_id{{ $sanPhamCT->id }}">
                                            <option value="">--Chọn size--</option>
                                            @foreach ($sizes as $size)
                                                <option value="{{ $size->id }}">{{ $size->ten_size }}</option>
                                            @endforeach
                                        </select>
                                        <span id="size-error" class="text-danger" style="display: none;">Vui lòng chọn
                                            size!</span>
                                    </div>

                                    <div class="check-box ms-5">
                                        <h4 class="title">Màu Sắc</h4>
                                        <div class="d-flex check-box-wrap-list" id="color-options">
                                            <!-- Màu sắc sẽ được load sau khi chọn size -->
                                        </div>
                                        <span id="color-error" class="text-danger" style="display: none;">Vui lòng chọn
                                            màu!</span>
                                    </div>
                                </div>

                                <div class="product-count style d-flex flex-column flex-sm-row mt-30 mb-20">
                                    <div class="count d-flex">
                                        <input type="number" name="quantity" min="1"
                                            max="{{ $sanPhamCT->so_luong }}" value="1" required
                                            id="quantity-input" />
                                        <div class="button-group">
                                            <button type="button" class="count-btn increment"
                                                onclick="incrementQuantity()">
                                                <i class="fas fa-chevron-up"></i>
                                            </button>
                                            <button type="button" class="count-btn decrement"
                                                onclick="decrementQuantity()">
                                                <i class="fas fa-chevron-down"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div>
                                        @auth
                                            <button type="submit" class="btn btn-dark btn--xl mt-5 mt-sm-0">
                                                <span class="me-2"><i class="ion-android-add"></i></span> Thêm vào giỏ hàng
                                            </button>
                                        @endauth
                                        @guest
                                            <button type="button" class="btn btn-dark btn--xl mt-5 mt-sm-0"
                                                onclick="promptLogin()">
                                                <span class="me-2"><i class="ion-android-add"></i></span> Thêm vào giỏ hàng
                                            </button>
                                        @endguest
                                    </div>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- product-single end -->
    <!-- product tab start -->

    <div class="product-tab theme1 bg-white pt-60 pb-80">
        <div class="container">
            <div class="product-tab-nav">
                <div class="row align-items-center">
                    <div class="col-12">
                        <nav class="product-tab-menu single-product">
                            <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-home-tab" data-bs-toggle="pill" href="#pills-home"
                                        role="tab" aria-controls="pills-home" aria-selected="true">Mô tả</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                        href="#pills-profile" role="tab" aria-controls="pills-profile"
                                        aria-selected="false">Chi tiết Sản phẩm</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-contact-tab" data-bs-toggle="pill"
                                        href="#pills-contact" role="tab" aria-controls="pills-contact"
                                        aria-selected="false">Đánh giá</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- product-tab-nav end -->
            <div class="row">
                <div class="col-12">
                    <div class="tab-content" id="pills-tabContent">
                        <!-- first tab-pane -->
                        <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="single-product-desc">
                                <p>
                                    {{ $sanPhamCT->ma_ta_san_pham }}
                                </p>
                            </div>
                        </div>
                        <!-- second tab-pane -->
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                            aria-labelledby="pills-profile-tab">
                            <div class="single-product-desc">
                                <div class="product-anotherinfo-wrapper">
                                    <ul>
                                        {{ $sanPhamCT->mo_ta_ngan }}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- third tab-pane -->
                        <div class="tab-pane fade show active" id="pills-contact" role="tabpanel"
                            aria-labelledby="pills-contact-tab">
                            <div class="single-product-desc">
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="review-wrapper">
                                            @foreach ($sanPhamCT->danh_gias as $danhgia)
                                                <div class="single-review">
                                                    <div class="review-img">
                                                        <img src="/assets/img/testimonial-image/1.png" alt="" />
                                                    </div>
                                                    <div class="review-content">
                                                        <div class="review-top-wrap">
                                                            <div class="review-left">
                                                                <div class="review-name">
                                                                    <h4>{{ $danhgia->users->ho_ten }}</h4>
                                                                </div>
                                                                <div class="rating-product">
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        <i
                                                                            class="{{ $i <= $danhgia->diem_so ? 'ion-android-star' : 'ion-android-star-outline' }}"></i>
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="review-bottom">
                                                            <p>
                                                            <p>{{ $danhgia->binh_luan }}</p>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="ratting-form-wrapper">
                                            <h3>Thêm đánh giá</h3>
                                            <div class="ratting-form">
                                                <form action="#">
                                                    <div class="star-box">
                                                        <span>Đánh giá của bạn:</span>
                                                        <div class="rating-product">
                                                            <i class="ion-android-star" data-value="1"></i>
                                                            <i class="ion-android-star" data-value="2"></i>
                                                            <i class="ion-android-star" data-value="3"></i>
                                                            <i class="ion-android-star" data-value="4"></i>
                                                            <i class="ion-android-star" data-value="5"></i>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="rating-form-style form-submit">
                                                                <textarea id="review" name="Your Review" placeholder="Viết đánh giá" maxlength="100"></textarea>
                                                                <p id="charCount">0/100</p>
                                                                <input type="submit" value="Gửi" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
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
    </div>
    <!-- product tab end -->
    <!-- new arrival section start -->
    <section class="theme1 bg-white pb-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title pb-3 mb-3">Bạn cũng có thể thích</h2>
                        <p class="text mt-10">Add Related products to weekly line up</p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="product-slider-init theme1 slick-nav">
                        @foreach ($sanLienQuan as $sanphamlq)
                            <div class="slider-item">
                                <div class="card product-card">
                                    <div class="card-body p-0">
                                        <div class="media flex-column">
                                            <div class="product-thumbnail position-relative">
                                                <span class="badge badge-danger top-right">New</span>
                                                <a href="{{ route('sanpham.chitiet', $sanphamlq->id) }}">
                                                    <img class="first-img"
                                                        src="{{ asset('storage/' . $sanphamlq->anh_san_pham) }}"
                                                        alt="thumbnail" />
                                                </a>
                                                <!-- product links -->
                                                <ul class="actions d-flex justify-content-center">
                                                    <li>
                                                        <a class="action" href="wishlist.html">
                                                            <span data-bs-toggle="tooltip" data-placement="bottom"
                                                                title="add to wishlist" class="icon-heart">
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="action" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#compare">
                                                            <span data-bs-toggle="tooltip" data-placement="bottom"
                                                                title="Add to compare" class="icon-shuffle"></span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="action" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#quick-view">
                                                            <span data-bs-toggle="tooltip" data-placement="bottom"
                                                                title="Quick view" class="icon-magnifier"></span>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <!-- product links end-->
                                            </div>
                                            <div class="media-body">
                                                <div class="product-desc">
                                                    <h3 class="title">
                                                        <a
                                                            href="shop-grid-4-column.html">{{ $sanphamlq->ten_san_pham }}</a>
                                                    </h3>
                                                    <div class="star-rating">
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star de-selected"></span>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <span class="product-price">{{ $sanphamlq->gia_goc }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- slider-item end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        // Hàm lọc màu sắc khi chọn size
        document.getElementById('size_san_pham_id{{ $sanPhamCT->id }}').addEventListener('change', function() {
            var sizeId = this.value;
            var colorOptions = @json($colorsBySize);

            var colorContainer = document.getElementById('color-options');
            colorContainer.innerHTML = ''; // Clear previous colors

            if (sizeId && colorOptions[sizeId]) {
                colorOptions[sizeId].forEach(function(color) {
                    var colorInput = document.createElement('input');
                    colorInput.type = 'radio';
                    colorInput.name = 'color';
                    colorInput.id = 'color-' + color.id;
                    colorInput.value = color.id;
                    colorInput.required = true;

                    var colorLabel = document.createElement('label');
                    colorLabel.setAttribute('for', 'color-' + color.id);
                    colorLabel.style.backgroundColor = color.ma_mau;
                    colorLabel.classList.add('me-2');
                    colorLabel.textContent = color.ten_color;

                    var colorDiv = document.createElement('div');
                    colorDiv.classList.add('widget-check-box');
                    colorDiv.appendChild(colorInput);
                    colorDiv.appendChild(colorLabel);

                    colorContainer.appendChild(colorDiv);
                });
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('form[id^="add-to-cart-form"]').forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault(); // Ngăn chặn hành động mặc định của form

                    const formData = new FormData(form); // Lấy dữ liệu của form
                    const url = form.getAttribute('action');
                    fetch(url, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json' // Cấu hình để server hiểu đây là yêu cầu JSON
                            },
                            body: formData
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(
                                    'Network response was not ok'); // Kiểm tra phản hồi HTTP
                            }
                            return response.json(); // Xử lý phản hồi JSON
                        })
                        .then(data => {
                            if (data.success) {
                                toastr.success(data.message); // Hiển thị thông báo thành công
                            } else {
                                toastr.error(data.message ||
                                    'Có lỗi xảy ra.'); // Hiển thị thông báo lỗi nếu có
                            }
                        })
                        .catch(error => {
                            toastr.error(
                                'Đã xảy ra lỗi khi thêm vào giỏ hàng. Vui lòng kiểm tra lại.'
                            ); // Thông báo lỗi chung

                            console.error('Error:', error); // Để debug lỗi trên console
                        });
                });
            });
        });

        // Hàm tăng số lượng
        function incrementQuantity() {
            const quantityInput = document.querySelector('input[name="quantity"]');
            let quantity = parseInt(quantityInput.value);
            if (quantity < 10) {
                quantityInput.value = quantity + 1;
            }
        } // Hàm giảm số lượng function decrementQuantity() { const
        quantityInput = document.querySelector('input[name="quantity" ]');
        let quantity = parseInt(quantityInput.value);
        if (quantity > 1) {
            quantityInput.value = quantity - 1;
        }


        function showMainImage(imageUrl) {
            // Tìm phần tử của ảnh chính
            const mainImage = document.querySelector('.main-product .product-thumb img');
            if (mainImage) {
                mainImage.src = imageUrl;
            }
        }
        const reviewInput = document.getElementById("review");
        const charCountDisplay = document.getElementById("charCount");

        reviewInput.addEventListener("input", function() {
            const currentLength = reviewInput.value.length;

            // Cập nhật bộ đếm ký tự
            charCountDisplay.textContent = `${currentLength}/100`;

            // Nếu vượt quá 100 ký tự, cắt ngắn lại (phòng ngừa trường hợp maxlength không hoạt động trên một số trình duyệt)
            if (currentLength > 100) {
                reviewInput.value = reviewInput.value.substring(0, 100);
            }
        });
        $(document).ready(function() {
            $('.rating-product i').on('click', function() {
                console.log("Star clicked!"); // Check if this message appears in the console
                var rating = $(this).data('value');

                // Remove active class from all stars
                $('.rating-product i').removeClass('active');

                // Add active class to selected stars and those before it
                $(this).addClass('active');
                $(this).prevAll().addClass('active');

                // Display the rating in the console or handle it as needed
                console.log("Selected rating:", rating);
            });
        });

        function promptLogin() {
            // toastr.options = {
            //     "closeButton": true,
            //     "progressBar": true,
            //     "positionClass": "toast-top-right",
            //     "timeOut": "3000",
            // };
            toastr.warning("Bạn cần đăng nhập hoặc đăng ký để thêm sản phẩm vào giỏ hàng.");

            // setTimeout(function() {
            //     window.location.href = "{{ route('auth.login') }}";
            // }, 1000);
        }
    </script>
    <style>
        .rating-product i {
            font-size: 24px;
            color: #ccc;
            /* Default color for unselected stars */
            cursor: pointer;
            /* Pointer cursor for clickable stars */
        }

        .rating-product i.active {
            color: #ffcc00;
            /* Highlight color for selected stars */
        }
    </style>


    <!-- new arrival section end -->
@endsection
