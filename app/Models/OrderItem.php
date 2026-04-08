<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price'
    ];

    // RELASI KE ORDER
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // RELASI KE PRODUCT
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getPriceAttribute($value)
    {
        if ($value > 0) {
            return $value;
        }
        return $this->product ? $this->product->price : 0;
    }
}