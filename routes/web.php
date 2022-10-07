<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BuddieController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AccountController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Route::get('/leerlingen', [LeerlingenController::class, 'index'])->name('leerlingen');
// Route::get('/leerlingen/{id}', [LeerlingenController::class, 'view'])->name('leerlingen.view');

Route::controller(StudentsController::class)->group(function () {
    Route::prefix('students')->group(function () {
        Route::name('students.')->group(function () {
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

Route::controller(QuestionController::class)->group(function () {
    Route::prefix('questions')->group(function () {
        Route::name('questions.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('store');
            Route::get('/{id}', 'show')->name('show');
            Route::post('/{id}/answer', 'answer')->name('answer');
            Route::get('/{id}/delete', 'delete')->name('delete');
            Route::post('/{id}/delete/confirm', 'destroy')->name('destroy');
        });
    });
});

Route::controller(ScheduleController::class)->group(function () {
    Route::prefix('schedule')->group(function () {
        Route::name('schedule.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'post')->name('post');
            Route::get('/request/{timestamp}/{vak}', 'request')->name('request');
        });
    });
});

// Authentication routes
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'post']);

Route::get('/logout', [AccountController::class, 'logout'])->name('logout');