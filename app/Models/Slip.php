<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slip extends Model
{
    use HasFactory;

    protected $table = 'slips';
    protected $primaryKey = 'slip_id'; // เพิ่มบรรทัดนี้

    protected $fillable = [
        'user_id',
        'amount',
        'coins',
        'slip_path',
        'status',
        'admin_note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
