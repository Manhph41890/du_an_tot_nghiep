@extends('admin.layout')

@section('css')
@endsection

@section('content')
    <div class="content-page">

        <div class="content">

            <!-- Start Content-->
            <div class="container-xxl">
                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0"> {{ $title }} </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0"></h5>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <form action="{{ route('phuongthucthanhtoans.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                
                                                <label for="kieu_thanh_toan" class="form-label">Kiểu thanh toán </label>
                                                <select type="text" id="kieu_thanh_toan" name="kieu_thanh_toan"
                                                    class="form-select @error('kieu_thanh_toan') is-invalid @enderror"
                                                    value="{{ old('kieu_thanh_toan') }}">
                                                    
                                                    <option selected>Chọn phương thức thanh toán</option>
                                                    <option value="1">Thanh toán khi nhận hàng</option>
                                                    <option value="2">Thanh toán Online</option>
                                                </select>
                                                @error('kieu_thanh_toan')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container-fluid -->
@endsection


