<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\forgot_password;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    // Show the form for requesting a password reset
    public function showForgotPasswordForm()
    {
        return view('auth.forgot_password');
    }

    // Send the password reset link
    public function sendResetLink(Request $request)
    {
        // Validate the input email
        $request->validate(['email' => 'required|email']);

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Không tìm thấy người dùng với thông tin này.']);
        }

        // Generate a random 5-digit verification code
        $code = rand(10000, 99999);

        // Insert or update the token in the password_reset_tokens table
        forgot_password::updateOrInsert(
            ['email' => $user->email],
            ['token' => $code, 'created_at' => now()]
        );

        // Send an email containing the verification code
        Mail::send('auth.verify_code', ['code' => $code, 'user' => $user], function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Mã xác thực để đặt lại mật khẩu');
        });

        // Return back with a status message
        return back()->with('status', 'Mã xác thực đã được gửi đến email của bạn.');
    }

    // Show the form to verify the code
    public function showVerifyCodeForm()
    {
        return view('auth.verify_code');
    }

    // Verify the code entered by the user
    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required'
        ]);

        // Find the verification code in the database
        $record = forgot_password::where('email', $request->email)
            ->where('token', $request->code)
            ->first();

        if (!$record) {
            return response()->json(['error' => 'Mã xác thực không hợp lệ hoặc đã hết hạn.'], 422);
        }

        // Check the creation time of the verification code (e.g., 30 minutes)
        if ($record->created_at < now()->subMinutes(30)) {
            return response()->json(['error' => 'Mã xác thực đã hết hạn.'], 422);
        }

        // Log the verified record
        Log::info('Record verified', ['email' => $record->email, 'token' => $record->token]);

        // If the code is valid, redirect to the password reset page
        return response()->json(['redirectUrl' => route('auth.reset_password', $record->token)]);
    }

    // Show the password reset form
    public function showResetPasswordForm($token)
    {
        return view('auth.reset_password', ['token' => $token]);
    }

    // Handle the password reset
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        // Verify the token
        $record = forgot_password::where('email', $request->email)->where('token', $request->token)->first();

        if (!$record) {
            return back()->withErrors(['token' => 'Mã xác thực không hợp lệ.']);
        }

        // Update the user's password
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete the verification token after use
        $record->delete();

        return redirect()->route('login')->with('status', 'Mật khẩu đã được đặt lại thành công.');
    }
}
