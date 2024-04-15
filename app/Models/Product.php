<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function order()
    {
        return $this->belongsToMany(Order::class, 'detail_orders', 'product_id', 'order_id');
    }

    public function rasa()
    {
        return $this->belongsTo(Rasa::class, 'rasa_id', 'id');
    }
}
