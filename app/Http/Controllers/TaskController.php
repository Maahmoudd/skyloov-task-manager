<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteTaskRequest;
use App\Http\Requests\FilterTasksRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Services\ITaskService;
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
        return $task ? $this->respondSuccess($task, status: Response::HTTP_CREATED) : $this->respondError(errors: 'Failed to create task', message: 'Task not created', status: Response::HTTP_FORBIDDEN);
    }


    public function update(UpdateTaskRequest $request)
    {
        $task = $this->taskService->updateTask($request->validated());
        return $task ? $this->respondSuccess($task) : $this->respondError(errors: 'Failed to update task', message: 'Task not updated', status: Response::HTTP_FORBIDDEN);
    }

    public function destroy(DeleteTaskRequest $request)
    {
        $task = $this->taskService->deleteTask($request->validated()['id']);
        return $task ? $this->respondSuccess(message: 'Task deleted') : $this->respondError(errors: 'Failed to delete task', message: 'Task not deleted', status: Response::HTTP_FORBIDDEN);
    }
}
