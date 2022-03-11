<?php

namespace App\GraphQL\Validators\Task;

use Nuwave\Lighthouse\Validation\Validator;

class UpdateTaskValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:tasks,id'],
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
            'id' => 'タスクID',
            'title' => 'タイトル',
            'text' => '内容',
        ];
    }
}
