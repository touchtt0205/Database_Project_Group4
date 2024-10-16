<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags'; // Table name if different from the default plural form
    protected $primaryKey = 'tags_id'; // Primary key if different from the default 'id'

    protected $fillable = [
        'name',
    ];

    public function photoTags()
    {
        return $this->hasMany(PhotoTag::class, 'tags_id', 'tags_id');
    }

    public function images()
{
    return $this->belongsToMany(Image::class, 'photo_tags', 'tags_id', 'photo_id');
}
}