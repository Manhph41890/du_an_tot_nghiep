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
                        <!-- Display Success Message -->

                        {{-- Lỗi biến thể --}}
                        @if ($errors->has('product_variants'))
                            <ul>
                                @foreach ($errors->get('product_variants.*') as $variantIndex => $errorMessages)
                                    @foreach ($errorMessages as $error)
                                        <li>{{ str_replace(':index', $variantIndex + 1, $error) }}</li>
                                    @endforeach
                                @endforeach
                            </ul>
                        @endif
                        {{-- @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif --}}

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
                                                <label for="gia_nhap" class="form-label">Giá Nhập</label>
                                                <input type="number" id="gia_nhap" name="gia_nhap"
                                                    class="form-control @error('gia_nhap') is-invalid @enderror"
                                                    value="{{ old('gia_nhap') }}">
                                                @error('gia_nhap')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="gia_goc" class="form-label">Giá Bán</label>
                                                <input type="number" id="gia_goc" name="gia_goc"
                                                    class="form-control @error('gia_goc') is-invalid @enderror"
                                                    value="{{ old('gia_goc') }}">
                                                @error('gia_goc')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="gia_km" class="form-label">Giá khuyến mãi</label>
                                                <input type="number" id="gia_km" name="gia_km" min="0"
                                                    class="form-control @error('gia_km') is-invalid @enderror"
                                                    value="{{ old('gia_km') }}">
                                                @error('gia_km')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="danh_muc_id" class="form-label">Danh mục</label>
                                                <select class="form-select @error('danh_muc_id') is-invalid @enderror"
                                                    name="danh_muc_id" id="danh_muc_id">
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
                                                <label for="anh_san_pham" class="form-label">Hình ảnh chính</label>
                                                <input type="file" id="anh_san_pham" name="anh_san_pham"
                                                    class="form-control @error('anh_san_pham') is-invalid @enderror">
                                                @error('anh_san_pham')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <div class="mt-2">
                                                    <img id="imagePreview"
                                                        src="{{ old('anh_san_pham') ? asset('storage/' . old('anh_san_pham')) : (isset($sanPham->anh_san_pham) ? asset('storage/' . $sanPham->anh_san_pham) : '') }}"
                                                        alt="Hình ảnh"
                                                        style="display: '{{ old('anh_san_pham') || isset($sanPham->anh_san_pham) ? 'block' : 'none' }}'; width: 200px;">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="ma_ta_san_pham" class="form-label">Mô tả sản phẩm</label>
                                                <!-- <input type="text" id="ma_ta_san_pham" name="ma_ta_san_pham"
                                                                    class="form-control @error('ma_ta_san_pham') is-invalid @enderror"
                                                                    value="{{ old('ma_ta_san_pham') }}"> -->

                                                <textarea rows="5" id="ma_ta_san_pham" name="ma_ta_san_pham"
                                                    class="form-control @error('ma_ta_san_pham') is-invalid @enderror" value="{{ old('ma_ta_san_pham') }}">
                                                </textarea>
                                                @error('ma_ta_san_pham')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3 col-12">
                                            <label class="form-label">Trạng thái</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input @error('is_active') is-invalid @enderror"
                                                    type="radio" name="is_active" id="trang_thai_hide" value="0"
                                                    {{ old('is_active', 0) == 0 ? 'checked' : '' }}>
                                                <label class="form-check-label text-danger"
                                                    for="trang_thai_hide">Ẩn</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input @error('is_active') is-invalid @enderror"
                                                    type="radio" name="is_active" id="trang_thai_show" value="1"
                                                    {{ old('is_active', 1) == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label text-success" for="trang_thai_show">Hiển
                                                    thị</label>
                                            </div>

                                            @error('is_active')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <!-- Product Variants Form -->
                            <div class="card mb-3">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">Biến thể sản phẩm</h5>
                                    <button type="button" class="btn btn-success" id="add-variant">Thêm biến
                                        thể</button>
                                </div>

                                <!-- Hiển thị lỗi chung cho product_variants -->
                                @if ($errors->has('product_variants'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('product_variants') }}
                                    </div>
                                @endif

                                <div class="card-body">
                                    <div id="variant-container">
                                        <!-- Lặp qua các biến thể đã chọn trong dữ liệu cũ (old data) nếu có -->
                                        @foreach (old('product_variants.size_san_pham', []) as $index => $size)
                                            <div class="row variant-item mb-3">
                                                <div class="col-lg-2">
                                                    <label for="size_san_pham_{{ $index }}"
                                                        class="form-label">Size</label>
                                                    <select
                                                        name="product_variants[size_san_pham][]"class="form-control @error('product_variants.*.size_san_pham') is-invalid @enderror"
                                                        id="sizeSelect_{{ $index }}">
                                                        <option value="">Chọn kích thước</option>
                                                        @foreach ($sizes as $sizeOption)
                                                            <option value="{{ $sizeOption->id }}"
                                                                {{ old('product_variants.size_san_pham.' . $index) == $sizeOption->id ? 'selected' : '' }}>
                                                                {{ $sizeOption->ten_size }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('product_variants.*.size_san_pham'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('product_variants.*.size_san_pham') }}
                                                        </div>
                                                    @endif

                                                </div>

                                                <div class="col-lg-2">
                                                    <label for="color_san_pham_{{ $index }}"
                                                        class="form-label">Màu sắc</label>
                                                    <select name="product_variants[color_san_pham][]" class="form-control"
                                                        id="colorSelect_{{ $index }}">
                                                        <option value="">Chọn màu sắc</option>
                                                        @foreach ($colors as $color)
                                                            <option value="{{ $color->id }}"
                                                                {{ old('product_variants.color_san_pham.' . $index) == $color->id ? 'selected' : '' }}>
                                                                {{ $color->ten_color }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('product_variants.*.color_san_pham.' . $index)
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-lg-2">
                                                    <label for="so_luong_{{ $index }}" class="form-label">Số
                                                        lượng</label>
                                                    <input type="number" name="product_variants[so_luong][]"
                                                        class="form-control"
                                                        value="{{ old('product_variants.so_luong.' . $index, 0) }}"
                                                        min="0" required>
                                                    @error('product_variants.*.so_luong.' . $index)
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-lg-2">
                                                    <label for="gia_{{ $index }}" class="form-label">Giá biến
                                                        thể</label>
                                                    <input type="number" name="product_variants[gia][]"
                                                        class="form-control"
                                                        value="{{ old('product_variants.gia.' . $index, 0) }}">
                                                    @error('product_variants.*.gia.' . $index)
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-lg-3">
                                                    <label for="anh_bien_the_{{ $index }}" class="form-label">Hình
                                                        ảnh biến thể</label>
                                                    <input type="file" name="product_variants[anh_bien_the][]"
                                                        class="form-control">
                                                    @error('product_variants.*.anh_bien_the.' . $index)
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
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


                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('script')
    <script>
        document.getElementById('add-variant').addEventListener('click', function() {
            var container = document.getElementById('variant-container');
            var newVariant = container.children[0].cloneNode(true);
            container.appendChild(newVariant);
        });

        document.getElementById('variant-container').addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-variant')) {
                var item = event.target.closest('.variant-item');
                if (item) {
                    item.remove();
                }
            }
        });
    </script>
