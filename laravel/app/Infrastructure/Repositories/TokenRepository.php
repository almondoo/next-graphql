<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Interfaces\TokenInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TokenRepository implements TokenInterface
{
    private User $user;

    /**
     * 初期化
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function createToken(): string
    {
        return Auth::user()->createToken(env(ACCESS_TOKEN))->accessToken;
    }
}
