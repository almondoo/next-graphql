<?php

namespace App\UseCases\Task;

use App\UseCases\UseCase;
use App\Services\Task\TaskService;
use Illuminate\Support\Facades\DB;

class DeleteTaskUseCase extends UseCase
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
        DB::beginTransaction();
        try {
            $this->taskService->deleteTask($request['id']);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->addErrorMessage('task', $e->getMessage());
            $this->fail();
        }
        return $this->commit();
    }
}
