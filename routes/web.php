<?php

use App\Http\Controllers\TimeTracker\Task\CreateTaskController;
use App\Http\Controllers\TimeTracker\Task\GetAllTaskController;
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
Route::get('/', function () {
    return view('welcome');
});

Route::post('/tasks', CreateTaskController::class);
Route::get('/tasks-list', GetAllTaskController::class);
