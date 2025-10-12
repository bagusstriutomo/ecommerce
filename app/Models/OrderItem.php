<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    
    // Nonaktifkan timestamps karena tabel ini tidak memilikinya
    public $timestamps = false; 

    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'qty',
        'subtotal',
    ];

    /** Relasi: OrderItem dimiliki oleh satu Order. */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /** Relasi: OrderItem merujuk ke satu Product. */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}