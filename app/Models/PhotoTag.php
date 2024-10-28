<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoTag extends Model
{
    use HasFactory;

    protected $table = 'Photo_tags'; // ชื่อของตารางในฐานข้อมูล
    public $timestamps = false; // ตั้งเป็น false หากคุณไม่ต้องการใช้ timestamps

    protected $fillable = [
        'photo_id',
        'tags_id',
    ];

    public function image()
    {
        return $this->belongsTo(Image::class, 'photo_id', 'id'); // ความสัมพันธ์กับโมเดล Image
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class, 'tags_id', 'tags_id'); // ความสัมพันธ์กับโมเดล Tag
    }
}
