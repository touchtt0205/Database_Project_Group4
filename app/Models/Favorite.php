<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favorite extends Model
{
    protected $fillable = ['user_id', 'image_id']; // ระบุฟิลด์ที่ต้องการอนุญาตในการทำ mass assignment

    // ความสัมพันธ์กับโมเดล User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // ความสัมพันธ์กับโมเดล Image
    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class);
    }
}
