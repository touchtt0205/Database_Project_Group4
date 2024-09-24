<?php

namespace App\Http\Controllers;

use App\Models\CoinTransaction;
use App\Models\Slip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CoinController extends Controller
{
    // แสดงฟอร์มเติม coins
    public function create()
    {
        return view('coins.create');
    }

    // บันทึกการเติม coins
    public function store(Request $request)
    {
        // ตรวจสอบข้อมูลที่ส่งมาจากฟอร์ม
        $request->validate([
            'amount' => 'required|integer|min:1',
            'coins' => 'required|integer|min:1',
            'slip_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        // อัปโหลดไฟล์สลิปและเก็บไว้ใน storage
        $path = $request->file('slip_path')->store('slips', 'public');

        // สร้างรายการสลิปใหม่ในฐานข้อมูล
        $slip = Slip::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'coins' => $request->coins,
            'slip_path' => $path,
            'status' => 'pending',
            'description' => $request->description,
        ]);

        // สร้างรายการการทำธุรกรรมในฐานข้อมูล
        CoinTransaction::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'transaction_type' => 'credit', // หรือ 'debit' ขึ้นอยู่กับธุรกรรม
            'description' => $request->description,
        ]);

        return redirect()->route('coins.create')->with('success', 'เติม Coins เรียบร้อยแล้ว! รอการตรวจสอบจากแอดมิน');
    }
    public function index()
    {
        $cardsData = [
            ['price' => 9.99, 'quantity' => 100],
            ['price' => 19.99, 'quantity' => 250],
            ['price' => 29.99, 'quantity' => 500],
            ['price' => 49.99, 'quantity' => 1000],
            ['price' => 99.99, 'quantity' => 2500],
            ['price' => 149.99, 'quantity' => 5000],
            ['price' => 199.99, 'quantity' => 10000],
            ['price' => 249.99, 'quantity' => 20000],
            ['price' => 299.99, 'quantity' => 50000],
        ];

        return view('coins.index', compact('cardsData'));
    }

    public function showCoinsPage()
    {
        $cardsData = [
            ['price' => 9.99, 'quantity' => 100],
            ['price' => 19.99, 'quantity' => 250],
            ['price' => 29.99, 'quantity' => 500],
            ['price' => 49.99, 'quantity' => 1000],
            ['price' => 99.99, 'quantity' => 2500],
            ['price' => 149.99, 'quantity' => 5000],
            ['price' => 199.99, 'quantity' => 10000],
            ['price' => 249.99, 'quantity' => 20000],
            ['price' => 299.99, 'quantity' => 50000],
        ];

        return view('coins', compact('cardsData'));
    }

    public function purchaseCoins(Request $request)
    {
        $quantities = $request->input('quantity');
        $prices = $request->input('price');

        // Assuming you want to process all selected quantities at once,
        // you could loop through them, but here we'll take the first selected option
        if ($quantities && $prices) {
            // For example, taking the first selected option
            $selectedQuantity = $quantities[0];
            $selectedPrice = $prices[0];

            // Create a new transaction in the database
            CoinTransaction::create([
                'user_id' => Auth::id(),
                'amount' => $selectedPrice,
                'transaction_type' => 'purchase',
                'description' => "Purchased {$selectedQuantity} coins for \${$selectedPrice}",
            ]);

            // Here, you might want to also update the user's coin balance
            // User::find(Auth::id())->increment('coins', $selectedQuantity);

            return redirect()->back()->with('success', 'Coins purchased successfully!');
        }

        return redirect()->back()->withErrors('No coins were selected.');
    }
}
