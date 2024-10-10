<?php

namespace App\Services;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskService implements ITaskService
{

    public function listAllTasks(): ?AnonymousResourceCollection
    {
        // TODO: Implement listAllTasks() method.
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
