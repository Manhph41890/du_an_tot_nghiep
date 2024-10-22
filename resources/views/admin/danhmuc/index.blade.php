@extends('admin.layout')

@section('css')
@endsection

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container">
                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0">{{ $title }}</h4>
                    </div>
                    <form method="post" action="{{ route('danhmucs.index') }}" class="d-flex">
                        @csrf
                        @method('GET')
                        <input type="text" name="search_ten_danh_muc" class="form-control me-2" placeholder="Tìm sản phẩm..."  value="{{ request('search_ten_danh_muc') }}">
                        <select name="search_dm" class="form-select me-2">
                            <option value="">Hiển thị tất cả</option>
                            <option value="0" {{ request('search_dm') == '0' ? 'selected' : '' }}>Hiển thị</option>
                            <option value="1" {{ request('search_dm') == '1' ? 'selected' : '' }}>Ẩn</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Tìm</button>
                    </form>
                </div>
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="row">
                                <div class="col-2">
                                    @if ($isAdmin)
                                        <a href="{{ route('danhmucs.create') }}" class="btn btn-success">Tạo Mới</a>
                                    @endif
                                </div>
                                <div class="col-4">
                                    <script>
                                        $(document).ready(function() {
                                            @if (Session::has('success'))
                                                toastr.success("{{ Session::get('success') }}", "Thông báo", {
                                                    progressBar: true,
                                                    closeButton: true,
                                                    timeOut: 3000
                                                });
                                            @endif
                                            @if (Session::has('error'))
                                                toastr.error("{{ Session::get('error') }}", "Thông báo", {
                                                    progressBar: true,
                                                    closeButton: true,
                                                    timeOut: 3000
                                                });
                                            @endif
                                        });
                                    </script>
                                </div>
                            </div>
                        </div><!-- end card header -->

                        <div class="row">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Hình ảnh</th>
                                                <th scope="col">Tên danh mục</th>
                                                <th scope="col">Trạng Thái</th>
                                                @if ($isAdmin)
                                                    <th scope="col">Hành Động</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($danhmucs as $index => $item)
                                                <tr>
                                                    <th scope="row">{{ $index + 1 }}</th>
                                                    <td>
                                                        @if ($item->anh_danh_muc)
                                                            <img src="{{ asset('/storage/' . $item->anh_danh_muc) }}"
                                                                width="50px">
                                                        @else
                                                            <img src="" alt="Không có ảnh" width="50px">
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->ten_danh_muc }}</td>
                                                    <td
                                                        class="{{ $item->is_active == 0 ? 'text-success' : 'text-danger' }}">
                                                        {{ $item->is_active == 0 ? 'Hiển Thị' : 'Ẩn' }}
                                                    </td>
                                                    <td>
                                                        @if ($isAdmin)
                                                            <a href="{{ route('danhmucs.edit', $item->id) }}">
                                                                <i
                                                                    class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i>
                                                            </a>
                                                            <form action="{{ route('danhmucs.destroy', $item->id) }}"
                                                                method="POST" style="display:inline;"
                                                                onsubmit="return confirm('Bạn có muốn xóa danh mục sản phẩm này không?')">
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
                        </div>
                        <div class="row p-2">
                            {{ $danhmucs->links() }}
                        </div>
                    </div>
                </div>
            </div> <!-- container-fluid -->
        </div>
    </div>

@section('js')
@endsection
@endsection
