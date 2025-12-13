<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    protected $fillable = ['transaction_id', 'product_id', 'qty', 'price'];

    // Relasi ke Produk (untuk ambil nama barang)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}