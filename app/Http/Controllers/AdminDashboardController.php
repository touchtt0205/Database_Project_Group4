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
        if (!Auth::user()->isAdmin) {
            return redirect('/dashboard'); // redirect หากไม่ใช่ admin
        }
        // แสดงหน้า dashboard สำหรับ admin
        return view('admin.dashboard');
    }
}
