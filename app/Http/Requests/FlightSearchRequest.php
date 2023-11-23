<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlightSearchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'origin' => 'required|integer|exists:cities,id',
            'destination' => 'required|integer|exists:cities,id',
            'departure' => 'required|date:Y-m-d',
            'capacity' => 'required|integer',
        ];
    }
}
