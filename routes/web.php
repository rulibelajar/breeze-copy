<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserController;

use App\Http\Controllers\Airline\AirlineController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminGameWorldController;
use App\Http\Controllers\Admin\AircraftsController;
use App\Http\Controllers\AirlinesWorlds\AirlinesWorld1Controller;
use App\Http\Controllers\AirlinesWorlds\AirlinesWorld2Controller;
use App\Http\Controllers\AirlinesWorlds\AirlinesWorld3Controller;
use App\Models\AirlinesWorlds\AirlinesWorld1;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
        Route::post('/world1', [AirlinesWorld1Controller::class, 'store'])->name('world1.store');
        Route::post('/world2', [AirlinesWorld2Controller::class, 'store'])->name('world2.store');
        Route::post('/world3', [AirlinesWorld3Controller::class, 'store'])->name('world3.store');

        // Masuk ke halaman airline dalam satu world
        Route::get('/world{world}/airline/{airline}', [AirlineController::class, 'save'])
            ->name('airline.save');
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



        Route::get('/game-worlds', [AdminGameWorldController::class, 'index'])->name('gameworlds');
    });
