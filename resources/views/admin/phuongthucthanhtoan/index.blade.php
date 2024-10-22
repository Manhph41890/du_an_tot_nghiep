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

                        <div class="card-header d-flex justify-content-between">
                            @if ($isAdmin)
                                
                           
                            <div>
                                <a href="{{ route('phuongthucthanhtoans.create') }}" class="btn btn-success">Thêm Phương Thức Thanh Toán</a>
                            </div>
                            @endif
                            <!-- Hiển thị thông báo thành công -->
                            @if (session('success'))
                                <div class="alert-dismissable alert alert-success  fade show " role="alert">
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
                                                <th scope="col">STT</th>
                                                <th scope="col">Kiểu thanh toán</th>
                                                @if($isAdmin)
                                                <th scope="col">Hành Động </th>
                                                @endif
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($phuongthucthanhtoans as $index => $item)
                                                <tr>
                                                    <th scope="row">{{ $index + 1 }}</th>
                                                    <td>{{ $item->kieu_thanh_toan }}</td>
                                                    
                                                    <td>
                                                        @if ($isAdmin)
                                                        <a href="{{ route('phuongthucthanhtoans.edit', $item->id) }}"><i
                                                                class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i></a>
                                                        <form action="{{ route('phuongthucthanhtoans.destroy', $item->id) }}"
                                                            method="POST" style="display:inline;"
                                                            onsubmit="return confirm ('Bạn có muốn xóa phương thức thanh toán này không ?') ">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" style="border: none; background: none;">
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


                        </div>

                        {{ $phuongthucthanhtoans->links() }}
                    </div>

                </div>


            </div> <!-- container-fluid -->

        </div>
    </div>

@section('js')
    <!-- Include your JS files here -->
@endsection
@endsection
