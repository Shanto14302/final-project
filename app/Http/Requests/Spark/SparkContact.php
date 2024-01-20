<?php

namespace App\Http\Requests\Spark;

use Illuminate\Foundation\Http\FormRequest;

class SparkContact extends FormRequest
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
            'phone_number_1'=>'required',
            'phone_number_2'=>'required',
            'phone_number_3'=>'required',
            'email_address'=>'required',
        ];
    }
}
