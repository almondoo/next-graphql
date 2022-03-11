<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Interfaces\TaskInterface;
use App\Models\Task;

class TaskRepository implements TaskInterface
{
    private Task $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function find(int $id): ?Task
    {
        return $this->task->find($id);
    }

    public function paginate(): ?object
    {
        return $this->task->with('user')->paginate(env('TASK_LIST_COUNT'));
    }

    public function conditionPaginate(array $condition = []): ?object
    {
        return $this->task->where($condition)->with('user')->paginate(env('TASK_LIST_COUNT'));
    }

    public function fetchAll(): object
    {
        return $this->task->get();
    }

    public function createTask(array $request): Task
    {
        return $this->task->create($request);
    }

    public function updateTask(int $id, array $request): Task
    {
        $task = $this->find($id);
        $task->fill($request)->save();
        return $task->refresh();
    }

    public function deleteTask(int $id): int
    {
        return $this->task->destroy($id);
    }
}
