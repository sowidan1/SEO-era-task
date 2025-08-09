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
            'phone' => [
                'required',
                'string',
                'regex:/^(\+201|01)[0-2,5]{1}[0-9]{8}$/',
            ],
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(apiError(
            message: 'Validation failed',
            code: 422,
            errors: $validator->errors()
        ));
    }
}
