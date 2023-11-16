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
            'name' => 'required|string',
            'lastname' => 'required|string',
            'national_code' => 'required|melli_code',
            'birthdate' => 'required|date',
            'gender' => ['required', Rule::enum(Gender::class)],
            'user_id' => 'required|exists:users,id',
            'phone' => 'required|iran_mobile',
            'email' => 'required|email',
        ];
    }
}
