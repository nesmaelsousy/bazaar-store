<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|string|min:3',
            'user_id' => 'required|exists:users,id|unique:stores,user_id',
            'phone' => 'required|string|min:10',
            'address' => 'required|string|min:10',
            'bio' => 'required|string|min:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rating' => 'required|numeric|min:0|max:5',
            'status' => 'required|string|in:active,archive',

        ];
    }
    public function messages()
    {
        return [
         
            'user_id.unique' => 'The selected user already has a store.',
    
        ];
    }
}
