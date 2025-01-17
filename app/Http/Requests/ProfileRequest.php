<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => ['nullable', 'string', 'max:50'],
            'mobile' => ['nullable', 'string', 'iran_mobile'],
            'national_code' => ['nullable', 'string', 'melli_code'],
            'image' => ['nullable', 'image', 'mimes:jpg', 'max:2048'],
            'gender' => [ 'nullable', 'string'],
        ];
    }
}
