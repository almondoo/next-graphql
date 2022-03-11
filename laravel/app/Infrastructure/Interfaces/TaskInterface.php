<?php

namespace App\Infrastructure\Interfaces;

use App\Models\Task;

interface TaskInterface
{
    public function find(int $id);
    public function paginate();
    public function conditionPaginate(array $condition = []);
    public function fetchAll();
    public function createTask(array $request): Task;
    public function updateTask(int $id, array $request): Task;
    public function deleteTask(int $id);
}
