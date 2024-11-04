@extends('admin.layout')

@section('title')
    {{-- {{ $title }} --}}
@endsection

@section('css')
@endsection

@section('content')
    <div class="content-page">

        <div class="content">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


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
                                <form action="{{ route('baiviets.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group mb-3">
                                        <label for="anh_bai_viet">Hình ảnh bài viết</label>
                                        <input type="file" name="anh_bai_viet"
                                            class="form-control @error('anh_bai_viet') is-invalid @enderror">
                                        @error('anh_bai_viet')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="tieu_de_bai_viet">Tiêu đề bài viết</label>
                                        <input type="text" name="tieu_de_bai_viet" value="{{ old('tieu_de_bai_viet') }}"
                                            class="form-control @error('tieu_de_bai_viet') is-invalid @enderror">
                                        @error('tieu_de_bai_viet')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="noi_dung">Nội dung</label>
                                        <textarea name="noi_dung" class="form-control @error('noi_dung') is-invalid @enderror">{{ old('noi_dung') }}</textarea>
                                        @error('noi_dung')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <input type="hidden" name="ngay_dang"
                                            value="{{ old('ngay_dang', now()->format('Y-m-d')) }}"
                                            class="form-control @error('ngay_dang')
                                        is-invalid @enderror">
                                        @error('ngay_dang')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="is_active">Trạng thái</label>
                                        <div class="d-flex gap-2">
                                            <div class="form-check">
                                                <input class="form-check-input @error('is_active') is-invalid @enderror"
                                                    type="radio" name="is_active" value="0"
                                                    {{ old('is_active') == 0 ? 'checked' : '' }}>
                                                <label for="is_active">Hiển thị</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input @error('is_active') is-invalid @enderror"
                                                    type="radio" name="is_active" value="1"
                                                    {{ old('is_active') == 1 ? 'checked' : '' }}>
                                                <label for="is_active">Ẩn</label>
                                            </div>
                                        </div>
                                        @error('is_active')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-success">Tạo bài viết</button>
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
