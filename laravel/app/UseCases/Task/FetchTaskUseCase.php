<?php

namespace App\UseCases\Task;

use App\UseCases\UseCase;
use App\Services\Task\TaskService;

class FetchTaskUseCase extends UseCase
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
        $data = [];
        if (!empty($request['id'])) {
            $data['task'] = $this->taskService->findTask($request['id']);
        } else {
            $data['tasks'] = $this->taskService->paginate();
        }
        return $this->commit($data);
    }
}
