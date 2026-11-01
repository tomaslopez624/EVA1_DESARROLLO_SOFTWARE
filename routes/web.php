<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoController;

Route::get('/', function () {
    return view('welcome');
});

// 1. Listar todos los proyectos
Route::get('/proyectos', [ProyectoController::class, 'index'])->name('proyectos.index');

// 2. Agregar Proyecto (Muestra el formulario y procesa la creación)
Route::get('/proyectos/crear', [ProyectoController::class, 'create'])->name('proyectos.create');
Route::post('/proyectos', [ProyectoController::class, 'store'])->name('proyectos.store');

// 5. Obtener un proyecto por su id
Route::get('/proyectos/{id}', [ProyectoController::class, 'show'])->name('proyectos.show');

// 4. Actualizar proyecto por su id (Muestra el formulario y procesa la actualización)
Route::get('/proyectos/{id}/editar', [ProyectoController::class, 'edit'])->name('proyectos.edit');
Route::put('/proyectos/{id}', [ProyectoController::class, 'update'])->name('proyectos.update');

// 3. Eliminar proyecto por su Id
Route::delete('/proyectos/{id}', [ProyectoController::class, 'destroy'])->name('proyectos.destroy');