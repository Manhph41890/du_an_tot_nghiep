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
                        <h4 class="fs-18 fw-semibold m-0">{{ $title }}</h4>
                    </div>
                </div>

                <!-- Striped Rows -->
                <div class="col-xl-12">
                    <div class="card">

                        <div class="card-header justify-content-between">

                            <div class="row">

                                <div class="col-3">
                                    <a href="{{ route('chucvus.create') }}" class="btn btn-success">Thêm Chức Vụ</a>
                                </div>

                                <div class="col-9">
                                    <!-- Hiển thị thông báo thành công -->
                                    @if (session('success'))
                                        <div class="alert alert-success d-flex justify-content-between mb-0" role="alert">
                                            {{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
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
                                                <th scope="col">Tên chức vụ</th>
                                                <th scope="col">Mô tả chức vụ</th>
                                                <th scope="col">Hành Động </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($chucvus as $index => $item)
                                                <tr>
                                                    <th scope="row">{{ $index + 1 }}</th>
                                                    <td>{{ $item->ten_chuc_vu }}</td>
                                                    <td>{{ $item->mo_ta_chuc_vu }}</td>
                                                    <td>
                                                        <a href="{{ route('chucvus.edit', $item->id) }}"><i
                                                                class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i></a>
                                                        <form action="{{ route('chucvus.destroy', $item->id) }}"
                                                            method="POST" style="display:inline;"
                                                            onsubmit="return confirm ('Bạn có muốn xóa danh mục sản phẩm này không ?') ">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" style="border: none; background: none;">
                                                                <i
                                                                    class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>


                        </div>

                        {{ $chucvus->links() }}
                    </div>

                </div>


            </div> <!-- container-fluid -->

        </div>
    </div>

@section('js')
    <!-- Include your JS files here -->
@endsection
@endsection
