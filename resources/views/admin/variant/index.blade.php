@extends('admin.layout')
@section('css')
@endsection
@section('content')
    <style>
        #maMauInput {
            background-color: transparent;
            /* Màu nền mặc định */
            color: #000;
            /* Màu chữ */
            border: 1px solid #ccc;
            /* Đường viền mặc định */
        }

        #maMauInput.valid {
            color: #fff;
            /* Màu chữ cho mã màu hợp lệ */
        }

        input.valid {
            color: #fff;
        }

        input.invalid {
            border: 1px solid red;
        }
    </style>
    <div class="content-page">

        <div class="content">
            <div class="container">
                <h2>Quản lý Biến Thể</h2>

                <!-- Danh sách màu sắc -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>Danh sách Màu Sắc</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên Màu</th>
                                    <th>Mã Màu</th>
                                    <th>Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($colors as $color)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $color->ten_color }}</td>
                                        <td style="color: {{ $color->ma_mau }};">{{ $color->ma_mau }}</td>
                                        <td>
                                            <!-- Nút sửa -->
                                            <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                data-target="#editColorModal{{ $color->id }}">
                                                Sửa
                                            </button>

                                            <!-- Nút xóa -->
                                            <form action="{{ route('variants.colors.UpdateStatus', $color->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PUT')
                                            
                                                @if($color->is_active)
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn ẩn màu này không?')">
                                                        Ẩn
                                                    </button>
                                                @else
                                                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Bạn có chắc chắn muốn hiện màu này không?')">
                                                        Hiện
                                                    </button>
                                                @endif
                                            </form>
                                            
                                        </td>
                                    </tr>

                                    <!-- Modal sửa màu -->
                                    <div class="modal fade" id="editColorModal{{ $color->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="editColorModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form action="{{ route('variants.colors.update', $color->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editColorModalLabel">Sửa Màu</h5>

                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="ten_color">Tên Màu</label>
                                                            <input type="text" name="ten_color" class="form-control"
                                                                value="{{ $color->ten_color }}" required>

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="ma_mau">Mã Màu</label>
                                                            <input type="text" name="ma_mau" class="form-control"
                                                                value="{{ $color->ma_mau }}" required>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">

                                                        <button type="submit" class="btn btn-primary">Cập Nhật</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Form thêm màu sắc -->
                        <form action="{{ route('variants.colors.store') }}" method="POST" class="mt-4">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" name="ten_color" class="form-control" placeholder="Nhập tên màu"
                                    value="{{ old('ten_color') }}" required>


                                <input type="text" name="ma_mau" class="form-control"
                                    placeholder="Nhập mã màu (ví dụ: #ff0000)" id="maMauInput" required>



                                <button type="submit" class="btn btn-primary">Thêm Màu</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Danh sách kích thước -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>Danh sách Kích Thước</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên Kích Thước</th>
                                    <th>Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sizes as $size)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $size->ten_size }}</td>
                                        <td>
                                            <!-- Nút sửa -->
                                            <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                data-target="#editSizeModal{{ $size->id }}">
                                                Sửa
                                            </button>

                                            <!-- Nút xóa -->
                                            <form action="{{ route('variants.sizes.UpdateStatus1', $size->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PUT')
                                            
                                                @if($size->is_active)
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn ẩn size này không?')">
                                                        Ẩn
                                                    </button>
                                                @else
                                                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Bạn có chắc chắn muốn hiện size này không?')">
                                                        Hiện
                                                    </button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Modal sửa kích thước -->
                                    <div class="modal fade" id="editSizeModal{{ $size->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="editSizeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form action="{{ route('variants.sizes.update', $size->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editSizeModalLabel">Sửa Kích Thước
                                                        </h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="ten_size">Tên Kích Thước</label>
                                                            <input type="text" name="ten_size" class="form-control"
                                                                value="{{ $size->ten_size }}" required>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">

                                                        <button type="submit" class="btn btn-primary">Cập Nhật</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Form thêm kích thước -->
                        <form action="{{ route('variants.sizes.store') }}" method="POST" class="mt-4">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" name="ten_size" class="form-control"
                                    placeholder="Nhập tên kích thước" value="{{ old('ten_size') }}" required>
                                <button type="submit" class="btn btn-primary">Thêm Kích Thước</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        

        // Lấy danh sách màu sắc và kích thước từ server
        var existingColors = @json($colors->map(fn($color) => strtolower($color)));
        var existingSizes = @json($sizes->map(fn($sizes) => strtolower($sizes)));;

        document.querySelector('form[action="{{ route('variants.colors.store') }}"]').addEventListener('submit', function(
            event) {
            var newColor = document.querySelector('input[name="ten_color"]').value.trim().toLowerCase();

            // Kiểm tra trùng lặp với danh sách màu đã có
            if (existingColors.some(color => color.trim().toLowerCase() === newColor)) {
                event.preventDefault();
                toastr.error('Tên màu này đã tồn tại! Vui lòng nhập tên khác.');
            }
        });


        // Kiểm tra trùng kích thước
        document.querySelector('form[action="{{ route('variants.sizes.store') }}"]').addEventListener('submit', function(
            event) {
            var newSize = document.querySelector('input[name="ten_size"]').value.trim().toLowerCase();
            if (existingSizes.includes(newSize)) {
                event.preventDefault();
                toastr.error('Kích thước này đã tồn tại! Vui lòng nhập kích thước khác.');
            }
        });

        // Kiểm tra mã màu hợp lệ
        document.getElementById('maMauInput').addEventListener('input', function() {
            const colorValue = this.value;
            if (/^#([0-9A-F]{3}){1,2}$/i.test(colorValue)) {
                this.style.backgroundColor = colorValue;
                this.classList.add('valid');
                this.classList.remove('invalid');
            } else {
                this.style.backgroundColor = 'transparent';
                this.classList.add('invalid');
                this.classList.remove('valid');
            }
        });

        // Hiển thị modal
        $(document).ready(function() {
            $('.btn-warning').click(function() {
                var colorId = $(this).data('target');
                $(colorId).modal('show');
            });
        });

        // Reset modal khi đóng
        $('#editColorModal{{ $color->id }}').on('hidden.bs.modal', function() {
            $(this).find('form')[0].reset();
            $(this).find('.valid').removeClass('valid');
            $(this).find('.invalid').removeClass('invalid');
        });
    </script>
@endsection
