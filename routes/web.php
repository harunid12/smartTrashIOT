<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TrashDataController;

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

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/auth', [AuthController::class, 'authenticate'])->name('auth');
});

Route::middleware('auth')->group(function (){
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // profile
    Route::get('/settings', [UserController::class, 'settings'])->name('settings');
    Route::put('/profile_update', [UserController::class, 'update'])->name('profileUpdate');
    
    // trash data
    Route::get('/g', [TrashDataController::class, 'index'])->name('data');
    
});