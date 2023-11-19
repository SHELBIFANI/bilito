<?php

namespace App\Http\Requests;

use App\Enums\Gender;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePassengersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() == true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'passengers.*.name' => 'required|string',
            'passengers.*.lastname' => 'required|string',
            'passengers.*.gender' => ['required', Rule::enum(Gender::class)],
            'passengers.*.national_code' => 'required|string',
            'passengers.*.birthdate' => 'required|date',
        ];
    }
}
