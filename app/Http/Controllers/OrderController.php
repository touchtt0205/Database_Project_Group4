<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class OrderController extends Controller
{
    public function summary()
    {
        $carts = Cart::where('user_id', Auth::id())->with('product')->get();
        return view('orders.summary', compact('carts'));
    }
}
