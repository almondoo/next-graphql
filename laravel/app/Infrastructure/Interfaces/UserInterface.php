<?php

namespace App\Infrastructure\Interfaces;

use App\Models\User;

interface UserInterface
{
    public function find(int $id): ?User;
    public function fetchAll(): array;
    public function createUser(array $request): User;
    public function updateUser(int $id, array $request): int;
    public function deleteUser(int $id): int;
    public function fetchLoginUser(): ?User;
}
