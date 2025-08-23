<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\GameWorld\GameWorldController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


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
Route::middleware(['auth', 'userMiddleware'])
    ->group(function () {
        //Route::get('/', [UserController::class, 'index'])->name('worlds');
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
        Route::get('/worlds', [UserController::class, 'worlds'])->name('worlds');
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



        Route::get('game-worlds', [GameWorldController::class, 'index'])->name('gameworlds');
    });
