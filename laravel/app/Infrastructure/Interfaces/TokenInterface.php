<?php

namespace App\Infrastructure\Interfaces;

interface TokenInterface
{
    public function createToken(): string;
}
