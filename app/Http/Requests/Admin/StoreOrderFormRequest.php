<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrderFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'order_number' => ['required', 'string', 'max:255', Rule::unique('orders', 'order_number')],
            'subtotal' => ['required', 'numeric', 'min:0'],
            'total' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'string', 'max:255'],
            'created_by' => ['required', 'integer', 'exists:users,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'order_number.required' => 'The order number is required.',
            'order_number.string' => 'The order number must be a valid string.',
            'order_number.max' => 'The order number may not be greater than 255 characters.',
            'order_number.unique' => 'An order with this number already exists.',
            'subtotal.required' => 'The subtotal is required.',
            'subtotal.numeric' => 'The subtotal must be a valid number.',
            'subtotal.min' => 'The subtotal must be at least 0.',
            'total.required' => 'The total is required.',
            'total.numeric' => 'The total must be a valid number.',
            'total.min' => 'The total must be at least 0.',
            'status.required' => 'The status is required.',
            'status.string' => 'The status must be a valid string.',
            'status.max' => 'The status may not be greater than 255 characters.',
            'created_by.required' => 'The created by user is required.',
            'created_by.exists' => 'The selected user does not exist.',
        ];
    }
}
