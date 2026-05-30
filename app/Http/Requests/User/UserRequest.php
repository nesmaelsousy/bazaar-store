<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
// file
// name
// username
// phone
// address
// email
// password
// status
// Active
// role
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        "name" => "required|string|max:255",
        "username" => "required|string|max:255",
        "phone" => "required|string|max:20",
        "address" => "required|string|max:255",
        "email" => "required|email",
        "password" => "nullable|min:6",
        "image" => "nullable|image|max:2048",
        "role" => "required",
    ];
    }
}
