<?php

namespace App\GraphQL\Validators\Task;

use Nuwave\Lighthouse\Validation\Validator;

class CreateTaskValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:200'],
            'text' => ['required', 'string', 'max:20000'],
        ];
    }

    /**
     * バリデーションエラーのカスタム属性の取得
     */
    public function attributes(): array
    {
        return [
            'title' => 'タイトル',
            'text' => '内容',
        ];
    }
}
