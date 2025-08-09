<?php

namespace App\Http\Requests\V1\Api\Post;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2048',
            'contact_phone' => 'required|string|max:20',
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
