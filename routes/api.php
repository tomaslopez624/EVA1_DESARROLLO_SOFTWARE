<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProyectoController;

// Rutas públicas de la API (Registro e Inicio de Sesión)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas por el middleware JWT
Route::middleware('jwt.auth')->group(function () {
    Route::get('/proyectos', [ProyectoController::class, 'index']);
});
