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
                    <form method="post" action="{{ route('duyetruttienAdmin') }}" class="d-flex">
                        @csrf
                        @method('GET')
                        <input type="text" name="search_ten_nguoi_dung" class="form-control me-2"
                            placeholder="Tìm tài khoản..." value="{{ request('search_ten_nguoi_dung') }}">
                        <select name="search_duyetrut" class="form-select me-2">
                            <option value="">Chọn</option>
                            <option value="Chờ duyệt" {{ request('search_duyetrut') == 'Chờ duyệt' ? 'selected' : '' }}>Chờ
                                duyệt</option>
                            <option value="Thành công" {{ request('search_duyetrut') == 'Thành công' ? 'selected' : '' }}>
                                Thành công</option>
                            <option value="Thất bại" {{ request('search_duyetrut') == 'Thất bại' ? 'selected' : '' }}>Thất
                                bại</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Tìm</button>
                    </form>
                </div>
                <div class="col-xl-12">
                    <div class="card">
                        <div class="row">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">#ID</th>
                                                <th scope="col">Người rút</th>
                                                <th scope="col">Thông giao dịch</th>
                                                <th scope="col">Thời gian rút tiền</th>
                                                <th scope="col">Số tiền rút</th>
                                                <th scope="col">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($duyetruttien as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>
                                                        {{ $item->vi_nguoi_dung?->user?->ho_ten ?? 'Không có thông tin' }}
                                                    </td>
                                                    <td>
                                                        {{-- <a class="btn btn-success" data-bs-dismiss="modal">Xem chi tiết </a> --}}
                                                        <a type="button" class="btn btn-success"
                                                            href="{{ route('thongTinRut', $item->id) }}">
                                                            Xem chi tiết
                                                        </a>
                                                    </td>
                                                    <td>{{ date('d-m-Y H:i:s', strtotime($item->thoi_gian_rut)) }}
                                                    <td>{{ number_format($item->tien_rut, 0, ',', '.') }} VNĐ</td>
                                                    <td>

                                                        <form action="{{ route('duyetRutAdmin', $item->id) }}"
                                                            class="mb-2" method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            @if ($item->trang_thai === 'Chờ duyệt')
                                                                <button type="submit"
                                                                    class="btn btn-info btn-sm">Duyệt</button>
                                                            @elseif ($item->trang_thai === 'Thành công')
                                                                <button type="button" class="btn btn-success btn-sm"
                                                                    disabled>Đã duyệt</button>
                                                            @elseif ($item->trang_thai === 'Thất bại')
                                                                <button title="Click vào để xem" type="button"
                                                                    class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                                    data-bs-target="#rejectReasonModal">
                                                                    Xem lý do hủy
                                                                </button>
                                                            @endif
                                                        </form>
                                                        <div class="modal fade" id="rejectReasonModal" tabindex="-1"
                                                            aria-labelledby="rejectReasonModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-danger text-white">
                                                                        <h5 class="modal-title" id="rejectReasonModalLabel">
                                                                            Lý do từ chối rút tiền</h5>
                                                                        <button type="button"
                                                                            class="btn-close btn-close-white"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="alert alert-warning" role="alert">
                                                                            <strong>Lý do:</strong>
                                                                            <p>{{ $item->noi_dung_tu_choi }}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Đóng</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <form action="{{ route('HuyRutAdmin', $item->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('PUT')

                                                            @if ($item->trang_thai === 'Chờ duyệt')
                                                                <button type="button" class="btn btn-danger btn-sm"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#myModal{{ $item->id }}">
                                                                    Từ chối
                                                                </button>
                                                            @endif

                                                            <!-- Modal -->
                                                            <div class="modal" id="myModal{{ $item->id }}">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">

                                                                        <!-- Modal Header -->
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Lý do từ chối</h4>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"></button>
                                                                        </div>

                                                                        <!-- Modal Body -->
                                                                        <div class="modal-body">
                                                                            <textarea class="form-control  @error('noi_dung_tu_choi') is-invalid @enderror" rows="5" name="noi_dung_tu_choi"
                                                                                value="{{ old('noi_dung_tu_choi') }}"" placeholder="Nội dung..."></textarea>
                                                                            @error('noi_dung_tu_choi')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>

                                                                        <!-- Modal Footer -->
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Đóng</button>
                                                                            <!-- Nút Submit đúng kiểu -->
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Xác nhận</button>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>

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
@endsection
