<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TipoOrganizacionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Obtener todos los usuarios (solo para administradores)
Route::prefix('users')->group(function () {
    Route::post('/filters', [UserController::class, 'getUsersPendingApproval'])->middleware(['auth', 'verified'])->name('users.filter');
    Route::get('/', [UserController::class, 'getUsersPendingApproval'])->middleware(['auth', 'verified'])->name('users.getAll');
    Route::post('/{id}/approve', [UserController::class, 'approveUser'])->middleware(['auth', 'verified'])->name('users.approve');
    Route::post('/{id}/reject', [UserController::class, 'rejectUser'])->middleware(['auth', 'verified'])->name('users.reject');
});

//Gestion de Usuarios TCU, solo para administradores
Route::prefix('userTcu')->group(function () {
    Route::get('/gestionUsuarios', [UserController::class, 'viewGestionUsuarios'])->middleware(['auth', 'verified'])->name('userTcu.gestionUsuarios');
});



// Rutas protegidas por autenticación
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
Route::prefix('contactos')->group(function () {
  //  Route::get('/', [\App\Http\Controllers\ContactoController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\ContactoController::class, 'store']);
   // Route::get('/{id}', [\App\Http\Controllers\ContactoController::class, 'show']);
   // Route::put('/{id}', [\App\Http\Controllers\ContactoController::class, 'update']);
   // Route::delete('/{id}', [\App\Http\Controllers\ContactoController::class, 'destroy']);
});
Route::prefix('organizaciones')->group(function () {
  //  Route::get('/', [\App\Http\Controllers\ContactoController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\OrganizacionController::class, 'store']);
   // Route::get('/{id}', [\App\Http\Controllers\ContactoController::class, 'show']);
   // Route::put('/{id}', [\App\Http\Controllers\ContactoController::class, 'update']);
   // Route::delete('/{id}', [\App\Http\Controllers\ContactoController::class, 'destroy']);
});
require __DIR__.'/auth.php';
