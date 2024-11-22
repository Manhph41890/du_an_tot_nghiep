<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Kiểm tra nếu người dùng đã đăng nhập và có quyền
        if (Auth::check()) {
            $userRole = Auth::user()->chuc_vu->ten_chuc_vu;

            // Kiểm tra xem quyền của người dùng có phù hợp với yêu cầu hay không
            if (in_array($userRole, $roles)) {
                return $next($request); // Người dùng có quyền, tiếp tục với request
            }

            // Nếu quyền không đúng, trả về view lỗi 403 với thông báo
            return response()->view('errors.403', [], 403);
        }

        // Nếu người dùng chưa đăng nhập
        return redirect('/auth/login')->withErrors('Bạn cần phải đăng nhập để truy cập.');
    }
}