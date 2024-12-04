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
                        <h4 class="fs-18 fw-semibold m-0">Danh sách người dùng</h4>
                    </div>

                    <div class="col-4">
                        <form action="{{ route('user.index') }}" method="POST">
                            @csrf
                            @method('GET')
                            <input type="text" id="search_product_name" name="search_product_name" placeholder="Tìm kiếm"
                                value="{{ request('search_product_name') }}" class="form-control"
                                onchange="this.form.submit();">
                        </form>
                    </div>

                    <div class="col-3">
                        <form action="{{ route('user.index') }}" method="POST" id="filter-form">
                            @csrf
                            @method('GET')
                            <select class="form-select" name="search_dm"
                                onchange="document.getElementById('filter-form').submit();">
                                <option value="">Hiển thị tất cả</option>
                                <option value="1" {{ request('search_dm') == '1' ? 'selected' : '' }}>Hiển
                                    thị</option>
                                <option value="0" {{ request('search_dm') == '0' ? 'selected' : '' }}>Ẩn
                                </option>
                            </select>
                        </form>
                    </div>

                </div>

                <!-- Striped Rows -->
                <div class="col-xl-12">
                    <div class="card">

                        <!-- Tab Links -->
                        <ul class="nav nav-tabs" id="userTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="all-tab" data-bs-toggle="tab" href="#all" role="tab"
                                    aria-controls="all" aria-selected="true">Tất cả</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="khach-hang-tab" data-bs-toggle="tab" href="#khach-hang"
                                    role="tab" aria-controls="khach-hang" aria-selected="true">Khách hàng</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="shipper-tab" data-bs-toggle="tab" href="#shipper" role="tab"
                                    aria-controls="shipper" aria-selected="false">Nhân viên vận chuyển</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="quan-ly-tab" data-bs-toggle="tab" href="#quan-ly" role="tab"
                                    aria-controls="quan-ly" aria-selected="false">Nhân viên quản lý</a>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content" id="userTabContent" style="margin: 0 20px">

                            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                                <div class="table-responsive mt-3">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Chức vụ</th>
                                                <th scope="col">Họ và tên</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Số điện thoại</th>
                                                <th scope="col">Trạng thái</th>
                                                <th scope="col">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($list as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>{{ $item->chuc_vu?->mo_ta_chuc_vu }}</td>
                                                    <td>{{ $item->ho_ten }}</td>
                                                    <td>{{ $item->email }}</td>
                                                    <td>{{ $item->so_dien_thoai }}</td>
                                                    <td>{!! $item->is_active
                                                        ? '<span class="badge bg-primary">Hiển Thị</span>'
                                                        : '<span class="badge bg-danger">Ẩn</span>' !!}</td>
                                                    <td>
                                                        <a href="{{ route('user.show', $item->id) }}"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#myModal{{ $item->id }}">
                                                            <i
                                                                class="mdi mdi-eye text-muted fs-18 rounded-2 border p-1 me-1"></i>
                                                        </a>

                                                        <!-- Đảm bảo mỗi modal có ID riêng -->
                                                        <div class="modal fade" id="myModal{{ $item->id }}"
                                                            tabindex="-1"
                                                            aria-labelledby="exampleModalLabel{{ $item->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">

                                                                    <div class="modal-body">
                                                                        @include('admin.user.show', [
                                                                            'post' => $item,
                                                                        ])
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Đóng</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <a href="{{ route('user.edit', $item->id) }}"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#myModalnhanEditS{{ $item->id }}">
                                                            <i
                                                                class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i>
                                                        </a>

                                                        <!-- Đảm bảo mỗi modal có ID riêng -->
                                                        <div class="modal fade" id="myModalnhanEditS{{ $item->id }}"
                                                            tabindex="-1"
                                                            aria-labelledby="exampleModalLabel{{ $item->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">

                                                                    <div class="modal-body">
                                                                        @include('admin.user.edit', [
                                                                            'post' => $item,
                                                                        ])
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Đóng</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="mt-3">
                                        {{ $list->links() }}
                                    </div>
                                </div>
                            </div>

                            <!-- Khách hàng -->
                            <div class="tab-pane fade" id="khach-hang" role="tabpanel" aria-labelledby="khach-hang-tab">
                                <div class="table-responsive mt-3">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>

                                                <th scope="col">Họ và tên</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Số điện thoại</th>
                                                <th scope="col">Trạng thái</th>
                                                <th scope="col">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($list as $item)
                                                @if ($item->chuc_vu->ten_chuc_vu == 'khach_hang')
                                                    <tr>
                                                        <td>{{ $item->id }}</td>
                                                        <td>{{ $item->chuc_vu?->mo_ta_chuc_vu }}</td>
                                                        <td>{{ $item->ho_ten }}</td>
                                                        <td>{{ $item->email }}</td>
                                                        <td>{{ $item->so_dien_thoai }}</td>
                                                        <td>{!! $item->is_active
                                                            ? '<span class="badge bg-primary">Hiển Thị</span>'
                                                            : '<span class="badge bg-danger">Ẩn</span>' !!}</td>
                                                        <td>
                                                            <a href="{{ route('user.show', $item->id) }}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#myModaluser{{ $item->id }}">
                                                                <i
                                                                    class="mdi mdi-eye text-muted fs-18 rounded-2 border p-1 me-1"></i>
                                                            </a>

                                                            <!-- Đảm bảo mỗi modal có ID riêng -->
                                                            <div class="modal fade" id="myModaluser{{ $item->id }}"
                                                                tabindex="-1"
                                                                aria-labelledby="exampleModalLabel{{ $item->id }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">

                                                                        <div class="modal-body">
                                                                            @include('admin.user.show', [
                                                                                'post' => $item,
                                                                            ])
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Đóng</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <a href="{{ route('user.edit', $item->id) }}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#myModalnhanEditN{{ $item->id }}">
                                                                <i
                                                                    class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i>
                                                            </a>

                                                            <!-- Đảm bảo mỗi modal có ID riêng -->
                                                            <div class="modal fade"
                                                                id="myModalnhanEditN{{ $item->id }}" tabindex="-1"
                                                                aria-labelledby="exampleModalLabel{{ $item->id }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">

                                                                        <div class="modal-body">
                                                                            @include('admin.user.edit', [
                                                                                'post' => $item,
                                                                            ])
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Đóng</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="mt-3">
                                        {{ $list->links() }}
                                    </div>
                                </div>
                            </div>

                            <!-- Nhân viên vận chuyển -->
                            <div class="tab-pane fade" id="shipper" role="tabpanel" aria-labelledby="shipper-tab">
                                <div class="table-responsive mt-3">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>

                                                <th scope="col">Họ và tên</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Số điện thoại</th>
                                                <th scope="col">Trạng thái</th>
                                                <th scope="col">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($list as $item)
                                                @if ($item->chuc_vu->ten_chuc_vu == 'shipper')
                                                    <tr>
                                                        <td>{{ $item->id }}</td>
                                                        <td>{{ $item->chuc_vu?->mo_ta_chuc_vu }}</td>
                                                        <td>{{ $item->ho_ten }}</td>
                                                        <td>{{ $item->email }}</td>
                                                        <td>{{ $item->so_dien_thoai }}</td>
                                                        <td>{!! $item->is_active
                                                            ? '<span class="badge bg-primary">Hiển Thị</span>'
                                                            : '<span class="badge bg-danger">Ẩn</span>' !!}</td>
                                                        <td>
                                                            <a href="{{ route('user.show', $item->id) }}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#myModalshipper{{ $item->id }}">
                                                                <i
                                                                    class="mdi mdi-eye text-muted fs-18 rounded-2 border p-1 me-1"></i>
                                                            </a>

                                                            <!-- Đảm bảo mỗi modal có ID riêng -->
                                                            <div class="modal fade"
                                                                id="myModalshipper{{ $item->id }}" tabindex="-1"
                                                                aria-labelledby="exampleModalLabel{{ $item->id }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">

                                                                        <div class="modal-body">
                                                                            @include('admin.user.show', [
                                                                                'post' => $item,
                                                                            ])
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Đóng</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <a href="{{ route('user.edit', $item->id) }}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#myModalnhanEditD{{ $item->id }}">
                                                                <i
                                                                    class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i>
                                                            </a>
    
                                                            <!-- Đảm bảo mỗi modal có ID riêng -->
                                                            <div class="modal fade" id="myModalnhanEditD{{ $item->id }}"
                                                                tabindex="-1"
                                                                aria-labelledby="exampleModalLabel{{ $item->id }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
    
                                                                        <div class="modal-body">
                                                                            @include('admin.user.edit', [
                                                                                'post' => $item,
                                                                            ])
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Đóng</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="mt-3">
                                        {{ $list->links() }}
                                    </div>
                                </div>
                            </div>

                            <!-- Nhân viên quản lý -->
                            <div class="tab-pane fade" id="quan-ly" role="tabpanel" aria-labelledby="quan-ly-tab">
                                <div class="table-responsive mt-3">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>

                                                <th scope="col">Họ và tên</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Số điện thoại</th>
                                                <th scope="col">Trạng thái</th>
                                                <th scope="col">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($list as $item)
                                                @if ($item->chuc_vu->ten_chuc_vu == 'nhan_vien')
                                                    <tr>
                                                        <td>{{ $item->id }}</td>
                                                        <td>{{ $item->chuc_vu?->mo_ta_chuc_vu }}</td>
                                                        <td>{{ $item->ho_ten }}</td>
                                                        <td>{{ $item->email }}</td>
                                                        <td>{{ $item->so_dien_thoai }}</td>
                                                        <td>{!! $item->is_active
                                                            ? '<span class="badge bg-primary">Hiển Thị</span>'
                                                            : '<span class="badge bg-danger">Ẩn</span>' !!}</td>
                                                        <td>
                                                            <a href="{{ route('user.show', $item->id) }}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#myModalnhan{{ $item->id }}">
                                                                <i
                                                                    class="mdi mdi-eye text-muted fs-18 rounded-2 border p-1 me-1"></i>
                                                            </a>

                                                            <!-- Đảm bảo mỗi modal có ID riêng -->
                                                            <div class="modal fade" id="myModalnhan{{ $item->id }}"
                                                                tabindex="-1"
                                                                aria-labelledby="exampleModalLabel{{ $item->id }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">

                                                                        <div class="modal-body">
                                                                            @include('admin.user.show', [
                                                                                'post' => $item,
                                                                            ])
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Đóng</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <a href="{{ route('user.edit', $item->id) }}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#myModalnhanEditL{{ $item->id }}">
                                                                <i
                                                                    class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i>
                                                            </a>
    
                                                            <!-- Đảm bảo mỗi modal có ID riêng -->
                                                            <div class="modal fade" id="myModalnhanEditL{{ $item->id }}"
                                                                tabindex="-1"
                                                                aria-labelledby="exampleModalLabel{{ $item->id }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
    
                                                                        <div class="modal-body">
                                                                            @include('admin.user.edit', [
                                                                                'post' => $item,
                                                                            ])
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Đóng</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="mt-3">
                                        {{ $list->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>




            </div> <!-- container-fluid -->

        </div>
    </div>
@endsection
