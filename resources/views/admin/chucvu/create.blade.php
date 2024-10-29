@extends('admin.layout')

@section('css')
@endsection

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-xxl">
                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">{{ $title }}</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('chucvus.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="ten_chuc_vu" class="form-label">Tên chức vụ</label>
                                                <select id="ten_chuc_vu" name="ten_chuc_vu"
                                                    class="form-select @error('ten_chuc_vu') is-invalid @enderror">
                                                    <option value="">--Chọn--</option>
                                                    <option value="admin" {{ old('admin') == 'admin' ? 'selected' : '' }}>
                                                        Admin
                                                    </option>
                                                    <option value="nhan_vien"
                                                        {{ old('nhan_vien') == 'nhan_vien' ? 'selected' : '' }}>
                                                        Nhân viên
                                                    </option>
                                                    <option value="khach_hang"
                                                        {{ old('khach_hang') == 'khach_hang' ? 'selected' : '' }}>
                                                        Khách hàng
                                                    </option>
                                                </select>
                                                @error('ten_chuc_vu')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="mo_ta_chuc_vu" class="form-label">Mô tả</label>
                                                <input type="text" id="mo_ta_chuc_vu" name="mo_ta_chuc_vu"
                                                    class="form-control @error('mo_ta_chuc_vu') is-invalid @enderror"
                                                    value="{{ old('mo_ta_chuc_vu') }}">
                                                @error('mo_ta_chuc_vu')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success">Thêm mới</button>
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
