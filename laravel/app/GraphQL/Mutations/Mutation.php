<?php

namespace App\GraphQL\Mutations;

class Mutation
{
    protected const UN_AUTHENTICATED_MESSAGE = '認証エラー。';
    protected const AUTHENTICATED_CANNOT_USED = 'ゲストユーザーのみ使用可能。';
}
