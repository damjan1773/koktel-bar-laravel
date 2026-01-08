<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KorisnikController;
use App\Http\Controllers\KoktelController;
use App\Http\Controllers\SastojakController;
use App\Http\Controllers\PorudzbinaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('korisnici', KorisnikController::class);
Route::resource('kokteli', KoktelController::class);
Route::resource('sastojci', SastojakController::class);
Route::resource('porudzbine', PorudzbinaController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('korisniks', App\Http\Controllers\KorisnikController::class);

    Route::resource('koktels', App\Http\Controllers\KoktelController::class);

    Route::resource('sastojaks', App\Http\Controllers\SastojakController::class);

    Route::resource('porudzbinas', App\Http\Controllers\PorudzbinaController::class);
});

require __DIR__.'/auth.php';
