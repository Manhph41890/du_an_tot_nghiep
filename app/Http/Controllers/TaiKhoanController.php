<?php

namespace App\Http\Controllers;

use App\Models\chi_tiet_vi;
use App\Models\don_hang;
use App\Models\lich_su_thanh_toan;
use App\Models\ls_nap_vi;
use App\Models\ls_rut_vi;
use App\Models\ls_thanh_toan_vi;
use App\Models\vi_nguoi_dung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TaiKhoanController extends Controller
{
    //
    public function showAccountDetails(Request $request)
    {
        $user = Auth::user(); // Lấy thông tin người dùng hiện tại
        $title = " THÔNG TIN TÀI KHOẢN ";
        $avatar = $user->anh_dai_dien ? Storage::url($user->anh_dai_dien) : asset('assets/client/images/avatar.png');
        $showForm = $request->query('showForm') === 'true';

        $myOrders = don_hang::where('user_id', $user->id)->latest()->paginate(4);
        $viNguoiDung = vi_nguoi_dung::where('user_id', $user->id)->first();

        // Lấy lịch sử giao dịch (chi tiết ví)
        $chiTietVi = chi_tiet_vi::with('don_hang', 'vi_nguoi_dung')
            ->where('vi_nguoi_dung_id', $viNguoiDung->id) // Lọc theo ID ví người dùng
            ->latest('id') // Lấy giao dịch mới nhất trước
            ->get();

        $lsThanhToanVi = ls_thanh_toan_vi::with('don_hang', 'vi_nguoi_dung')
            ->where('vi_nguoi_dung_id', $viNguoiDung->id) // Lọc theo ID ví người dùng
            ->latest('id') // Lấy giao dịch mới nhất trước
            ->get();

        $lsNapVi = ls_nap_vi::with('bank', 'vi_nguoi_dung')
            ->where('vi_nguoi_dung_id', $viNguoiDung->id) // Lọc theo ID ví người dùng
            ->latest('id') // Lấy giao dịch mới nhất trước
            ->get();

        $lsRutVi_choduyet = ls_rut_vi::with('vi_nguoi_dung', 'bank')
            ->where('trang_thai', 'Chờ duyệt')
            ->where('vi_nguoi_dung_id', $viNguoiDung->id) // Lọc theo ID ví người dùng
            ->latest('id') // Lấy giao dịch mới nhất trước
            ->get();

        $lsRutVi_thanhcong = ls_rut_vi::with('vi_nguoi_dung', 'bank')
            ->where('trang_thai', 'Thành công')
            ->where('vi_nguoi_dung_id', $viNguoiDung->id) // Lọc theo ID ví người dùng
            ->latest('id') // Lấy giao dịch mới nhất trước
            ->get();

        $lsRutVi_thatbai = ls_rut_vi::with('vi_nguoi_dung', 'bank')
            ->where('trang_thai', 'Thất bại')
            ->where('vi_nguoi_dung_id', $viNguoiDung->id) // Lọc theo ID ví người dùng
            ->latest('id') // Lấy giao dịch mới nhất trước
            ->get();

        return view('client.taikhoan.thong-tin', compact('user', 'avatar', 'title', 'showForm', 'myOrders', 'viNguoiDung', 'chiTietVi', 'lsThanhToanVi', 'lsNapVi', 'lsRutVi_choduyet', 'lsRutVi_thanhcong', 'lsRutVi_thatbai'));
    }

    public function vanchuyen($id)
    {
        $donhang = don_hang::with('shipper')->findOrFail($id);
        $status = $donhang->shipper->status;
        return view('client.taikhoan.vanchuyen', compact('donhang', 'status'));
    }

    public function donHang()
    {
        $user = Auth::user();
        $myOrders = don_hang::where('user_id', $user->id)->latest()->paginate(4);
        return view('client.taikhoan.don-hang', compact('myOrders', 'user'));
    }

    public function viTien()
    {
        $user = Auth::user(); // Lấy thông tin người dùng hiện tại
        $viNguoiDung = vi_nguoi_dung::where('user_id', $user->id)->first();

        // Lấy lịch sử giao dịch (chi tiết ví)
        $chiTietVi = chi_tiet_vi::with('don_hang', 'vi_nguoi_dung')
            ->where('vi_nguoi_dung_id', $viNguoiDung->id) // Lọc theo ID ví người dùng
            ->latest('id') // Lấy giao dịch mới nhất trước
            ->get();

        $lsThanhToanVi = ls_thanh_toan_vi::with('don_hang', 'vi_nguoi_dung')
            ->where('vi_nguoi_dung_id', $viNguoiDung->id) // Lọc theo ID ví người dùng
            ->latest('id') // Lấy giao dịch mới nhất trước
            ->get();

        $lsNapVi = ls_nap_vi::with('bank', 'vi_nguoi_dung')
            ->where('vi_nguoi_dung_id', $viNguoiDung->id) // Lọc theo ID ví người dùng
            ->latest('id') // Lấy giao dịch mới nhất trước
            ->get();

        $lsRutVi_choduyet = ls_rut_vi::with('vi_nguoi_dung', 'bank')
            ->where('trang_thai', 'Chờ duyệt')
            ->where('vi_nguoi_dung_id', $viNguoiDung->id) // Lọc theo ID ví người dùng
            ->latest('id') // Lấy giao dịch mới nhất trước
            ->get();

        $lsRutVi_thanhcong = ls_rut_vi::with('vi_nguoi_dung', 'bank')
            ->where('trang_thai', 'Thành công')
            ->where('vi_nguoi_dung_id', $viNguoiDung->id) // Lọc theo ID ví người dùng
            ->latest('id') // Lấy giao dịch mới nhất trước
            ->get();

        $lsRutVi_thatbai = ls_rut_vi::with('vi_nguoi_dung', 'bank')
            ->where('trang_thai', 'Thất bại')
            ->where('vi_nguoi_dung_id', $viNguoiDung->id) // Lọc theo ID ví người dùng
            ->latest('id') // Lấy giao dịch mới nhất trước
            ->get();

        return view('client.taikhoan.vi-tien', compact('viNguoiDung', 'user', 'chiTietVi', 'lsThanhToanVi', 'lsNapVi', 'lsRutVi_choduyet', 'lsRutVi_thanhcong', 'lsRutVi_thatbai')); // Truyền các biến cần thiết
    }

    public function quanTri()
    {
        $user = Auth::user();
        return view('client.taikhoan.quan-tri', compact('user'));
    }


    public function showMyOrder(don_hang $don_hang, $id)
    {
        $donhang = don_hang::with([
            'user',
            'khuyen_mai',
            'phuong_thuc_thanh_toan',
            'phuong_thuc_van_chuyen',
            'chi_tiet_don_hangs.san_pham',
            'chi_tiet_don_hangs.color_san_pham',
            'chi_tiet_don_hangs.size_san_pham',
            'lich_su_thanh_toans',
            'huy_don_hang',
        ])->findOrFail($id);
        $donhang->tong_tien = $donhang->chi_tiet_don_hangs->sum('thanh_tien');
        $currentStatus = $donhang->shipper ? $donhang->shipper->status : null;

        // Trả về view cùng với dữ liệu đơn hàng
        return view('client.taikhoan.showmyorder', compact('donhang', 'currentStatus'));
    }

    public function successOrder($id)
    {
        // Tìm đơn hàng theo id
        $donhang = don_hang::findOrFail($id);

        // Cập nhật trạng thái đơn hàng sang "Thành công"
        $donhang->trang_thai_don_hang = 'Thành công';
        $donhang->trang_thai_thanh_toan = 'Đã thanh toán';
        $donhang->save();

        // Redirect về dashboard với thông báo thành công
        return redirect()->route('taikhoan.donhang')->with('success', 'Đơn hàng đã được xác nhận thành công.');
    }



    public function cancel($id)
    {
        $donhang = don_hang::findOrFail($id);

        // Cập nhật trạng thái đơn hàng sang "Đã hủy"
        $donhang->trang_thai_don_hang = 'Đã hủy';
        $donhang->save();

        return redirect()->route('taikhoan.donhang')->with('success', 'Đơn hàng đã được hủy.');
    }

    public function history($id)
    {
        $user = Auth::user();
        $history = lich_su_thanh_toan::findOrFail($id);
        $donhang = $history->don_hang;
        $title = "Lịch sử đơn hàng ";
        return view('client.taikhoan.history', compact('user', 'title', 'history', 'donhang'));
    }


    public function updateAvatar(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'anh_dai_dien' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $params = $request->except('_token');
            $user = Auth::user();

            if ($request->hasFile('anh_dai_dien')) {
                // Delete old avatar
                if ($user->anh_dai_dien) {
                    Storage::disk('public')->delete($user->anh_dai_dien);
                }

                // Save new avatar
                $filepath = $request->file('anh_dai_dien')->store('uploads/avatars', 'public');
                $params['anh_dai_dien'] = $filepath;
            } else {
                $params['anh_dai_dien'] = $user->anh_dai_dien;
            }

            try {
                // Update user profile
                $user->update($params);

                return redirect()->route('taikhoan.dashboard')->with('success', 'Cập nhật hình đại diện thành công');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
            }
        }
    }

    public function updateThongtin(Request $request)
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Validate the input data
        $request->validate([
            'ho_ten' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'so_dien_thoai' => 'nullable|string|max:15',
            'ngay_sinh' => 'nullable|date',
            'gioi_tinh' => 'nullable|string|max:10',
            'dia_chi' => 'nullable|string|max:255',
            'anh_dai_dien' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Prepare data for updating
        $params = $request->except('_token', 'anh_dai_dien');

        // Process avatar if uploaded
        if ($request->hasFile('anh_dai_dien')) {
            // Delete old avatar
            if ($user->anh_dai_dien) {
                Storage::disk('public')->delete($user->anh_dai_dien);
            }

            // Save new avatar
            $filepath = $request->file('anh_dai_dien')->store('uploads/avatars', 'public');
            $params['anh_dai_dien'] = $filepath;
        } else {
            // Keep existing avatar if none uploaded
            $params['anh_dai_dien'] = $user->anh_dai_dien;
        }

        try {
            // Update user profile with all params
            $user->update($params);

            return redirect()->route('taikhoan.dashboard')->with('success', 'Thông tin tài khoản đã được cập nhật thành công.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
}
