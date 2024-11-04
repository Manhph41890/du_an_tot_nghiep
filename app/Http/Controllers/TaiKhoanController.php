<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TaiKhoanController extends Controller
{
    //
    public function showAccountDetails(Request $request)
    {
        $user = Auth::user(); // Lấy thông tin người dùng hiện tại
        $title = " Thông tin tài khoản ";
        $avatar = $user->anh_dai_dien ? Storage::url($user->anh_dai_dien) : asset('assets/client/images/avatar.png');
        $showForm = $request->query('showForm') === 'true';

        return view('client.taikhoan.dashboard', compact('user', 'avatar', 'title', 'showForm'));
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

                return redirect()->route('client.taikhoan.dashboard')->with('success', 'Cập nhật hình đại diện thành công');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
            }
        }
    }
    public function updateuser(Request $request)
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
        ]);

        // Update the user's information
        $user->ho_ten = $request->input('ho_ten');
        $user->email = $request->input('email');
        $user->so_dien_thoai = $request->input('so_dien_thoai');
        $user->ngay_sinh = $request->input('ngay_sinh');
        $user->gioi_tinh = $request->input('gioi_tinh');
        $user->dia_chi = $request->input('dia_chi');

        // Save the updated user information
        $user->save();

        // Redirect back with a success message
        // dieuf huong aaaaa
        
        return redirect()->route('client.taikhoan.dashboard')->with('success', 'Thông tin tài khoản đã được cập nhật thành công.');
    }
}
