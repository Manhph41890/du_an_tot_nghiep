@extends('admin.layout')

@section('css')
@endsection

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-xxl">
                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0"> {{ $title }} </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('sanphams.update', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card">
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
                                                    value="{{ old('ten_san_pham', $product->ten_san_pham) }}" required>
                                                @error('ten_san_pham')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="gia_goc" class="form-label">Giá gốc</label>
                                                <input type="number" id="gia_goc" name="gia_goc"
                                                    class="form-control @error('gia_goc') is-invalid @enderror"
                                                    value="{{ old('gia_goc', $product->gia_goc) }}" required>
                                                @error('gia_goc')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="danh_muc_id" class="form-label">Danh mục</label>
                                                <select class="form-select" name="danh_muc_id" id="danh_muc_id" required>
                                                    @foreach ($danh_mucs as $id => $ten_danh_muc)
                                                        <option value="{{ $id }}"
                                                            {{ old('danh_muc_id', $product->danh_muc_id) == $id ? 'selected' : '' }}>
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
                                                    value="{{ old('gia_km', $product->gia_km) }}">
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
                                                    @if ($product->anh_san_pham)
                                                        <img id="imagePreview"
                                                            src="{{ asset('storage/' . $product->anh_san_pham) }}"
                                                            alt="Hình ảnh" style="width: 200px; display: block;">
                                                    @else
                                                        <img id="imagePreview" src="#" alt="Hình ảnh"
                                                            style="display: none;">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="ma_ta_san_pham" class="form-label">Mô tả sản phẩm</label>
                                                <!-- Thay input bằng textarea -->
                                                <textarea id="ma_ta_san_pham" name="ma_ta_san_pham" class="form-control @error('ma_ta_san_pham') is-invalid @enderror">
                                                    {{ old('ma_ta_san_pham', $product->ma_ta_san_pham) }}
                                                </textarea>

                                                @error('ma_ta_san_pham')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3 col-12">
                                            <label class="form-label">Trạng thái</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="is_active"
                                                    id="trang_thai_show" value="1"
                                                    {{ old('is_active', $product->is_active) == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label text-success" for="trang_thai_show">Hiển
                                                    thị</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="is_active"
                                                    id="trang_thai_hide" value="0"
                                                    {{ old('is_active', $product->is_active) == 0 ? 'checked' : '' }}>
                                                <label class="form-check-label text-danger" for="trang_thai_hide">Ẩn</label>
                                            </div>
                                            @error('is_active')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form nhập biến thể sản phẩm -->
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">Biến thể sản phẩm</h5>
                                    <button type="button" class="btn btn-success" id="add-variant">Thêm biến
                                        thể</button>
                                </div>
                                <div class="card-body">
                                    <div id="variant-container">
                                        @foreach (old('product_variants', $product->bien_the_san_phams) as $index => $variant)
                                            <div class="row variant-item mb-3">
                                                <div class="col-lg-2">
                                                    <label for="size_san_pham" class="form-label">Size</label>
                                                    <select name="product_variants[size_san_pham][]" class="form-control"
                                                        id="sizeSelect">
                                                        <option value="">Chọn kích thước</option>
                                                        @foreach ($sizes as $size)
                                                            <option value="{{ $size->id }}"
                                                                @if (old("product_variants.size_san_pham.$index") == $size->id ||
                                                                        (isset($variant) && $variant->size_san_pham_id == $size->id)) selected @endif>
                                                                {{ $size->ten_size }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-lg-2">
                                                    <label for="color_san_pham" class="form-label">Màu sắc</label>
                                                    <select name="product_variants[color_san_pham][]" class="form-control"
                                                        id="colorSelect">
                                                        <option value="">Chọn màu sắc</option>
                                                        @foreach ($colors as $color)
                                                            <option value="{{ $color->id }}"
                                                                @if (old("product_variants.color_san_pham.$index") == $color->id ||
                                                                        (isset($variant) && $variant->color_san_pham_id == $color->id)) selected @endif>
                                                                {{ $color->ten_color }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    @error('product_variants.*.color_san_pham')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-lg-2">
                                                    <label for="so_luong" class="form-label">Số lượng</label>
                                                    <input type="number" name="product_variants[so_luong][]"
                                                        class="form-control"
                                                        value="{{ old("product_variants.so_luong.$index", $variant->so_luong) }}"
                                                        required>
                                                </div>
                                                <div class="col-lg-2">
                                                    <label for="gia" class="form-label">Giá biến thể</label>
                                                    <input type="number" name="product_variants[gia][]"
                                                        class="form-control"
                                                        value="{{ old("product_variants.gia.$index", $variant->gia) }}"
                                                        required>
                                                </div>

                                                <div class="col-lg-3">
                                                    <label for="anh_bien_the" class="form-label">Hình ảnh biến thể</label>
                                                    <input type="file" name="product_variants[anh_bien_the][]"
                                                        class="form-control">

                                                    <input type="hidden" name="product_variants[old_anh_bien_the][]"
                                                        value="{{ $variant->anh_bien_the }}">

                                                    <div class="mt-2">
                                                        @if ($variant->anh_bien_the)
                                                            <img id="imagePreview"
                                                                src="{{ asset('storage/' . $variant->anh_bien_the) }}"
                                                                alt="Hình ảnh" style="width: 200px; display: block;">
                                                        @else
                                                            <img id="imagePreview" src="#" alt="Hình ảnh"
                                                                style="display: none;">
                                                        @endif
                                                    </div>
                                                </div>


                                                <div class="col-lg-1 d-flex align-items-end">
                                                    <button type="button"
                                                        class="btn btn-sm btn-danger remove-variant">Xóa</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>

                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
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
                    <div class="col-lg-2">
                                                <label for="size_san_pham" class="form-label">Size</label>
                                                <select name="product_variants[size_san_pham][]" class="form-control"
                                                    id="sizeSelect">
                                                    <option value="">Chọn kích thước</option>
                                                    @foreach ($sizes as $size)
                                                        <option value="{{ $size->id }}">{{ $size->ten_size }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                @error('product_variants.*.size_san_pham')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>
                                            <div class="col-lg-2">
                                                <label for="color_san_pham" class="form-label">Màu sắc</label>
                                                <select name="product_variants[color_san_pham][]" class="form-control"
                                                    id="sizeSelect">
                                                    <option value="">Chọn kích thước</option>
                                                    @foreach ($colors as $color)
                                                        <option value="{{ $color->id }}">{{ $color->ten_color }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                @error('product_variants.*.color_san_pham')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-2">
                                                <label for="so_luong" class="form-label">Số lượng</label>
                                                <input type="number" name="product_variants[so_luong][]"
                                                    class="form-control" value="0" min="0" required>
                                                @error('product_variants.*.so_luong')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-2">
                                                <label for="gia" class="form-label">Giá biến thể</label>
                                                <input type="number" name="product_variants[gia][]" class="form-control"
                                                    value="0">
                                                @error('product_variants.*.gia')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3">
                                                <label for="anh_bien_the" class="form-label">Hình ảnh biến thể</label>
                                                <input type="file" name="product_variants[anh_bien_the][]"
                                                    class="form-control">
                                                @error('product_variants.*.anh_bien_the')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-1 d-flex align-items-end">
                                                <button type="button"
                                                    class="btn btn-sm btn-danger remove-variant">Xóa</button>
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
