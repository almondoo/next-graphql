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
     * ユースケースに合った処理を行う
     * 返り値で失敗の場合は全てfalseを返す
     */
    public function execute(array $request): array
    {
        if ($this->authService->authenticate($request['email'], $request['password'], $request['is_remember'])) {
            return $this->commit([
                'user' => $this->authService->fetchLoginUser()
            ]);
        }
        $this->addErrorMessage('login', 'メールアドレスかパスワードが違います。');
        return $this->fail();
    }
}
