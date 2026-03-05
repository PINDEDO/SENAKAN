<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// ... (rest of the file)

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class , 'index'])->name('dashboard');
    Route::get('/board', [BoardController::class , 'index'])->name('board.index');
    Route::get('/projects', [ProjectController::class , 'index'])->name('projects.index');

    Route::get('/profile', [ProfileController::class , 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class , 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class , 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin,coordinador'])->prefix('admin')->group(function () {
    Route::get('/metrics', [AdminController::class , 'index'])->name('admin.metrics');
    Route::get('/users', [UserController::class , 'index'])->name('users.index');
    Route::get('/reports', [ReportController::class , 'index'])->name('reports.index');

    // Project Management
    Route::post('/projects', [ProjectController::class , 'store'])->name('projects.store');
    Route::put('/projects/{project}', [ProjectController::class , 'update'])->name('projects.update');
    Route::delete('/projects/{project}', [ProjectController::class , 'destroy'])->name('projects.destroy');

    // Task Management
    Route::post('/tasks', [TaskController::class , 'store'])->name('tasks.store');
    Route::post('/tasks/update-order', [TaskController::class , 'updateOrder'])->name('tasks.updateOrder');
});

require __DIR__ . '/auth.php';
