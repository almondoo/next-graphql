<?php

namespace App\GraphQL\Validators\Task;

use Nuwave\Lighthouse\Validation\Validator;

class DeleteTaskValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:tasks,id']
        ];
    }

    /**
     * バリデーションエラーのカスタム属性の取得
     */
    public function attributes(): array
    {
        return [
            'id' => 'タスクID',
        ];
    }
}
