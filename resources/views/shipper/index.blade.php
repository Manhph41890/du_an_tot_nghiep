@extends('shipper.layout')

@section('content')
    <style>
        /* Tổng thể */
        .container {
            margin-top: 20px;
        }

        /* Card */
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-body {
            background-color: #f8f9fa;
            padding: 20px;
        }

        .card h2 {
            color: #333;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Bảng */
        .table {
            margin-top: 20px;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table-bordered {
            border: 1px solid #ddd;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f2f2f2;
        }

        .table-striped tbody tr:hover {
            background-color: #e9ecef;
        }

        .table thead {
            background: #343a40;
            color: #fff;
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
            padding: 15px;
            font-size: 16px;
        }

        .table th {
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Nút */
        .confirm-order {
            padding: 8px 12px;
            font-size: 14px;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
        }

        .confirm-order.btn-primary {
            background-color: #007bff;
            border: none;
        }

        .confirm-order.btn-primary:hover {
            background-color: #0056b3;
        }

        .confirm-order.btn-success {
            background-color: #28a745;
            border: none;
            cursor: default;
        }

        .confirm-order.btn-success:hover {
            background-color: #28a745;
        }

        /* Hiệu ứng */
        .card-body {
            animation: fadeIn 0.5s ease-in-out;
        }

        .animate-shake {
            display: inline-block;
            animation: shake 0.5s ease-in-out infinite;
        }


        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <div class="content-page">
        <div class="content">
            <div class="container">

                <!-- Striped Rows -->
                <div class="col-xl-12">
                    <div class="card">
                        <div class="row">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <h2 class="text-center mt-50 mb-4 ">Đơn hàng đang chuẩn bị hàng</h2>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped text-center">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Mã đơn hàng</th>
                                                    <th>Ngày tạo</th>
                                                    <th>Trạng thái</th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($donHangs as $donHang)
                                                    <tr id="order-{{ $donHang->id }}">
                                                        <td>{{ $donHang->ma_don_hang }}</td>
                                                        <td>{{ optional($donHang->created_at)->format('d/m/Y H:i:s') }}</td>
                                                        <td>{{ $donHang->trang_thai_don_hang }}</td>
                                                        <td>
                                                            <button class="btn btn-primary confirm-order"
                                                                data-id="{{ $donHang->id }}">Xác nhận lấy đơn</button>
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
                </div>


            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Xử lý sự kiện khi bấm nút "Xác nhận lấy đơn"
            $('.confirm-order').click(function() {
                var donHangId = $(this).data('id'); // Lấy ID đơn hàng
                var button = $(this); // Lấy nút bấm

                $.ajax({
                    url: '/shipper/xac-nhan-lay-don/' + donHangId, // Đường dẫn đến controller
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // CSRF token
                    },
                    success: function(response) {
                        // Thông báo thành công và cập nhật trạng thái
                        alert(response.message);

                        // Cập nhật trạng thái đơn hàng
                        $('#order-' + donHangId).find('td:eq(2)').text('Đã lấy hàng');

                        // Thay đổi màu nút và nội dung
                        button.removeClass('btn-primary').addClass('btn-success');
                        button.text('Đã lấy hàng');
                    },
                    error: function() {
                        alert('Có lỗi xảy ra, vui lòng thử lại!');
                    }
                });
            });
        });
    </script>
@endsection
