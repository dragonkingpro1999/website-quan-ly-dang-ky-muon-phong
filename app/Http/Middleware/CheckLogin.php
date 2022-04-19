<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // dd(Auth::guard('nguoi_dung')->user()->ma);
        if (Auth::guard('nguoi_dung')->guest()) {
            Session::put('error', "Bạn chưa đăng nhập hoặc tài khoản quá hạn");
            return redirect()->route('login');
        }

        return $next($request);
    }
}
