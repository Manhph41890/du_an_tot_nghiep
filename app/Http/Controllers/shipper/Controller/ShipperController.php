<?php

namespace App\Http\Controllers\Shipper\Controller;

use App\Http\Controllers\Controller;
use App\Models\DanhGiaShipper;
use App\Models\don_hang;
use App\Models\Shipper;
use App\Models\ShipperProfit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShipperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
                'name' => $user->ho_ten, // Thay bằng tên shipper thực tế
                'phone' => $user->so_dien_thoai, // Thay bằng số điện thoại shipper thực tế
                'status' => 'Đã lấy hàng',
                'don_hang_id' => $donHang->id, // Quan hệ với bảng don_hang
                'chuc_vu_id' => 5, // Thay bằng ID chức vụ thực tế, có thể là giá trị động
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

        if ($status === 'Đã thành công') {
            $donHang = $shipper->donHang;

            $profit = $donHang->tong_tien * 0.04;

            $shipperProfit = ShipperProfit::firstOrCreate(
                ['shipper_id' => $currentShipperId],
                ['total_profit' => 0]
            );

            $shipperProfit->total_profit += $profit;
            $shipperProfit->save();

            $donHang->update(['trang_thai_don_hang' => 'Đã giao']);
        } elseif ($status === 'Đã hủy') {
            $donHang = $shipper->donHang;
            $donHang->update(['trang_thai_don_hang' => 'Đã hủy']);
        }

        $shipper->update(['status' => $status]);

        return response()->json(['success' => true]);
    }
    public function showProfits()
    {
        $shipper = Auth::user();
        $title = "Lợi nhuận";

        $profitHistory = ShipperProfit::with(['donHang' => function ($query) {
            $query->where('status', 'Đã thành công');
        }])
            ->where('shipper_id', auth()->id())
            ->get();

        $totalProfit = $profitHistory->sum('total_profit');

        return view('shipper.profits', [
            'shipper' => $shipper,
            'profitHistory' => $profitHistory,
            'totalProfit' => $totalProfit,
            'title' => $title,
        ]);
    }

    public function storeShipperReview(Request $request, $shipperId)
    {
        // Kiểm tra và xác thực dữ liệu
        $request->validate([
            'diem_so' => 'required|integer|min:1|max:5',
            'binh_luan' => 'nullable|string|max:255',
        ]);

        // Lưu đánh giá cho shipper
        DanhGiaShipper::create([
            'shipper_id' => $shipperId,
            'user_id' => auth()->id(),
            'diem_so' => $request->input('diem_so'),
            'binh_luan' => $request->input('binh_luan'),
        ]);

        return redirect()->back()->with('success', 'Đánh giá đã được gửi!');
    }

    public function policy()
    {
        $title = "Chính sách vận chuyển";


        return view('shipper.policy', compact('title'));
    }
}
