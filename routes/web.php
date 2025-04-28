<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PesananController;


Route::get('/', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/grafik', [AuthController::class, 'getGrafik'])->name('index');
    Route::resource('pesanan', PesananController::class)->except(['show']);
    Route::get('/detailPesanan/{id}', [PesananController::class, 'detail'])->name('pesanan.detail');
    Route::get('/editPesanan/{id}', [PesananController::class, 'edit'])->name('pesanan.edit');
    Route::put('/pesanan/status/{id}', [PesananController::class, 'updateStatus'])->name('pesanan.updateStatus');
    Route::resource('pelanggan', PelangganController::class)->except(['show']);
    Route::resource('layanan', LayananController::class)->except(['show']);
    Route::resource('pengeluaran', PengeluaranController::class)->except(['show']);
});
