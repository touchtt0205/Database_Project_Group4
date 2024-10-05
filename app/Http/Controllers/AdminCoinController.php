<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\CoinTransaction;

use App\Models\Slip;

class AdminCoinController extends Controller
{
    public function index()
    
    {
        if (!Auth::user()->isAdmin) {
            return redirect('/dashboard'); // redirect หากไม่ใช่ admin
        }
        $slips = Slip::all();
        return view('admin.coins.index', compact('slips'));
    }
    public function approveSlip($slip_id)
    {
        $slip = Slip::findOrFail($slip_id);

        $user = $slip->user;
        $user->coins += $slip->coins;
        $user->save();

        CoinTransaction::create([
            'user_id' => $user->id,
            'amount' => $slip->amount,
            'transaction_type' => 'credit',
            'description' => 'Approved slip for coins',
            'status' => 'approved',
        ]);

        $slip->status = 'approved';
        $slip->save();
        $slip->delete();

        return redirect()->route('admin.slips.index')->with('success', 'Slip approved and coins credited successfully!');
    }

    public function rejectSlip($slip_id)
    {
        $slip = Slip::findOrFail($slip_id);
        $slip->status = 'rejected';
        $slip->admin_note = 'Rejected by admin';
        $slip->save();
        $slip->delete();

        return redirect()->route('admin.slips.index')->with('error', 'Slip rejected successfully.');
    }
}