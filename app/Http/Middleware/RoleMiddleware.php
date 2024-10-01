<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check user đã đăng nhập chưa theo từng chức vụ 
        if (Auth::check() && in_array(Auth::user()->chuc_vu->ten_chuc_vu, $roles)) {
            return $next($request);
        }

        return redirect('/auth/login')->withErrors('Access Denied. You do not have permission.');
    }
}
