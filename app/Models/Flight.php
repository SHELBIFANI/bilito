<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'departure',
        'arrival',
        'airline_id',
        'origin_id',
        'destination_id',
        'capacity',
        'price',
        'plane',
    ];

    public function origin()
    {
        return $this->belongsTo(City::class, 'origin_id');
    }

    public function destination()
    {
        return $this->belongsTo(City::class, 'destination_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
