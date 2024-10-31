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
    </style>
    <div class="content-page">

        <div class="content">
            <div class="container">
                <h2>Quản lý Biến Thể</h2>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

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
                                            <form action="{{ route('variants.colors.destroy', $color->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa màu này không?')">Xóa</button>
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
                                                            @if ($errors->has('ten_color'))
                                                                <div class="invalid-feedback d-block">
                                                                    {{ $errors->first('ten_color') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="ma_mau">Mã Màu</label>
                                                            <input type="text" name="ma_mau" class="form-control"
                                                                value="{{ $color->ma_mau }}" required>
                                                            @if ($errors->has('ma_mau'))
                                                                <div class="invalid-feedback d-block">
                                                                    {{ $errors->first('ma_mau') }}
                                                                </div>
                                                            @endif
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
                                @if ($errors->has('ten_color'))
                                    <div class="invalid-feedback d-block">
                                        {{ $errors->first('ten_color') }}
                                    </div>
                                @endif

                                <input type="text" name="ma_mau" class="form-control"
                                    placeholder="Nhập mã màu (ví dụ: #ff0000)" id="maMauInput" required>

                                @if ($errors->has('ma_mau'))
                                    <div class="invalid-feedback d-block">
                                        {{ $errors->first('ma_mau') }}
                                    </div>
                                @endif

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
                                            <form action="{{ route('variants.sizes.destroy', $size->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa kích thước này không?')">Xóa</button>
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
                                                            @if ($errors->has('ten_size'))
                                                                <div class="invalid-feedback d-block">
                                                                    {{ $errors->first('ten_size') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="gia">Giá</label>
                                                            <input type="number" name="gia" class="form-control"
                                                                value="{{ $size->gia }}" required>
                                                            @if ($errors->has('gia'))
                                                                <div class="invalid-feedback d-block">
                                                                    {{ $errors->first('gia') }}
                                                                </div>
                                                            @endif
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
                                @if ($errors->has('ten_size'))
                                    <div class="invalid-feedback d-block">
                                        {{ $errors->first('ten_size') }}
                                    </div>
                                @endif
                                <button type="submit" class="btn btn-primary">Thêm Kích Thước</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('maMauInput').addEventListener('input', function() {
            const colorValue = this.value;

            // Kiểm tra mã màu hợp lệ
            if (/^#([0-9A-F]{3}){1,2}$/i.test(colorValue)) {
                this.style.backgroundColor = colorValue; // Cập nhật màu nền
                this.classList.add('valid'); // Thêm lớp để thay đổi màu chữ
            } else {
                this.style.backgroundColor = 'transparent'; // Đặt lại màu nền nếu không hợp lệ
                this.classList.remove('valid'); // Xóa lớp nếu không hợp lệ
            }
        });
        $(document).ready(function() {
            $('.btn-warning').click(function() {
                var colorId = $(this).data('target');
                $(colorId).modal('show');
            });
        });
        $('#editColorModal{{ $color->id }}').on('hidden.bs.modal', function() {
            $(this).find("form")[0].reset(); // Reset form khi đóng
        });
    </script>

@endsection
