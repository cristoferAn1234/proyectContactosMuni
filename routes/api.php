<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::middleware('auth:sanctum')->group(function () {
  // Rutas protegidas que requieren autenticación
  Route::prefix('usuarios')->group(function () {
    Route::get('/', [UserController::class, 'getUser']);
   
    });
});
           Route::post('/register', [UserController::class, 'register']);
            Route::post('/login', [UserController::class, 'login']);