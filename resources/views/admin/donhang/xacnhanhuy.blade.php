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
                    {{-- <form method="post" action="{{ route('danhmucs.index') }}" class="d-flex">
                        @csrf
                        @method('GET')
                        <input type="text" name="search_ten_danh_muc" class="form-control me-2"
                            placeholder="Tìm danh mục..." value="{{ request('search_ten_danh_muc') }}">
                        <select name="search_dm" class="form-select me-2">
                            <option value="">Hiển thị tất cả</option>
                            <option value="0" {{ request('search_dm') == '0' ? 'selected' : '' }}>Hiển thị</option>
                            <option value="1" {{ request('search_dm') == '1' ? 'selected' : '' }}>Ẩn</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Tìm</button>
                    </form> --}}
                </div>
                <div class="col-xl-12">
                    <div class="card">
                        {{-- <div class="card-header justify-content-between">
                            <div class="row">
                                <div class="col-2">
                                    @if ($isAdmin)
                                        <a href="{{ route('danhmucs.create') }}" class="btn btn-success">Tạo Mới</a>
                                    @endif
                                </div>
                            </div>
                        </div><!-- end card header --> --}}
                        <div class="row">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">#ID</th>
                                                <th scope="col">ID đơn hàng</th>
                                                <th scope="col">Tên khách hàng</th>
                                                <th scope="col">Thời gian</th>
                                                <th scope="col">Trạng Thái</th>
                                                <th scope="col">Chi tiết huỷ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($huyDons as $index => $huyDon)
                                                <tr>
                                                    <th scope="row">{{ $huyDon->id }}</th>
                                                    <td>{{ $huyDon->don_hang_id }}</td>
                                                    <td>{{ $huyDon->don_hang->user->ho_ten ?? 'Không xác định' }}</td>
                                                    <td>{{ $huyDon->thoi_gian_huy }}</td>
                                                    <td>{{ $huyDon->trang_thai }}</td>
                                                    <td>
                                                        @if ($huyDon->trang_thai == 'Chờ xác nhận hủy')
                                                            <a href="#" data-bs-toggle="modal"
                                                                data-bs-target="#allmyModalXacNhanhuy{{ $huyDon->id }}">
                                                                <a href="{{ route('huy-don-hang', $huyDon->id) }}"
                                                                    class="btn btn-info btn-sm">Xem và
                                                                    duyệt</a>
                                                            </a>
                                                        @elseif ($huyDon->trang_thai == 'Xác nhận hủy' || $huyDon->trang_thai == 'Từ chối hủy')
                                                            <a href="{{ route('huy-don-hang', $huyDon->id) }}"
                                                                class="btn btn-info btn-sm">Đã duyệt</a>
                                                        @else
                                                            <p>Trạng thái không hợp lệ</p>
                                                        @endif
                                                        <!-- The Modal -->
                                                        <div class="modal" id="allmyModalXacNhanhuy{{ $huyDon->id }}">
                                                            @include('admin.donhang.showhuy', [
                                                                'donhang' => $huyDon,
                                                            ])
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row p-2">
                            {{-- {{ $danhmucs->links() }} --}}
                        </div>
                    </div>
                </div>
            </div> <!-- container-fluid -->
        </div>
    </div>

@section('js')
@endsection
@endsection
