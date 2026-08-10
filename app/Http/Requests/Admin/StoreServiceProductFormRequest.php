<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreServiceProductFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'service_id' => ['required', 'integer', 'exists:services,id'],
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['nullable', 'numeric', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'service_id.required' => 'The service is required.',
            'service_id.exists' => 'The selected service does not exist.',
            'product_id.required' => 'The product is required.',
            'product_id.exists' => 'The selected product does not exist.',
            'quantity.numeric' => 'The quantity must be a valid number.',
            'quantity.min' => 'The quantity must be at least 0.',
        ];
    }
}
