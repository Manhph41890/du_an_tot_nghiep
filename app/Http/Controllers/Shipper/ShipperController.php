<?php

namespace App\Http\Controllers\Shipper;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\don_hang;
use App\Models\Shipper;
use App\Models\Vishipper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
                'ly_do_huy' => '',
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
        $shipper_id = Auth::id();

        // Lấy các shipper với trạng thái "Đã lấy hàng"
        $shippers = Shipper::with('donHang')->where('shipper_id', $shipper_id) // Quan hệ với bảng DonHang
            ->get();
        return view('shipper.show', compact('shippers', 'title', 'shipper_id'));
    }
    public function updateStatus(Request $request, $shipperId)
    {
        $shipper = Shipper::findOrFail($shipperId);
        $status = $request->input('status');
        $lyDoHuy = $request->input('ly_do_huy');
        $currentShipperId = Auth::id();

        if ($status === 'Thành công') {
            $donHang = $shipper->donHang;

            if ($donHang) {
                $profit = $donHang->tong_tien * 0.04;

                // Sử dụng updateOrCreate để cập nhật hoặc tạo mới bản ghi Vishipper
                $vishipper = Vishipper::updateOrCreate(
                    ['shipper_id' => $currentShipperId],
                    ['tong_tien' => DB::raw('tong_tien + ' . $profit)]
                );

                $donHang->update(['trang_thai_don_hang' => 'Đã giao']);
            } else {
                Log::error('DonHang not found for shipper', ['shipper_id' => $currentShipperId]);
            }
        } elseif ($status === 'Thất bại') {
            $donHang = $shipper->donHang;

            if ($donHang) {
                $donHang->update(['trang_thai_don_hang' => 'Thất bại']);
                $shipper->ly_do_huy = $lyDoHuy;
            } else {
                Log::error('DonHang not found for shipper', ['shipper_id' => $currentShipperId]);
            }
        }

        $shipper->update(['status' => $status]);

        return response()->json(['success' => true]);
    }



    public function showProfits()
    {
        $shipperId = Auth::id();
        $title = "Lợi nhuận";
        $shippers = Shipper::where('shipper_id', $shipperId)
            ->where('status', 'Thành công')
            ->orderBy('id', 'desc')->paginate(2);
        $viShipper = Vishipper::where('shipper_id', $shipperId)->first();
        return view('shipper.profits', [
            'shipperId' => $shipperId,
            'title' => $title,
            'viShipper' => $viShipper,
            'shippers' => $shippers
        ]);
    }

    public function policy()
    {
        $title = "Chính sách vận chuyển";
        return view('shipper.policy', compact('title'));
    }

    public function rut()
    {
        $banks = Bank::all();
        $title = 'Rút tiền';
        return view('shipper.rut-tien', compact('banks', 'title'));
    }

    public function withdraw(Request $request)
    {
        $request->validate([
            'bank_id' => 'required|exists:banks,id',
            'amount' => 'required|numeric|min:1',
            'pin' => 'required',
        ]);

        $shipperId = Auth::id();
        $viShipper = Vishipper::where('shipper_id', $shipperId)->first();

        // dd($viNguoiDung->tong_tien);

        if (!$viShipper || $viShipper->tong_tien < $request->amount) {
            return redirect()->back()->with('error', 'Số dư không đủ.');
        }

        // Lấy ngân hàng
        $bank = Bank::findOrFail($request->bank_id);

        // Kiểm tra mã PIN
        if ($bank->pin !== $request->pin) {
            return  redirect()->route('shipper.rut-tien')->with('error', 'Mã PIN không chính xác.');
        }

        // Cập nhật số dư
        $viShipper->tong_tien -= $request->amount;
        $viShipper->save();

        $bank->balance += $request->amount;
        $bank->save();

        return  redirect()->back()->with('success', 'Rút thành công');
    }
}