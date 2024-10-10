<?php

namespace App\Services;

use App\Http\Resources\TaskResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface ITaskService
{
    public function listAllTasks(): ?AnonymousResourceCollection;
    public function createTask(array $data): ?TaskResource;
    public function getTaskById(int $id): ?TaskResource;
    public function updateTask(array $data, $id): ?TaskResource;
    public function deleteTask(int $id): bool;

}
