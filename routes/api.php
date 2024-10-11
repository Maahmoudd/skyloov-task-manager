<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::post('login', AuthController::class)->name('login');


Route::prefix('tasks')->middleware('auth:sanctum')->group(function () {

    Route::apiResource('', TaskController::class)->only(['store', 'index']);
    Route::patch('', [TaskController::class, 'update'])->name('task.update');
    Route::delete('', [TaskController::class, 'destroy'])->name('task.destroy');
});
