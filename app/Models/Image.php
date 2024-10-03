<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    // Define the fillable properties
    protected $fillable = [
        'path',      // Allow mass assignment for the path
        'user_id',   // Other fields you want to allow
        'price',
        'title',
        'max_sales',
        'description',
    ];

    // If you have any relationships defined, you can add them here
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function comments()
    {
        return $this->hasMany(Comments::class, 'photo_id');
    }

    
}