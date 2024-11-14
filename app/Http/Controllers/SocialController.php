<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\chuc_vu; // Đảm bảo đã import model chuc_vu
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->scopes(['openid', 'profile', 'email'])  // Thêm phạm vi profile và email
            ->redirect();
    }


    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        // dd($user); 
        return $this->loginOrCreateUser($user, 'google');
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')
            ->scopes(['email', 'public_profile']) // Đảm bảo rằng các phạm vi này có trong ứng dụng của bạn
            ->redirect();
    }

    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->stateless()->user();
        return $this->loginOrCreateUser($user, 'facebook');
    }

    protected function loginOrCreateUser($socialUser, $provider)
    {
        // Lấy ID của vai trò 'khach_hang'
        $khachHangRole = chuc_vu::where('ten_chuc_vu', 'khach_hang')->first();

        // Tìm hoặc tạo người dùng
        $user = User::firstOrCreate(
            ['email' => $socialUser->getEmail()],
            [
                'ho_ten' => $socialUser->getName(),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'anh_dai_dien' => $socialUser->getAvatar(),
                'chuc_vu_id' => $khachHangRole ? $khachHangRole->id : null, // Gán chuc_vu_id cho người dùng
            ]
        );

        // Đăng nhập người dùng vừa tạo hoặc đã tồn tại
        Auth::login($user);

        // Chuyển hướng sau khi đăng nhập thành công
        return redirect()->intended('/');
    }
    public function logout(Request $request)
    {
        Auth::logout(); // Đăng xuất người dùng
        return redirect('/');
    }
}
