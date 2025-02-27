<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\OrderHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{


    public function index()
    {
        // ดึงข้อมูลจำนวนผู้ใช้
        $userCount = User::count();

        // ดึงข้อมูลยอดรวมที่ใช้ในการซื้อขาย
        $totalSpent = OrderHistory::sum('price');

        // ดึงข้อมูลยอดรวมที่ใช้ในการซื้อขาย
        $totalSpent = OrderHistory::sum('price');
        if (!Auth::user()->isAdmin) {
            return redirect('/images'); // redirect หากไม่ใช่ admin
        }

        return view('admin.dashboard', compact('userCount', 'totalSpent'));

        // แสดงหน้า dashboard สำหรับ admin
        // return view('admin.dashboard');
    }
}