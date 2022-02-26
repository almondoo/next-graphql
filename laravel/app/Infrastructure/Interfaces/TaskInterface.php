<?php

namespace App\Infrastructure\Interfaces;

interface TaskInterface
{
    public function find(int $id);
    public function paginate();
    public function conditionPaginate(array $condition = []);
    public function fetchAll();
    public function createTask(array $request);
    public function updateTask(int $id, array $request);
    public function deleteTask(int $id);
}
