<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\MemberTransaction;

use App\Models\MembershipSlip;

class AdminMemberController extends Controller
{
    public function index()

    {
        if (!Auth::user()->isAdmin) {
            return redirect('/images'); // redirect หากไม่ใช่ admin
        }
        $slips = MembershipSlip::all();
        return view('admin.membership.index', compact('slips'));
    }
    public function approveSlip($slip_id)
    {
        $slip = MembershipSlip::findOrFail($slip_id);
        // dd($slip);
        $user = $slip->user;
        $user->member_level = $slip->benefits;
        $user->save();



        MemberTransaction::create([
            'user_id' => $user->id,
            'amount' => $slip->amount,
            'transaction_type' => 'credit',
            'description' => 'Approved slip for coins',
            'status' => 'approved',
        ]);

        $slip->status = 'approved';
        $slip->save();
        $slip->delete();

        return redirect()->route('admin.membership.index')->with('success', 'Slip approved and membership credited successfully!');
    }

    public function rejectSlip($slip_id)
    {
        $slip = MembershipSlip::findOrFail($slip_id);
        $user = $slip->user;
        MemberTransaction::create([
            'user_id' => $user->id,
            'amount' => $slip->amount,
            'transaction_type' => 'credit',
            'description' => 'Reject slip for coins',
            'status' => 'rejected',
        ]);
        $slip->status = 'rejected';
        $slip->admin_note = 'Rejected by admin';
        $slip->save();
        $slip->delete();

        return redirect()->route('admin.slips.index')->with('error', 'Slip rejected successfully.');
    }
}