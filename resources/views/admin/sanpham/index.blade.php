@extends('admin.layout')

@section('css')
    <style>
        .variant-list {
            margin-top: 10px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            display: none;
            /* Ẩn các biến thể ban đầu */
        }

        .toggle-variants {
            cursor: pointer;
            /* Thêm con trỏ tay cho các nút xổ ra */
        }
    </style>
@endsection

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container">
                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0">{{ $title }}</h4>
                    </div>
                </div>

                <!-- Striped Rows -->
                <div class="col-xl-12">
                    <div class="card">


                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <a href="{{ route('sanphams.create') }}" class="btn btn-success">Thêm Sản Phẩm</a>
                            </div>
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissable fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close justify-content-center" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                    </div><!-- end card header -->

                    <div class="row">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Danh Mục</th>
                                            <th scope="col">Tên Sản Phẩm</th>
                                            <th scope="col">Giá Gốc</th>
                                            <th scope="col">Giá Khuyến Mãi</th>
                                            <th scope="col">Ảnh Sản Phẩm</th>
                                            <th scope="col">Số Lượng</th>
                                            <th scope="col">Mô tả sản Phẩm</th>
                                            <th scope="col">Trạng Thái</th>
                                            <th scope="col">Biến Thể</th>
                                            <th scope="col">Hành Động</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        {{-- <div id="accordion">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <a class="btn" data-bs-toggle="collapse" href="#collapseOne">
                                                            Collapsible Group Item #1
                                                        </a>
                                                    </div>
                                                    <div id="collapseOne" class="collapse show" data-bs-parent="#accordion">
                                                        <div class="card-body">
                                                            Lorem ipsum..
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}

                                        <<<<<<< HEAD @foreach ($data as $index => $item)
                                            <tr>
                                                <th scope="row">{{ $index + 1 }}</th>
                                                <td>{{ $item->danh_muc?->ten_danh_muc }}</td>
                                                <td>{{ $item->ten_san_pham }}</td>
                                                <td>{{ number_format($item->gia_goc, 0, ',', '.') }} VND</td>
                                                <td>{{ number_format($item->gia_km, 0, ',', '.') }} VND</td>
                                                <td>
                                                    @if ($item->anh_san_pham)
                                                        <img src="{{ asset('storage/' . $item->anh_san_pham) }}"
                                                            alt="Hình ảnh sản phẩm" width="50px">
                                                    @else
                                                        <img src="{{ asset('images/placeholder.png') }}" alt="Không có ảnh"
                                                            width="50px">
                                                        <!-- Placeholder image -->
                                                    @endif
                                                </td>
                                                <td>{{ $item->so_luong }}</td>
                                                <td>{{ $item->ma_ta_san_pham }}</td>
                                                <td>{!! $item->is_active
                                                    ? '<span class="badge bg-primary">Hiển Thị</span>'
                                                    : '<span class="badge bg-danger">Ẩn</span>' !!}</td>
                                                =======
                                                @foreach ($data as $index => $item)
                                            <tr>
                                                <th scope="row">{{ $index + 1 }}</th>
                                                <td>{{ $item->danh_muc?->ten_danh_muc }}</td>
                                                <td>{{ $item->ten_san_pham }}</td>
                                                <td>{{ number_format($item->gia_goc, 0, ',', '.') }} VND</td>
                                                <td>{{ number_format($item->gia_km, 0, ',', '.') }} VND</td>
                                                <td>
                                                    @if ($item->anh_san_pham)
                                                        <img src="{{ asset('storage/' . $item->anh_san_pham) }}"
                                                            alt="Hình ảnh sản phẩm" width="50px">
                                                    @else
                                                        <img src="{{ asset('images/placeholder.png') }}" alt="Không có ảnh"
                                                            width="50px">
                                                        <!-- Placeholder image -->
                                                    @endif
                                                </td>
                                                <td>{{ $item->so_luong }}</td>
                                                <td>{{ $item->ma_ta_san_pham }}</td>
                                                <<<<<<< HEAD <td
                                                    class="{{ $item->is_active == 0 ? 'text-success' : 'text-danger' }}">
                                                    {{ $item->is_active == 0 ? 'Hiển Thị' : 'Ẩn' }}
                                                    </td>
                                                    =======
                                                    <td>{!! $item->is_active
                                                        ? '<span class="badge bg-primary">Hiển Thị</span>'
                                                        : '<span class="badge bg-danger">Ẩn</span>' !!}</td>
                                                    >>>>>>> f80c2f82532e34a03f39f4ea1a86616f265aabf4
                                                    >>>>>>> 0333264aae0f360a2d05ef5c669954e847a8c8a6

                                                    <td>
                                                        <div id="variants-{{ $item->id }}" class="variant-list">
                                                            @if ($item->bien_the_san_phams->isNotEmpty())
                                                                @foreach ($item->bien_the_san_phams as $variant)
                                                                    @if ($variant->so_luong > 0)
                                                                        <!-- Kiểm tra số lượng lớn hơn 0 -->
                                                                        @if ($variant->sizeSanPham && $variant->colorSanPham)
                                                                            <p>
                                                                                Size: {{ $variant->sizeSanPham->ten_size }}
                                                                                -
                                                                                Màu:
                                                                                {{ $variant->colorSanPham->ten_color }} -
                                                                                Số lượng: {{ $variant->so_luong }}
                                                                            </p>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                <p>Không có biến thể nào.</p>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('sanphams.edit', $item->id) }}">
                                                            <i
                                                                class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i>
                                                        </a>
                                                        <form action="{{ route('sanphams.destroy', $item->id) }}"
                                                            method="POST" style="display:inline;"
                                                            onsubmit="return confirm('Bạn có muốn xóa sản phẩm này không?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" style="border: none; background: none;">
                                                                <i
                                                                    class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"></i>
                                                            </button>
                                                        </form>
                                                    </td>

                                            </tr>
                                            @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{ $data->links() }}
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div>
    </div>

    @section('js')
        <script>
            document.querySelectorAll('.toggle-variants').forEach(function(toggle) {
                toggle.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target');
                    const targetElement = document.querySelector(targetId);

                    // Kiểm tra sự tồn tại của phần tử mục tiêu
                    if (targetElement) {
                        if (targetElement.style.display === "none" || targetElement.style.display === "") {
                            targetElement.style.display = "block"; // Hiển thị phần tử
                            this.querySelector('.plus-icon').textContent = '-'; // Đổi biểu tượng
                        } else {
                            targetElement.style.display = "none"; // Ẩn phần tử
                            this.querySelector('.plus-icon').textContent = '+'; // Đổi biểu tượng
                        }
                    } else {
                        console.log('Element not found for ID:', targetId);
                    }
                });
            });
        </script>
    @endsection
@endsection
