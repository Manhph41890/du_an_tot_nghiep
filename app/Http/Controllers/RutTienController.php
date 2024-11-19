<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\ls_rut_vi;
use App\Models\vi_nguoi_dung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RutTienController extends Controller
{

    public function rut()
    {
        $viNguoiDung = vi_nguoi_dung::where('user_id', Auth::id());
        $banks = Bank::all();
        return view('client.taikhoan.rut-tien', compact('viNguoiDung', 'banks'));
    }

    public function withdraw(Request $request)
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

        if (!$viNguoiDung || $viNguoiDung->tong_tien < $request->amount) {
            return redirect()->route('taikhoan.rut-tien')->with('error', 'Số dư không đủ.');
        }

        // Lấy ngân hàng
        $bank = Bank::findOrFail($request->bank_id);

        // Kiểm tra mã PIN
        if ($bank->pin !== $request->pin) {
            return  redirect()->route('taikhoan.rut-tien')->with('error', 'Mã PIN không chính xác.');
        }

        // Cập nhật số dư
        $viNguoiDung->tong_tien -= $request->amount;
        $viNguoiDung->save();

        $bank->balance += $request->amount;
        $bank->save();

        DB::table('ls_rut_vis')->insert([
            'vi_nguoi_dung_id' => $user->vi_nguoi_dungs->id,
            'thoi_gian_rut' => now()->timezone('Asia/Ho_Chi_Minh'),
            'tien_rut' => $request->amount,
            'trang_thai' => 'Thành công',
            'bank_id' => $request->bank_id,
        ]);

        return  redirect()->route('taikhoan.rut-tien')->with('success', 'Rút tiền thành công.');
    }


    public function duyetruttienAdmin()
    {
        $title = "Duyệt rút tiền khách hàng";
        $duyetruttien = ls_rut_vi::with(['vi_nguoi_dung.user', 'bank'])->get();

        // dd($duyetruttien);
        return view('admin.lichsuduyetrut', compact('title', 'duyetruttien'));
    }
}
