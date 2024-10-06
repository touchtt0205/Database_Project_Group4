<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MembershipSlip;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MemberSlipController extends Controller
{
    // ฟังก์ชันสำหรับการบันทึกข้อมูลสลิปการซื้อสมาชิก
    public function store(Request $request)
    {
        // Validate input data
        $request->validate([
            'slip_path' => 'required|image|max:2048',
            'amount' => 'required|numeric',
            'membership_name' => 'required|string', // แก้เป็น membership_name
        ]);

        // dd($request->all()); // This will display the input data and stop execution

        // Store the slip image
        $path = $request->file('slip_path')->store('slips', 'public');

        // Check if the upload was successful
        if (!$path) {
            return redirect()->back()->withErrors(['slip_path' => 'Failed to upload the slip image.']);
        }

        try {
            // Create the membership slip record
            $membershipSlip = MembershipSlip::create([
                'user_id' => Auth::id(),
                'amount' => $request->amount,
                'benefits' => $request->membership_name,
                'slip_path' => $path,
                'status' => 'pending',
            ]);

            // dd($membershipSlip);
            // Redirect with success message
            return redirect()->back()->with('success', 'Slip uploaded successfully, waiting for admin approval.');
        } catch (\Exception $e) {
            Log::error('Error saving membership slip: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to upload slip.']);
        }
    }
}
