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
use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\Auth\AdminLoginController;

// Public routes
Route::middleware('guest:admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

// Protected routes
Route::middleware('auth:admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/check-new-data', [DashboardController::class, 'checkNewData'])->name('checkNewData');
    
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
    // Sosialisasi
    Route::get('/sosialisasi', [LayananKegiatanController::class, 'sosialisasi'])->name('sosialisasi');
    Route::get('/sosialisasi/{id}/edit', [LayananKegiatanController::class, 'editSosialisasi'])->name('sosialisasi.edit');
    Route::put('/sosialisasi/{id}', [LayananKegiatanController::class, 'updateSosialisasi'])->name('sosialisasi.update');
    Route::delete('/sosialisasi/{id}', [LayananKegiatanController::class, 'destroySosialisasi'])->name('sosialisasi.destroy');
    
    // Tes Urine Mandiri
    Route::get('/tes-urine', [LayananKegiatanController::class, 'tesUrine'])->name('tes-urine');
    Route::get('/tes-urine/{id}/edit', [LayananKegiatanController::class, 'editTesUrine'])->name('tes-urine.edit');
    Route::put('/tes-urine/{id}', [LayananKegiatanController::class, 'updateTesUrine'])->name('tes-urine.update');
    Route::delete('/tes-urine/{id}', [LayananKegiatanController::class, 'destroyTesUrine'])->name('tes-urine.destroy');
    Route::get('/tes-urine/export', [LayananKegiatanController::class, 'exportTesUrine'])->name('tes-urine.export');
    
    // TAT
    Route::get('/tat', [LayananKegiatanController::class, 'tat'])->name('tat');
    Route::get('/tat/{id}/edit', [LayananKegiatanController::class, 'editTat'])->name('tat.edit');
    Route::put('/tat/{id}', [LayananKegiatanController::class, 'updateTat'])->name('tat.update');
    Route::delete('/tat/{id}', [LayananKegiatanController::class, 'destroyTat'])->name('tat.destroy');
    Route::get('/tat/export', [LayananKegiatanController::class, 'exportTat'])->name('tat.export');
    
    // Magang
    Route::get('/magang', [LayananKegiatanController::class, 'magang'])->name('magang');
    Route::get('/magang/{id}/edit', [LayananKegiatanController::class, 'editMagang'])->name('magang.edit');
    Route::put('/magang/{id}', [LayananKegiatanController::class, 'updateMagang'])->name('magang.update');
    Route::delete('/magang/{id}', [LayananKegiatanController::class, 'destroyMagang'])->name('magang.destroy');
    Route::get('/magang/export', [LayananKegiatanController::class, 'exportMagang'])->name('magang.export');
});
    // routes/web.php

Route::prefix('layanan/pengaduan')->name('layanan.pengaduan.')->group(function () {
    // Gratifikasi
    Route::get('/gratifikasi', [LayananPengaduanController::class, 'gratifikasi'])->name('gratifikasi');
    Route::get('/gratifikasi/{id}/edit', [LayananPengaduanController::class, 'editGratifikasi'])->name('gratifikasi.edit');
    Route::put('/gratifikasi/{id}', [LayananPengaduanController::class, 'updateGratifikasi'])->name('gratifikasi.update');
    Route::delete('/gratifikasi/{id}', [LayananPengaduanController::class, 'destroyGratifikasi'])->name('gratifikasi.destroy');
    Route::get('/gratifikasi/export/excel', [LayananPengaduanController::class, 'exportGratifikasi'])->name('gratifikasi.export');

    // Whistleblowing
    Route::get('/whistleblowing', [LayananPengaduanController::class, 'whistleblowing'])->name('whistleblowing');
    Route::get('/whistleblowing/{id}/edit', [LayananPengaduanController::class, 'editWhistleblowing'])->name('whistleblowing.edit');
    Route::put('/whistleblowing/{id}', [LayananPengaduanController::class, 'updateWhistleblowing'])->name('whistleblowing.update');
    Route::delete('/whistleblowing/{id}', [LayananPengaduanController::class, 'destroyWhistleblowing'])->name('whistleblowing.destroy');
    Route::get('/whistleblowing/export/excel', [LayananPengaduanController::class, 'exportWhistleblowing'])->name('whistleblowing.export');

    // Narkoba
    Route::get('/narkoba', [LayananPengaduanController::class, 'narkoba'])->name('narkoba');
    Route::get('/narkoba/{id}/edit', [LayananPengaduanController::class, 'editNarkoba'])->name('narkoba.edit');
    Route::put('/narkoba/{id}', [LayananPengaduanController::class, 'updateNarkoba'])->name('narkoba.update');
    Route::delete('/narkoba/{id}', [LayananPengaduanController::class, 'destroyNarkoba'])->name('narkoba.destroy');
    Route::get('/narkoba/export/excel', [LayananPengaduanController::class, 'exportNarkoba'])->name('narkoba.export');

    // Kritik Saran
    Route::get('/kritiksaran', [LayananPengaduanController::class, 'kritiksaran'])->name('kritiksaran');
    Route::get('/kritiksaran/{id}/edit', [LayananPengaduanController::class, 'editKritiksaran'])->name('kritiksaran.edit');
    Route::put('/kritiksaran/{id}', [LayananPengaduanController::class, 'updateKritiksaran'])->name('kritiksaran.update');
    Route::delete('/kritiksaran/{id}', [LayananPengaduanController::class, 'destroyKritiksaran'])->name('kritiksaran.destroy');
    Route::get('/kritiksaran/export/excel', [LayananPengaduanController::class, 'exportKritiksaran'])->name('kritiksaran.export');
});

// Admin Management Routes - HANYA Super Admin
    Route::prefix('management')->name('management.')->middleware('superadmin')->group(function () {
        Route::get('/', [AdminManagementController::class, 'index'])->name('index');
        Route::get('/create', [AdminManagementController::class, 'create'])->name('create');
        Route::post('/', [AdminManagementController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdminManagementController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminManagementController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminManagementController::class, 'destroy'])->name('destroy');
    });

    // Kelola Admin
    Route::resource('administrators', AdministratorController::class);

    // Logout 
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});