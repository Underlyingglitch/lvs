<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BuddieController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LeerlingenController;
use App\Http\Controllers\Auth\AccountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/leerlingen', [LeerlingenController::class, 'index'])->name('leerlingen');
Route::get('/leerlingen/{id}', [LeerlingenController::class, 'view'])->name('leerlingen.view');

Route::get('/buddies', [BuddieController::class, 'index'])->name('buddies');
Route::get('/buddies/{id}', [BuddieController::class, 'view'])->name('buddies.view');

// Authentication routes
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'post']);

Route::get('/logout', [AccountController::class, 'logout'])->name('logout');