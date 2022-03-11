<?php

namespace App\Services\Task;

use App\Infrastructure\Interfaces\TaskInterface;
use App\Models\Task;

class TaskService
{

    private TaskInterface $taskRepo;

    /**
     * 初期化
     */
    public function __construct(TaskInterface $taskRepo)
    {
        $this->taskRepo = $taskRepo;
    }

    /**
     * @return object
     */
    public function fetchTask()
    {
        return $this->taskRepo->fetchAll();
    }

    public function findTask(int $id = null): ?Task
    {
        return $this->taskRepo->find($id);
    }

    public function paginate(): ?object
    {
        return $this->taskRepo->paginate();
    }

    public function searchPaginate(string $keyword): ?object
    {
        return $this->taskRepo->conditionPaginate([['title', 'like', "%{$keyword}%"]]);
    }

    public function createTask(array $data): Task
    {
        return $this->taskRepo->createTask($data);
    }

    public function updateTask(int $id, array $data): Task
    {
        return $this->taskRepo->updateTask($id, $data);
    }

    public function deleteTask(int $id): bool
    {
        return $this->taskRepo->deleteTask($id);
    }
}
