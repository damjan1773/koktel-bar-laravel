<?php

use App\Http\Controllers\KoktelController;
use App\Http\Controllers\KorisnikController;
use App\Http\Controllers\PorudzbinaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SastojakController;
use Illuminate\Support\Facades\Route;

Route::get('/konobar', fn () => view('konobar.dashboard'))->middleware('auth');
Route::middleware(['auth', 'role:konobar'])->group(function () {
    Route::get('/konobar/porudzbine', [PorudzbinaController::class, 'konobarIndex'])->name('konobar.porudzbine.index');
    Route::get('/konobar/porudzbine/create', [PorudzbinaController::class, 'konobarCreate'])->name('konobar.porudzbine.create');
    Route::post('/konobar/porudzbine', [PorudzbinaController::class, 'konobarStore'])->name('konobar.porudzbine.store');
    Route::get('/konobar/porudzbine/{porudzbina}/sent', [PorudzbinaController::class, 'konobarSent'])->name('konobar.porudzbine.sent');
    Route::post('/konobar/porudzbine/{porudzbina}/isporuceno', [PorudzbinaController::class, 'konobarIsporuceno'])->name('konobar.porudzbine.isporuceno');

});

Route::middleware(['auth', 'role:sanker'])->group(function () {
    Route::get('/sanker/porudzbine', [PorudzbinaController::class, 'sankerIndex'])->name('sanker.porudzbine.index');
    Route::post('/sanker/porudzbine/{porudzbina}/spremno', [PorudzbinaController::class, 'sankerSpremno'])->name('sanker.porudzbine.spremno');
    Route::get('/sanker', fn () => view('sanker.dashboard'))
        ->name('sanker.dashboard');

});

Route::middleware(['auth', 'role:menadzer'])->group(function () {

    Route::get('/menadzer', fn () => view('menadzer.dashboard'))
        ->name('menadzer.dashboard');

    Route::resource('koktels', KoktelController::class);
    Route::resource('sastojaks', SastojakController::class);

    Route::get('/menadzer/porudzbine', [PorudzbinaController::class, 'menadzerIndex'])
        ->name('menadzer.porudzbine.index');

    Route::get('/menadzer/porudzbine/{porudzbina}/edit', [PorudzbinaController::class, 'menadzerEdit'])
        ->name('menadzer.porudzbine.edit');

    Route::put('/menadzer/porudzbine/{porudzbina}', [PorudzbinaController::class, 'menadzerUpdate'])
        ->name('menadzer.porudzbine.update');

    Route::delete('/menadzer/porudzbine/{porudzbina}', [PorudzbinaController::class, 'menadzerDestroy'])
        ->name('menadzer.porudzbine.destroy');

    Route::patch('/sastojaks/{sastojak}/plus', [SastojakController::class, 'plus'])
        ->name('sastojaks.plus');

    Route::patch('/sastojaks/{sastojak}/minus', [SastojakController::class, 'minus'])
        ->name('sastojaks.minus');

});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('korisnici', KorisnikController::class);
Route::resource('kokteli', KoktelController::class);
Route::resource('sastojci', SastojakController::class);
Route::resource('porudzbinas', PorudzbinaController::class) ->only(['edit', 'update']);

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
