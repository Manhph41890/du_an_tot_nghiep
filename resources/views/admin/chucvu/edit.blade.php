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
                                <form action="{{ route('chucvus.update', $chuc_vu->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">       
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="ten_chuc_vu" class="form-label">Tên chức</label>
                                                <input type="text" id="ten_chuc_vu" name="ten_chuc_vu"
                                                    class="form-control @error('ten_chuc_vu') is-invalid @enderror"
                                                    value="{{ old('ten_chuc_vu', $chuc_vu->ten_chuc_vu) }}">
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
                                                    value="{{ old('mo_ta_chuc_vu', $chuc_vu->mo_ta_chuc_vu) }}">
                                                @error('mo_ta_chuc_vu')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary">Cập nhật</button>
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


