@extends('admin.layout')

@section('css')
@endsection

@section('content')
    <div class="content-page">

        <div class="content">

            <!-- Start Content-->
            <div class="container-xxl">
                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0"> {{ $title }} </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        @if ($errors->any())
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header align-items-center d-flex">
                                            <div class="alert alert-danger" style="width: 100%;">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <form action="{{ route('sanphams.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Sản phẩm</h5>
                                </div><!-- end card header -->

                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="ten_san_pham" class="form-label">Tên sản phẩm</label>
                                                <input type="text" id="ten_san_pham" name="ten_san_pham"
                                                    class="form-control @error('ten_san_pham') is-invalid @enderror"
                                                    value="{{ old('ten_san_pham') }}">
                                                @error('ten_san_pham')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="gia_goc" class="form-label">Giá gốc</label>
                                                <input type="number" id="gia_goc" name="gia_goc"
                                                    class="form-control @error('gia_goc') is-invalid @enderror"
                                                    value="{{ old('gia_goc') }}">
                                                @error('gia_goc')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="danh_muc_id" class="form-label">Danh mục</label>
                                                <select type="text" class="form-select" name="danh_muc_id"
                                                    id="danh_muc_id">
                                                    @foreach ($danh_mucs as $id => $ten_danh_muc)
                                                        <option value="{{ $id }}">{{ $ten_danh_muc }}</option>
                                                    @endforeach
                                                </select>
                                                @error('danh_muc_id')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="gia_km" class="form-label">Giá khuyến mãi</label>
                                                <input type="number" id="gia_km" name="gia_km"
                                                    class="form-control @error('gia_km') is-invalid @enderror"
                                                    value="{{ old('gia_km') }}">
                                                @error('gia_km')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="anh_san_pham" class="form-label">Hình ảnh </label>
                                                <input type="file" id="anh_san_pham" name="anh_san_pham"
                                                    class="form-control @error('anh_san_pham') is-invalid @enderror">
                                                @error('anh_san_pham')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <div class="mt-2">
                                                    <img id="imagePreview" src="#" alt="Hình ảnh"
                                                        style="display: none;width:200px;">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="so_luong" class="form-label">Số lượng</label>
                                                <input type="number" id="so_luong" name="so_luong"
                                                    class="form-control @error('so_luong') is-invalid @enderror"
                                                    value="{{ old('so_luong') }}">
                                                @error('so_luong')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="ma_ta_san_pham" for="comment">Mô tả sản phẩm</label>
                                                <textarea class="form-control" name="ma_ta_san_pham" id="" cols="30" rows="7" class="@error('ma_ta_san_pham') is-invalid @enderror"
                                                value="{{ old('ma_ta_san_pham') }}"></textarea>
                                                @error('ma_ta_san_pham')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="trang_thai" class="form-label">Trạng thái</label>
                                            <div class="col-sm-10 mb-3 d-flex gap-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_active"
                                                        id="trang_thai_show" value="1"
                                                        {{ old('is_active') == 0 ? 'checked' : '' }}>
                                                    <label class="form-check-label text-success"
                                                        for="trang_thai_show">Hiển thị</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_active"
                                                        id="trang_thai_hide" value="0"
                                                        {{ old('is_active') == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label text-danger"
                                                        for="trang_thai_hide">Ẩn</label>
                                                </div>
                                                @error('is_active')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Biến Thể</h5>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="color_san_pham" class="form-label">Màu sắc</label>
                                                <input type="text" id="color_san_pham"
                                                    name="product_variants[1-2][color]"
                                                    class="form-control @error('product_variants.1-2.color') is-invalid @enderror"
                                                    value="{{ old('product_variants.1-2.color') }}">
                                                @error('product_variants.1-2.color')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="size_san_pham" class="form-label">Size sản phẩm</label>
                                                <input type="text" id="size_san_pham"
                                                    name="product_variants[1-2][size]"
                                                    class="form-control @error('product_variants.1-2.size') is-invalid @enderror"
                                                    value="{{ old('product_variants.1-2.size') }}">
                                                @error('product_variants.1-2.size')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="anh_bien_the" class="form-label">Hình ảnh biến thể</label>
                                                <input type="file" id="anh_bien_the"
                                                    name="product_variants[1-2][anh_bien_the]"
                                                    class="form-control @error('product_variants.1-2.anh_bien_the') is-invalid @enderror">
                                                @error('product_variants.1-2.anh_bien_the')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <div class="mt-2">
                                                    <img id="imagePreview" src="#" alt="Hình ảnh biến thể"
                                                        style="display: none;width:200px;">
                                                </div>
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
    </div> <!-- container-fluid -->
@endsection

@section('js')
    <script>
        document.getElementById('anh_san_pham').addEventListener('change', function() {
            const file = this.files[0];
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            if (file && !validTypes.includes(file.type)) {
                alert('Chỉ cho phép tải lên các loại file: jpeg, png, jpg, gif');
                this.value = ''; // Clear the file input
            }
        });
    </script>
@endsection
