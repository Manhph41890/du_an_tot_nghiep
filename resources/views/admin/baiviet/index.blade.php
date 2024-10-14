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
                                    <a href="{{ route('baiviets.create') }}" class="btn btn-success">Thêm bài viết
                                    </a>
                                </div>
                                <div class="col-3">
                                    <form action="{{ route('baiviets.index') }}" method="POST" id="filter-form-km">
                                        @csrf
                                        @method('GET')
                                        <div class="form-group mb-3">
                                            <input type="text" name="search_" class="form-control"
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
                                                <th scope="col">Tiêu đề bài viết</th>
                                                <th scope="col"> Ảnh bài viết </th>
                                                <th scope="col"> Ngày đăng</th>
                                                <th scope="col">Tác giả</th>
                                                <th scope="col">Trạng thái</th>
                                                <th scope="col">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($baiviets as $key => $baiviet)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $baiviet->tieu_de_bai_viet }}</td>
                                                    <td>
                                                        @if ($baiviet->anh_bai_viet)
                                                            <img src="{{ asset('storage/' . $baiviet->anh_bai_viet) }}"
                                                                alt="Hình ảnh bv" width="50px">
                                                        @else
                                                            <img src="{{ asset('images/placeholder.png') }}"
                                                                alt="Không có ảnh" width="50px">
                                                            <!-- Placeholder image -->
                                                        @endif
                                                    </td>
                                                    <td>{{ $baiviet->ngay_dang }}</td>
                                                    <td>{{ $baiviet->user?->ho_ten }}</td>
                                                    <td
                                                        class="{{ $baiviet->is_active == 0 ? 'text-success' : 'text-danger' }}">
                                                        {{ $baiviet->is_active == 0 ? 'Hiển Thị' : 'Ẩn' }}
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <a href="{{ route('baiviets.show', $baiviet->id) }}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#myModal{{ $baiviet->id }}">
                                                                <i
                                                                    class="mdi mdi-eye text-muted fs-18 rounded-2 border p-1 me-1"></i>
                                                            </a>

                                                            <!-- The Modal -->
                                                            <div class="modal" id="myModal{{ $baiviet->id }}">
                                                                @include('admin.baiviet.show', [
                                                                    'post' => $baiviet,
                                                                ])
                                                            </div>
                                                        </div>

                                                        <a href="{{ route('baiviets.edit', $baiviet->id) }}"><i
                                                                class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i></a>
                                                        <form action="{{ route('baiviets.destroy', $baiviet->id) }}"
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
                                </div><br>
                                {{ $baiviets->links() }}
                            </div>

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
