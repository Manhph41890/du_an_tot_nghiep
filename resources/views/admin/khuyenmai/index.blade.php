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

                <!-- Striped Rows -->
                <div class="col-xl-12">
                    <div class="card">

                        <div class="card-header ">
                            <div class="row">
                                <div class="col-2">
                                    <a href="{{ route('khuyenmais.create') }}" class="btn btn-success">Thêm mã khuyến mãi
                                    </a>
                                </div>
                                <div class="col-3">
                                    <form action="{{ route('khuyenmais.index') }}" method="POST" id="filter-form-km">
                                        @csrf
                                        @method('GET')
                                        <div class="form-group mb-3">
                                            <input type="text" name="search_km" class="form-control"
                                                placeholder="Tìm kiếm theo mã khuyến mãi"
                                                onchange="document.getElementById('filter-form-km').submit();">
                                        </div>
                                    </form>
                                </div>
                                <div class="col-7">
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
                        </div>

                        <div class="row">
                            <div class="card-body">
                                <div class="table-responsive">

                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Tên khuyến mãi</th>
                                                <th scope="col">Mã khuyến mãi </th>
                                                <th scope="col">Giá trị </th>
                                                <th scope="col">Số lượng mã </th>
                                                <th scope="col">Ngày bắt đầu </th>
                                                <th scope="col">Ngày kết thúc</th>
                                                <th scope="col">Trạng Thái </th>
                                                <th scope="col">Hành Động </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($khuyenMais as $key => $khuyenMai)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $khuyenMai->ten_khuyen_mai }}</td>
                                                    <td>{{ $khuyenMai->ma_khuyen_mai }}</td>
                                                    <td>{{ $khuyenMai->gia_tri_khuyen_mai }}đ</td>
                                                    <td>{{ $khuyenMai->so_luong_ma }}</td>
                                                    <td>{{ $khuyenMai->ngay_bat_dau }}</td>
                                                    <td>{{ $khuyenMai->ngay_ket_thuc }}</td>
                                                    <td
                                                        class="{{ $khuyenMai->is_active == 0 ? 'text-success' : 'text-danger' }}">
                                                        {{ $khuyenMai->is_active == 0 ? 'Hiển Thị' : 'Ẩn' }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('khuyenmais.edit', $khuyenMai->id) }}"><i
                                                                class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i></a>
                                                        <form action="{{ route('khuyenmais.destroy', $khuyenMai->id) }}"
                                                            method="POST" style="display:inline;"
                                                            onsubmit="return confirm ('Bạn có muốn xóa danh mục sản phẩm này không ?') ">
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
                            {{-- {{ $khuyenMai->links() }} --}}
                        </div>

                    </div>

                </div>


            </div> <!-- container-fluid -->

        </div>
    </div>

@section('js')
    <!-- Include your JS files here -->
@endsection
@endsection
