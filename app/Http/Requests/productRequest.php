<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class productRequest extends FormRequest
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
        // app/Http/Requests/productRequest.php

    return [
        'title' => 'required|string|max:255',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'images' => 'nullable|array',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'colors'=>'nullable',
        'sizes'=>'nullable',
        'stock_quantity'=>'numeric',
        'category_id' => 'required|exists:categories,id',
        'status' => 'required|in:active,archived',
        'is_customizable' => 'required|in:0,1',
        'description' => 'nullable|string',
        'seller_id' => 'required|exists:users,id',
        'value' => 'nullable|json'
    ];
}
    
    public function attributes()
{
    return [
        'images.*' => 'additional image',
    ];
}

    public function messages(): array
    {
        return [
      'images.*.mimes'=>'Please upload images in JPEG, JPG, PNG, or GIF format only.'
        ];
    }
}
