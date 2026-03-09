<?php

use App\Http\Controllers\AlumniController;
use App\Http\Controllers\PelacakanController;
use App\Http\Controllers\ProfilPencarianController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('alumni.index');
});

Route::resource('alumni', AlumniController::class)->parameters([
    'alumni' => 'alumni',
]);

Route::get('/profil-pencarian/{alumni}', [ProfilPencarianController::class, 'show'])->name('profil.show');
Route::post('/profil-pencarian/{alumni}/generate', [ProfilPencarianController::class, 'generate'])->name('profil.generate');

Route::get('/pelacakan/{alumni}', [PelacakanController::class, 'index'])->name('pelacakan.index');
Route::post('/pelacakan/{alumni}/proses', [PelacakanController::class, 'proses'])->name('pelacakan.proses');
Route::post('/pelacakan/{alumni}/hasil/{hasil}/verifikasi', [PelacakanController::class, 'verifikasi'])->name('pelacakan.verifikasi');
Route::post('/pelacakan/{alumni}/hasil/{hasil}/simpan', [PelacakanController::class, 'simpan'])->name('pelacakan.simpan');
