<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Api\ComunidadController;
use Illuminate\Http\Request;

class HomeController extends Controller
{
   public function index()
{
    // Llamamos al método 'lecturasInstalaciones' para obtener los datos
    $proyectosContadoresLecturas = $this->lecturasInstalaciones();

    // Pasamos los datos a la vista 'welcome'
    return view('welcome', ['proyectosContadoresLecturas' => $proyectosContadoresLecturas]);
}

}
