<?php

namespace App\Http\Requests\Task;

use App\Http\Requests\Request;

class UpdateTaskRequest extends Request
{
    /**
     * リクエストを行う権限があるかどうか確認
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * バリデーションするルール
     *
     * @return array
     */
    public function rules()
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
            'task_id' => 'タスクID',
            'user_id' => 'ユーザーID',
            'title' => 'タイトル',
            'text' => '内容',
        ];
    }
}
