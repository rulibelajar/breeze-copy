<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\World\WorldController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';

// User Route
Route::middleware(['auth', 'userMiddleware'])->group(function () {
    Route::get('dashboard', [UserController::class, 'index'])->name('dashboard');
});

// Admin Route Coba
Route::middleware(['auth', 'adminMiddleware'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/user', [AdminUserController::class, 'index'])->name('user');
        Route::put('/users/{user}/ban', [AdminUserController::class, 'ban'])->name('user.ban');

        // World Model
        Route::resource('worlds', WorldController::class);
        Route::post('/worlds/{world}/reset', [WorldController::class, 'reset'])->name('worlds.reset');

        // API routes untuk real-time data
        Route::get('/api/worlds/{world}/data', [WorldController::class, 'getWorldData']);
    });
