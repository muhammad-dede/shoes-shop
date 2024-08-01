<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function userAddress()
    {
        return $this->belongsTo(UserAddress::class, 'id_user_address', 'id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status', 'id');
    }

    public function orderItem()
    {
        return $this->hasMany(OrderItem::class, 'id_order', 'id');
    }

    public function orderShipping()
    {
        return $this->hasOne(OrderShipping::class, 'id_order', 'id');
    }

    public function orderPayment()
    {
        return $this->hasOne(OrderPayment::class, 'id_order', 'id');
    }
}
