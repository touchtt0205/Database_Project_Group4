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
            'price' => 29.00,
            'benefits' => 'Bronze benefits including 5% discount on all purchases.',
        ]);

        Membership::create([
            'level' => 'Silver',
            'price' => 59,
            'benefits' => 'Silver benefits including 14% discount on all purchases.',
        ]);

        Membership::create([
            'level' => 'Gold',
            'price' => 89,
            'benefits' => 'Gold benefits including 20% discount and priority support.',
        ]);

        Membership::create([
            'level' => 'Platinum',
            'price' => 129,
            'benefits' => 'Platinum benefits including 30% discount and personalized support.',
        ]);
        // เพิ่มระดับสมาชิกใหม่
        Membership::create([
            'level' => 'Diamond',
            'price' => 199,
            'benefits' => 'Diamond benefits including 40% discount and VIP support.',
        ]);

        Membership::create([
            'level' => 'Ultimate',
            'price' => 299,
            'benefits' => 'Ultimate benefits including 55% discount and dedicated account manager.',
        ]);
    }
}
