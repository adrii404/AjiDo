<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('test', 'test');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('todo', 'todo')
    ->middleware(['auth', 'verified'])
    ->name('todo');

Route::view('calendar', 'calendar')
    ->middleware(['auth', 'verified'])
    ->name('calendar');

Route::view('tracker', 'tracker')
    ->middleware(['auth', 'verified'])
    ->name('tracker');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/todos', [TodoController::class, 'index']);
Route::post('/todos', [TodoController::class, 'store']);

Route::patch('/todos/{todo}/toggle', [TodoController::class, 'toggle']);

require __DIR__.'/auth.php';
