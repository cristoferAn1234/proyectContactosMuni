<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TipoOrganizacionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Ruta pública - Redirigir al login o dashboard según estado de autenticación
Route::get('/', function () {
    return auth()->check() 
        ? redirect()->route('dashboard') 
        : redirect()->route('login');
})->name('home');

// Dashboard - Solo usuarios autenticados, verificados y aprobados
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'approved'])->name('dashboard');


// ============================================
// RUTAS DE ADMINISTRADOR
// ============================================
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    
    Route::prefix('users')->group(function () {
    Route::post('/filters', [UserController::class, 'getUsersPendingApproval'])->middleware(['auth', 'verified'])->name('users.filter');
    Route::get('/', [UserController::class, 'getUsersPendingApproval'])->middleware(['auth', 'verified'])->name('users.getAll');
    Route::post('/{id}/approve', [UserController::class, 'approveUser'])->middleware(['auth', 'verified'])->name('users.approve');
    Route::post('/{id}/reject', [UserController::class, 'rejectUser'])->middleware(['auth', 'verified'])->name('users.reject');
    Route::post('/{id}/assign-role', [UserController::class, 'asignRole'])->name('users.assignRole');
});

Route::prefix('userTcu')->group(function () {
    Route::get('/gestionUsuarios', [UserController::class, 'viewGestionUsuarios'])->middleware(['auth', 'verified'])->name('userTcu.gestionUsuarios');
});

    // Gestión de tipos de organización (solo administradores)
    Route::prefix('tiposOrganizacion')->name('tiposOrganizacion.')->group(function () {
        Route::get('/', [TipoOrganizacionController::class, 'index'])->name('index');
        Route::post('/', [TipoOrganizacionController::class, 'store'])->name('store');
        Route::get('/{id}', [TipoOrganizacionController::class, 'show'])->name('show');
        Route::put('/{id}', [TipoOrganizacionController::class, 'update'])->name('update');
        Route::delete('/{id}', [TipoOrganizacionController::class, 'destroy'])->name('destroy');
    });
});

// ============================================
// RUTAS PARA USUARIOS AUTENTICADOS Y APROBADOS
// ============================================
Route::middleware(['auth', 'verified', 'approved'])->group(function () {
    
    // Perfil de usuario
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    // Gestión de contactos
    Route::prefix('contactos')->name('contactos.')->group(function () {
        Route::get('/', [\App\Http\Controllers\ContactoController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\ContactoController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\ContactoController::class, 'store'])->name('store');
        Route::get('/{id}', [\App\Http\Controllers\ContactoController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [\App\Http\Controllers\ContactoController::class, 'edit'])->name('edit');
        Route::put('/{id}', [\App\Http\Controllers\ContactoController::class, 'update'])->name('update');
        Route::delete('/{id}', [\App\Http\Controllers\ContactoController::class, 'destroy'])->name('destroy')->middleware('role:admin');
    });

    // Gestión de organizaciones
  Route::prefix('organizaciones')->name('organizaciones.')->group(function () {

    // === RUTAS QUE YA TENÍAS Y NO HAY QUE CAMBIAR ===
    Route::post('/', [\App\Http\Controllers\OrganizacionController::class, 'store'])->name('store');
    Route::get('/', [\App\Http\Controllers\OrganizacionController::class, 'index'])->name('index');
    Route::get('/disponibles', [\App\Http\Controllers\OrganizacionController::class, 'disponibles'])->name('disponibles');
    Route::get('/{id}', [\App\Http\Controllers\OrganizacionController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [\App\Http\Controllers\OrganizacionController::class, 'edit'])->name('edit');
    Route::get('/{id}/asignaciones', [\App\Http\Controllers\OrganizacionController::class, 'asignaciones'])->name('asignaciones');
    Route::post('/AsignarUsuario', [\App\Http\Controllers\OrganizacionController::class, 'assignarUsuario'])->name('asignarUsuario');
    Route::delete('/delete/{id}/user/{userId}', [\App\Http\Controllers\OrganizacionController::class, 'desasignarUsuario'])->name('desasignarUsuario');

    // === SEGUNDO BLOQUE DE RUTAS (AGREGADO SIN CAMBIAR NADA) ===
    Route::get('/create', [\App\Http\Controllers\OrganizacionController::class, 'create'])->name('create');
    Route::put('/{id}', [\App\Http\Controllers\OrganizacionController::class, 'update'])->name('update');
    Route::delete('/{id}', [\App\Http\Controllers\OrganizacionController::class, 'destroy'])
        ->name('destroy')
        ->middleware('role:admin');
});
});
require __DIR__.'/auth.php';
