@extends('admin.layout')

@section('css')
@endsection

@section('content')

    <div class="content-page">

        <div class="content">

            <!-- Start Content-->
            <div class="container">

                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0">{{ $title }}</h4>
                    </div>
                </div>

                <!-- Striped Rows -->
                <div class="col-xl-12">
                    <div class="card">

                        <div class="card-header justify-content-between">
                            <div class="row">
                                <div class="col-2">
                                    <a href="{{ route('sanphams.create') }}" class="btn btn-success">Thêm Sản Phẩm</a>
                                </div>
                                <div class="col-2">
                                    <form action="{{ route('sanphams.index') }}" method="POST" id="filter-form-sp">
                                        @csrf
                                        @method('GET')
                                        <div class="form-group mb-3">
                                            <input type="text" name="search_sp_ten" class="form-control"
                                                placeholder="Tìm kiếm theo tên"
                                                onchange="document.getElementById('filter-form-sp').submit();">
                                        </div>
                                    </form>
                                </div>
                                <div class="col-2">
                                    <form action="{{ route('sanphams.index') }}" method="POST" id="filter-form-dm">
                                        @csrf
                                        @method('GET')
                                        <select class="form-select" name="search_sp_dm"
                                            onchange="document.getElementById('filter-form-dm').submit();">
                                            <option value="">Lọc danh mục</option>
                                            @foreach ($danhmucs as $dm)
                                                <option value="{{ $dm->id }}"
                                                    {{ request('search_sp_dm') == $dm->id ? 'selected' : '' }}>
                                                    {{ $dm->ten_danh_muc }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </div>
                                <div class="col-2">
                                    <form action="{{ route('sanphams.index') }}" method="POST" id="filter-form-tt">
                                        @csrf
                                        @method('GET')
                                        <select class="form-select" name="search_sp"
                                            onchange="document.getElementById('filter-form-tt').submit();">
                                            <option value="">Lọc trạng thái</option>
                                            <option value="0" {{ request('search_sp') == '0' ? 'selected' : '' }}>Hiển
                                                thị</option>
                                            <option value="1" {{ request('search_sp') == '1' ? 'selected' : '' }}>Ẩn
                                            </option>
                                        </select>
                                    </form>
                                </div>
                                <div class="col-4">
                                    <!-- Hiển thị thông báo thành công -->
                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissable fade show " role="alert">
                                            {{ session('success') }}
                                            <button type="button" class="btn-close justify-content-center"
                                                data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                </div>
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
                                                <th scope="col">Trạng Thái </th>
                                                <th scope="col">Hành Động </th>
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

                                            @foreach ($data as $index => $item)
                                                <tr>
                                                    <th scope="row">{{ $index + 1 }}</th>
                                                    <td>{{ $item->danh_muc?->ten_danh_muc }}</td>
                                                    <td>{{ $item->ten_san_pham }}</td>
                                                    <td>{{ $item->gia_goc }}</td>
                                                    <td>{{ $item->gia_km }}</td>

                                                    <td>
                                                        @if ($item->anh_san_pham)
                                                            <img src="{{ asset('/storage/' . $item->anh_san_pham) }}"
                                                                width="50px">
                                                        @else
                                                            <img src="" alt="Không có ảnh" width="50px">
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->so_luong }}</td>
                                                    <td>{{ $item->ma_ta_san_pham }}</td>
                                                    <td
                                                        class="{{ $item->is_active == 0 ? 'text-success' : 'text-danger' }}">
                                                        {{ $item->is_active == 0 ? 'Hiển Thị' : 'Ẩn' }}
                                                    </td>

                                                    <td>
                                                        <a href="{{ route('danhmucs.edit', $item->id) }}">
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
    <!-- Include your JS files here -->
@endsection
@endsection
