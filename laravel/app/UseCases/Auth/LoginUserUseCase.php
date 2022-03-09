<?php

namespace App\UseCases\Auth;

use App\UseCases\UseCase;
use App\Services\Auth\AuthService;
use App\Services\User\UserService;

class LoginUserUseCase extends UseCase
{
    protected AuthService $authService;
    protected UserService $userService;

    /**
     * 必要なものは先にinjectionする
     */
    public function __construct(
        AuthService $authService,
        UserService $userService
    ) {
        $this->authService = $authService;
        $this->userService = $userService;
    }

    /**
     * ログイン処理
     */
    public function execute(array $request): array
    {
        $auth = $this->authService->authenticate($request['email'], $request['password']);
        if ($auth) {
            return $this->commit([
                'user' => $this->authService->fetchForceLoginUser($request['email']),
                'access_token' => $auth['access_token'],
                'refresh_token' => $auth['refresh_token']
            ]);
        }
        return $this->fail('メールアドレスかパスワードが違います。');
    }
}
