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
                        <h4 class="fs-18 fw-semibold m-0">Danh sách đánh giá</h4>
                    </div>
                </div>

                <!-- Striped Rows -->
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header justify-content-between">

                            <div class="row">
                                <div class="col-4">
                                    <form action="{{ route('danhgia.index') }}" method="GET">
                                        @csrf
                                        <input type="text" id="search_product_name" name="search_product_name"
                                            placeholder="Tìm kiếm sản phẩm" value="{{ request('search_product_name') }}"
                                            class="form-control" onchange="this.form.submit();">
                                    </form>
                                </div>
                                
  
                                <div class="col-3">
                                    <form action="{{ route('danhgia.index') }}" method="GET" id="filter-form">
                                        @csrf
                                        <select class="form-select" name="diem_so" onchange="document.getElementById('filter-form').submit();">
                                            <option value="">Tất cả điểm số</option>
                                            @for ($i = 0; $i <= 10; $i++)
                                                <option value="{{ $i }}" {{ request('diem_so') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </form>
                                </div>
                                

                            </div>

                        </div><!-- end card header -->


                        <div class=" d-flex justify-content-between">
                            <!-- Hiển thị thông báo thành công -->
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissable fade show " role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close justify-content-center" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        </div><!-- end card header -->

                        <div class="row">
                            <div class="card-body">
                                <div class="table-responsive">

                                    <table class="table table-striped mb-0">

                                        <thead>
                                            <tr>
                                                <th scope="col">Id</th>
                                                <th scope="col">ID sản phẩm</th>
                                                <th scope="col">ID user</th>
                                                <th scope="col">Ngày đánh giá</th>
                                                <th scope="col">Điểm số</th>
                                                <th scope="col">Bình luận</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($list as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>{{ $item->san_phams?->ten_san_pham }}</td>
                                                    <td>{{ $item->users?->ho_ten }}</td>
                                                    <td>{{ $item->ngay_danh_gia }}</td>
                                                    <td>{{ $item->diem_so }}</td>
                                                    <td>{{ $item->binh_luan }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
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
