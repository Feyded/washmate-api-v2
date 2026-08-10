<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The service name is required.',
            'name.string' => 'The service name must be a valid string.',
            'name.max' => 'The service name may not be greater than 255 characters.',
            'price.required' => 'The service price is required.',
            'price.numeric' => 'The service price must be a valid number.',
            'price.min' => 'The service price must be at least 0.',
        ];
    }
}
