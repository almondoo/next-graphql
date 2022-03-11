<?php

namespace App\GraphQL\Mutations\Task;

use App\Models\Task;
use App\UseCases\Task\UpdateTaskUseCase;
use Error;

class UpdateTask
{
    private UpdateTaskUseCase $updateTaskUseCase;

    public function __construct(UpdateTaskUseCase $updateTaskUseCase)
    {
        $this->updateTaskUseCase = $updateTaskUseCase;
    }

    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args): Task
    {
        $result = $this->updateTaskUseCase->execute($args);
        if ($result['is_fail']) {
            throw new Error($result['message']);
        }

        return $result['data']['task'];
    }
}
