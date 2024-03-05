<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Check
{
    public function handle(Request $request, Closure $next)
    {
        $khachhang = Auth::guard('client')->check();
        if($khachhang) {
            return $next($request);
        } else {
            toastr()->error('Bạn cần đăng nhập trước!');
            return redirect('/');
        }
    }
}
