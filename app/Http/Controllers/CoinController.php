<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CoinTransaction;
use App\Http\Controllers\QrCode;

class CoinController extends Controller
{
    // แสดงหน้าเลือกแพ็คเกจ Coins
    public function showCoinPackages()
    {
        $cardsData = [
            ['price' => 9, 'quantity' => 100],
            ['price' => 19, 'quantity' => 250],
            ['price' => 29, 'quantity' => 500],
            ['price' => 49, 'quantity' => 1000],
            ['price' => 99, 'quantity' => 2500],
            ['price' => 149, 'quantity' => 5000],
            ['price' => 199, 'quantity' => 10000],
            ['price' => 249, 'quantity' => 20000],
            ['price' => 299, 'quantity' => 50000],
        ];

        return view('coins.index', compact('cardsData'));
    }

    // ฟังก์ชันสำหรับบันทึกข้อมูลการเติม Coins
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'coins' => 'required|integer|min:1',
        ]);

        CoinTransaction::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'transaction_type' => 'purchase',
            'description' => 'Coin purchase of ' . $request->coins . ' coins',
        ]);

        $user = Auth::user();
        $user->coins += $request->coins;

        return redirect()->back()->with('success', 'Coins added successfully!');
    }
}
