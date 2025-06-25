<?php

use Illuminate\Support\Facades\Route;
use Modules\Plant\App\Http\Controllers\AccessionNotebookController;
use Modules\Plant\App\Http\Controllers\GardenLocationController;
use Modules\Plant\App\Http\Controllers\PlantController;
use Modules\Plant\App\Http\Controllers\PlantMaterialController;
use Modules\Plant\App\Http\Controllers\PlantOriginController;
use Modules\Plant\App\Http\Controllers\PlantStatusController;
use Modules\Plant\App\Http\Controllers\SeedBankController;
use Modules\Plant\App\Http\Controllers\SeedCabinetController;

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

Route::middleware(['web', 'auth', 'role:super-admin|admin|guest', 'check_first_password_change', 'check_two_step_verification'])->prefix('plant')->name('plant.')->group(function () {
    Route::prefix('material')->name('material.')->group(function () {
        // List and show routes
        Route::get('/', [PlantMaterialController::class, 'index'])->name('index');

        // Create, update, and delete routes
        Route::post('/store', [PlantMaterialController::class, 'store'])->name('store')->middleware('can:can_create_data');
        Route::post('/update/{id}', [PlantMaterialController::class, 'update'])->name('update')->middleware('can:can_update_data');
        Route::post('/destroy/{id}', [PlantMaterialController::class, 'destroy'])->name('destroy')->middleware('can:can_delete_data');
    });

    Route::prefix('origin')->name('origin.')->group(function () {
        // List and show routes
        Route::get('/', [PlantOriginController::class, 'index'])->name('index');

        // Create, update, and delete routes
        Route::post('/store', [PlantOriginController::class, 'store'])->name('store')->middleware('can:can_create_data');
        Route::post('/update/{id}', [PlantOriginController::class, 'update'])->name('update')->middleware('can:can_update_data');
        Route::post('/destroy/{id}', [PlantOriginController::class, 'destroy'])->name('destroy')->middleware('can:can_delete_data');
    });

    Route::prefix('accession-notebook')->name('accession-notebook.')->group(function () {
        // List and show routes
        Route::get('/', [AccessionNotebookController::class, 'index'])->name('index');

        // Create, update, and delete routes
        Route::post('/store', [AccessionNotebookController::class, 'store'])->name('store')->middleware('can:can_create_data');
        Route::post('/update/{id}', [AccessionNotebookController::class, 'update'])->name('update')->middleware('can:can_update_data');
        Route::post('/destroy/{id}', [AccessionNotebookController::class, 'destroy'])->name('destroy')->middleware('can:can_delete_data');
    });

    Route::prefix('seed-cabinet')->name('seed-cabinet.')->group(function () {
        // List and show routes
        Route::get('/', [SeedCabinetController::class, 'index'])->name('index');

        // Create, update, and delete routes
        Route::post('/store', [SeedCabinetController::class, 'store'])->name('store')->middleware('can:can_create_data');
        Route::post('/update/{id}', [SeedCabinetController::class, 'update'])->name('update')->middleware('can:can_update_data');
        Route::post('/destroy/{id}', [SeedCabinetController::class, 'destroy'])->name('destroy')->middleware('can:can_delete_data');
    });

    Route::prefix('seed-bank')->name('seed-bank.')->group(function () {
        // List and show routes
        Route::get('/', [SeedBankController::class, 'index'])->name('index');

        // Create, update, and delete routes
        Route::post('/store', [SeedBankController::class, 'store'])->name('store')->middleware('can:can_create_data');
        Route::post('/update/{id}', [SeedBankController::class, 'update'])->name('update')->middleware('can:can_update_data');
        Route::post('/destroy/{id}', [SeedBankController::class, 'destroy'])->name('destroy')->middleware('can:can_delete_data');
    });

    Route::prefix('garden-location')->name('garden-location.')->group(function () {
        // List and show routes
        Route::get('/', [GardenLocationController::class, 'index'])->name('index');

        // Create, update, and delete routes
        Route::post('/store', [GardenLocationController::class, 'store'])->name('store')->middleware('can:can_create_data');
        Route::post('/update/{id}', [GardenLocationController::class, 'update'])->name('update')->middleware('can:can_update_data');
        Route::post('/destroy/{id}', [GardenLocationController::class, 'destroy'])->name('destroy')->middleware('can:can_delete_data');
    });

    Route::prefix('plant-status')->name('plant-status.')->group(function () {
        // List and show routes
        Route::get('/', [PlantStatusController::class, 'index'])->name('index');

        // Create, update, and delete routes
        Route::post('/store', [PlantStatusController::class, 'store'])->name('store')->middleware('can:can_create_data');
        Route::post('/update/{id}', [PlantStatusController::class, 'update'])->name('update')->middleware('can:can_update_data');
        Route::post('/destroy/{id}', [PlantStatusController::class, 'destroy'])->name('destroy')->middleware('can:can_delete_data');
    });
});
