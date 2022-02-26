<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
// use Illuminate\Contracts\Validation\Validator;
// use Illuminate\Validation\ValidationException;

class Request extends FormRequest
{
    /**
     * Handle a failed validation attempt.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // protected function failedValidation(Validator $validator): void
    // {
    //     throw (new ValidationException($validator))
    //         ->errorBag($this->errorBag)
    //         ->redirectTo($this->getRedirectUrl());
    // }
}
