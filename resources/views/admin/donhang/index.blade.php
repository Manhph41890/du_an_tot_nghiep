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
                        <h4 class="fs-18 fw-semibold m-0"></h4>
                    </div>
                </div>
                <!-- Striped Rows -->
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <div class="row">
                                <div class="col-2">
                                    <a href="{{ route('danhmucs.create') }}" class="btn btn-success">Tạo Mới</a>
                                </div>
                                <div class="col-3">
                                    <form action="{{ route('danhmucs.index') }}" method="GET">
                                        @csrf
                                        <input type="text" id="search_ten_danh_muc" name="search_ten_danh_muc"
                                            placeholder="Tìm kiếm" value="{{ request('search_ten_danh_muc') }}"
                                            class="form-control" onchange="this.form.submit();">
                                    </form>
                                </div>

                                <div class="col-4">
                                    @if (Session::has('success'))
                                        <script>
                                            toastr.options = {
                                                'progressBar': true,
                                                'closeButton': true
                                            }
                                            toastr.success("{{ Session::get('success') }}", {
                                                timeOut: 3000
                                            });
                                        </script>
                                    @endif
                                    @if (Session::has('error'))
                                        <script>
                                            toastr.options = {
                                                'progressBar': true,
                                                'closeButton': true
                                            }
                                            toastr.error("{{ Session::get('error') }}", {
                                                timeOut: 3000
                                            });
                                        </script>
                                    @endif
                                </div>
                            </div>
                        </div><!-- end card header -->
                        <div class="row">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>User ID</th>
                                                    <th>Sản phẩm ID</th>
                                                    <th>Phương thức thanh toán ID</th>
                                                    <th>Phương thức vận chuyển ID</th>
                                                    <th>Tổng tiền</th>
                                                    <th>Họ tên</th>
                                                    <th>Email</th>
                                                    <th>Số điện thoại</th>
                                                    <th>Địa chỉ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($donhangs as $item)
                                                    <tr>
                                                        <td>{{ optional($item->user)->id ?? 'Null' }}</td>
                                                        <td>{{ $item->san_pham_id ?? 'Null' }}</td>
                                                        <td>{{ $item->phuong_thuc_thanh_toan_id ?? 'Null' }}</td>
                                                        <td>{{ $item->phuong_thuc_van_chuyen_id ?? 'Null' }}</td>
                                                        <td>{{ $item->tong_tien ?? 'Null' }}</td>
                                                        <td>{{ $item->ho_ten ?? 'Null' }}</td>
                                                        <td>{{ $item->email ?? 'Null' }}</td>
                                                        <td>{{ $item->so_dien_thoai ?? 'Null' }}</td>
                                                        <td>{{ $item->dia_chi ?? 'Null' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </table>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row p-2">
                            {{ $danhmucs->links() }}
                        </div> --}}
                    </div>
                </div>
            </div> <!-- container-fluid -->
        </div>
    </div>

@section('js')
    <!-- Include your JS files here -->
@endsection
@endsection
