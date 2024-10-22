<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];


    public function isAdmin()
    {
        return $this->role === 0;
    }

    public function isUser()
    {
        return $this->role === 1;
    }

    public function errors()
    {
        return $this->errors();
    }

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function order()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }

    public function qrCode()
    {
        return $this->hasMany(QRCode::class, 'user_id', 'id');
    }

    public function tukar()
    {
        return $this->hasMany(TukarQr::class, 'user_id', 'id');
    }
}
