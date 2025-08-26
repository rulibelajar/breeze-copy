<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\GameWorld\GameWorldController;
use App\Http\Controllers\Admin\AircraftsController;
use App\Http\Controllers\Worlds\World1Controller;
use App\Http\Controllers\Worlds\World2Controller;
use App\Http\Controllers\Worlds\World3Controller;

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
        Route::post('/world1', [World1Controller::class, 'store'])->name('world1.store');
        Route::post('/world2', [World2Controller::class, 'store'])->name('world2.store');
        Route::post('/world3', [World3Controller::class, 'store'])->name('world3.store');
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
        Route::get('/aircrafts', [AircraftsController::class, 'index'])->name('aircrafts');



        Route::get('game-worlds', [GameWorldController::class, 'index'])->name('gameworlds');
        Route::post('/world1', [World1Controller::class, 'store'])->name('world1.store');
    });
