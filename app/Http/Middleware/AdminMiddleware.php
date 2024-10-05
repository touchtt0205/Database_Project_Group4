<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        // ตรวจสอบว่าผู้ใช้ล็อกอินและเป็น admin หรือไม่
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/'); // หรือ redirect ไปยังหน้าอื่น
        }

        return $next($request);
    }

    protected $routeMiddleware = [
        // Other middleware
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
    ];
}
