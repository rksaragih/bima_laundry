<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
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

Route::get('/login', function () {
    return view('login');
})->name('login');