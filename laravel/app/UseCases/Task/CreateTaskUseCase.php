<?php

namespace App\UseCases\Task;

use App\UseCases\UseCase;
use App\Services\Auth\AuthService;
use App\Services\Task\TaskService;
use Illuminate\Support\Facades\DB;

class CreateTaskUseCase extends UseCase
{
    private TaskService $taskService;
    private AuthService $authService;

    /**
     * 必要なものは先にinjectionする
     */
    public function __construct(
        AuthService $authService,
        TaskService $taskService,
    ) {
        $this->authService = $authService;
        $this->taskService = $taskService;
    }

    /**
     * 処理実行
     */
    public function execute(array $request): array
    {
        $login_user = $this->authService->fetchLoginUser();
        DB::beginTransaction();
        try {
            $task = $this->taskService->createTask([
                'user_id' => $login_user->id,
                'title' => $request['title'],
                'text' =>  $request['text'],
            ]);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->addErrorMessage('task', $e->getMessage());
            return $this->fail();
        }
        return $this->commit(['task' => $task]);
    }
}
