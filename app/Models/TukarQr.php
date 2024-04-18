<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TukarQr extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'user_id', 'qr_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function qr()
    {
        return $this->hasOne(QrCode::class, 'qr_id', 'id');
    }
}
