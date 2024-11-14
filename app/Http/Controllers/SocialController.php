<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str; // Thêm dòng này

class SocialController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    { 
        $user = Socialite::driver('google')->user();
        return $this->loginOrCreateUser($user, 'google');
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {   
        $user = Socialite::driver('facebook')->stateless()->user();
        return $this->loginOrCreateUser($user, 'facebook');
    }

    protected function loginOrCreateUser($socialUser, $provider)
    {
        // Tìm hoặc tạo người dùng
        $user = User::firstOrCreate(
            ['email' => $socialUser->getEmail()],
            [
                'name' => $socialUser->getName(),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'avatar' => $socialUser->getAvatar(),
            ]
        );

        Auth::login($user);

        return redirect()->intended('/home'); // Chuyển hướng sau khi đăng nhập thành công
    }
}
