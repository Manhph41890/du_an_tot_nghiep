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
                                    <form action="{{ route('danhgia.index') }}" method="POST">
                                        @csrf
                                        @method('GET')
                                        <input type="text" id="search_product_name" name="search_product_name"
                                            placeholder="Tìm kiếm sản phẩm" value="{{ request('search_product_name') }}"
                                            class="form-control" onchange="this.form.submit();">
                                    </form>
                                </div>
                                
  
                                <div class="col-3">
                                    <form action="{{ route('danhgia.index') }}" method="POST" id="filter-form">
                                        @csrf
                                        @method('GET')
                                        <select class="form-select" name="diem_so" onchange="document.getElementById('filter-form').submit();">
                                            <option value="">Tất cả điểm số</option>
                                            @for ($i = 1; $i <= 5; $i++)
                                                <option value="{{ $i }}" {{ request('diem_so') == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </form>
                                </div>
                                

                            </div>

                        </div><!-- end card header -->



                        <div class="row">
                            <div class="card-body">
                                <div class="table-responsive">

                                    <table class="table table-striped mb-0">

                                        <thead>
                                            <tr>
                                                <th scope="col">Id</th>
                                                <th scope="col">Tên sản phẩm</th>
                                                <th scope="col">Tên người dùng</th>
                                                <th scope="col">Ngày đánh giá</th>
                                                <th scope="col">Điểm số</th>
                                                {{-- <th scope="col">Bình luận</th> --}}
                                                <th scope="col">Thao tác</th>
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
                                                {{-- <td>{{ $item->binh_luan }}</td> --}}
                                                <td>
                                                    <div>
                                                        <!-- Thay đổi data-bs-target để tương ứng với ID của item -->
                                                        <a href="{{ route('danhgia.show', $item->id) }}" data-bs-toggle="modal" data-bs-target="#myModal{{ $item->id }}">
                                                            <i class="mdi mdi-eye text-muted fs-18 rounded-2 border p-1 me-1"></i>
                                                        </a>
                                        
                                                        <!-- Đảm bảo mỗi modal có ID riêng -->
                                                        <div class="modal fade" id="myModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $item->id }}" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    {{-- <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel{{ $item->id }}">Chi tiết đánh giá</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div> --}}
                                                                    <div class="modal-body">
                                                                        @include('admin.danhgia.show', ['post' => $item])
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
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
