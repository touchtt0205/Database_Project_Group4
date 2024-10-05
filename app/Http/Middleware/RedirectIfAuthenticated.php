<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        // ตรวจสอบว่าผู้ใช้ล็อกอินอยู่หรือไม่
        if (Auth::guard($guard)->check()) {
            // ถ้าล็อกอินอยู่ ให้ redirect ไปยังหน้าอื่น เช่น หน้าแดชบอร์ด
            return redirect('/dashboard'); // เปลี่ยนเส้นทางนี้ตามต้องการ
        }

        return $next($request);
    }
}
