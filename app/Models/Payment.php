<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'total',
        'geteway',
        'tracking_code',
    ];

    public function order()
    {
        return $this->belongsToMany(Order::class);
    }
}