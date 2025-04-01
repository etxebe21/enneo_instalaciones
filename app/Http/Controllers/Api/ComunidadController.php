<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ComunidadController extends Controller
{
    // Método para obtener proyectos con contadores filtrados por comunidad
    public function getProyectosConContadores($id = null)
    {
        $query = DB::table('proyectos')
            ->join('contadores', 'proyectos.ID_COMUNIDAD', '=', 'contadores.ID_COMUNIDAD')
            ->select(
                'proyectos.ID_COMUNIDAD',  
                'proyectos.COMUNIDAD',     
                'contadores.ID_CONTADOR',  
                'contadores.DESCRIPCION',   
                'contadores.ULTIMA_LECTURA', 
                'contadores.FECHA'          
            )
            ->whereBetween('proyectos.ID_COMUNIDAD', [5066, 5070]); // Este filtro puede ser modificado si necesitas

        // Si se pasa un ID, filtrar por ese ID
        if ($id) {
            $query->where('proyectos.ID_COMUNIDAD', '=', $id);
        }

        // Ejecutar la consulta
        $proyectosContadores = $query->get();

        return $proyectosContadores;
    }

    // Método para mostrar la vista con los proyectos de la comunidad
    public function index($id = null)
    {
        // Obtenemos los proyectos contadores filtrados por comunidad (o todos si no hay id)
        $proyectosContadores = $this->getProyectosConContadores($id);
        
        // Pasamos los datos a la vista 'dalias'
        return view('prueba', ['proyectosContadores' => $proyectosContadores]);
    }

    public function indexA($id)
{
    // Obtener los datos del proyecto para la comunidad
    $proyectosContadores = DB::table('proyectos')
        ->join('contadores', 'proyectos.ID_COMUNIDAD', '=', 'contadores.ID_COMUNIDAD')
        ->select(
            'proyectos.ID_COMUNIDAD',  
            'proyectos.COMUNIDAD',     
            'contadores.ID_CONTADOR',  
            'contadores.DESCRIPCION',   
            'contadores.ULTIMA_LECTURA', 
            'contadores.FECHA'          
        )
        ->where('proyectos.ID_COMUNIDAD', $id)
        ->get();

    // Verifica si tienes datos
    if ($proyectosContadores->isEmpty()) {
        // Si no hay datos, responde con un error JSON
        return response()->json(['error' => 'No se encontraron datos para la comunidad'], 404);
    }

    // Devuelve los datos en formato JSON
    return response()->json($proyectosContadores);
}

}
