<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterTasksRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Services\ITaskService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends ApiBaseController
{
    public function __construct(protected ITaskService $taskService){}

    public function index(FilterTasksRequest $request)
    {
        $tasks = $this->taskService->listAllTasks();
        return $tasks ? $this->respondSuccess($tasks['resource']) : $this->respondError(errors: 'Failed to get tasks', message: 'Tasks not found', status: Response::HTTP_FORBIDDEN);
    }

    public function store(StoreTaskRequest $request)
    {
        $task = $this->taskService->createTask($request->validated());
        return $task ? $this->respondSuccess($task) : $this->respondError(errors: 'Failed to create task', message: 'Task not created', status: Response::HTTP_FORBIDDEN);
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
