@extends('admin.layout')

@section('css')
@endsection

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-xxl">
                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0">{{ $title }}</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <!-- Hiển thị thông báo thành công -->
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                                <div class="mt-3">
                                    <a href="{{ route('sanphams.create') }}" class="btn btn-primary">Thêm sản phẩm khác</a>
                                    <a href="{{ route('sanphams.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
                                </div>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('sanphams.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Thông tin sản phẩm</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="ten_san_pham" class="form-label">Tên sản phẩm</label>
                                                <input type="text" id="ten_san_pham" name="ten_san_pham"
                                                    class="form-control @error('ten_san_pham') is-invalid @enderror"
                                                    value="{{ old('ten_san_pham') }}">
                                                @error('ten_san_pham')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="gia_goc" class="form-label">Giá gốc</label>
                                                <input type="number" id="gia_goc" name="gia_goc"
                                                    class="form-control @error('gia_goc') is-invalid @enderror"
                                                    value="{{ old('gia_goc') }}">
                                                @error('gia_goc')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="danh_muc_id" class="form-label">Danh mục</label>
                                                <select class="form-select" name="danh_muc_id" id="danh_muc_id">
                                                    <option value="">Chọn danh mục</option>
                                                    @foreach ($danh_mucs as $id => $ten_danh_muc)
                                                        <option value="{{ $id }}"
                                                            {{ old('danh_muc_id') == $id ? 'selected' : '' }}>
                                                            {{ $ten_danh_muc }}</option>
                                                    @endforeach
                                                </select>
                                                @error('danh_muc_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="gia_km" class="form-label">Giá khuyến mãi</label>
                                                <input type="number" id="gia_km" name="gia_km"
                                                    class="form-control @error('gia_km') is-invalid @enderror"
                                                    value="{{ old('gia_km') }}">
                                                @error('gia_km')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="anh_san_pham" class="form-label">Hình ảnh chính</label>
                                                <input type="file" id="anh_san_pham" name="anh_san_pham"
                                                    class="form-control @error('anh_san_pham') is-invalid @enderror">
                                                @error('anh_san_pham')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <div class="mt-2">
                                                    <img id="imagePreview" src="#" alt="Hình ảnh"
                                                        style="display: none; width: 200px;">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="ma_ta_san_pham" class="form-label">Mô tả sản phẩm</label>
                                                <input type="text" id="ma_ta_san_pham" name="ma_ta_san_pham"
                                                    class="form-control @error('ma_ta_san_pham') is-invalid @enderror"
                                                    value="{{ old('ma_ta_san_pham') }}">
                                                @error('ma_ta_san_pham')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3 col-12">
                                            <label class="form-label">Trạng thái</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input @error('is_active') is-invalid @enderror"
                                                    type="radio" name="is_active" id="trang_thai_show" value="1"
                                                    {{ old('is_active') == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label text-success" for="trang_thai_show">Hiển
                                                    thị</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input @error('is_active') is-invalid @enderror"
                                                    type="radio" name="is_active" id="trang_thai_hide" value="0"
                                                    {{ old('is_active') == 0 ? 'checked' : '' }}>
                                                <label class="form-check-label text-danger"
                                                    for="trang_thai_hide">Ẩn</label>
                                            </div>
                                            @error('is_active')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form nhập biến thể sản phẩm -->
                            <div class="card mb-3">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">Biến thể sản phẩm</h5>
                                    <button type="button" class="btn btn-success" id="add-variant">Thêm biến
                                        thể</button>
                                </div>
                                <div class="card-body">
                                    <div id="variant-container">
                                        <div class="row variant-item mb-3">
                                            <div class="col-lg-3">
                                                <label for="size_san_pham" class="form-label">Size</label>
                                                <input type="text" name="product_variants[size_san_pham][]"
                                                    class="form-control" placeholder="Nhập size">
                                            </div>
                                            <div class="col-lg-3">
                                                <label for="color_san_pham" class="form-label">Màu sắc</label>
                                                <input type="text" name="product_variants[color_san_pham][]"
                                                    class="form-control" placeholder="Nhập màu sắc">
                                            </div>
                                            <div class="col-lg-2">
                                                <label for="so_luong" class="form-label">Số lượng</label>
                                                <input type="number" name="product_variants[so_luong][]"
                                                    class="form-control" value="0">
                                            </div>
                                            <div class="col-lg-3">
                                                <label for="anh_bien_the" class="form-label">Hình ảnh biến thể</label>
                                                <input type="file" name="product_variants[anh_bien_the][]"
                                                    class="form-control">
                                            </div>
                                            <div class="col-lg-1 d-flex align-items-end">
                                                <button type="button"
                                                    class="btn btn-sm btn-danger remove-variant">Xóa</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Thêm mới</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Xem trước hình ảnh chính sản phẩm
            document.getElementById('anh_san_pham').addEventListener('change', function(event) {
                const imagePreview = document.getElementById('imagePreview');
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreview.style.display = 'block';
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Thêm biến thể sản phẩm
            document.getElementById('add-variant').addEventListener('click', function() {
                const variantContainer = document.getElementById('variant-container');
                const newVariant = document.createElement('div');
                newVariant.classList.add('row', 'variant-item', 'mb-3');
                newVariant.innerHTML = `
                    <div class="col-lg-3">
                        <label for="size_san_pham" class="form-label">Size</label>
                        <input type="text" name="product_variants[size_san_pham][]" class="form-control" placeholder="Nhập size">
                    </div>
                    <div class="col-lg-3">
                        <label for="color_san_pham" class="form-label">Màu sắc</label>
                        <input type="text" name="product_variants[color_san_pham][]" class="form-control" placeholder="Nhập màu sắc">
                    </div>
                    <div class="col-lg-2">
                        <label for="so_luong" class="form-label">Số lượng</label>
                        <input type="number" name="product_variants[so_luong][]" class="form-control" value="0">
                    </div>
                    <div class="col-lg-3">
                        <label for="anh_bien_the" class="form-label">Hình ảnh biến thể</label>
                        <input type="file" name="product_variants[anh_bien_the][]" class="form-control">
                    </div>
                    <div class="col-lg-1 d-flex align-items-end">
                        <button type="button" class="btn btn-sm btn-danger remove-variant">Xóa</button>
                    </div>
                `;
                variantContainer.appendChild(newVariant);
            });

            // Xóa biến thể sản phẩm
            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-variant')) {
                    event.target.closest('.variant-item').remove();
                }
            });
        });
    </script>
@endsection
