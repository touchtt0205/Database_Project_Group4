<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class OrderHistory extends Model
// {
//     use HasFactory;

//     protected $fillable = [
//         'user_id',
//         'order_id',
//         'coins',
//         'price',
//         'status',
//         'created_at',
//         'image_id',
//     ];

//     // Define the relationship with User
//     public function user()
//     {
//         return $this->belongsTo(User::class);
//     }

//     // Define the relationship with Order
//     public function order()
//     {
//         return $this->belongsTo(Order::class);
//     }
//     public function image()
//     {
//         return $this->belongsTo(Image::class);
//     }
// }

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'image_id', 'price'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
