<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderShipping extends Model
{
    use HasFactory;

    protected $table = 'order_shipping';

    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order', 'id');
    }

    public function courier()
    {
        return $this->belongsTo(Courier::class, 'code_courier', 'code');
    }
}
