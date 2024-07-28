<?php

use App\Http\Controllers\LabelController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskStatusController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('index');
})->name('dashboard');

Route::get('task_statuses', [TaskStatusController::class, 'index'])->name('task_statuses.index');
Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::get('labels', [LabelController::class, 'index'])->name('labels.index');

Route::middleware('auth')->group(function () {
    Route::resource('tasks', TaskController::class)->except([
        'index', 'show',
    ]);
    Route::resource('task_statuses', TaskStatusController::class)->except([
        'index', 'show'
    ]);
    Route::resource('labels', LabelController::class)->except([
        'index', 'show'
    ]);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
Route::get('labels/{label}', [LabelController::class, 'show'])->name('labels.show');

require __DIR__ . '/auth.php';
