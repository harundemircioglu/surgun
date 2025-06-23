<?php

use Illuminate\Support\Facades\Route;
use Modules\Role\App\Http\Controllers\RoleController;
use Modules\Role\App\Http\Controllers\UserPermissionController;

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

Route::middleware(['web', 'auth'])->prefix('role')->name('role.')->group(function () {
    // role routes

    Route::prefix('permission')->name('permission.')->group(function () {
        // permission routes

        Route::prefix('user-permission')->name('user-permission.')->group(function () {
            // user permission routes

            Route::middleware(['can:can_update_data'])->group(function () {
                Route::post('/update/{id}', [UserPermissionController::class, 'update'])->name('update');
            });
        });
    });
});
