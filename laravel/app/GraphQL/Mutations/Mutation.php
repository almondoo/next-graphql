<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use Error;

class Mutation
{
    protected const UN_AUTHENTICATED_MESSAGE = '認証エラー。';
    protected const AUTHENTICATED_CANNOT_USED = 'ゲストユーザーのみ使用可能。';


    protected function authenticated(?User $user): bool
    {
        $is_auth = false;
        if (!$user) {
            $is_auth = true;
        }
        return $is_auth;
    }
}
