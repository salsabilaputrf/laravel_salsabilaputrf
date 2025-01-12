<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\RumahSakitController;
use App\Http\Controllers\DashboardController;
use Illuminate\Foundation\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::resource('rumah_sakit', RumahSakitController::class);
Route::resource('pasien', PasienController::class);


Route::delete('/pasien/{id}', [PasienController::class, 'destroy'])->name('pasien.destroy');
Route::delete('/rumah_sakit/{id}', [RumahSakitController::class, 'destroy'])->name('rumah_sakit.destroy');


Route::get('/pasien/data', [PasienController::class, 'index'])->name('pasien.index');
Route::get('/rumah_sakit', [RumahSakitController::class, 'index'])->name('rumah_sakit.index');


Route::get('/pasien/filter/{rumah_sakit_id}', [PasienController::class, 'filter'])->name('pasien.filter');

Route::post('/pasien/create', [PasienController::class, 'store'])->name('pasien.store');
Route::post('/rumah_sakit/create', [RumahSakitController::class, 'store'])->name('rumah_sakit.store');

Route::put('/rumah-sakit/{id}', [RumahSakitController::class, 'update'])->name('rumah_sakit.update');
Route::put('/pasien/{id}', [PasienController::class, 'update'])->name('pasien.update');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__.'/auth.php';
