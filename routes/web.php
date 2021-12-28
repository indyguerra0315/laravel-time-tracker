<?php

use App\Http\Controllers\TimeTracker\Task\CreateTaskController;
use App\Http\Controllers\TimeTracker\Task\FinishTaskController;
use App\Http\Controllers\TimeTracker\Task\GetAllTaskController;
use App\Http\Controllers\TimeTracker\Task\HomeController;
use App\Http\Controllers\TimeTracker\Task\ViewTaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Listado de Tareas
Route::get('/', HomeController::class);
Route::post('/tasks', CreateTaskController::class);
Route::post('/tasks/{id}', FinishTaskController::class);
Route::get('/tasks/{id}', ViewTaskController::class);
Route::get('/tasks-list', GetAllTaskController::class);
