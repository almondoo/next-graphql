<?php

namespace App\GraphQL\Mutations\Task;

use App\Models\Task;
use App\UseCases\Task\CreateTaskUseCase;
use Error;
use Illuminate\Support\Facades\Log;

class CreateTask
{
    private CreateTaskUseCase $createTaskUseCase;
    public function __construct(CreateTaskUseCase $createTaskUseCase)
    {
        $this->createTaskUseCase = $createTaskUseCase;
    }

    /**
     * @param null  $_
     * @param array<string, mixed>  $args
     */
    public function __invoke($_, array $args): Task
    {
        $result = $this->createTaskUseCase->execute($args);
        if ($result['is_fail']) {
            throw new Error($result['message']);
        }

        return $result['data']['task'];
    }
}
