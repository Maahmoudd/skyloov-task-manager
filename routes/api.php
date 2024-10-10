<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::post('login', AuthController::class)->name('login');

Route::apiResource('tasks', TaskController::class)->middleware('auth:sanctum');
