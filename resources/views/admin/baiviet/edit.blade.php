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
                            </div>

                            <div class="card-body">
                                <form action="{{ route('baiviets.update', $post->id) }}" method="POST"
                                    enctype="multipart/form-data">

                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="anh_bai_viet" class="form-label">Hình ảnh bài viết </label>
                                        <input type="file" id="anh_bai_viet" name="anh_bai_viet"
                                            class="form-control @error('anh_bai_viet') is-invalid @enderror">
                                        @error('anh_bai_viet')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="mt-2">
                                            @if ($post->anh_bai_viet)
                                                <img id="imagePreview" src="{{ asset('storage/' . $post->anh_bai_viet) }}"
                                                    alt="Hình ảnh" style="width: 200px;">
                                            @else
                                                <img id="imagePreview" src="#" alt="Hình ảnh"
                                                    style="display: none; width: 200px;">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="tieu_de_bai_viet">Tiêu đề bài viết</label>
                                        <input type="text" name="tieu_de_bai_viet"
                                            value="{{ old('tieu_de_bai_viet', $post->tieu_de_bai_viet) }}"
                                            class="form-control @error('tieu_de_bai_viet') is-invalid @enderror">
                                        @error('tieu_de_bai_viet')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="noi_dung">Nội dung</label>
                                        <textarea type="text" name="noi_dung" class="form-control @error('noi_dung') is-invalid @enderror">{{ old('noi_dung', $post->noi_dung) }}</textarea>
                                        @error('noi_dung')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="is_active" class="form-label">Trạng thái</label>
                                        <div class="col-sm-10 mb-3 d-flex gap-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="is_active"
                                                    id="trang_thai_show" value="0"
                                                    {{ old('is_active', $post->is_active) == '0' ? 'checked' : '' }}>
                                                <label class="form-check-label text-success" for="trang_thai_show">Hiển
                                                    thị</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="is_active"
                                                    id="trang_thai_hide" value="1"
                                                    {{ old('is_active', $post->is_active) == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label text-danger" for="trang_thai_hide">Ẩn</label>
                                            </div>
                                        </div>
                                        @error('is_active')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
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
