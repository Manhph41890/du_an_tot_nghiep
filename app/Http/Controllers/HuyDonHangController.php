<?php

namespace App\Http\Controllers;

use App\Models\don_hang;
use App\Models\huy_don_hang;
use Illuminate\Http\Request;

class HuyDonHangController extends Controller
{
    public function index()
    {
        // Lấy tất cả các đơn hàng đã hủy
        $huyDons = huy_don_hang::with('don_hang.user')->latest('id')->paginate(6);
        $title = "Danh sách đơn hàng cần xác nhận hủy";
        return view('admin.donhang.xacnhanhuy', compact('huyDons', 'title'));
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'ly_do_huy' => 'required|string|max:100',
            'don_hang_id' => 'required|exists:don_hangs,id', // Kiểm tra nếu don_hang_id có tồn tại
        ]);

        // Lấy thông tin đơn hàng
        $donHang = don_hang::find($request->don_hang_id);

        // Kiểm tra trạng thái đơn hàng
        if (
            $donHang->trang_thai_thanh_toan !== 'Chưa thanh toán' ||
            $donHang->trang_thai_don_hang !== 'Chờ xác nhận'
        ) {
            return redirect()->back()->withErrors([
                'error' => 'Đơn hàng không thể hủy do trạng thái không hợp lệ.',
            ]);
        }

        // Tạo bản ghi trong bảng hủy đơn hàng
        huy_don_hang::create([
            'don_hang_id' => $donHang->id,
            'ly_do_huy' => $request->ly_do_huy,
            'thoi_gian_huy' => now()->setTimezone('Asia/Ho_Chi_Minh'),
            'trang_thai' => 'Chờ xác nhận hủy',
        ]);

        // Trả về thông báo thành công
        return redirect()->back()->with('success', 'Yêu cầu hủy đơn hàng đã được gửi.');
    }
    public function showhuy($id)
    {
        // $donhang = don_hang::with([
        //     'user',
        //     'khuyen_mai',
        //     'phuong_thuc_thanh_toan',
        //     'phuong_thuc_van_chuyen',
        //     'chi_tiet_don_hangs.san_pham',
        //     'chi_tiet_don_hangs.color_san_pham',
        //     'chi_tiet_don_hangs.size_san_pham'
        // ])->findOrFail($id);
        $huyDat = huy_don_hang::with(
            'don_hang.user',
            'don_hang.khuyen_mai',
            'don_hang.phuong_thuc_thanh_toan',
            'don_hang.phuong_thuc_van_chuyen',
            'don_hang.chi_tiet_don_hangs.san_pham',
            'don_hang.chi_tiet_don_hangs.color_san_pham',
            'don_hang.chi_tiet_don_hangs.size_san_pham'
        )->findOrFail($id);;
        $huyDat->donhang->tong_tien = $huyDat->donhang->chi_tiet_don_hangs->sum('thanh_tien');
        // Trả về view cùng với dữ liệu đơn hàng
        return view('admin.donhang.showhuy', compact('huyDat'));
    }

    // Xác nhận hủy đơn hàng (Xác nhận hủy)
    public function confirmCancel($id)
    {
        // Tìm yêu cầu hủy đơn hàng
        $huyDon = huy_don_hang::findOrFail($id);

        // Tìm đơn hàng liên quan
        $donHang = $huyDon->don_hang;

        // Kiểm tra trạng thái của đơn hàng có hợp lệ cho việc xác nhận hủy
        if ($donHang->trang_thai_don_hang !== 'Chờ xác nhận') {
            return redirect()->back()->withErrors([
                'error' => 'Đơn hàng không thể hủy vì trạng thái không hợp lệ.',
            ]);
        }

        // Cập nhật trạng thái yêu cầu hủy thành "Xác nhận hủy"
        $huyDon->update([
            'trang_thai' => 'Xác nhận hủy',
        ]);

        // Cập nhật trạng thái đơn hàng thành "Đã hủy"
        $donHang->update([
            'trang_thai_don_hang' => 'Đã hủy',
        ]);

        // Trả về thông báo thành công
        return redirect()->back()->with('success', 'Đơn hàng đã được xác nhận hủy.');
    }

    // Từ chối hủy đơn hàng (Từ chối hủy)
    public function rejectCancel($id)
    {
        // Tìm yêu cầu hủy đơn hàng
        $huyDon = huy_don_hang::findOrFail($id);

        // Tìm đơn hàng liên quan
        $donHang = $huyDon->don_hang;

        // Kiểm tra trạng thái của đơn hàng có hợp lệ cho việc từ chối hủy
        if ($donHang->trang_thai_don_hang !== 'Chờ xác nhận') {
            return redirect()->back()->withErrors([
                'error' => 'Đơn hàng không thể từ chối hủy vì trạng thái không hợp lệ.',
            ]);
        }

        // Cập nhật trạng thái yêu cầu hủy thành "Từ chối hủy"
        $huyDon->update([
            'trang_thai' => 'Từ chối hủy',
        ]);

        // Trả về thông báo thành công
        return redirect()->back()->with('success', 'Đơn hàng đã bị từ chối hủy.');
    }
}
