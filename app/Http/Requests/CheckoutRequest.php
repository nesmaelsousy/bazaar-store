<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'fullname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20', 'regex:/^[0-9+\s\-]+$/'],
            'email' => ['required', 'email', 'max:255'],
            'street' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'BuildNum' => ['required', 'string', 'max:50'],
            'district' => ['required', 'string', 'max:255'],
            'apartment' => ['nullable', 'string', 'max:50'],
            'floor' => ['nullable', 'string', 'max:50'],
        ];
    }
}
