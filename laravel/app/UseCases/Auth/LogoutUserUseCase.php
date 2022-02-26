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
     * 処理実行
     * 
     * @param array $where 条件
     */
    public function execute(): array
    {
        $this->authService->logout();
        return $this->commit();
    }
}
