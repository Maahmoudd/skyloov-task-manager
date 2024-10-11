<?php

namespace App\Services;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Repositories\ITaskRepository;

class TaskService implements ITaskService
{
    public function __construct(protected ITaskRepository $taskRepository){}

    public function listAllTasks(): ?array
    {
        $tasks = $this->taskRepository->with('user')->orderBy('due_date')->paginate();
        return $tasks ? (array)TaskResource::collection($tasks) : null;
    }

    public function createTask(array $data): ?TaskResource
    {
        $task = Task::create($data);
        return $task ? TaskResource::make($task->load('user')) : null;
    }

    public function getTaskById(int $id): ?TaskResource
    {
        // TODO: Implement getTaskById() method.
    }

    public function updateTask(array $data, $id): ?TaskResource
    {
        // TODO: Implement updateTask() method.
    }

    public function deleteTask(int $id): bool
    {
        // TODO: Implement deleteTask() method.
    }
}
