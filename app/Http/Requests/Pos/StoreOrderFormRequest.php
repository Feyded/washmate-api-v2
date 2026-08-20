<?php

namespace App\Http\Requests\Pos;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'items' => ['required', 'array', 'min:1'],
            'items.*.service_id' => [
                'required',
                'integer',
                'exists:services,id',
            ],
            'items.*.quantity' => [
                'required',
                'numeric',
                'min:1',
            ],
            'items.*.products' => [
                'required',
                'array',
                'min:1',
            ],
            'items.*.products.*.product_id' => [
                'required',
                'integer',
                'exists:products,id',
            ],
            'items.*.products.*.quantity' => [
                'required',
                'numeric',
                'min:1',
            ],
            'items.*.products.*.type' => [
                'required',
                'in:preset,addon',
            ],
        ];
    }
}
