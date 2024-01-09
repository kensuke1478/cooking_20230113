<?php

use Illuminate\Support\Facades\Route;
use App\HTTP\Controllers\TasksController;

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

Route::get('/', [TasksController::class, 'index'])->name('tasks.index');
Route::get('/tasks/add',[TasksController::class, 'add'])->name('tasks.add');
Route::post('/tasks/add',[TasksController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{task}/edit',[TasksController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{task}',[TasksController::class, 'update'])->name('tasks.update');
Route::post('/tasks/derete/{id}',[TasksController::class, 'derete'])->name('tasks.derete');
Route::get('/tasks/{task}/show', [TasksController::class, 'show'])->name('tasks.show');
