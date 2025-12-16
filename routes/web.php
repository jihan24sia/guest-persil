<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PetaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\PersilController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SengketaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\DokumentasiController;
use App\Http\Controllers\JenisPenggunaanController;

// =========================
// Halaman Publik
// =========================
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/servis', [ServiceController::class, 'index'])->name('servis');
Route::get('/dokumentasi', [DokumentasiController::class, 'index'])->name('dokumentasi');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/developer', [DeveloperController::class, 'index'])->name('developer');
Route::resource('user', UserController::class);

// =========================
// Custom Route: Delete Media
// (HARUS di atas resource!)
// =========================
Route::delete('/persil/media/{media}', [PersilController::class, 'deleteMedia'])
    ->name('persil.media.delete');

Route::delete('/dokumen/media/{media}', [DokumenController::class, 'deleteMedia'])
    ->name('dokumen.media.delete');

Route::delete('/sengketa/media/{media}', [SengketaController::class, 'deleteMedia'])
    ->name('sengketa.media.delete');

Route::delete('/peta/media/{media}', [PetaController::class, 'deleteMedia'])
    ->name('peta.media.delete');
// web.php
Route::get('/peta/{peta}/detail', [PetaController::class, 'showDetail'])->name('peta.detail');

// =========================
// Admin Resource Routes
// =========================



/* LOGIN */
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'role:admin,super_admin'])->group(function () {



    Route::resource('warga', WargaController::class);

    Route::resource('persil', PersilController::class);
    Route::resource('dokumen', DokumenController::class);
    Route::resource('peta', PetaController::class);
    Route::resource('sengketa', SengketaController::class);
    Route::resource('jenis', JenisPenggunaanController::class);
});
