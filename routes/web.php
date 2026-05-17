<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use Illuminate\Support\Facades\Route;

Route::get('/',       [AuthController::class, 'showLogin'])->name('login');
Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/staff',                        [KaryawanController::class, 'index'])->name('staff.index');
    Route::post('/staff',                       [KaryawanController::class, 'store'])->name('staff.store');
    Route::post('/staff/{karyawan}/update',     [KaryawanController::class, 'update'])->name('staff.update');
    Route::post('/staff/{karyawan}/delete',     [KaryawanController::class, 'destroy'])->name('staff.destroy');
    Route::post('/karyawan/{karyawan}/update-status', [DashboardController::class, 'updateStatus'])
        ->name('karyawan.update-status');
});
