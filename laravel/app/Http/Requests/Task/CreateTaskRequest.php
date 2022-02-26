<?php

namespace App\Http\Requests\Task;

use App\Http\Requests\Request;

class CreateTaskRequest extends Request
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
