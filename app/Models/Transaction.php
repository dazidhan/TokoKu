<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['invoice_code', 'customer_name', 'total_price', 'total_items', 'status'];

    // Relasi ke Item
    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }
}