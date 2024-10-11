<?php

namespace App\Services;

use App\Http\Resources\TaskResource;
use App\Models\Task;

interface ITaskService
{
    public function listAllTasks(): ?array;
    public function createTask(array $data): ?TaskResource;
    public function getTaskById(int $id): ?Task;
    public function updateTask(array $data): ?TaskResource;
    public function deleteTask(int $id): bool;

}
