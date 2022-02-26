<?php

namespace App\Services\Auth;

use App\Infrastructure\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    private UserInterface $userRepo;

    public function __construct(UserInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * 認証を行う
     */
    public function authenticate(string $email, string $password, $remember_me): bool
    {
        if (Auth::attempt(['email' => $email, 'password' => $password], $remember_me)) {
            return true;
        }
        return false;
    }

    /**
     * ログアウト
     */
    public function logout(): void
    {
        Auth::logout();
    }

    /**
     * ログインユーザー取得
     */
    public function fetchLoginUser(): ?User
    {
        return $this->userRepo->fetchLoginUser();
    }
}
