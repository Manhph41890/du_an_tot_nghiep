@extends('client.layout')

@section('content')
    <div class="container">
        <h2>Cảm ơn bạn đã đặt hàng!</h2>
        <p>Đơn hàng của bạn đã được đặt thành công. Bạn sẽ nhận được email xác nhận trong thời gian sớm nhất.</p>
        <a href="{{ route('home') }}" class="btn btn-primary">Tiếp tục mua sắm</a>
    </div>
@endsection
