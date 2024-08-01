<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_item';

    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product', 'id');
    }

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class, 'id_product_variant', 'id');
    }
}
