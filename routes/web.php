<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PengeluaranController;


Route::get('/', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/grafik', function () {
        return view('index');
    })->name('index');

    Route::get('/dataPesanan', function () {
        return view('dataPesanan');
    })->name('dataPesanan');

    Route::get('/tambahPesanan', function () {
        return view('pesanan.tambahPesanan');
    })->name('tambahPesanan');

    Route::get('/detailPesanan', function () {
        return view('pesanan.detailPesanan');
    })->name('detailPesanan');

    Route::get('/editPesanan', function () {
        return view('pesanan.editPesanan');
    })->name('editPesanan');


    Route::resource('pelanggan', PelangganController::class)->except(['show']);
    Route::resource('layanan', LayananController::class)->except(['show']);
    Route::resource('pengeluaran', PengeluaranController::class)->except(['show']);

});
