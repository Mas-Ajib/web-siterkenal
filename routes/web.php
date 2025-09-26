<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicFormController;
use App\Livewire\FormSkhpn;
use App\Livewire\FormRehabilitasi;
use App\Livewire\FormKegiatan;

use App\Livewire\PPIDForm;


Route::get('/', function () {
    return view('beranda');
})->name('beranda');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';




// Form layanan publik

Route::get('/skhpn', [PublicFormController::class, 'skhpn'])->name('form.skhpn');
Route::post('/skhpn', [PublicFormController::class, 'submitSkhpn'])->name('form.skhpn.submit');

Route::get('/rehabilitasi', [PublicFormController::class, 'rehabilitasi'])->name('form.rehabilitasi');
Route::post('/rehabilitasi', [PublicFormController::class, 'submitRehabilitasi'])->name('form.rehabilitasi.submit');

Route::get('/kegiatan', [PublicFormController::class, 'kegiatan'])->name('form.kegiatan');
Route::post('/kegiatan', [PublicFormController::class, 'submitKegiatan'])->name('form.kegiatan.submit');

Route::get('/pengaduan', [PublicFormController::class, 'pengaduan'])->name('form.pengaduan');
Route::post('/pengaduan', [PublicFormController::class, 'submitPengaduan'])->name('form.pengaduan.submit');

Route::get('/skhpn', FormSkhpn::class)->name('form.skhpn');
Route::get('/rehabilitasi', FormRehabilitasi::class)->name('form.rehabilitasi');
Route::get('/kegiatan', FormKegiatan::class)->name('form.kegiatan');


Route::get('/rehabilitasi/konfirmasi', function () {
    return view('rehabilitasi-konfirmasi');
})->name('rehabilitasi.konfirmasi');

// Form PPID
Route::get('/layanan/ppid', [App\Http\Controllers\PpidController::class, 'create'])->name('form.ppid');
Route::post('/layanan/ppid', [App\Http\Controllers\PpidController::class, 'store'])->name('form.ppid.submit');

// permohonan Kegiatan
Route::get('/kegiatan', function () {
    return view('pages.kegiatan.index');
})->name('form.kegiatan');

Route::get('/kegiatan/sosialisasi', function () {
    return view('pages.kegiatan.sosialisasi');
})->name('form.kegiatan.sosialisasi');

Route::get('/kegiatan/tesurine', function () {
    return view('pages.kegiatan.tesurine');
})->name('form.kegiatan.tesurine');

Route::get('/kegiatan/magang', function () {
    return view('pages.kegiatan.magang');
})->name('form.kegiatan.magang');

Route::get('/kegiatan/tat', function () {
    return view('pages.kegiatan.tat');
})->name('form.kegiatan.tat');


// form tes urine 
use App\Livewire\FormTesUrineMandiri;

Route::get('/tes-urine-mandiri', FormTesUrineMandiri::class)->name('form.tesurine');

use App\Livewire\FormMagang;
Route::get('/magang', FormMagang::class)->name('form.magang');

Route::get('/confirmation', function () {
    return view('confirmation', [
        'title' => request('title', 'Konfirmasi Pengisian Formulir'),
        'phone' => '628975419000', // nomor WA default (ubah sesuai kebutuhan)
    ]);
})->name('confirmation');


// Pengaduan Masyarakat
Route::get('/pengaduan', function () {
    return view('pages.pengaduan.index');
})->name('form.pengaduan');

Route::get('/pengaduan/gratifikasi', function () {
    return view('pages.pengaduan.gratifikasi');
})->name('form.pengaduan.gratifikasi');

Route::get('/pengaduan/whistleblowing', function () {
    return view('pages.pengaduan.whistleblowing');
})->name('form.pengaduan.whistleblowing');

Route::get('/pengaduan/penyalahgunaan', function () {
    return view('pages.pengaduan.penyalahgunaan');
})->name('form.pengaduan.penyalahgunaan');

Route::get('/pengaduan/kritik-saran', function () {
    return view('pages.pengaduan.kritik-saran');
})->name('form.pengaduan.kritik');

//tentang
Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');

// Route untuk PPID 
Route::get('/ppid', PPIDForm::class)->name('ppid');

Route::get('/ppid-informasi', function () {
    return view('ppid-informasi');
});

