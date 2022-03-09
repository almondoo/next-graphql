<?php

namespace App\GraphQL\Mutations\Task;

use Illuminate\Support\Facades\Log;

class CreateTask
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        Log::info($args);
        Log::info('createtask');
    }
}
