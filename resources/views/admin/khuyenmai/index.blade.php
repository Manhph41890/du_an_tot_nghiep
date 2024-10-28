@extends('admin.layout')


@section('css')
@endsection

@section('content')
    <div class="content-page">
        <div class="content">
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
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header ">
                            <div class="row align-items-center">
                                @if ($isAdmin)
                                    <div class="col-2">
                                        <a href="{{ route('khuyenmais.create') }}" class="btn btn-success">Thêm mã khuyến
                                            mãi
                                        </a>
                                    </div>
                                @endif
                                <div class="col-10">
                                    <form action="{{ route('khuyenmais.index') }}" method="POST" id="filter-form-km">
                                        @csrf
                                        @method('GET')
                                        <div class="form-group d-flex align-items-end gap-3">
                                            <div>
                                                <input class="form-control" value="{{ request()->search_km }}"
                                                    type="text" name="search_km" id="search_km"
                                                    placeholder="Tìm kiếm theo mã">
                                            </div>
                                            <div>
                                                <input class="form-control" type="date" name="start_date" id="start_date"
                                                    value="{{ request()->start_date }}">
                                            </div>
                                            <div>
                                                <input class="form-control" type="date" name="end_date" id="end_date"
                                                    value="{{ request()->end_date }}">
                                            </div>
                                            <div>
                                                <select class="form-select" id="trang_thai" name="trang_thai">
                                                    <option value="">Tất cả</option>
                                                    <option value="0"
                                                        {{ request('trang_thai') == '0' ? 'selected' : '' }}>Đang hoạt động
                                                    </option>
                                                    <option value="1"
                                                        {{ request('trang_thai') == '1' ? 'selected' : '' }}>Hết hạn
                                                    </option>
                                                </select>
                                            </div>
                                            <button class="btn btn-success">Lọc</button>
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
                                                    <td>
                                                        @php
                                                            $tong_tien = $khuyenMai->gia_tri_khuyen_mai;
                                                            if (intval($tong_tien) == $tong_tien) {
                                                                echo number_format($tong_tien, 0, ',', '.');
                                                            } elseif (floor($tong_tien) == $tong_tien) {
                                                                echo number_format($tong_tien, 0, ',', '.');
                                                            } else {
                                                                echo number_format($tong_tien, 2, ',', '.');
                                                            }
                                                        @endphp
                                                        đ
                                                    </td>
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
                                                                onsubmit="return confirm ('Bạn có muốn xóa mã khuyến mãi này không ?') ">
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
   @vite('resources/js/voucher.js')
@section('js')
  
     <!-- Include Pusher JS library -->
     <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
     <script>
         // Enable pusher logging - don't include this in production
         Pusher.logToConsole = true;
 
         var pusher = new Pusher('ceead74684be5e1955f8', {
             cluster: 'ap1',
             encrypted: true
         });
 
         var channel = pusher.subscribe('my-channel');
         channel.bind('my-event', function(data) {
             // Reload the page or update the table with new data
             alert('New promotion code added or updated: ' + data.message);
             location.reload(); // Optional: reload the page
         });
     </script>
@endsection
@endsection
