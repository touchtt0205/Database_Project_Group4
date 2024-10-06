<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberTransaction extends Model
{
    use HasFactory;

    // Specify the table if it does not follow the convention (optional)
    protected $table = 'membership_transactions';
    // public $timestamps = false;


    // Define fillable attributes
    protected $fillable = [
        'user_id',
        'amount',
        'transaction_type',
        'description',
        'status',
        'created_at',

    ];

    // ความสัมพันธ์กับ User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
