<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (Auth::check()) {
            $userRole = strtolower(Auth::user()->chuc_vu->ten_chuc_vu);
            $roles = array_map('strtolower', $roles);
            // dd($userRole, $roles);
            if (in_array($userRole, $roles)) {
                return $next($request);
            }

            return response()->view('error.403', [], 403);
        }

        return redirect('/auth/login')->withErrors('Bạn cần phải đăng nhập để truy cập.');
    }
}