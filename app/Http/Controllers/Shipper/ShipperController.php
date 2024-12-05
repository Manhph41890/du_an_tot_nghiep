<?php

namespace App\Http\Controllers\Shipper;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\don_hang;
use App\Models\san_pham;
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
        $title = 'Vận chuyển đơn hàng';

        // Lấy thông tin shipper đang đăng nhập
        $shipper = Auth::user();

        //
        $shipper_address = $shipper->dia_chi;
        // dd($shipper_address);
        $shipper_address_parts = array_map('trim', explode(',', $shipper_address));

        $shipper_ward = isset($shipper_address_parts[2]) ? $shipper_address_parts[2] : '';
        $shipper_district = isset($shipper_address_parts[3]) ? $shipper_address_parts[3] : '';
        $shipper_city = isset($shipper_address_parts[4]) ? $shipper_address_parts[4] : '';
        // Lấy tất cả đơn hàng có trạng thái 'Đang chuẩn bị hàng'
        $donHangs = don_hang::where('trang_thai_don_hang', 'Đang chuẩn bị hàng')->get();

        // Lọc đơn hàng theo địa chỉ của shipper
        $filteredOrders = $donHangs->filter(function ($order) use ($shipper_district, $shipper_ward, $shipper_city) {
            $addressParts = array_map('trim', explode(',', $order->dia_chi));

            $order_ward = isset($addressParts[2]) ? $addressParts[2] : '';
            $order_district = isset($addressParts[3]) ? $addressParts[3] : '';
            $order_city = isset($addressParts[4]) ? $addressParts[4] : '';
            return $order_district == $shipper_district && ($order_ward == $shipper_ward && $order_city == $shipper_city);
        });

        return view('shipper.index', ['donHangs' => $filteredOrders, 'title' => $title]);
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
            'status' => 'success',
        ]);
    }
    public function show()
    {
        $title = 'Đơn hàng đã lấy hàng';
        $shipper_id = Auth::id();

        // Lấy các shipper với trạng thái "Đã lấy hàng"
        $shippers = Shipper::with('donHang')
            ->where('shipper_id', $shipper_id) // Quan hệ với bảng DonHang
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
                $profit = 30000 * 0.2; //
                // Sử dụng updateOrCreate để cập nhật hoặc tạo mới bản ghi Vishipper
                $vishipper = Vishipper::updateOrCreate(['shipper_id' => $currentShipperId], ['tong_tien' => DB::raw('tong_tien + ' . $profit)]);

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

            // Khôi phục số lượng sản phẩm trong kho và biến thể sản phẩm
            foreach ($donHang->chi_tiet_don_hangs as $item) {
                $variant = $item->san_pham
                    ->bien_the_san_phams()
                    ->where('color_san_pham_id', $item->color_san_pham_id)
                    ->where('size_san_pham_id', $item->size_san_pham_id)
                    ->first();

                if ($variant) {
                    // Tăng lại số lượng của biến thể sản phẩm
                    $variant->so_luong += $item->so_luong;
                    $variant->save();
                }

                $product = san_pham::find($item->san_pham_id);
                if ($product) {
                    // Tăng lại số lượng sản phẩm trong kho
                    $product->so_luong += $item->so_luong;
                    $product->save();
                }
            }
        }

        $shipper->update(['status' => $status]);

        return response()->json(['success' => true]);
    }

    public function showProfits()
    {
        $shipperId = Auth::id();
        $title = 'Lợi nhuận';
        $shippers = Shipper::where('shipper_id', $shipperId)->where('status', 'Thành công')->orderBy('id', 'desc')->paginate(2);
        $viShipper = Vishipper::where('shipper_id', $shipperId)->first();
        return view('shipper.profits', [
            'shipperId' => $shipperId,
            'title' => $title,
            'viShipper' => $viShipper,
            'shippers' => $shippers,
        ]);
    }

    public function policy()
    {
        $title = 'Chính sách vận chuyển';
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
            return redirect()->route('shipper.rut-tien')->with('error', 'Mã PIN không chính xác.');
        }

        // Cập nhật số dư
        $viShipper->tong_tien -= $request->amount;
        $viShipper->save();

        $bank->balance += $request->amount;
        $bank->save();

        return redirect()->back()->with('success', 'Rút thành công');
    }
}
