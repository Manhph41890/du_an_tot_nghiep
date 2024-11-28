<?php

namespace App\Http\Controllers\Shipper;

use App\Http\Controllers\Controller;
use App\Models\don_hang;
use App\Models\Shipper;
use App\Models\Vishipper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShipperController extends Controller
{
    public function index()
    {
        //
        $title = "Vận chuyển đơn hàng";
        // Lấy tất cả đơn hàng có trạng thái 'Đang chuẩn bị hàng'
        $donHangs = don_hang::where('trang_thai_don_hang', 'Đang chuẩn bị hàng')->get();
        return view('shipper.index', compact('donHangs', 'title'));
    }
    public function xacNhanLayDon(don_hang $donHang)
    {
        // Kiểm tra nếu trạng thái là "Đang chuẩn bị hàng" thì thay đổi trạng thái thành "Đã lấy hàng"
        if ($donHang->trang_thai_don_hang == 'Đang chuẩn bị hàng') {
            $donHang->update([
                'trang_thai_don_hang' => 'Đang vận chuyển',
            ]);
            $user = Auth::user(); // Lấy người dùng hiện tại
            // Insert vào bảng shippers
            Shipper::create([
                'status' => 'Đã lấy hàng',
                'shipper_id' => $user->id,
                'don_hang_id' => $donHang->id, // Quan hệ với bảng don_hang
            ]);
        }
        // Trả về phản hồi
        return response()->json([
            'message' => 'Trạng thái đơn hàng đã được cập nhật và shipper đã được thêm.',
            'status' => 'success'
        ]);
    }
    public function show()
    {
        $title = "Đơn hàng đã lấy hàng";
        // Lấy các shipper với trạng thái "Đã lấy hàng"
        $shippers = Shipper::with('donHang') // Quan hệ với bảng DonHang
            ->get();
        return view('shipper.show', compact('shippers', 'title'));
    }
    public function updateStatus(Request $request, $shipperId)
    {
        $shipper = Shipper::findOrFail($shipperId);
        $status = $request->input('status');
        $currentShipperId = Auth::id();


        if ($status === 'Thành công') {
            $donHang = $shipper->donHang;
            $profit = $donHang->tong_tien * 0.04;
            $vishipper = Vishipper::firstOrCreate(
                ['shipper_id' => $currentShipperId],
                ['tong_tien' => 0]
            );
            $vishipper->tong_tien += $profit;
            $vishipper->save();
            $donHang->update(['trang_thai_don_hang' => 'Đã giao']);
        } elseif ($status === 'Đã hủy') {
            $donHang = $shipper->donHang;
            $donHang->update(['trang_thai_don_hang' => 'Thất bại']);
        }
        $shipper->update(['status' => $status]);
        return response()->json(['success' => true]);
    }
}