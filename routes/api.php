<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProvinciaController;

Route::middleware('auth:sanctum')->group(function () {
  // Rutas protegidas que requieren autenticación
  Route::prefix('usuarios')->group(function () {
    Route::get('/', [UserController::class, 'getUser']);
   
    });

    Route::prefix(('provincias'))->group(function () {
        Route::get('/', [ProvinciaController::class, 'index']);
        Route::post('/', [ProvinciaController::class, 'store']);
        Route::put('/{id}', [ProvinciaController::class, 'update']);
        // Ruta para eliminar una provincia (opcional)
        // Route::delete('/{id}', [ProvinciaController::class, 'destroy']);
    });
});
           Route::post('/register', [UserController::class, 'register']);
            Route::post('/login', [UserController::class, 'login']);