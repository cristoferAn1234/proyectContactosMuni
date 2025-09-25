<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TipoOrganizacionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::prefix('tiposOrganizacion')->group(function () {
    Route::get('/', [TipoOrganizacionController::class, 'index']);
    Route::post('/', [TipoOrganizacionController::class, 'store']);
    Route::get('/{id}', [TipoOrganizacionController::class, 'show']);
    Route::put('/{id}', [TipoOrganizacionController::class, 'update']);
    Route::delete('/{id}', [TipoOrganizacionController::class, 'destroy']);
});

require __DIR__.'/auth.php';
