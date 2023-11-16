<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'geteway_ref',
        'user_id',
        'flight_id',
        'total',
        'email',
        'phone',
    ];

    public function passengers()
    {
        return $this->belongsToMany(passenger::class);
    }
}
