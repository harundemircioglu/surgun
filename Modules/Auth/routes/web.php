<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\App\Http\Controllers\AuthController;
use Modules\Auth\App\Http\Controllers\UserController;

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

Route::get('/', [AuthController::class, 'loginIndex'])->name('auth.loginIndex');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::middleware(['web', 'auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    // change first password
    Route::get('/change-first-password', [AuthController::class, 'changeFirstPasswordIndex'])->name('auth.changeFirstPasswordIndex');
    Route::post('/change-first-password', [AuthController::class, 'changeFirstPassword'])->name('auth.changeFirstPassword');
});

Route::middleware(['auth', 'web'])->prefix('user')->name('user.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');

    Route::middleware(['can:can_create_data', 'can:can_update_data', 'can:can_delete_data'])->group(function () {
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::post('/destroy/{id}', [UserController::class, 'destroy'])->name('destroy');
    });
});
