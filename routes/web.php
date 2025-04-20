<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\LayananController;

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

    Route::resource('pelanggan', PelangganController::class)->except(['show']);
    Route::resource('layanan', LayananController::class)->except(['show']);

    Route::get('/dataPengeluaran', function () {
        return view('dataPengeluaran');
    })->name('dataPengeluaran');

});