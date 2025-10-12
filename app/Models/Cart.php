<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    /** Relasi: Satu Keranjang dimiliki oleh satu User. */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /** Relasi: Satu Keranjang memiliki banyak CartItem. */
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
}