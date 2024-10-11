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

    public function getTaskById(int $id): ?Task
    {
        return $this->taskRepository->find($id);
    }

    public function updateTask(array $data): ?TaskResource
    {
        $task = $this->getTaskById($data['id']);
        return $task ? TaskResource::make($this->taskRepository->update($data, $task->id)->load('user')) : null;
    }

    public function deleteTask(int $id): bool
    {
        return $this->taskRepository->delete($id);
    }
}
