<?php

namespace App\UseCases\Auth;

use App\UseCases\UseCase;
use App\Services\Auth\AuthService;

class LogoutUserUseCase extends UseCase
{
    protected AuthService $authService;

    /**
     * 必要なものは先にinjectionする
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * ログアウト処理
     */
    public function execute(): array
    {
        if (!$this->authService->logout()) {
            return $this->fail('トークンの削除に失敗しました。');
        }
        return $this->commit();
    }
}
