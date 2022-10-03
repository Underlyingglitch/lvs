<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BuddieController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LeerlingenController;
use App\Http\Controllers\Auth\AccountController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Route::get('/leerlingen', [LeerlingenController::class, 'index'])->name('leerlingen');
// Route::get('/leerlingen/{id}', [LeerlingenController::class, 'view'])->name('leerlingen.view');

Route::controller(LeerlingenController::class)->group(function () {
    Route::prefix('leerlingen')->group(function () {
        Route::name('leerlingen.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{id}', 'show')->name('show');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::post('/{id}/edit', 'update');
            Route::get('/{id}/delete', 'delete')->name('destroy');
            Route::post('/{id}/delete', 'destroy');
        });
    });
});

Route::controller(BuddieController::class)->group(function () {
    Route::prefix('buddies')->group(function () {
        Route::name('buddies.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{id}', 'show')->name('show');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::post('/{id}/edit', 'update');
            Route::get('/{id}/delete', 'delete')->name('destroy');
            Route::post('/{id}/delete', 'destroy');
        });
    });
});

Route::controller(UserController::class)->group(function () {
    Route::prefix('users')->group(function () {
        Route::name('users.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{id}', 'show')->name('show');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::post('/{id}/edit', 'update');
            Route::get('/{id}/delete', 'delete')->name('delete');
            Route::post('/{id}/delete/confirm', 'destroy')->name('destroy');
        });
    });
});

// Authentication routes
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'post']);

Route::get('/logout', [AccountController::class, 'logout'])->name('logout');