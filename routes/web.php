<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BuddieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AccountController;
use App\Http\Controllers\AbsenceRequestsController;
use App\Http\Controllers\ConversationsController;

Route::middleware('auth')->group(function(){
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::controller(StudentsController::class)->group(function () {
        Route::prefix('students')->group(function () {
            Route::name('students.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{student}', 'show')->name('show');
                Route::get('/{student}/edit', 'edit')->name('edit');
                Route::post('/{student}/edit', 'update');
                Route::get('/{student}/delete', 'delete')->name('destroy');
                Route::post('/{student}/delete', 'destroy');
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
                Route::get('/create', 'create')->name('create');
                Route::post('/create', 'store')->name('store');
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
                Route::get('/{id}/answer/delete', 'delete_answer')->name('delete_answer');
                Route::get('/{id}/publish', 'publish')->name('publish');
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
                Route::get('/request/{timestamp}/{vak}/{uid}', 'request')->name('request');
            });
        });
    });

    Route::controller(ProjectsController::class)->group(function () {
        Route::prefix('projects')->group(function () {
            Route::name('projects.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/save', 'store')->name('store')->withoutMiddleware('checkproject');
            });
        });
        Route::get('/project', 'own')->name('projects.own')->withoutMiddleware('checkproject');
    });

    Route::controller(AbsenceRequestsController::class)->group(function () {
        Route::prefix('absencerequests')->group(function () {
            Route::name('absencerequests.')->group(function () {
                Route::get('/', 'index')->name('index');
            });
        });
    });

    Route::controller(ProfileController::class)->group(function () {
        Route::prefix('profile')->group(function () {
            Route::name('profile.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/password', 'storepassword')->name('storepassword');
            });
        });
    });

    Route::controller(ConversationsController::class)->group(function () {
        Route::prefix('conversations')->group(function(){
            Route::name('conversations.')->group(function(){
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/create', 'store')->name('store');
                Route::get('/{id}', 'show')->name('show');
                Route::post('/{id}', 'update')->name('update');
                Route::post('/{id}/prepare', 'prepare')->name('prepare');
                Route::post('/{id}/addinvitees', 'addinvitees')->name('addinvitees');
                Route::post('/{id}/removeinvitee', 'removeinvitee')->name('removeinvitee');
            });
        });
    });
});

// Authentication routes
Route::withoutMiddleware(['auth', 'checkproject'])->group(function(){
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'post']);

    Route::get('/logout', [AccountController::class, 'logout'])->name('logout');
});
