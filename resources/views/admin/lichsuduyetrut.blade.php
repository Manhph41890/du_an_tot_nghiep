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
                                                    <td>
                                                        <form action="{{ route('duyetRutAdmin', $item->id) }}" method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            @if ($item->trang_thai === 'Chờ duyệt')
                                                                <button type="submit"
                                                                    class="btn btn-info btn-sm">Duyệt</button>
                                                            @else
                                                                <button type="button" class="btn btn-success btn-sm"
                                                                    disabled>Đã duyệt</button>
                                                            @endif
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
