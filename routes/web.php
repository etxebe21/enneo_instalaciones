<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ComunidadController;

Route::get('/', [ComunidadController::class, 'index']); 
Route::get('/comunidad/{id}', [ComunidadController::class, 'showPanel'])->name('comunidad.show');
Route::get('/enneo-tv/{poblacion}/{contador}-{instalacion}', [EnneoController::class, 'showPanel'])
    ->name('presentacion.enneotv');

// Route::get('/', [ComunidadController::class, 'getInstalacionesProyecto'])->name('presentacion.enneotv');

// Otras rutas API para obtener los datos de proyectos, contadores y lecturas
Route::get('proyectos-contadores', [ComunidadController::class, 'getProyectosConContadores']);
Route::get('proyectos-contadores-lecturas', [ComunidadController::class, 'lecturasInstalaciones']);
