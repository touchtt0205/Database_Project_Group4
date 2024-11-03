<?php

// OrderHistoryController.php
namespace App\Http\Controllers;

use App\Models\OrderHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class AdminOrderHistoryController extends Controller
{
    public function index()
    {
        // ดึงข้อมูลผู้ใช้ทั้งหมด
        $orderHistories = OrderHistory::all();
        return view('admin.orderHistory.index', compact('orderHistories'));
    }

    // New function to get order history for a specific user
    // AdminOrderHistoryController.php

    public function showUserOrderHistory($userId)
    {
        // Retrieve order histories for the specific user, including user details
        $orderHistories = OrderHistory::with('user')->where('user_id', $userId)->get();

        return view('admin.orderHistory.userHistory', compact('orderHistories'));
    }
}
