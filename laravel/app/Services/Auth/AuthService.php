<?php

namespace App\Services\Auth;

use App\Infrastructure\Interfaces\TokenInterface;
use App\Infrastructure\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class AuthService
{
    private UserInterface $userRepo;
    private TokenInterface $tokenRepo;

    public function __construct(
        UserInterface $userRepo,
        TokenInterface $tokenRepo,
    ) {
        $this->userRepo = $userRepo;
        $this->tokenRepo = $tokenRepo;
    }

    /**
     * 認証を行う
     * 
     * 認証成功 jsonデータ
     * 認証失敗 false
     */
    public function authenticate(string $email, string $password): mixed
    {
        $response = Http::asForm()->post(env('APP_GUZZLE_URL') . '/oauth/token', [
            'grant_type' => 'password',
            'client_id' => '2',
            'client_secret' => env('PASSPORT_PASSWORD_CLIENT_SECRET'),
            'username' => $email,
            'password' => $password,
            'scope' => '',
        ]);

        $json = $response->json();
        return  !isset($json['error']) ? $json : false;
    }

    /**
     * ログアウト
     * トークンをrevokeする
     */
    public function logout(): bool
    {
        $user = $this->userRepo->fetchLoginUser();
        return $user->token()->revoke();
    }

    /**
     * ログインユーザー取得
     */
    public function fetchLoginUser(): ?User
    {
        return $this->userRepo->fetchLoginUser();
    }

    /**
     * ログインタイミングのユーザー取得 (強制)
     */
    public function fetchForceLoginUser(string $email): ?User
    {
        return $this->userRepo->findByEmail($email);
    }
}
