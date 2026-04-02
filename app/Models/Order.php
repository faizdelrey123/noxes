<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address_id',
        'order_code',   // ✅ tambah ini
        'shipping',
        'payment',
        'total',
        'proof',
        'status'        // ✅ tambah status
    ];

    // ===============================
    // AUTO GENERATE ORDER CODE
    // ===============================
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->order_code = 'NXS-' . strtoupper(uniqid());
            $order->status = 'tertunda'; // default status
        });
    }

    // ===============================
    // RELASI
    // ===============================

    // KE ORDER ITEMS
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // KE USER
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // KE ADDRESS
    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    // ===============================
    // HELPER STATUS (BIAR RAPI DI VIEW)
    // ===============================
    public function getStatusLabelAttribute()
    {
        return ucfirst($this->status);
    }
}