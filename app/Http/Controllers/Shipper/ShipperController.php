<?php

namespace App\Http\Controllers\Shipper;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBankRequest;
use App\Models\Bank;
use App\Models\don_hang;
use App\Models\san_pham;
use App\Models\Shipper;
use App\Models\User;
use App\Models\Vishipper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ShipperController extends Controller
{
    public function parseAddress($address)
    {
        $parts = array_map('trim', explode(',', $address));
        $numParts = count($parts);

        return [
            'detail' => $numParts > 4 ? $parts[$numParts - 5] : '',
            'ward' => $numParts > 3 ? $parts[$numParts - 4] : '',
            'district' => $numParts > 2 ? $parts[$numParts - 3] : '',
            'city' => $numParts > 1 ? $parts[$numParts - 2] : '',
            'province' => $numParts > 0 ? $parts[$numParts - 1] : '',
        ];
    }

    public function index()
    {
        $title = 'Vận chuyển đơn hàng';

        // Lấy thông tin shipper đang đăng nhập
        $shipper = Auth::user();

        // Parse shipper address
        $parsed_shipper_address = $this->parseAddress($shipper->dia_chi);

        // Lấy tất cả đơn hàng có trạng thái 'Đang chuẩn bị hàng'
        $donHangs = don_hang::where('trang_thai_don_hang', 'Đang chuẩn bị hàng')->get();

        // Lọc đơn hàng theo địa chỉ của shipper
        $filteredOrders = $donHangs->filter(function ($order) use ($parsed_shipper_address) {
            $parsed_order_address = $this->parseAddress($order->dia_chi);

            // Compare parsed addresses
            return $parsed_order_address['province'] === $parsed_shipper_address['province'];
        });

        return view('shipper.index', ['donHangs' => $filteredOrders, 'title' => $title]);
    }

    public function xacNhanLayDon(don_hang $donHang)
    {
        $user = Auth::user(); // Lấy shipper hiện tại

        // Kiểm tra nếu shipper đã có đơn hàng 'Đang vận chuyển'
        // $existingOrder = Shipper::where('shipper_id', $user->id)
        //     ->where('status', 'Đã lấy hàng')
        //     ->first();

        // if ($existingOrder) {
        //     return response()->json([
        //         'message' => 'Bạn đã xác nhận một đơn hàng khác.',
        //         'status' => 'error',
        //     ]);
        // }

        // Kiểm tra nếu trạng thái đơn hàng là "Đang chuẩn bị hàng"
        if ($donHang->trang_thai_don_hang == 'Đang chuẩn bị hàng') {
            $donHang->update([
                'trang_thai_don_hang' => 'Đang vận chuyển',
            ]);

            // Insert vào bảng shippers
            Shipper::create([
                'status' => 'Đã lấy hàng',
                'ly_do_huy' => '',
                'shipper_id' => $user->id,
                'don_hang_id' => $donHang->id, // Quan hệ với bảng don_hang
            ]);

            return response()->json([
                'message' => 'Trạng thái đơn hàng đã được cập nhật và shipper đã được thêm.',
                'status' => 'success',
            ]);
        }

        return response()->json([
            'message' => 'Không thể xác nhận đơn hàng này.',
            'status' => 'error',
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
        $request->validate([
            'image_path' => 'image|mimes:jpeg,png,jpg|max:2048', // Optional image validation
        ]);
        $shipper = Shipper::findOrFail($shipperId);
        $status = $request->input('status');
        $lyDoHuy = $request->input('ly_do_huy');
        $currentShipperId = Auth::id();

        if ($status === 'Thành công') {
            $donHang = $shipper->donHang;
            // Image upload handling
            if ($request->hasFile('image_path')) {
                $imagePath = $request->file('image_path')->store('delivery_proofs', 'public');
                $shipper->image_path = $imagePath;
            }
            if ($donHang) {
                $profit = $donHang->tong_tien * 0.04;

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
        $user = Auth::id();
        $banks = Bank::where('user_id', $user)->get();

        $viShipperId = DB::table('vi_shippers')->where('shipper_id', $user)->value('id');

        $pendingWithdrawal = DB::table('ls_rut_shippers')->where('vi_shipper_id', $viShipperId)->where('trang_thai', 'Chờ xử lý')->exists();
        $title = 'Rút tiền';

        // Truyền biến pendingWithdrawal vào view
        return view('shipper.rut-tien', compact('banks', 'title', 'pendingWithdrawal'));
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

        DB::table('ls_rut_shippers')->insert([
            'vi_shipper_id' => $viShipper->id,
            'thoi_gian_rut' => now()->timezone('Asia/Ho_Chi_Minh'),
            'tien_rut' => $request->amount,
            'noi_dung_tu_choi' => 'null',
            'trang_thai' => 'Chờ xử lý',
            'bank_id' => $request->bank_id,
        ]);

        // // Cập nhật số dư
        $viShipper->tong_tien -= $request->amount;
        $viShipper->save();

        $bank->balance += $request->amount;
        $bank->save();

        return redirect()->back()->with('success', 'Yêu cầu rút đã được gửi');
    }

    public function createbank()
    {
        $title = 'Tạo ngân hàng';
        $user = Auth::user();
        $userId = Auth::id();
        $linkedBanksCount = Bank::where('user_id', $user->id)->count();
        $response = Http::get(env('VIETQR_BANKS_LIST'));
        if ($response->successful()) {
            $banks = $response->json()['data']; // Lấy dữ liệu từ API
        } else {
            $banks = []; // Nếu API không trả về dữ liệu, để mảng rỗng
        }
        $listBank = Bank::where('user_id', $userId)->latest('id')->get();
        return view('shipper.lkbank', compact('title', 'user', 'banks', 'userId', 'listBank', 'linkedBanksCount'));
    }

    public function storebank(StoreBankRequest $request)
    {
        // Get authenticated user
        $user = Auth::user();
        // Kiểm tra số lượng ngân hàng đã liên kết
        $linkedBanksCount = Bank::where('user_id', $user->id)->count();
        if ($linkedBanksCount >= 3) {
            return redirect()->back()->with('error', 'Bạn chỉ được liên kết tối đa 3 ngân hàng.');
        }

        $response = Http::get(env('VIETQR_BANKS_LIST'));
        if ($response->successful()) {
            $banks = $response->json()['data']; // Lấy dữ liệu từ API
        } else {
            $banks = []; // Nếu API không trả về dữ liệu, để mảng rỗng
        }
        $selectedBank = collect($banks)->firstWhere('name', $request->bank_id);
        $bankLogo = $selectedBank ? $selectedBank['logo'] : null;
        // dd($bankLogo);
        // Create bank record
        Bank::create([
            'name' => $request->bank_id,
            'img' => $bankLogo,
            'account_number' => $request->account_number,
            'account_holder' => $request->account_holder,
            'pin' => $request->pin,
            'balance' => rand(100, 10000) * 1000, // Random balance
            'user_id' => $user->id,
        ]);

        // Redirect or return success response
        return redirect()->back()->with('success', 'Liên kết ngân hàng thành công!');
    }
}
