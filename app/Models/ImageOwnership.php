<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageOwnership extends Model
{
    use HasFactory;

    protected $table = 'image_ownerships'; // The table name
    protected $fillable = ['user_id', 'image_id', 'path', 'purchased_at', 'price']; // Fillable fields

    // Define relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define relationship with Image
    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
