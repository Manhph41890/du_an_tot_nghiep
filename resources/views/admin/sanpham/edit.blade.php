@extends('admin.layout')

@section('css')
@endsection

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-xxl">
                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0">Chỉnh sửa sản phẩm</h4>
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
                                                            {{ $id == $product->danh_muc_id ? 'selected' : '' }}>
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
                                                            alt="Hình ảnh" style="width: 200px;">
                                                    @else
                                                        <img id="imagePreview" src="#" alt="Hình ảnh"
                                                            style="display: none; width: 200px;">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="so_luong" class="form-label">Số lượng</label>
                                                <input type="number" id="so_luong" name="so_luong"
                                                    class="form-control @error('so_luong') is-invalid @enderror"
                                                    value="{{ old('so_luong', $product->so_luong) }}" required>
                                                @error('so_luong')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="ma_ta_san_pham" class="form-label">Mô tả sản phẩm</label>
                                                <input type="text" id="ma_ta_san_pham" name="ma_ta_san_pham"
                                                    class="form-control @error('ma_ta_san_pham') is-invalid @enderror"
                                                    value="{{ old('ma_ta_san_pham', $product->ma_ta_san_pham) }}">
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

                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Biến thể sản phẩm</h5>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card-body" style="height: 450px; overflow: scroll">
                                            <div class="live-preview">
                                                <div class="row gy-4">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <tr class="text-center">
                                                                <th>Size</th>
                                                                <th>Màu Sắc</th>
                                                                <th>Số Lượng</th>
                                                                <th>Image</th>
                                                            </tr>

                                                            @foreach ($sizes as $sizeID => $sizeName)
                                                                @foreach ($colors as $colorID => $colorName)
                                                                    @php
                                                                        // Tìm biến thể đã lưu
                                                                        $variant = $product->bien_the_san_phams
                                                                            ->firstWhere('size_san_pham_id', $sizeID)
                                                                            ->firstWhere('color_san_pham_id', $colorID);
                                                                    @endphp
                                                                    <tr class="text-center">
                                                                        <td><b>{{ $sizeName }}</b></td>
                                                                        <td>{{ $colorName }}</td>
                                                                        <td>
                                                                            <input type="number" class="form-control"
                                                                                name="product_variants[{{ $sizeID . '-' . $colorID }}][so_luong]"
                                                                                value="{{ $variant->so_luong ?? 0 }}">
                                                                        </td>
                                                                        <td>
                                                                            <input type="file" class="form-control"
                                                                                name="product_variants[{{ $sizeID . '-' . $colorID }}][anh_bien_the]">
                                                                            @if ($variant && $variant->anh_bien_the)
                                                                                <img src="{{ asset('storage/' . $variant->anh_bien_the) }}"
                                                                                    alt="Hình ảnh biến thể"
                                                                                    style="width: 100px;">
                                                                            @endif
                                                                        </td>
                                                                        <input type="hidden"
                                                                            name="product_variants[{{ $sizeID . '-' . $colorID }}][size]"
                                                                            value="{{ $sizeID }}">
                                                                        <input type="hidden"
                                                                            name="product_variants[{{ $sizeID . '-' . $colorID }}][color]"
                                                                            value="{{ $colorID }}">
                                                                    </tr>
                                                                @endforeach
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('anh_san_pham').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('imagePreview');
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        });
    </script>
@endsection
