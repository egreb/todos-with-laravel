<?php

use App\Http\Controllers\Api\TodoController as ApiTodoController;
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

Route::prefix("api")->group(function () {
    Route::get('todo', [ApiTodoController::class, 'index'])
        ->middleware('auth')
        ->name('todo');

    Route::post('todo/store', [ApiTodoController::class, 'store']);
});

require __DIR__ . '/auth.php';
