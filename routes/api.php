<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Middleware\AuthorizeTask;
use Illuminate\Support\Facades\Route;

Route::post('login', AuthController::class)->name('login');


Route::prefix('tasks')->middleware('auth:sanctum')->as('tasks.')->group(function () {

    Route::apiResource('', TaskController::class)->only(['store', 'index']);
    Route::put('', [TaskController::class, 'update'])->middleware(AuthorizeTask::class)->name('update');
    Route::delete('', [TaskController::class, 'destroy'])->middleware(AuthorizeTask::class)->name('destroy');
});
