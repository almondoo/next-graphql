<?php

namespace App\UseCases\Auth;

use App\UseCases\UseCase;
use App\Services\Auth\AuthService;
use App\Services\User\UserService;
use Illuminate\Support\Facades\DB;

class RegisterUserUseCase extends UseCase
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
        $this->userService = $userService;
        $this->authService = $authService;
    }

    /**
     * 処理実行
     * 
     * @param array $where 条件
     */
    public function execute(array $request): array
    {
        DB::beginTransaction();
        try {
            $user = $this->userService->createUser(
                $request['name'],
                $request['email'],
                $request['password']
            );
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->addErrorMessage('create_user', $e->getMessage());
            return $this->fail();
        }
        if ($this->authService->authenticate($user->email, $request['password'], $request['is_remember'])) {
            $user = $this->authService->fetchLoginUser();
        }
        return $this->commit(['user' => $user]);
    }
}
