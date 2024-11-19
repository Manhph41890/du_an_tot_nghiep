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
                                                <th scope="col">Thông tin ngân hàng</th>
                                                <th scope="col">Thời gian</th>
                                                <th scope="col">Số tiền rút</th>
                                                <th scope="col">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($duyetruttien as $item)
                                                <tr>
                                                    <td scope="row">{{ $item->id }}</td>
                                                    <td scope="row">
                                                        {{ $item->vi_nguoi_dung?->user?->ho_ten ?? 'Không có thông tin' }}
                                                    </td>
                                                    <td>
                                                        <div class="col">
                                                            <label
                                                                class="card bank-card p-3 shadow-sm border d-flex flex-column align-items-center text-center"
                                                                style="cursor: pointer;">
                                                                <img src="{{ $item->bank?->img }}"
                                                                    alt="{{ $item->bank?->name }}" class="img-fluid mb-2"
                                                                    style="height: 50px;">
                                                                <span class="fw-bold">{{ $item->bank?->name }}</span>
                                                                <small
                                                                    class="text-muted">{{ $item->bank?->account_number }}</small>
                                                                <h4>{{ $item->bank?->account_holder }}</h4>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>{{ date('d-m-Y H:i:s', strtotime($item->thoi_gian_rut)) }}
                                                    <td>{{ number_format($item->tien_rut, 0, ',', '.') }} VNĐ</td>
                                                    {{-- <td>
                                                    @if ($huyDon->trang_thai == 'Chờ xác nhận hủy')
                                                        <!-- Chỉ hiển thị nút khi trạng thái là "Chờ xác nhận hủy" -->
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#allmyModalXacNhanhuy{{ $huyDon->id }}"
                                                            class="btn btn-info btn-sm">
                                                            Xem và duyệt
                                                        </a>
                                                    @elseif ($huyDon->trang_thai == 'Xác nhận hủy' || $huyDon->trang_thai == 'Từ chối hủy')
                                                        <!-- Nếu đã xác nhận hoặc từ chối hủy -->
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#allmyModalXacNhanhuy{{ $huyDon->id }}"
                                                            class="btn btn-info btn-sm"">Đã duyệt</a>
                                                    @else
                                                        <p>Trạng thái không hợp lệ</p>
                                                    @endif

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="allmyModalXacNhanhuy{{ $huyDon->id }}"
                                                        tabindex="-1" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-xl">
                                                            <!-- Add modal-lg class here -->
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Chi
                                                                        tiết hủy đơn hàng</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    @include('admin.donhang.showhuy', [
                                                                        'huyDat' => $huyDon,
                                                                    ])
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td> --}}
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
