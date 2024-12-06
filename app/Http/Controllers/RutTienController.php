<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bank;
use App\Models\ls_rut_vi;
use App\Models\ShipperProfit;
use Illuminate\Http\Request;
use App\Models\vi_nguoi_dung;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;

class RutTienController extends Controller
{



    public function nap()
    {
        $viNguoiDung = vi_nguoi_dung::where('user_id', Auth::id());
        $banks = Bank::all();
        return view('client.taikhoan.nap-tien', compact('viNguoiDung', 'banks'));
    }

    public function loaded(Request $request)
    {
        $request->validate([
            'bank_id' => 'required|exists:banks,id',
            'amount' => 'required|numeric|min:1',
            'pin' => 'required',
        ]);

        $user = Auth::user();

        // Lấy ví của người dùng
        $viNguoiDung = $user->vi_nguoi_dungs;
        // dd($viNguoiDung->tong_tien);
        // Lấy ngân hàng
        $bank = Bank::findOrFail($request->bank_id);

        if (!$bank || $bank->balance < $request->amount) {
            return redirect()->route('taikhoan.nap-tien')->with('error', 'Số dư ngân hàng không đủ.');
        }


        // Kiểm tra mã PIN
        if ($bank->pin !== $request->pin) {
            return  redirect()->route('taikhoan.nap-tien')->with('error', 'Mã PIN không chính xác.');
        }

        // Cập nhật số dư
        $viNguoiDung->tong_tien += $request->amount;
        $viNguoiDung->save();

        $bank->balance -= $request->amount;
        $bank->save();

        DB::table('ls_nap_vis')->insert([
            'vi_nguoi_dung_id' => $user->vi_nguoi_dungs->id,
            'thoi_gian_nap' => now()->timezone('Asia/Ho_Chi_Minh'),
            'tien_nap' => $request->amount,
            'trang_thai' => 'Thành công',
            'bank_id' => $request->bank_id,
        ]);

        return  redirect()->route('taikhoan.nap-tien')->with('success', 'Nạp tiền thành công');
    }




    public function rut()
    {
        $response = Http::get(env('VIETQR_BANKS_LIST'));

        if ($response->successful()) {
            $banks = $response->json()['data']; // Lấy dữ liệu từ API
        } else {
            $banks = []; // Nếu API không trả về dữ liệu, để mảng rỗng
        }
        $viNguoiDung = vi_nguoi_dung::where('user_id', Auth::id());
        // $banks = Bank::all();
        return view('client.taikhoan.rut-tien', compact('viNguoiDung', 'banks'));
    }


    public function withdraw(Request $request)
    {
        // Gọi API để lấy danh sách ngân hàng
        $response = Http::get(env('VIETQR_BANKS_LIST'));

        if ($response->successful()) {
            $banks = collect($response->json()['data']); // Sử dụng collect để thao tác dễ hơn
        } else {
            return redirect()->route('taikhoan.rut-tien')->with('error', 'Không thể tải danh sách ngân hàng.');
        }

        // Validate dữ liệu đầu vào
        $request->validate([
            'bank_id' => ['required', Rule::in($banks->pluck('code')->toArray())], // Kiểm tra mã ngân hàng từ API
            'amount' => 'required|numeric|min:1',
            'pin' => 'required',
        ]);

        $user = Auth::user();

        // Lấy ví người dùng
        $viNguoiDung = $user->vi_nguoi_dungs;

        if (!$viNguoiDung || $viNguoiDung->tong_tien < $request->amount) {
            return redirect()->route('taikhoan.rut-tien')->with('error', 'Số dư không đủ.');
        }

        // Tìm ngân hàng từ API
        $bank = $banks->firstWhere('code', $request->bank_id);
        if (!$bank) {
            return redirect()->route('taikhoan.rut-tien')->with('error', 'Ngân hàng không hợp lệ.');
        }

        // Kiểm tra mã PIN (giả sử mã PIN là cố định hoặc lưu ở đâu đó)
        if ($request->pin !== '123456') { // Thay '123456' bằng logic kiểm tra thực tế
            return redirect()->route('taikhoan.rut-tien')->with('error', 'Mã PIN không chính xác.');
        }

        // Cập nhật số dư trong ví người dùng
        $viNguoiDung->tong_tien -= $request->amount;
        $viNguoiDung->save();

        // Ghi lại lịch sử rút tiền
        DB::table('ls_rut_vis')->insert([
            'vi_nguoi_dung_id' => $viNguoiDung->id,
            'thoi_gian_rut' => now()->timezone('Asia/Ho_Chi_Minh'),
            'tien_rut' => $request->amount,
            'trang_thai' => 'Chờ duyệt',
            'bank_id' => $request->bank_id,
        ]);

        return redirect()->route('taikhoan.rut-tien')->with('success', 'Yêu cầu rút đã được gửi.');
    }


    public function duyetruttienAdmin(Request $request)
    {
        $title = "Duyệt rút tiền khách hàng";

        $query = ls_rut_vi::query()->with(['vi_nguoi_dung.user', 'bank']);

        // lọc trạng thái
        if ($request->has('search_duyetrut')) {
            $is_active = $request->input('search_duyetrut');
            if ($is_active == 'Chờ duyệt' || $is_active == 'Thành công' || $is_active == 'Thất bại') {
                $query->where('trang_thai', $is_active);
            }
        }

        // tim theo tên người dùng
        if ($request->has('search_ten_nguoi_dung') && !empty($request->input('search_ten_nguoi_dung'))) {
            $search_ten_nguoi_dung = $request->input('search_ten_nguoi_dung');
            $query->whereHas('vi_nguoi_dung.user', function ($q) use ($search_ten_nguoi_dung) {
                $q->where('ho_ten', 'like', '%' . $search_ten_nguoi_dung . '%');
            });
        }

        $duyetruttien = $query->orderBy('id', 'DESC')->get();

        // dd($duyetruttien);
        return view('admin.lichsuduyetrut', compact('title', 'duyetruttien'));
    }

    public function duyetRutAdmin($id)
    {
        $lsRutVi = ls_rut_vi::find($id);
        if (!$lsRutVi) {
            return redirect()->back()->with('error', 'Không tìm thấy yêu cầu rút tiền.');
        }
        $lsRutVi->trang_thai = 'Thành công';
        $lsRutVi->updated_at = Carbon::now()->setTimezone('Asia/Ho_Chi_Minh');
        $lsRutVi->save();
        return redirect()->back()->with('success', 'Yêu cầu rút tiền đã được duyệt.');
    }




    public function HuyRutAdmin($id, Request $request)
    {
        $request->validate([
            'noi_dung_tu_choi' => 'required|string',
        ], [
            'noi_dung_tu_choi.required' => "Nội dung không được để trống",
            'noi_dung_tu_choi.string' => "Nội dung phải là chữ",
        ]);
        $lsRutVi = ls_rut_vi::findOrFail($id);
        $lsRutVi->update([
            'trang_thai' => 'Thất bại',
        ]);
        $lsRutVi->updated_at = Carbon::now()->setTimezone('Asia/Ho_Chi_Minh');
        $lsRutVi->noi_dung_tu_choi = $request->input('noi_dung_tu_choi');
        $lsRutVi->save();
        return redirect()->back()->with('success', 'Xác nhận từ chối rút tiền thành công.');
    }
}