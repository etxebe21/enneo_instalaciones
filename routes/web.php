<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ComunidadController;

Route::get('/', [ComunidadController::class, 'index']); 
Route::get('/comunidad/{id}', [ComunidadController::class, 'index'])->name('comunidad.show');

// Otras rutas API para obtener los datos de proyectos, contadores y lecturas
Route::get('proyectos-contadores', [ComunidadController::class, 'getProyectosConContadores']);
Route::get('proyectos-contadores-lecturas', [ComunidadController::class, 'lecturasInstalaciones']);