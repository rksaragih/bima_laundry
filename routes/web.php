<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\LayananPengirimanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\DashboardController;

Route::view('/', 'welcome');

Route::get('/loginPage', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/grafik', [DashboardController::class, 'getGrafik'])->name('index');

    Route::resource('pesanan', PesananController::class)->except(['show']);
    Route::get('/detailPesanan/{id}', [PesananController::class, 'detail'])->name('pesanan.detail');
    Route::get('/editPesanan/{id}', [PesananController::class, 'edit'])->name('pesanan.edit');
    Route::put('/pesanan/status/{id}', [PesananController::class, 'updateStatus'])->name('pesanan.updateStatus');
    Route::get('/searchPesanan', [PesananController::class, 'searchByNama'])->name('pesanan.search');
    Route::get('pesanan/{id}/print', [PesananController::class, 'printNota'])->name('pesanan.print');
    Route::get('/pesanan/filter', [PesananController::class, 'filter'])->name('pesanan.filter');
    Route::get('/pesanan/export', [PesananController::class, 'export'])->name('pesanan.export');

    Route::resource('pelanggan', PelangganController::class)->except(['show']);
    Route::get('/searchPelanggan', [PelangganController::class, 'searchByNama'])->name('pelanggan.search');
    Route::get('/pelanggan/export', [PelangganController::class, 'export'])->name('pelanggan.export');
    Route::resource('layanan', LayananController::class)->except(['show']);
    Route::resource('pengeluaran', PengeluaranController::class)->except(['show']);
    Route::get('/layanan-pengiriman', [LayananPengirimanController::class, 'index'])->name('layananpengiriman.index');
    Route::get('/pengeluaran/export', [PengeluaranController::class, 'export'])->name('pengeluaran.export');

});