@endsection
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
                    <select name="product_variants[size_san_pham][]" class="form-control colorInput" id="sizeSelect">
                        <option value="">Chọn kích thước</option>
                        @foreach ($sizes as $size)
                            <option value="{{ $size->id }}">{{ $size->ten_size }}</option>
                        @endforeach
                    </select>
                    @error('product_variants.*.size_san_pham')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-2">
                    <label for="color_san_pham" class="form-label">Màu sắc</label>
                    <select name="product_variants[color_san_pham][]" class="form-control sizeInput" id="colorSelect">
                        <option value="">Chọn màu sắc</option>
                        @foreach ($colors as $color)
                            <option value="{{ $color->id }}">{{ $color->ten_color }}</option>
                        @endforeach
                    </select>
                    @error('product_variants.*.color_san_pham')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-2">
                    <label for="so_luong" class="form-label">Số lượng</label>
                    <input type="number" name="product_variants[so_luong][]" class="form-control" value="0" min="0" required>
                    @error('product_variants.*.so_luong')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-2">
                    <label for="gia" class="form-label">Giá biến thể</label>
                    <input type="number" name="product_variants[gia][]" class="form-control" value="0">
                    @error('product_variants.*.gia')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-3">
                    <label for="anh_bien_the" class="form-label">Hình ảnh biến thể</label>
                    <input type="file" name="product_variants[anh_bien_the][]" class="form-control">
                    @error('product_variants.*.anh_bien_the')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-1 d-flex align-items-end">
                    <button type="button" class="btn btn-sm btn-danger remove-variant">Xóa</button>
                </div>`;
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
