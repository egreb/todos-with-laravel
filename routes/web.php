<?php

use App\Http\Controllers\TodoController;
use App\Models\Todo;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $todos = Todo::all()->sortByDesc('created_at');
    return view('dashboard', ['todos' => $todos]);
})->middleware(['auth'])->name('dashboard');

Route::post('/todo/create', [TodoController::class, 'create'])
    ->middleware('auth')
    ->name('todo.create');

Route::delete('/todo/delete/{id}', [TodoController::class, 'delete'])
    ->middleware('auth')
    ->name('todo.delete');

Route::patch('/todo/{id}/complete', [TodoController::class, 'complete'])
    ->middleware('auth')
    ->name('todo.complete');

require __DIR__ . '/auth.php';
