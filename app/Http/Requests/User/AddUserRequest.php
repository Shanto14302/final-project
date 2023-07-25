<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_name' => 'required|max:255',
            'user_email' => 'required|email|unique:users,email|max:55',
            'user_phone' => 'required|unique:users,phone|max:55',
            'user_role' => 'required|max:55',
            'password' => 'required|max:55',
            'rpassword' => 'required|max:55|same:password',
        ];
    }
}
