<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
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

    Route::get('/profile',          [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update',  [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    Route::get('/settings',                              [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings/info',                        [SettingController::class, 'updateInfo'])->name('settings.info');
    Route::post('/settings/layanan',                     [SettingController::class, 'storeLayanan'])->name('settings.layanan.store');
    Route::post('/settings/layanan/{layanan}/update',    [SettingController::class, 'updateLayanan'])->name('settings.layanan.update');
    Route::post('/settings/layanan/{layanan}/toggle',    [SettingController::class, 'toggleLayanan'])->name('settings.layanan.toggle');
    Route::post('/settings/layanan/{layanan}/delete',    [SettingController::class, 'destroyLayanan'])->name('settings.layanan.destroy');
    Route::post('/settings/tampilan',                    [SettingController::class, 'updateTampilan'])->name('settings.tampilan');
});
