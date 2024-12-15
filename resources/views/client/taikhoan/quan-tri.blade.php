@extends('client.taikhoan.dashboard')

@section('conten-taikhoan')
    <div class="">
        <div class="myaccount-content">
            <h3>Quản trị</h3>

            <div class="welcome mb-20 d-flex">
                <h5><strong>Vào trang quản trị với chức vụ là:<h4 class="badge bg-primary ms-3 h3">
                            {{ $user->chuc_vu?->ten_chuc_vu }}</h4></strong></h5>
            </div>
            <a href="{{ route('thong_ke_chung') }}" class="btn btn-success">Vào quản trị</a>

        </div>
    </div>
@endsection
