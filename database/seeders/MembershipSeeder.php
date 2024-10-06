<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Membership;

class MembershipSeeder extends Seeder
{
    public function run()
    {
        // ลบข้อมูลระดับสมาชิกเก่าทิ้งก่อน
        Membership::truncate();

        // สร้างระดับสมาชิกต่าง ๆ
        Membership::create([
            'level' => 'Bronze',
            'price' => 100.00,
            'benefits' => 'Basic benefits including access to exclusive content.',
        ]);

        Membership::create([
            'level' => 'Silver',
            'price' => 200.00,
            'benefits' => 'Silver benefits including 10% discount on all purchases.',
        ]);

        Membership::create([
            'level' => 'Gold',
            'price' => 500.00,
            'benefits' => 'Gold benefits including 20% discount and priority support.',
        ]);

        Membership::create([
            'level' => 'Platinum',
            'price' => 1000.00,
            'benefits' => 'Platinum benefits including 30% discount and personalized support.',
        ]);

        // เพิ่มระดับสมาชิกใหม่
        Membership::create([
            'level' => 'Diamond',
            'price' => 3000.00,
            'benefits' => 'Diamond benefits including 40% discount and VIP support.',
        ]);

        Membership::create([
            'level' => 'Ultimate',
            'price' => 10000.00,
            'benefits' => 'Ultimate benefits including 50% discount and dedicated account manager.',
        ]);
    }
}
