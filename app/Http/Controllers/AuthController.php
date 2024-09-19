<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\chuc_vu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    
    public function showFormRegister()
    {
        return view('auth.register');
    }

    
    public function register(Request $request)
    {
      
        $validatedData = $request->validate(
            [
                'ho_ten' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users',
                'so_dien_thoai' => 'required|string|max:10|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ],

            [
                'ho_ten.required' => 'Họ tên không được để trống',
                'ho_ten.max' => 'Họ tên không được quá 255 ký tự',
                'email.required' => 'Email không được để trống',
                'email.email' => 'Email không đúng định dạng',
                'email.unique' => 'Email đã tồn tại',
                'so_dien_thoai.required' => 'Số điện thoại không được để trong',
                'so_dien_thoai.max' => 'Số điện thoại không được quá10 ký tự',
                'password.required' => 'Mật khẩu không được bỏ trống',
                'password.min' => 'Tối thiểu là 8 ký tự',
                'password.confirmed' => 'Mật khẩu xác nhận không khớp',


            ]
        );

       // Vai trò mặc định khi đăng ký là 'khach_hang'
        $khachHangRole =chuc_vu::where('ten_chuc_vu', 'khach_hang')->first();

        if (!$khachHangRole) {
            return redirect()->back()->withErrors(['error' => 'Không tìm thấy vai trò "khách hàng".']);
        }

       // Tạo người dùng mới
        $user = User::create([
            'ho_ten' => $validatedData['ho_ten'],
            'email' => $validatedData['email'],
            'so_dien_thoai' => $validatedData['so_dien_thoai'],
            'password' => Hash::make($validatedData['password']),
            'chuc_vu_id' => $khachHangRole->id,
        ]);

       // Tự động đăng nhập người dùng sau khi đăng ký
        Auth::login($user);

       
        return redirect()->route('welcome')->with('success', 'Đăng ký tài khoản thành công');
    }

    
    public function showFormLogin()
    {
        return view('auth.login');
    }

   
    public function login(Request $request)
    {


        
        $credentials = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string'
        ]
         ,[
            'email.required' => 'Email không được bỏ trống',
            'email.email' => 'Email không hợp lệ',
            'email.max' => 'Email quá dài',
            'password.required' => 'Mật khẩu không được bỏ trống',
            'password.string' => 'Mật khẩu phải là chuỗi ký tự',
        
         ]);

        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ])) {
            $user = Auth::user();

            // Phân quyênf cho từng chức vụ của người dùng
            switch ($user->chuc_vu->ten_chuc_vu) {
                case 'admin':
                    return redirect()->route('admin.home')->with('success', 'Đăng nhập thành công');
                case 'nhan_vien':
                    return redirect()->route('admin.home')->with('success', 'Đăng nhập thành công');
                case 'khach_hang':
                    return redirect()->route('welcome')->with('success', 'Đăng nhập thành công');
                    // case 'thanh_vien':
                    //     return redirect()->route('welcome')->with('success', 'Đăng nhập thành công');
                default:
                    Auth::logout();
                    return redirect()->route('login')->withErrors(['error' => 'Chức vụ không tồn tại']);
            }
        }

        
        return redirect()->back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng',
        ]);






    }
}
