@extends('admin.layout')

@section('css')
    <style>
        .variant-list {
            margin-top: 10px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
        }


        .table td,
        .table th {
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
@endsection

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container">
                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fw-semibold">{{ $title }}</h4>
                    </div>
                    <form method="GET" action="{{ route('sanphams.index') }}" class="d-flex">
                        <input type="text" name="search" class="form-control me-2" placeholder="Tìm sản phẩm..."
                            value="{{ request()->query('search') }}">
                        <select name="status" class="form-select me-2">
                            <option value="">Tất cả trạng thái</option>
                            <option value="1" {{ request()->query('status') == '1' ? 'selected' : '' }}>Hiển Thị
                            </option>
                            <option value="0" {{ request()->query('status') === '0' ? 'selected' : '' }}>Ẩn</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Tìm</button>
                    </form>
                </div>

                <!-- Striped Rows -->
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            @if ($isAdmin)
                                <a href="{{ route('sanphams.create') }}" class="btn btn-success">Thêm Sản Phẩm</a>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissable fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Danh Mục</th>
                                                <th>Tên Sản Phẩm</th>
                                                {{-- <th>Giá Gốc</th>
                                                <th>Giá Khuyến Mãi</th> --}}
                                                <th>Ảnh Sản Phẩm</th>

                                                <th>Trạng Thái</th>

                                                <th>Hành Động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $index => $item)
                                                <tr>
                                                    <th scope="row">{{ $index + 1 }}</th>
                                                    <td>{{ $item->danh_muc?->ten_danh_muc }}</td>
                                                    <td>{{ $item->ten_san_pham }}</td>
                                                    {{-- <td>{{ number_format($item->gia_goc, 0, ',', '.') }} VND</td>
                                                    <td>{{ number_format($item->gia_km, 0, ',', '.') }} VND</td> --}}
                                                    <td>
                                                        @if ($item->anh_san_pham)
                                                            <img src="{{ asset('storage/' . $item->anh_san_pham) }}"
                                                                alt="Hình ảnh sản phẩm" width="50px">
                                                        @else
                                                            <img src="{{ asset('images/placeholder.png') }}"
                                                                alt="Không có ảnh" width="50px">
                                                        @endif
                                                    </td>

                                                    <td>
                                                        {!! $item->is_active
                                                            ? '<span class="badge bg-primary">Hiển Thị</span>'
                                                            : '<span class="badge bg-danger">Ẩn</span>' !!}
                                                    </td>

                                                    <td>
                                                        @if ($isAdmin)
                                                            <a href="{{ route('sanphams.show', $item->id) }}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#productModal-{{ $item->id }}">
                                                                <i
                                                                    class="mdi mdi-eye text-muted fs-18 rounded-2 border p-1 me-1"></i>
                                                            </a>
                                                            <!-- Modal show chi tiết sản phẩm -->
                                                            <div class="modal fade" id="productModal-{{ $item->id }}"
                                                                tabindex="-1"
                                                                aria-labelledby="productModalLabel-{{ $item->id }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="productModalLabel-{{ $item->id }}">
                                                                                {{ $item->ten_san_pham }}</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="mb-3 ">
                                                                                <img src="{{ asset('storage/' . $item->anh_san_pham) }}"
                                                                                    alt="{{ $item->ten_san_pham }}"
                                                                                    class="img-fluid " width="200px">
                                                                            </div>
                                                                            <p><strong>Mô Tả:</strong>
                                                                                {{ $item->mo_ta_san_pham }}</p>
                                                                            <p><strong>Giá Nhập:</strong>
                                                                                {{ number_format($item->gia_nhap, 0, ',', '.') }}
                                                                                VND</p>
                                                                            <p><strong>Giá Bán:</strong>
                                                                                {{ number_format($item->gia_goc, 0, ',', '.') }}
                                                                                VND</p>
                                                                            <p><strong>Giá Khuyến Mãi:</strong>
                                                                                {{ number_format($item->gia_km, 0, ',', '.') }}
                                                                                VND</p>
                                                                            <p><strong>Số Lượng:</strong>
                                                                                {{ $item->so_luong }}</p>
                                                                            <p><strong>Trạng Thái:</strong>
                                                                                {!! $item->is_active
                                                                                    ? '<span class="badge bg-primary">Hiển Thị</span>'
                                                                                    : '<span class="badge bg-danger">Ẩn</span>' !!}
                                                                            </p>

                                                                            <h6>Biến Thể:</h6>
                                                                            @if ($item->bien_the_san_phams->isNotEmpty())
                                                                                <table class="table">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>Màu Sắc</th>
                                                                                            <th>Kích Thước</th>
                                                                                            <th>Số Lượng</th>
                                                                                            <th>Ảnh Biến Thể</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        @foreach ($item->bien_the_san_phams as $variant)
                                                                                            <tr>
                                                                                                <td>{{ $variant->color->ten_color }}
                                                                                                </td>
                                                                                                <td>{{ $variant->size->ten_size }}
                                                                                                </td>
                                                                                                <td>{{ $variant->so_luong }}
                                                                                                </td>
                                                                                                <td>
                                                                                                    @if ($variant->anh_bien_the)
                                                                                                        <img src="{{ asset('storage/' . $variant->anh_bien_the) }}"
                                                                                                            alt="Ảnh biến thể"
                                                                                                            width="50px">
                                                                                                    @else
                                                                                                        <img src="{{ asset('images/placeholder.png') }}"
                                                                                                            alt="Không có ảnh"
                                                                                                            width="50px">
                                                                                                    @endif
                                                                                                </td>
                                                                                            </tr>
                                                                                        @endforeach
                                                                                    </tbody>
                                                                                </table>
                                                                            @else
                                                                                <p>Không có biến thể nào cho sản phẩm này.
                                                                                </p>
                                                                            @endif
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Đóng</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <a href="{{ route('sanphams.edit', $item->id) }}">
                                                                <i
                                                                    class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i>
                                                            </a>
                                                            <form action="{{ route('sanphams.destroy', $item->id) }}"
                                                                method="POST" style="display:inline;"
                                                                onsubmit="return confirm('Bạn có muốn xóa sản phẩm này không?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    style="border: none; background: none;">
                                                                    <i
                                                                        class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"></i>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <a href="{{ route('sanphams.show', $item->id) }}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#productModal-{{ $item->id }}">
                                                                <i
                                                                    class="mdi mdi-eye text-muted fs-18 rounded-2 border p-1 me-1"></i>
                                                            </a>
                                                            <!-- Modal show chi tiết sản phẩm -->
                                                            <div class="modal fade" id="productModal-{{ $item->id }}"
                                                                tabindex="-1"
                                                                aria-labelledby="productModalLabel-{{ $item->id }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="productModalLabel-{{ $item->id }}">
                                                                                {{ $item->ten_san_pham }}</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="mb-3 ">
                                                                                <img src="{{ asset('storage/' . $item->anh_san_pham) }}"
                                                                                    alt="{{ $item->ten_san_pham }}"
                                                                                    class="img-fluid " width="200px">
                                                                            </div>
                                                                            <p><strong>Mô Tả:</strong>
                                                                                {{ $item->mo_ta_san_pham }}</p>
                                                                            <p><strong>Giá Gốc:</strong>
                                                                                {{ number_format($item->gia_goc, 0, ',', '.') }}
                                                                                VND</p>
                                                                            <p><strong>Giá Khuyến Mãi:</strong>
                                                                                {{ number_format($item->gia_km, 0, ',', '.') }}
                                                                                VND</p>
                                                                            <p><strong>Số Lượng:</strong>
                                                                                {{ $item->so_luong }}</p>
                                                                            <p><strong>Trạng Thái:</strong>
                                                                                {!! $item->is_active
                                                                                    ? '<span class="badge bg-primary">Hiển Thị</span>'
                                                                                    : '<span class="badge bg-danger">Ẩn</span>' !!}
                                                                            </p>

                                                                            <h6>Biến Thể:</h6>
                                                                            @if ($item->bien_the_san_phams->isNotEmpty())
                                                                                <table class="table">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>Màu Sắc</th>
                                                                                            <th>Kích Thước</th>
                                                                                            <th>Số Lượng</th>
                                                                                            <th>Ảnh Biến Thể</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        @foreach ($item->bien_the_san_phams as $variant)
                                                                                            <tr>
                                                                                                <td>{{ $variant->color->ten_color }}
                                                                                                </td>
                                                                                                <td>{{ $variant->size->ten_size }}
                                                                                                </td>
                                                                                                <td>{{ $variant->so_luong }}
                                                                                                </td>
                                                                                                <td>
                                                                                                    @if ($variant->anh_bien_the)
                                                                                                        <img src="{{ asset('storage/' . $variant->anh_bien_the) }}"
                                                                                                            alt="Ảnh biến thể"
                                                                                                            width="50px">
                                                                                                    @else
                                                                                                        <img src="{{ asset('images/placeholder.png') }}"
                                                                                                            alt="Không có ảnh"
                                                                                                            width="50px">
                                                                                                    @endif
                                                                                                </td>
                                                                                            </tr>
                                                                                        @endforeach
                                                                                    </tbody>
                                                                                </table>
                                                                            @else
                                                                                <p>Không có biến thể nào cho sản phẩm này.
                                                                                </p>
                                                                            @endif
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Đóng</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{ $data->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
