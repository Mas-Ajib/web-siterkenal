<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LayananPpidController;
use App\Http\Controllers\Admin\LayananRehabilitasiController;
use App\Http\Controllers\Admin\AdministratorController;
use App\Http\Controllers\Admin\AuthController;

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

// Layanan Permohonan Kegiatan
Route::prefix('layanan/kegiatan')->name('layanan.kegiatan.')->group(function () {
    // Sosialisasi
    Route::get('/sosialisasi', [LayananKegiatanController::class, 'sosialisasi'])->name('sosialisasi');
    Route::get('/sosialisasi/{id}/edit', [LayananKegiatanController::class, 'editSosialisasi'])->name('sosialisasi.edit');
    
    // Magang
    Route::get('/magang', [LayananKegiatanController::class, 'magang'])->name('magang');
    Route::get('/magang/{id}/edit', [LayananKegiatanController::class, 'editMagang'])->name('magang.edit');
    
    // Tes Urine
    Route::get('/tes-urine', [LayananKegiatanController::class, 'tesUrine'])->name('tes-urine');
    Route::get('/tes-urine/{id}/edit', [LayananKegiatanController::class, 'editTesUrine'])->name('tes-urine.edit');
    
    // TAT
    Route::get('/tat', [LayananKegiatanController::class, 'tat'])->name('tat');
    Route::get('/tat/{id}/edit', [LayananKegiatanController::class, 'editTat'])->name('tat.edit');
});

// Layanan Pengaduan Masyarakat
Route::prefix('layanan/pengaduan')->name('layanan.pengaduan.')->group(function () {
    // Gratifikasi
    Route::get('/gratifikasi', [LayananPengaduanController::class, 'gratifikasi'])->name('gratifikasi');
    Route::get('/gratifikasi/{id}/edit', [LayananPengaduanController::class, 'editGratifikasi'])->name('gratifikasi.edit');
    
    // Whistleblower
    Route::get('/whistleblower', [LayananPengaduanController::class, 'whistleblower'])->name('whistleblower');
    Route::get('/whistleblower/{id}/edit', [LayananPengaduanController::class, 'editWhistleblower'])->name('whistleblower.edit');
    
    // Narkoba
    Route::get('/narkoba', [LayananPengaduanController::class, 'narkoba'])->name('narkoba');
    Route::get('/narkoba/{id}/edit', [LayananPengaduanController::class, 'editNarkoba'])->name('narkoba.edit');
    
    // Kritik & Saran
    Route::get('/kritik-saran', [LayananPengaduanController::class, 'kritikSaran'])->name('kritik-saran');
    Route::get('/kritik-saran/{id}/edit', [LayananPengaduanController::class, 'editKritikSaran'])->name('kritik-saran.edit');
});

// Kelola Admin
Route::resource('administrators', AdministratorController::class);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');