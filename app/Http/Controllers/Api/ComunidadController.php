<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ComunidadController extends Controller
{
    // public function getProyectosConContadores()
    // {
    //     // Hacemos una consulta a las tablas 'proyectos' y 'contadores' con un JOIN
    //     $proyectosContadores = DB::table('proyectos')
    //         ->join('contadores', 'proyectos.ID_COMUNIDAD', '=', 'contadores.ID_COMUNIDAD')
    //         ->select(
    //             'proyectos.ID_COMUNIDAD',  // Seleccionamos ID_COMUNIDAD de la tabla 'proyectos'
    //             'proyectos.COMUNIDAD',      // Seleccionamos COMUNIDAD de la tabla 'proyectos'
    //             'contadores.ID_CONTADOR',   // Seleccionamos ID_CONTADOR de la tabla 'contadores'
    //             'contadores.DESCRIPCION',   // Seleccionamos DESCRIPCION de la tabla 'contadores'
    //             'contadores.ULTIMA_LECTURA', // Seleccionamos ULTIMA_LECTURA de la tabla 'contadores'
    //             'contadores.FECHA'          // Seleccionamos FECHA de la tabla 'contadores'
    //         )
    //         ->get();

    //     // Retornamos los proyectos con sus contadores asociados en formato JSON
    //     return response()->json($proyectosContadores);
    // }

    public function getProyectosConContadores()
{
    // Hacemos una consulta a las tablas 'proyectos' y 'contadores' con un JOIN
    $proyectosContadores = DB::table('proyectos')
        ->join('contadores', 'proyectos.ID_COMUNIDAD', '=', 'contadores.ID_COMUNIDAD')
        ->select(
            'proyectos.ID_COMUNIDAD',  // Seleccionamos ID_COMUNIDAD de la tabla 'proyectos'
            'proyectos.COMUNIDAD',      // Seleccionamos COMUNIDAD de la tabla 'proyectos'
            'contadores.ID_CONTADOR',   // Seleccionamos ID_CONTADOR de la tabla 'contadores'
            'contadores.DESCRIPCION',   // Seleccionamos DESCRIPCION de la tabla 'contadores'
            'contadores.ULTIMA_LECTURA', // Seleccionamos ULTIMA_LECTURA de la tabla 'contadores'
            'contadores.FECHA'          // Seleccionamos FECHA de la tabla 'contadores'
        )
        ->where('proyectos.ID_COMUNIDAD', 5066)  // Agregamos la condición para que solo retorne los proyectos con ID_COMUNIDAD 5066
        ->get();

    // Retornamos los proyectos con sus contadores asociados en formato JSON
    return response()->json($proyectosContadores);
}


   
    public function lecturasInstalaciones()
    {
        // Hacemos una consulta a las tablas 'proyectos', 'contadores' y 'lecturas_2025_03' con JOINs,
        // y filtramos por ID_COMUNIDAD entre 5066 y 5070
        $proyectosContadoresLecturas = DB::table('proyectos')
            ->join('contadores', 'proyectos.ID_COMUNIDAD', '=', 'contadores.ID_COMUNIDAD')
            ->leftJoin('lecturas_2025_03', 'contadores.ID_CONTADOR', '=', 'lecturas_2025_03.ID_CONTADOR')
            ->where('proyectos.ID_COMUNIDAD', 5066)
            ->select(
                'proyectos.ID_COMUNIDAD',  // Seleccionamos ID_COMUNIDAD de la tabla 'proyectos'
                'proyectos.COMUNIDAD',      // Seleccionamos COMUNIDAD de la tabla 'proyectos'
                'contadores.ID_CONTADOR',   // Seleccionamos ID_CONTADOR de la tabla 'contadores'
                'contadores.DESCRIPCION',   // Seleccionamos DESCRIPCION de la tabla 'contadores'
                'lecturas_2025_03.ID_LECTURA',  // Seleccionamos ID_LECTURA de la tabla 'lecturas_2025_03'
                'lecturas_2025_03.LECTURA',     // Seleccionamos LECTURA de la tabla 'lecturas_2025_03'
                'lecturas_2025_03.FECHA as lectura_fecha'  // Seleccionamos FECHA de la tabla 'lecturas_2025_03' con alias
            )
            ->get();  // Aquí ya no envolvemos en JSON, solo obtenemos la colección de datos
    
        // Retornamos directamente la colección de datos, sin JSON
        return $proyectosContadoresLecturas;
    }
    
    public function index()
    {
        // Llamamos al método 'lecturasInstalaciones' para obtener los datos
        $proyectosContadoresLecturas = $this->lecturasInstalaciones();
        $proyectosContadores = $this->getProyectosConContadores();
// dd($proyectosContadores);
    
        // Pasamos los datos a la vista 'welcome'
        return view('welcome', ['proyectosContadoresLecturas' => $proyectosContadoresLecturas, 'proyectosContadores' => $proyectosContadores]);
    }
    

    
}
