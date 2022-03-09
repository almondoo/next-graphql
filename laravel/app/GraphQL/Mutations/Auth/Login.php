<?php

namespace App\GraphQL\Mutations\Auth;

use App\UseCases\Auth\LoginUserUseCase;
use Illuminate\Support\Facades\Log;

class Login
{
    /**
     * ログイン用ユースケース
     */
    private LoginUserUseCase $loginUserUseCase;

    public function __construct(LoginUserUseCase $loginUserUseCase)
    {
        $this->loginUserUseCase = $loginUserUseCase;
    }

    /**
     * Return a value for the field.
     *
     * @param  @param  null  $root Always null, since this field has no parent.
     * @param  array<string, mixed>  $args The field arguments passed by the client.
     * @return mixed
     */
    public function __invoke($root, array $args): ?array
    {
        $result = $this->loginUserUseCase->execute($args);
        if ($result['is_fail']) {
            return null;
        }

        $access_token = $result['data']['access_token'];
        $refresh_token = $result['data']['refresh_token'];
        $user = $result['data']['user'];

        return [
            'name' => $user->name,
            'email' => $user->email,
            'access_token' => $access_token,
            'refresh_token' => $refresh_token,
        ];
    }
}
