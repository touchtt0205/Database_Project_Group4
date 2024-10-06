<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slip;
use Illuminate\Support\Facades\Auth;

class SlipController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'slip_path' => 'required|image|max:2048',
            'amount' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);


        $path = $request->file('slip_path')->store('slips', 'public');

        // บันทึกข้อมูลสลิป
        Slip::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'coins' => $request->quantity,
            'slip_path' => $path,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Slip uploaded successfully, waiting for admin approval.');
    }
}
