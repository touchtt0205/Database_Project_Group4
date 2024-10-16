<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo_id',
        'user_id',
    ];

    public function photo()
    {
        return $this->belongsTo(Image::class, 'photo_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}