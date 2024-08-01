<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $table = 'product_variant';

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product', 'id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'id_size', 'id');
    }
}
