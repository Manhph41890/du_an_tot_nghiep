<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\chuc_vu;
use App\Models\khuyen_mai;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function profile()
    {
        $user = Auth::user();

        return view('auth.profile', compact('user')); // Đường dẫn tới view của bạn
    }

    public function showFormRegister()
    {
        return view('auth.register');
    }




    // register có thêm tính năng tặng voucher cho khách hàng mới và ko bị giới hạn đăng kí đối với sdt
    public function register(Request $request)
    {
        // Bắt đầu quá trình đăng ký
        Log::info('Bắt đầu quá trình đăng ký.');

        // Xác thực dữ liệu đầu vào
        $validatedData = $request->validate(
            [
                'ho_ten' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users',
                'so_dien_thoai' => ['required', 'regex:/^(\+84|0)[1-9][0-9]{8}$/'],
                'password' => 'required|string|min:8|confirmed',
            ],
            [
                'ho_ten.required' => 'Họ tên không được để trống',
                'ho_ten.max' => 'Họ tên không được quá 255 ký tự',
                'email.required' => 'Email không được để trống',
                'email.email' => 'Email không đúng định dạng',
                'email.unique' => 'Email đã tồn tại',
                'so_dien_thoai.required' => 'Số điện thoại không được để trống',
                'so_dien_thoai.regex' => 'Số điện thoại không đúng định dạng',
                'password.required' => 'Mật khẩu không được bỏ trống',
                'password.min' => 'Tối thiểu là 8 ký tự',
                'password.confirmed' => 'Mật khẩu xác nhận không khớp',
            ]
        );


        Log::info('Dữ liệu đã xác thực: ', $validatedData);

        // Kiểm tra vai trò
        $khachHangRole = chuc_vu::where('ten_chuc_vu', 'khach_hang')->first();
        if (!$khachHangRole) {
            Log::error('Không tìm thấy vai trò "khách hàng"');
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
        Log::info('Người dùng đã được tạo: ', ['user_id' => $user->id]);

        // Kiểm tra voucher
        $existingUserWithVoucher = $this->checkUserVoucher($validatedData['so_dien_thoai']);
        Log::info('Kiểm tra voucher: ', ['existingUserWithVoucher' => $existingUserWithVoucher]);

        // Tạo voucher
        if (!$existingUserWithVoucher) {
            if (!$this->createUserVoucher($user->id, $validatedData['so_dien_thoai'])) {
                Log::error('Không thể tạo voucher.');
                return redirect()->back()->withErrors(['error' => 'Không thể tạo voucher.']);
            }
        }

        // Tự động đăng nhập người dùng
        Auth::login($user);
        Log::info('Đăng nhập tự động cho người dùng: ', ['user_id' => $user->id]);

        //
        $message = 'Đăng ký tài khoản thành công.' . ($existingUserWithVoucher ? ' Tuy nhiên, bạn không nhận được voucher.' : ' Bạn đã nhận được voucher khuyến mãi!');
        return redirect()->route('client.home')->with('notification', $message);
    }

    // Kiểm tra voucher
    private function checkUserVoucher($phoneNumber)
    {
        // Tìm user dựa trên số điện thoại
        $userWithPhoneNumber = User::where('so_dien_thoai', $phoneNumber)->first();

        if ($userWithPhoneNumber) {
            // Kiểm tra xem người dùng đã nhận voucher trước đó hay chưa dựa trên user_id
            return khuyen_mai::where('user_id', $userWithPhoneNumber->id)
                ->where('ten_khuyen_mai', 'Khuyến mãi khách hàng mới')
                ->exists();
        }

        // Người dùng với số điện thoại này chưa tồn tại
        return false;
    }

    // Tạo voucher
    private function createUserVoucher($userId, $phoneNumber)
    {
        try {
            khuyen_mai::create([
                'ten_khuyen_mai' => 'Khuyến mãi khách hàng mới',
                'ma_khuyen_mai' => 'KHACHMOI' . strtoupper(Str::random(8)), // Generate random voucher code
                'gia_tri_khuyen_mai' => 50000,
                'so_luong_ma' => 1,
                'ngay_bat_dau' => now(),
                'ngay_ket_thuc' => now()->addDays(30), // Voucher valid for 30 days
                'is_active' => 1,
                'user_id' => $userId,
                'so_dien_thoai' => $phoneNumber, // Store phone number
            ]);
            return true;
        } catch (\Exception $e) {
            Log::error('Lỗi khi tạo voucher: ' . $e->getMessage());
            return false;
        }
    }


    /**
     * Kiểm tra xem người dùng có voucher hay không
     */
    private function checkExistingVoucher($phoneNumber)
    {
        $userWithPhoneNumber = User::where('so_dien_thoai', $phoneNumber)->first();

        if ($userWithPhoneNumber) {
            return khuyen_mai::where('user_id', $userWithPhoneNumber->id)
                ->where('ten_khuyen_mai', 'Khuyến mãi khách hàng mới')
                ->exists();
        }

        return false;
    }

    /**
     * Tạo voucher cho người dùng mới
     */
    private function createVoucher($userId, $phoneNumber)
    {
        try {
            khuyen_mai::create([
                'ten_khuyen_mai' => 'Khuyến mãi khách hàng mới',
                'ma_khuyen_mai' => 'KHACHMOI' . strtoupper(Str::random(8)),
                'gia_tri_khuyen_mai' => 50000,
                'so_luong_ma' => 1,
                'ngay_bat_dau' => now(),
                'ngay_ket_thuc' => now()->addDays(30),
                'is_active' => 1,
                'user_id' => $userId,
                'so_dien_thoai' => $phoneNumber,
            ]);

            return true; // Trả về true nếu việc tạo voucher thành công
        } catch (\Exception $e) {
            Log::error('Lỗi khi tạo voucher: ' . $e->getMessage());
            return false; // Trả về false nếu có lỗi
        }
    }




    public function showFormLogin()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $credentials = $request->validate(
            [
                'email' => 'required|string|email|max:255',
                'password' => 'required|string'
            ],
            [
                'email.required' => 'Email không được bỏ trống',
                'email.email' => 'Email không hợp lệ',
                'email.max' => 'Email quá dài',
                'password.required' => 'Mật khẩu không được bỏ trống',
                'password.string' => 'Mật khẩu phải là chuỗi ký tự',
            ]
        );

        if (Auth::attempt($credentials, $request->has('remember'))) {
            // Eager load quan hệ chuc_vu của người dùng
            $user = User::with('chuc_vu')->find(Auth::user()->id);

            return $this->redirectToDashboardBasedOnRole($user)->with('notification', 'Đăng nhập thành công !');
        }

        // Truyền thông báo lỗi vào session
        if (!User::where('email', $request->email)->exists()) {
            $errorMessage = 'Email không tồn tại!';
        } else {
            $errorMessage = 'Mật khẩu không chính xác!';
        }

        return redirect()->back()->with('login_error', $errorMessage);
    }


    protected function redirectToDashboardBasedOnRole($user)
    {
        switch ($user->chuc_vu->ten_chuc_vu) {
            case 'shipper':
                return redirect()->route('shipper.danhSach');
            case 'admin':
            case 'nhan_vien':
                return redirect('/dashboard')->with('success', 'Đăng nhập thành công');
            case 'khach_hang':
                return redirect('/')->with('success', 'Đăng nhập thành công');
            default:
                Auth::logout();
                return redirect()->route('auth.login')->withErrors(['error' => 'Chức vụ không tồn tại']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Đăng xuất người dùng
        return redirect('/');
    }
}
