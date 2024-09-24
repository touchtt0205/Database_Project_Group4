<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoinTransaction extends Model
{
    use HasFactory;

    // Specify the table if it does not follow the convention (optional)
    protected $table = 'coin_transactions';

    // Define fillable attributes
    protected $fillable = [
        'user_id',
        'amount',
        'transaction_type',
        'description',
    ];

    // Define relationships if needed
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
