<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    use HasFactory;

    protected $table = 'order_payment';

    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order', 'id');
    }

    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class, 'id_bank_account', 'id');
    }
}
