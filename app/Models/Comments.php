<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $primaryKey = 'comment_id';
    protected $fillable = [
        'photo_id',
        'user_id',
        'content',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public $timestamps = false; // Since `created_at` is manually handled

    public function image()
    {
        return $this->belongsTo(Image::class, 'photo_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}