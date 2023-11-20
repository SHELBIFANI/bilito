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
        'email',
        'phone',
    ];

    public function passengers()
    {
        return $this->belongsToMany(passenger::class, 'passenger_order');
    }

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTotalAttribute()
    {
        return $this->passengers()->count() * $this->flight->price;
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    } 
}
