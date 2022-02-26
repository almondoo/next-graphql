<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class RegisterRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:100', 'string'],
            'email' => ['required', 'max: 255', 'string', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'string', 'confirmed'],
            'password_confirmation' => ['required', 'min:8', 'string'],
            'is_remember' => [],
        ];
    }

    /**
     * バリデーションエラーのカスタム属性の取得
     */
    public function attributes(): array
    {
        return [
            'name' => '名前',
            'email' => 'メールアドレス',
            'password' => 'パスワード',
            'password_confirmation' => 'パスワード確認',
            'is_remember' => '再ログイン',
        ];
    }
}
