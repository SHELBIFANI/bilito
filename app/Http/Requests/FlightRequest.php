<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlightRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'origin' => ['required', 'numeric'],
            'destination' => ['required', 'numeric'],
            'departure' => ['required', 'date_format:Y-m-d'],
            'number_of_passenger' => ['required', 'numeric'],
            'start_price' => ['nullable', 'numeric'],
            'end_price' => ['nullable', 'numeric'],
            'start_time' => ['nullable', 'date_format:H:i'],
            'end_time' => ['nullable', 'date_format:H:i'],
            'airline_id' => ['nullable', 'exists:airlines,id'],
        ];
    }
}
