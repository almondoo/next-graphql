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
     * ユーザー作成処理
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
            return $this->fail($e->getMessage());
        }

        // createしたユーザーなので必ず通る
        $auth = $this->authService->authenticate($user->email, $request['password']);
        if (!$auth) {
            return $this->fail('認証に失敗しました。');
        }

        return $this->commit([
            'user' => $this->authService->fetchForceLoginUser($request['email']),
            'access_token' => $auth['access_token'],
            'refresh_token' => $auth['refresh_token'],
        ]);
    }
}
