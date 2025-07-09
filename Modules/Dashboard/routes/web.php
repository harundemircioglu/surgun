<?php

use Illuminate\Support\Facades\Route;
use Modules\Dashboard\App\Http\Controllers\AuthenticationActivityController;
use Modules\Dashboard\App\Http\Controllers\ChartController;
use Modules\Dashboard\App\Http\Controllers\DashboardController;

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

Route::middleware(['web', 'auth', 'check_user_active_status', 'check_first_password_change', 'check_two_step_verification'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::middleware(['role:super-admin'])->group(function () {
        Route::get('/authentication-activities', [AuthenticationActivityController::class, 'index'])->name('authenticationActivities.index');

        Route::get('/charts', [ChartController::class, 'index'])->name('charts');

        Route::get('/get-accession-notebook-chart-data', [ChartController::class, 'getAccessionNotebookData'])->name('getAccessionNotebookData');

        Route::get('/get-seed-bank-data', [ChartController::class, 'getSeedBankData'])->name('getSeedBankData');
    });
});
