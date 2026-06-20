<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;

class CartRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */

    public function rules(): array
    {
        return [
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'nullable|integer|min:1|max:150',
            'size' => 'nullable',
            'color' => 'nullable',
            'attributes'=>'nullable|array',
            'engraving' => 'nullable'
        ];
    }
    public function messages()
    { return
        [
            'product_id.required' => 'Product is required',
            'product_id.exists' => 'Product not found',
            'quantity.integer' => 'Quantity must be a number',
            'quantity.min' => 'Minimum quantity is 1',
            'quantity.max' => 'Maximum quantity is 150',
        ];
    }
}
