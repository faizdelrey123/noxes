<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'series',
        'price',
        'stock',
        'image',
        'description',
        'spesifikasi'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getTerjualAttribute()
    {
        // Menghitung total quantity terjual yang status ordernya bukan 'tertunda' (berarti sudah diproses minimal)
        return $this->orderItems()->whereHas('order', function($q) {
            $q->whereIn('status', ['dikemas', 'dikirim', 'selesai']);
        })->sum('quantity');
    }
}