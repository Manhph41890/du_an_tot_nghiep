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
                                <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="chuc_vu_id" class="form-label">Chọn chức vụ</label>
                                        <select class="form-select @error('chuc_vu_id') is-invalid @enderror"
                                            name="chuc_vu_id" id="chuc_vu_id">
                                            <option value="3" selected>Nhân viên quản lý</option>
                                            <option value="5" selected>Nhân viên vận chuyển</option>
                                        </select>
                                        @error('chuc_vu_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3 btn-p">
                                        <label for="ho_ten">Họ và tên</label>
                                        <input type="text" name="ho_ten" value="{{ old('ho_ten') }}"
                                            class="form-control @error('ho_ten') is-invalid @enderror">
                                        @error('ho_ten')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="anh_dai_dien">Ảnh đại diện</label>
                                        <input type="file" name="anh_dai_dien"
                                            class="form-control @error('anh_dai_dien') is-invalid @enderror">
                                        @error('anh_dai_dien')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" value="{{ old('email') }}"
                                            class="form-control @error('email') is-invalid @enderror">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="so_dien_thoai">Số điện thoại</label>
                                        <input type="text" name="so_dien_thoai" value="{{ old('so_dien_thoai') }}"
                                            class="form-control @error('so_dien_thoai') is-invalid @enderror">
                                        @error('so_dien_thoai')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="ngay_sinh">Ngày sinh</label>
                                        <input type="date" name="ngay_sinh" value="{{ old('ngay_sinh') }}"
                                            class="form-control @error('ngay_sinh') is-invalid @enderror">
                                        @error('ngay_sinh')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="dia_chi">Địa chỉ</label>
                                        <input type="text" id="dia_chi" name="dia_chi" value="{{ old('dia_chi') }}"
                                            class="form-control @error('dia_chi') is-invalid @enderror">
                                        @error('dia_chi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div id="suggestions"></div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="gioi_tinh">Giới tính</label>
                                        <input type="text" name="gioi_tinh" value="{{ old('gioi_tinh') }}"
                                            class="form-control @error('gioi_tinh') is-invalid @enderror">
                                        @error('gioi_tinh')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">Mật Khẩu</label>
                                        <input type="text" name="password" value="{{ old('password') }}"
                                            class="form-control @error('password') is-invalid @enderror">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="trang_thai" class="form-label">Trạng thái</label>
                                        <div class="col-sm-10 mb-3 d-flex gap-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="is_active"
                                                    id="trang_thai_show" value="1"
                                                    {{ old('is_active') == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label text-success" for="trang_thai_show">Hiển
                                                    thị</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="is_active"
                                                    value="0" id="trang_thai_hide"
                                                    {{ old('is_active') == 0 ? 'checked' : '' }}>
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

                                    <button type="submit" class="btn btn-success">Thêm</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container-fluid -->
    <script>
        // api maps
        $(document).ready(function() {
            $('#dia_chi').on('input', function() {
                const input = $(this).val();
                if (input.length > 2) {
                    $.ajax({
                        url: 'https://rsapi.goong.io/place/autocomplete',
                        data: {
                            input: input,
                            location: '10.700920276971795,106.73296613898738',
                            limit: 10,
                            radius: 10,
                            api_key: '22Wn63woi41PWQdNMN9kaVUsgC9VFKEp1ZzjmQm5' // Ensure the API key is correctly supplied here
                        },
                        success: function(data) {
                            const suggestions = data.predictions.map(prediction =>
                                `<div>${prediction.description}</div>`).join('');
                            $('#suggestions').html(suggestions);
                        },
                        error: function(error) {
                            console.error('Error fetching autocomplete results:', error);
                        }
                    });
                } else {
                    $('#suggestions').empty();
                }
            });

            // Click on suggestion to fill input
            $('#suggestions').on('click', 'div', function() {
                $('#dia_chi').val($(this).text());
                $('#suggestions').empty();
            });
        });
    </script>
@endsection
