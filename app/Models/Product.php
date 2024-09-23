<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'image_path',
        'user_id',

    ];

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    // ในไฟล์ app/Models/Product.php
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
