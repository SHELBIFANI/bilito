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
            'name' => ['sometime', 'string', 'max:50'],
            'mobile' => ['sometime', 'string', 'iran_mobile'],
            'national_code' => ['sometime', 'string', 'melli_code'],
            'image' => ['sometime', 'image', 'mimes:jpg', 'max:2048'],
            'gender' => [ 'sometime', 'string'],
        ];
    }
}
