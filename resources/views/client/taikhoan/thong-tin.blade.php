@extends('client.taikhoan.dashboard')

@section('conten-taikhoan')
    <div class="">
        <div class="myaccount-content">
            <h3 style="font-size: 30px;">{{ $title }}</h3>

            <form id="user-info-form" style="font-size: 18px;" action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="align-items-center">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('storage/' . Auth::user()->anh_dai_dien) }}?t={{ time() }}"
                            class="rounded-circle img-thumbnail float-start" alt="Profile Image"
                            style="width: 100px; height: 100px; object-fit: cover;">
                        <div class="overflow-hidden ms-4">
                            <h4 class="m-0 text-dark fs-20">{{ Auth::user()->name }}</h4>

                            <a href="#" id="Avatar" class="ml-4 font-semibold text-primary hover:text-blue-700"
                                onclick="toggleAvatarForm(event)">
                                Thay đổi ảnh đại diện
                            </a>
                            <div id="change-avatar-form" style="display: none;">
                                <div class="form-group">
                                    <label for="anh_dai_dien">Hình đại diện</label>
                                    <input type="file" class="form-control" id="anh_dai_dien" name="anh_dai_dien">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Main Form for User Info & Avatar Update -->

                <input type="hidden" name="_method" value="POST" />

                <!-- User Info Fields -->
                <div class="account-details-form">
                    <div class="row">
                        <div class="col-12 mb-30">
                            <label for="ho_ten" class="mb-2">Họ tên</label>
                            <input id="ho_ten" name="ho_ten" type="text" value="{{ $user->ho_ten }}" disabled />
                        </div>
                        <div class="col-12 mb-30">
                            <label for="email" class="mb-2">Email</label>
                            <input id="email" name="email" type="email" value="{{ $user->email }}" disabled />
                        </div>
                        <div class="col-12 mb-30">
                            <label for="so_dien_thoai" class="mb-2">Số điện thoại</label>
                            <input id="so_dien_thoai" name="so_dien_thoai" type="number" value="{{ $user->so_dien_thoai }}"
                                disabled />
                        </div>
                        <div class="col-lg-6 col-12 mb-30">
                            <label for="ngay_sinh" class="mb-2">Ngày sinh</label>
                            <input id="ngay_sinh" name="ngay_sinh" type="date" class="form-control"
                                value="{{ $user->ngay_sinh }}" disabled />
                        </div>
                        <div class="col-lg-6 col-12 mb-30">
                            <label for="gioi_tinh" class="mb-2">Giới tính</label>
                            <select id="gioi_tinh" name="gioi_tinh" class="form-control"
                                {{ $user->gioi_tinh ? '' : 'disabled' }}>
                                <option value="Nam" {{ $user->gioi_tinh == 'Nam' ? 'selected' : '' }}>Nam</option>
                                <option value="Nữ" {{ $user->gioi_tinh == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                                <option value="Khác" {{ $user->gioi_tinh == 'Khác' ? 'selected' : '' }}>Khác</option>
                            </select>
                        </div>

                        <div class="col-12 mb-30"> <label for="dia_chi" class="mb-2">Địa chỉ</label> <input
                                id="dia_chi" name="dia_chi" type="text" value="{{ $user->dia_chi }}"
                                class="form-control" disabled> </div>
                        <div id="suggestions"></div>

                    </div>

                    <!-- Action Buttons -->
                    <div class="col-12">
                        <button type="button" class="btn btn-dark btn--md" id="toggleEditBtn" onclick="toggleEdit()">Cập
                            Nhật</button>
                        <button type="submit" class="btn btn-success btn--md" id="saveBtn" style="display: none;"
                            onclick="setFormAction('updateThongtin')">Lưu</button>
                        <button type="submit" class="btn btn-primary btn--md" id="avatarSaveBtn" style="display: none;"
                            onclick="setFormAction('avatarUpdate')">Cập nhật
                            ảnh đại diện</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
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
                            api_key: '22Wn63woi41PWQdNMN9kaVUsgC9VFKEp1ZzjmQm5'
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
            }); // Click on suggestion to fill input 
            $('#suggestions').on('click', 'div', function() {
                $('#dia_chi').val($(this).text());
                $('#suggestions').empty();
            });
        });
    </script>
@endsection
