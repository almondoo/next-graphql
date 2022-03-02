<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\UseCases\Task\FetchTaskUseCase;
use App\UseCases\Task\CreateTaskUseCase;
use App\UseCases\Task\UpdateTaskUseCase;
use App\UseCases\Task\DeleteTaskUseCase;
use App\UseCases\Task\SearchTaskUseCase;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private FetchTaskUseCase $fetchTaskUseCase;
    private CreateTaskUseCase $createTaskUseCase;
    private UpdateTaskUseCase $updateTaskUseCase;
    private DeleteTaskUseCase $deleteTaskUseCase;
    private SearchTaskUseCase $searchTaskUseCase;

    public function __construct(
        FetchTaskUseCase $fetchTaskUseCase,
        CreateTaskUseCase $createTaskUseCase,
        UpdateTaskUseCase $updateTaskUseCase,
        DeleteTaskUseCase $deleteTaskUseCase,
        SearchTaskUseCase $searchTaskUseCase,
    ) {
        $this->fetchTaskUseCase = $fetchTaskUseCase;
        $this->createTaskUseCase = $createTaskUseCase;
        $this->updateTaskUseCase = $updateTaskUseCase;
        $this->deleteTaskUseCase = $deleteTaskUseCase;
        $this->searchTaskUseCase = $searchTaskUseCase;
    }

    public function listTask(Request $request): View
    {
        $keyword = $request->input('keyword');
        if ($keyword) {
            $result = $this->searchTaskUseCase->execute(['keyword' => $keyword]);
        } else {
            $result = $this->fetchTaskUseCase->execute([]);
        }
        if ($result['is_fail']) {
            return response()->fail($result['messages']);
        }
        if ($request->session()->has('status')) {
            $result['data']['status'] = $request->session()->get('status');
        }
        return response()->success('task.list', $result['data']);
    }

    public function detailTask(Request $request, Task $task): View
    {
        if ($this->existsModel($task)) {
            $result = $this->fetchTaskUseCase->execute(['id' => $task->id]);

            if ($result['is_fail']) {
                return response()->fail($result['messages']);
            }
        }
        if ($request->session()->has('status')) {
            $result['data']['status'] = $request->session()->get('status');
        }
        return response()->success('task.detail', $result['data']);
    }

    public function createTask(CreateTaskRequest $request): RedirectResponse
    {
        $result = $this->createTaskUseCase->execute($request->all());
        if ($result['is_fail']) {
            return response()->fail($result['messages']);
        }
        $request->session()->flash('status', self::CREATE_STATUS);
        return to_route('task.detail', [
            'task' => $result['data']['task']->id,
        ]);
    }

    /**
     * @param Task $task Policyで使用
     */
    public function updateTask(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        $result = $this->updateTaskUseCase->execute($request->only(['id', 'title', 'text']));
        if ($result['is_fail']) {
            return response()->fail($result['messages']);
        }
        $request->session()->flash('status', self::UPDATE_STATUS);
        return to_route('task.detail', [
            'task' => $request->input('id'),
        ]);
    }

    public function deleteTask(Request $request, Task $task): RedirectResponse
    {
        $result = $this->deleteTaskUseCase->execute(['id' => $task->id]);
        if ($result['is_fail']) {
            return response()->fail($result['messages']);
        }
        $request->session()->flash('status', self::DELETE_STATUS);
        return to_route('task.list');
    }
}
