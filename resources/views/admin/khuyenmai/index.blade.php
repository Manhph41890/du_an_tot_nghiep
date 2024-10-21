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
                    <form method="GET" action="{{ route('khuyenmais.index') }}" class="d-flex">
                        <input type="text" name="search_km" class="form-control me-2" placeholder="Tìm mã khuyến mãi .."
                            value="{{ request()->query('search_km') }}"> <!-- Use search_km here -->
                        <select name="is_active" class="form-select me-2">
                            <option value="">Tất cả trạng thái</option>
                            <option value="1" {{ request()->query('is_active') == '1' ? 'selected' : '' }}>Đang hoạt
                                động</option>
                            <option value="0" {{ request()->query('is_active') == '0' ? 'selected' : '' }}>Hết hạn
                            </option>
                        </select>
                        <button type="submit" class="btn btn-primary">Tìm</button>
                    </form>


                </div>

                <!-- Striped Rows -->
                <div class="col-xl-12">
                    <div class="card">

                        <div class="card-header ">
                            <div class="row">
                                @if ($isAdmin)
                                    <div class="col-3">

                                        <a href="{{ route('khuyenmais.create') }}" class="btn btn-success">Thêm mã khuyến
                                            mãi
                                        </a>
                                    </div>
                                @endif
                               
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
                                                @if ($isAdmin)
                                                    <th scope="col">Hành Động </th>
                                                @endif
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
                                                        class="{{ $khuyenMai->is_active == 0 ? 'text-danger' : 'text-success' }}">
                                                        {{ $khuyenMai->is_active == 1 ? 'Đang Hoạt Động ' : 'Hết Hạn' }}
                                                    </td>
                                                    <td>
                                                        @if ($isAdmin)
                                                            <a href="{{ route('khuyenmais.edit', $khuyenMai->id) }}"><i
                                                                    class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i></a>
                                                            <form
                                                                action="{{ route('khuyenmais.destroy', $khuyenMai->id) }}"
                                                                method="POST" style="display:inline;"
                                                                onsubmit="return confirm ('Bạn có muốn xóa danh mục sản phẩm này không ?') ">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    style="border: none; background: none;">
                                                                    <i
                                                                        class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{ $khuyenMais->links() }}

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
