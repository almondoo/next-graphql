<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class Request extends FormRequest
{
    /**
     * Handle a failed validation attempt.
     *
     * @throws \Illuminate\Validation\HttpResponseException
     */
    protected function failedValidation(Validator $validator): HttpResponseException
    {
        $res = response()->fail($validator->errors()->toArray(), 400);
        throw new HttpResponseException($res);
    }
}
