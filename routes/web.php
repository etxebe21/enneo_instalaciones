<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ComunidadController;
use App\Http\Controllers\Api\Controllers;

Route::get('/', [ComunidadController::class, 'index']); 
Route::get('/comunidad/{id}', [Controllers::class, 'indexprueba']);
Route::get('/comunidad/{id}/actualizado', [ComunidadController::class, 'indexA']);
Route::get('/comunidad-grafica/{id}/{tipo}', [Controllers::class, 'show'])->name('grafica');
Route::get('/comunidad/{id}/actualizado', [Controllers::class, 'showA']);

// Otras rutas API para obtener los datos de proyectos, contadores y lecturas
Route::get('proyectos-contadores', [ComunidadController::class, 'getProyectosConContadores']);
Route::get('proyectos-contadores-lecturas', [ComunidadController::class, 'lecturasInstalaciones']);