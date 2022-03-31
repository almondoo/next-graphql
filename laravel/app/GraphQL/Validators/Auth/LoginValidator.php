<?php

namespace App\GraphQL\Validators\Auth;

use Nuwave\Lighthouse\Validation\Validator;

class LoginValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:255', 'string'],
            'password' => ['required', 'min:8', 'string']
        ];
    }

    /**
     * バリデーションエラーのカスタム属性の取得
     */
    public function attributes(): array
    {
        return [
            'email' => 'メールアドレス',
            'password' => 'パスワード'
        ];
    }
}
