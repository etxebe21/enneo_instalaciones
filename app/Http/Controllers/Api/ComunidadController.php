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

    // public function lecturasFtv()
    // {
    //     // Hacemos una consulta a las tablas 'proyectos', 'contadores', 'lecturas_2025_01'
    //     // y filtramos solo por 'Produccion FTV Total' en la tabla 'contadores'
        
    //     $lecturasFtvTotal = DB::table('proyectos')
    //         ->join('contadores', 'proyectos.ID_COMUNIDAD', '=', 'contadores.ID_COMUNIDAD')
    //         ->leftJoin('lecturas_2025_01', 'contadores.ID_CONTADOR', '=', 'lecturas_2025_01.ID_CONTADOR')
    //         ->where('proyectos.ID_COMUNIDAD', 5066)
    //         // Filtramos por 'Produccion FTV Total' en la columna 'DESCRIPCION' de la tabla 'contadores'
    //         ->where('contadores.DESCRIPCION', 'Produccion FTV Total')
    //         ->select(
    //             'proyectos.ID_COMUNIDAD',
    //             'proyectos.COMUNIDAD',
    //             'contadores.ID_CONTADOR',
    //             'contadores.DESCRIPCION',
    //             'lecturas_2025_01.ID_LECTURA as lecturas_2025_01',
    //             'lecturas_2025_01.LECTURA as LECTURA',
    //             'lecturas_2025_01.FECHA as lectura_fecha'
    //         )
    //         ->orderBy('lecturas_2025_01.FECHA', 'desc') // Aseguramos que las lecturas estén ordenadas por fecha
    //         ->get();  // Obtener los datos de las tablas con las lecturas correspondientes
    
    //     // Ahora filtramos para obtener solo el valor más alto de cada mes
    //     $lecturasFtvTotalGrouped = $lecturasFtvTotal->groupBy(function($date) {
    //         return \Carbon\Carbon::parse($date->LECTURA)->format('Y-m');  // Agrupamos por año-mes
    //     });
    
    //     // Filtrar solo el valor máximo de cada grupo de mes
    //     $lecturasFtvMaxMonth = $lecturasFtvTotalGrouped->map(function($group) {
    //         return $group->sortByDesc('lectura_01')->first();  // Tomamos el valor más alto del grupo
    //     });
    
    //     // Retornar el resultado
    //     return $lecturasFtvMaxMonth;
    // }

    public function lecturasFtv()
    {
        // Listado de tablas por cada mes
        $tablas = ['lecturas_2024_12', 'lecturas_2025_01', 'lecturas_2025_02', 'lecturas_2025_03']; // Agrega más si es necesario
    
        $lecturasFtvMaxMonth = collect(); // Colección vacía para almacenar los datos
    
        foreach ($tablas as $tabla) {
            // Obtener lecturas de la tabla actual
            $lecturasFtvTotal = DB::table('proyectos')
                ->join('contadores', 'proyectos.ID_COMUNIDAD', '=', 'contadores.ID_COMUNIDAD')
                ->leftJoin($tabla, 'contadores.ID_CONTADOR', '=', "$tabla.ID_CONTADOR")
                ->where('proyectos.ID_COMUNIDAD', 5066)
                ->where('contadores.DESCRIPCION', 'Produccion FTV Total')
                ->select(
                    'proyectos.ID_COMUNIDAD',
                    'proyectos.COMUNIDAD',
                    'contadores.ID_CONTADOR',
                    'contadores.DESCRIPCION',
                    "$tabla.LECTURA as LECTURA",
                    "$tabla.FECHA as lectura_fecha"
                )
                ->orderBy("$tabla.FECHA", 'asc')
                ->get();
    
            // Agrupar por mes
            $lecturasFtvTotalGrouped = $lecturasFtvTotal->groupBy(function ($date) {
                return \Carbon\Carbon::parse($date->lectura_fecha)->format('Y-m');
            });
    
            // Obtener primer y último valor de cada mes
            $resultadosMes = $lecturasFtvTotalGrouped->map(function ($group) {
                if ($group->count() >= 2) {
                    $group = $group->sortBy('lectura_fecha'); // Ordenar por fecha ascendente
    
                    $primer_valor = (float) $group->first()->LECTURA;
                    $ultimo_valor = (float) $group->last()->LECTURA;
                    $consumo = $ultimo_valor - $primer_valor;
    
                    return [
                        "lectura_fecha" => $group->first()->lectura_fecha,
                        "ID_COMUNIDAD" => $group->first()->ID_COMUNIDAD,
                        "COMUNIDAD" => $group->first()->COMUNIDAD,
                        "ID_CONTADOR" => $group->first()->ID_CONTADOR,
                        "DESCRIPCION" => $group->first()->DESCRIPCION,
                        "primer_valor" => $primer_valor,
                        "ultimo_valor" => $ultimo_valor,
                        "LECTURA" => $consumo
                    ];
                }
                return null;
            })->filter(); // Elimina valores nulos
    
            // Agregar resultados a la colección principal
            $lecturasFtvMaxMonth = $lecturasFtvMaxMonth->merge($resultadosMes);
        }
    
        return $lecturasFtvMaxMonth->values(); // Devolver valores en formato de array
    }
    
    public function index()
    {
        // Llamamos al método 'lecturasInstalaciones' para obtener los datos
        $proyectosContadoresLecturas = $this->lecturasInstalaciones();
        $proyectosContadores = $this->getProyectosConContadores();
        $lecturasFtvMaxMonth = $this->lecturasFtv();
        // dd($proyectosContadores);
        // dd($lecturasFtvMaxMonth);
    
        // Pasamos los datos a la vista 'welcome'
        return view('welcome', ['proyectosContadoresLecturas' => $proyectosContadoresLecturas, 'proyectosContadores' => $proyectosContadores, 'lecturasFtvMaxMonth'=>$lecturasFtvMaxMonth]);
    }
      
}
