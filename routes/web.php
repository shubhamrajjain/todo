<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::resource('users', UserController::class);


Route::group(['as' => 'tasks.'], function () {
    Route::get('/{id?}', [TaskController::class, 'index'])->name('index');
    Route::get('/tasks/completed-task', [TaskController::class, 'completedTask'])->name('complete');
    Route::get('/tasks/pending-task', [TaskController::class, 'pendingTask'])->name('pending');
});

Route::group(['prefix' => 'task', 'as' => 'task.'], function () {
    Route::get('/create', [TaskController::class, 'create'])->name('create');
    Route::post('/store', [TaskController::class, 'store'])->name('store');
    Route::delete('/delete/{id}', [TaskController::class, 'delete'])->name('delete');
    Route::post('/change-status/{id}', [TaskController::class, 'changeStatus'])->name('status');
    Route::get('/export-tasks', [TaskController::class, 'export'])->name('export');
});
