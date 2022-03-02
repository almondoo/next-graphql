<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\UseCases\Auth\LoginUserUseCase;
use App\UseCases\Auth\LogoutUserUseCase;
use App\UseCases\Auth\RegisterUserUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private LoginUserUseCase $loginUserUseCase;

    private LogoutUserUseCase $logoutUserUseCase;

    private RegisterUserUseCase $registerUserUseCase;

    public function __construct(
        LoginUserUseCase $loginUserUseCase,
        LogoutUserUseCase $logoutUserUseCase,
        RegisterUserUseCase $registerUserUseCase,
    ) {
        $this->loginUserUseCase = $loginUserUseCase;
        $this->logoutUserUseCase = $logoutUserUseCase;
        $this->registerUserUseCase = $registerUserUseCase;
    }

    /**
     * ユーザーを作成する
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $request_data = $request->all();
        $result = $this->registerUserUseCase->execute($request_data);
        if ($result['is_fail']) {
            return response()->fail($result['messages']);
        }

        return response()->success([
            'data' => $result['data'],
        ]);
    }

    /**
     * ユーザー認証
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $request_data = $request->only('email', 'password');
        $result = $this->loginUserUseCase->execute($request_data);
        if ($result['is_fail']) {
            return response()->fail($result['messages']);
        }

        return response()->success([
            'data' => $result['data'],
        ]);
    }

    /**
     * 認証しているユーザーをログアウトを行う
     */
    public function logout(Request $request): JsonResponse
    {
        $result = $this->logoutUserUseCase->execute();
        if ($result['is_fail']) {
            return response()->fail($result['messages']);
        }

        return response()->success([
            'data' => $result['data'],
        ]);
    }
}
