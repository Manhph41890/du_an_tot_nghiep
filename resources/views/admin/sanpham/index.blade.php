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

                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <a href="{{ route('sanphams.create') }}" class="btn btn-success">Thêm Sản Phẩm</a>
                            </div>
                            <!-- Hiển thị thông báo thành công -->
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissable fade show " role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close justify-content-center" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
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

                                                    <td>{!! $item->is_active
                                                        ? '<span class="badge bg-primary">Hiển Thị</span>'
                                                        : '<span class="badge bg-danger">Ẩn</span>' !!}</td>




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
