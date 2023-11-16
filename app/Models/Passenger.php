<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lastname',
        'gender',
        'national_code',
        'birthdate',
        'user_id',
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
