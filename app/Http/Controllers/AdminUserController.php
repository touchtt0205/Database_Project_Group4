<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        // ดึงข้อมูลผู้ใช้ทั้งหมด
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
}
