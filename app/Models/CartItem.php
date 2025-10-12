<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['cart_id', 'product_id', 'qty'];

    /** Relasi: CartItem dimiliki oleh satu Cart. */
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    /** Relasi: CartItem merujuk ke satu Product. */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}