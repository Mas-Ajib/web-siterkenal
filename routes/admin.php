<?php
// // routes/admin.php

// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Admin\AuthController;
// use App\Http\Controllers\Admin\DashboardController;

// // Auth Routes
// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// // Protected Routes - menggunakan auth:admin langsung
// Route::middleware(['auth:admin'])->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
//     Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// });

// routes/admin.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LayananPpidController;
use App\Http\Controllers\Admin\LayananRehabilitasiController;
use App\Http\Controllers\Admin\LayananKegiatanController;
use App\Http\Controllers\Admin\LayananPengaduanController;
use App\Http\Controllers\Admin\AdministratorController;

// Public routes
Route::middleware('guest:admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

// Protected routes
Route::middleware('auth:admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Layanan Informasi PPID
    Route::prefix('layanan/ppid')->name('layanan.ppid.')->group(function () {
        Route::get('/', [LayananPpidController::class, 'index'])->name('index');
        Route::get('/{id}/edit', [LayananPpidController::class, 'edit'])->name('edit');
        Route::put('/{id}', [LayananPpidController::class, 'update'])->name('update');
        Route::delete('/{id}', [LayananPpidController::class, 'destroy'])->name('destroy');
        Route::get('/export', [LayananPpidController::class, 'exportExcel'])->name('export');
    });

    // Layanan Rehabilitasi
    Route::prefix('layanan/rehabilitasi')->name('layanan.rehabilitasi.')->group(function () {
    Route::get('/', [LayananRehabilitasiController::class, 'index'])->name('index');
    Route::get('/{id}/edit', [LayananRehabilitasiController::class, 'edit'])->name('edit');
    Route::put('/{id}', [LayananRehabilitasiController::class, 'update'])->name('update');
    Route::delete('/{id}', [LayananRehabilitasiController::class, 'destroy'])->name('destroy');
    Route::get('/export', [LayananRehabilitasiController::class, 'exportExcel'])->name('export');
    });

    // Layanan Kegiatan
    Route::prefix('layanan/kegiatan')->name('layanan.kegiatan.')->group(function () {
        Route::get('/sosialisasi', [LayananKegiatanController::class, 'sosialisasi'])->name('sosialisasi');
        Route::get('/magang', [LayananKegiatanController::class, 'magang'])->name('magang');
        Route::get('/tes-urine', [LayananKegiatanController::class, 'tesUrine'])->name('tes-urine');
        Route::get('/tat', [LayananKegiatanController::class, 'tat'])->name('tat');
    });

    // Layanan Pengaduan
    Route::prefix('layanan/pengaduan')->name('layanan.pengaduan.')->group(function () {
        Route::get('/gratifikasi', [LayananPengaduanController::class, 'gratifikasi'])->name('gratifikasi');
        Route::get('/whistleblower', [LayananPengaduanController::class, 'whistleblower'])->name('whistleblower');
        Route::get('/narkoba', [LayananPengaduanController::class, 'narkoba'])->name('narkoba');
        Route::get('/kritik-saran', [LayananPengaduanController::class, 'kritikSaran'])->name('kritik-saran');
    });

    // Kelola Admin
    Route::resource('administrators', AdministratorController::class);

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});