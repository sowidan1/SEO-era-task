<?php

namespace App\Http\Requests\V1\Api\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => 'required|string|max:255|unique:users',
            'phone' => 'required|string|unique:users|max:12',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(apiError(
            error: 'Validation failed',
            code: 422,
            errors: $validator->errors()
        ));
    }
}
