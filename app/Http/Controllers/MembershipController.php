<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membership;
use App\Models\Slip;
use Illuminate\Support\Facades\Auth;

use App\Models\MembershipSlip;

class MembershipController extends Controller
{
    public function index()
    {
        $memberships = Membership::all();
        return view('memberships.index', compact('memberships'));
    }

    // ฟังก์ชันสำหรับบันทึกข้อมูลการซื้อสมาชิก
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'membership_id' => 'required|exists:memberships,id',
            'slip_path' => 'required|image|max:2048',
        ]);

        // บันทึกสลิป
        $path = $request->file('slip_path')->store('membership_slips', 'public');

        // บันทึกข้อมูลสลิปสมาชิก
        MembershipSlip::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'membership_id' => $request->membership_id,
            'slip_path' => $path,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Slip uploaded successfully, waiting for admin approval.');
    }

    // ฟังก์ชันสำหรับอนุมัติสลิปสมาชิก
    public function approveSlip($slip_id)
    {
        $slip = MembershipSlip::findOrFail($slip_id);
        $user = $slip->user;

        // อัปเดตสถานะและลบสลิป
        $slip->status = 'approved';
        $slip->save();

        // สามารถเพิ่มโค้ดที่นี่เพื่อให้สิทธิ์สมาชิกกับผู้ใช้
        // เช่น $user->membership_id = $slip->membership_id;

        return redirect()->route('admin.membership.index')->with('success', 'Slip approved successfully!');
    }

    // ฟังก์ชันสำหรับปฏิเสธสลิปสมาชิก
    public function rejectSlip($slip_id)
    {
        $slip = MembershipSlip::findOrFail($slip_id);
        $slip->status = 'rejected';
        $slip->admin_note = 'Rejected by admin';
        $slip->save();

        return redirect()->route('admin.membership.index')->with('error', 'Slip rejected successfully.');
    }
}
