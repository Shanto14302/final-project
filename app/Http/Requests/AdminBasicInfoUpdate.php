<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AdminBasicInfoUpdate extends FormRequest
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
            'user_name' => 'required|max:50',
            'user_email' => 'required|email|max:50|unique:users,email,'.Auth::user()->id,
            'user_phone' => 'required|max:20|unique:users,phone,'.Auth::user()->id,
        ];
    }
}
