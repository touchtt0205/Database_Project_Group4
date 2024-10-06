<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipSlip extends Model
{
    use HasFactory;

    protected $primaryKey = 'slip_id'; // ใช้ slip_id เป็น primary key


    protected $fillable = [
        'user_id',
        'amount',
        'benefits',
        'slip_path',
        'status',
        'admin_note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }
}
