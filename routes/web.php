<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    Route::get('/grafik', function () {
        return view('index');
    })->name('index');

    Route::get('/dataPesanan', function () {
        return view('dataPesanan');
    })->name('dataPesanan');

    Route::get('/dataPelanggan', function () {
        return view('dataPelanggan');
    })->name('dataPelanggan');

    Route::get('/dataPengeluaran', function () {
        return view('dataPengeluaran');
    })->name('dataPengeluaran');

    Route::get('/dataLayanan', function () {
        return view('dataLayanan');
    })->name('dataLayanan');
});