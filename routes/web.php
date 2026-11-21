<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProyectoController;

Route::get('/', function () {
    return redirect()->route('login.form');
});

// Rutas de Autenticación (Vistas y Formularios)
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Rutas de Proyectos protegidas con el Middleware JWT
Route::middleware('jwt.auth')->group(function () {
    Route::resource('proyectos', ProyectoController::class);
});