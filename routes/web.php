<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pasien', \App\Livewire\Pasien::class)->name('pasien');
Route::get('/poli', \App\Livewire\Poli::class)->name('poli');
Route::get('/dokter', \App\Livewire\Dokter::class)->name('dokter');

