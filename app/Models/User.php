<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Favorite;
use App\Models\Membership;



class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'coins',
        'isAdmin',
        'profile_photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function cartItemsCount()
    {
        return $this->hasMany(Cart::class)->count();
    }

    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }

    public function albums()
    {
        return $this->hasMany(Album::class);
    }
}
