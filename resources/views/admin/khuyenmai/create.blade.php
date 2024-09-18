@extends('admin.layout')

@section('title')
    {{-- {{ $title }} --}}
@endsection

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
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0"></h5>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <form action="{{ route('khuyenmais.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="ten_khuyen_mai">Tên Khuyến Mãi</label>
                                        <input type="text" name="ten_khuyen_mai" value="{{ old('ten_khuyen_mai') }}"
                                            class="form-control  @error('ten_khuyen_mai') is-invalid @enderror ">
                                        @error('ten_khuyen_mai')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group  mb-3">
                                        <label for="gia_tri_khuyen_mai">Giá Trị Khuyến Mãi:</label>
                                        <input type="number" name="gia_tri_khuyen_mai" value="{{ old('gia_tri_khuyen_mai') }}"
                                            class="form-control  @error('gia_tri_khuyen_mai') is-invalid @enderror">
                                        @error('gia_tri_khuyen_mai')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group  mb-3">
                                        <label for="so_luong_ma">Số Lần Sử Dụng:</label>
                                        <input type="number" name="so_luong_ma" value="{{ old('so_luong_ma') }}"
                                            class="form-control  @error('so_luong_ma') is-invalid @enderror">
                                        @error('so_luong_ma')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group  mb-3">
                                        <label for="ngay_bat_dau">Ngày Bắt Đầu:</label>
                                        <input type="date" name="ngay_bat_dau" value="{{ old('ngay_bat_dau') }}"
                                            class="form-control @error('ngay_bat_dau') is-invalid @enderror">
                                        @error('ngay_bat_dau')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group  mb-3">
                                        <label for="ngay_ket_thuc">Ngày Kết Thúc:</label>
                                        <input type="date" name="ngay_ket_thuc"  value="{{ old('ngay_ket_thuc') }}"
                                            class="form-control  @error('ngay_ket_thuc') is-invalid @enderror">
                                        @error('ngay_ket_thuc')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="is_active" class="form-label ">Trạng thái</label>
                                        <div class="col-sm-10 mb-3 d-flex gap-2">
                                            <div class="form-check">
                                                <input class="form-check-input  @error('is_active') is-invalid @enderror"
                                                    type="radio" name="is_active" id="trang_thai_show" value="0" 
                                                    {{ old('is_active') == 0 ? 'checked' : '' }}>
                                                <label class="form-check-label text-success " for="trang_thai_show">Hiển
                                                    thị</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input  @error('is_active') is-invalid @enderror"
                                                    type="radio" name="is_active" id="trang_thai_hide" value="1"
                                                    {{ old('is_active') == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label text-danger" for="trang_thai_hide">Ẩn</label>
                                            </div>
                                            @error('is_active')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-success">Tạo Khuyến Mãi</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container-fluid -->
@endsection

@section('js')
@endsection
