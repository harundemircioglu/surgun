<?php

use Illuminate\Support\Facades\Route;
use Modules\Plant\App\Http\Controllers\PlantController;

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

Route::middleware(['web', 'auth', 'role:super-admin|admin|guest'])->prefix('plant')->name('plant.')->group(function () {
    Route::prefix('material')->name('material.')->group(function () {

    });

    Route::prefix('origin')->name('origin.')->group(function () {

    });

    Route::prefix('accession-notebook')->name('accession-notebook.')->group(function () {

    });

    Route::prefix('seed-cabinet')->name('seed-cabinet.')->group(function () {

    });

    Route::prefix('seed-bank')->name('seed-bank.')->group(function () {

    });

    Route::prefix('garden-location')->name('garden-location.')->group(function () {

    });

    Route::prefix('plant-status')->name('plant-status.')->group(function () {

    });
});
