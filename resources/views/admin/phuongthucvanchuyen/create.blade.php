@extends('admin.layout')

@section('css')
@endsection

@section('content')
    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-xxl">
                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">{{ $title }}</h5>
                            </div><!-- end card header -->
                            <div class="card-body">
                                <form action="{{ route('phuongthucvanchuyens.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="kieu_van_chuyen" class="form-label">Kiểu vận chuyển</label>
                                                <select id="kieu_van_chuyen" name="kieu_van_chuyen"
                                                    class="form-select @error('kieu_van_chuyen') is-invalid @enderror">
                                                    <option value="">--Chọn--</option>
                                                    <option value="Giao hàng hỏa tốc"
                                                        {{ old('kieu_van_chuyen') == 'Giao hàng hỏa tốc' ? 'selected' : '' }}>
                                                        Giao hàng hỏa tốc
                                                    </option>
                                                    <option value="Giao hàng thường"
                                                        {{ old('kieu_van_chuyen') == 'Giao hàng thường' ? 'selected' : '' }}>
                                                        Giao hàng thường
                                                    </option>
                                                </select>
                                                @error('kieu_van_chuyen')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container-fluid -->
@endsection
