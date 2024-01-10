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
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// User Profile Routes
Route::get('/profile', [UserController::class, 'view_profile']);
Route::get('/edit', [UserController::class, 'edit']);
Route::patch('/edit', [UserController::class, 'edit_profile'])->name('edit_profile');

// User Authentication Routes
Route::get('/register', [UserController::class, 'register_page']);
Route::post('/register', [UserController::class, 'register']);
Route::get('/login', [UserController::class, 'login_page']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// Task Routes
Route::get('/add_task', [TaskController::class, 'add_task']);
Route::post('/add_task', [TaskController::class, 'create_task'])->name('create_task');
Route::get('/', [TaskController::class, 'index'])->name('search');
Route::get('/{taskId}', [TaskController::class, 'view_task'])->name('view_task');
Route::get('/edit_task/{taskId}', [TaskController::class, 'edit_task'])->name('edit_task');
Route::patch('/edit_task/{taskId}', [TaskController::class, 'update_task'])->name('update_task');
Route::delete('/delete/{taskId}', [TaskController::class, 'destroy'])->name('delete_task');

