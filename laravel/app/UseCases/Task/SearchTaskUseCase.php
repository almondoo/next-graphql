<?php

namespace App\UseCases\Task;

use App\Services\Task\TaskService;
use App\UseCases\UseCase;

class SearchTaskUseCase extends UseCase
{
    protected TaskService $taskService;

    /**
     * 必要なものは先にinjectionする
     */
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * 処理実行
     */
    public function execute(array $request): array
    {
        $tasks = $this->taskService->searchPaginate($request['keyword']);
        return $this->commit([
            'tasks' => $tasks,
            'keyword' => $request['keyword'],
        ]);
    }
}
