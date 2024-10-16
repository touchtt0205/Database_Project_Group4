<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoTag extends Model
{
    use HasFactory;


    protected $table = 'Photo_tags'; // Table name if different from the default plural form
    public $timestamps = false; // Set to true if you want to use timestamps

    protected $fillable = [
        'photo_id',
        'tags_id',
    ];

    public function image()
    {
        return $this->belongsTo(Image::class, 'photo_id', 'id'); // Assuming you have an Image model
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class, 'tags_id', 'tags_id');
    }
}