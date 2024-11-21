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
                                    @if ($isAdmin)
                                        <a href="{{ route('baiviets.create') }}" class="btn btn-success">Thêm bài viết
                                        </a>
                                    @endif
                                </div>
                                <div class="col-6">
                                    <form action="{{ route('baiviets.index') }}" method="GET" id="filter-form-km">
                                        <div class="d-flex gap-3 align-items-baseline">
                                            <div class=" mb-3 d-flex align-items-center gap-3">
                                                <div
                                                    class = "form-group d-flex align-items-center justify-content-center gap-3">
                                                    <label for="">Từ:</label>
                                                    <input class="form-control" type="date" name="start_date"
                                                        id="start_date" value="{{ request()->start_date }}">

                                                </div>
                                                <div div
                                                    class = "form-group d-flex align-items-center justify-content-center gap-3">
                                                    <label for="">Đến:</label>
                                                    <input class="form-control" type="date" name="end_date"
                                                        id="end_date" value="{{ request()->end_date }}">

                                                </div>
                                            </div>
                                            <button class="btn btn-success" type="submit">Lọc</button>
                                        </div>

                                    </form>
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
                                                        @endif
                                                    </td>
                                                    <td>{{ $baiviet->ngay_dang }}</td>
                                                    <td>{{ $baiviet->user?->ho_ten }}</td>
                                                    <td
                                                        class="{{ $baiviet->is_active == 0 ? 'text-success' : 'text-danger' }}">
                                                        {{ $baiviet->is_active == 1 ? 'Hiển Thị' : 'Ẩn' }}
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
