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
}
