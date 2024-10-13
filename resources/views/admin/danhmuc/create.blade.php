@extends('admin.layout')

@section('css')
@endsection

@section('content')
    <div class="content-page">

        <div class="content">
            <!-- Success Modal -->
            <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="successModalLabel">Thông báo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            {{ session('success') }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                // Hiển thị modal nếu có thông báo thành công
                $(document).ready(function() {
                    @if (session('success'))
                        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                        successModal.show();
                    @endif
                });
            </script>


            <!-- Success Modal -->
            <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="successModalLabel">Thông báo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            {{ session('success') }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                // Hiển thị modal nếu có thông báo thành công
                $(document).ready(function() {
                    @if (session('success'))
                        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                        successModal.show();
                    @endif
                });
            </script>



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
                                <form action="{{ route('danhmucs.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="ten_danh_muc" class="form-label">Tên danh mục </label>
                                                <input type="text" id="ten_danh_muc" name="ten_danh_muc"
                                                    class="form-control @error('ten_danh_muc') is-invalid @enderror"
                                                    value="{{ old('ten_danh_muc') }}">
                                                @error('ten_danh_muc')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="anh_danh_muc" class="form-label">Hình ảnh </label>
                                                <input type="file" id="anh_danh_muc" name="anh_danh_muc"
                                                    class="form-control @error('anh_danh_muc') is-invalid @enderror">
                                                @error('anh_danh_muc')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <div class="mt-2">
                                                    <img id="imagePreview" src="#" alt="Hình ảnh preview"
                                                        style="display: none;width:200px;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="trang_thai" class="form-label">Trạng thái</label>
                                            <div class="col-sm-10 mb-3 d-flex gap-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_active"
                                                        id="trang_thai_show" value="0"
                                                        {{ old('is_active') == 0 ? 'checked' : '' }}>
                                                    <label class="form-check-label text-success" for="trang_thai_show">Hiển
                                                        thị</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_active"
                                                        value="1" id="trang_thai_hide"
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



@section('js')
@endsection
