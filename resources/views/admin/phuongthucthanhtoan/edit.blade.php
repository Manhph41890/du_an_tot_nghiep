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
                                <form action="{{ route('phuongthucthanhtoans.update', $phuong_thuc_thanh_toan->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="kieu_thanh_toan" class="form-label">Kiểu thanh toán</label>
                                                <select type="text" id="kieu_thanh_toan" name="kieu_thanh_toan"
                                                    class="form-select @error('kieu_thanh_toan') is-invalid @enderror"
                                                    value="{{ old('kieu_thanh_toan', $phuong_thuc_thanh_toan->kieu_thanh_toan) }}">

                                                    <option value="Thanh toán khi nhận hàng" {{ $phuong_thuc_thanh_toan->kieu_thanh_toan == 'Thanh toán khi nhận hàng' ? 'selected' : '' }}>Thanh toán khi nhận hàng</option>
                                                    <option value="Thanh toán online" {{ $phuong_thuc_thanh_toan->kieu_thanh_toan == 'Thanh toán online' ? 'selected' : '' }}>Thanh toán online</option>
                                                
                                                </select>
                                                @error('kieu_thanh_toan')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                       
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary">Cập nhật</button>
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

@section('js')
@endsection
