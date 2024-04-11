<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_order extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'order_id',
        'product_id',
        'jumlah_beli'
    ];
}
