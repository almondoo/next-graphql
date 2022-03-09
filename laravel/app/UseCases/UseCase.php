<?php

namespace App\UseCases;

class UseCase
{
    /**
     * エラーが起きた
     */
    protected function fail(string $message)
    {
        return [
            'is_fail' => true,
            'message' => $message,
        ];
    }

    /**
     * ベースと返り値フォーマット
     */
    protected function commit($data = []): array
    {
        return [
            'data' => $data,
            'is_fail' => false,
        ];
    }
}
