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

    // public function lecturasFtv()
    // {
    //     // Consultar para el mes 2025-01
    //     $lecturasFtvTotal01 = DB::table('proyectos')
    //         ->join('contadores', 'proyectos.ID_COMUNIDAD', '=', 'contadores.ID_COMUNIDAD')
    //         ->leftJoin('lecturas_2025_01', 'contadores.ID_CONTADOR', '=', 'lecturas_2025_01.ID_CONTADOR')
    //         ->where('proyectos.ID_COMUNIDAD', 5066)
    //         ->where('contadores.DESCRIPCION', 'Produccion FTV Total')
    //         ->select(
    //             'proyectos.ID_COMUNIDAD',
    //             'proyectos.COMUNIDAD',
    //             'contadores.ID_CONTADOR',
    //             'contadores.DESCRIPCION',
    //             'lecturas_2025_01.LECTURA as LECTURA_2025_01',
    //             'lecturas_2025_01.FECHA as lectura_fecha_2025_01'
    //         )
    //         ->orderBy('lecturas_2025_01.FECHA', 'asc')
    //         ->get();
    
    //     // Consultar para el mes 2025-02
    //     $lecturasFtvTotal02 = DB::table('proyectos')
    //         ->join('contadores', 'proyectos.ID_COMUNIDAD', '=', 'contadores.ID_COMUNIDAD')
    //         ->leftJoin('lecturas_2025_02', 'contadores.ID_CONTADOR', '=', 'lecturas_2025_02.ID_CONTADOR')
    //         ->where('proyectos.ID_COMUNIDAD', 5066)
    //         ->where('contadores.DESCRIPCION', 'Produccion FTV Total')
    //         ->select(
    //             'proyectos.ID_COMUNIDAD',
    //             'proyectos.COMUNIDAD',
    //             'contadores.ID_CONTADOR',
    //             'contadores.DESCRIPCION',
    //             'lecturas_2025_02.LECTURA as LECTURA_2025_02',
    //             'lecturas_2025_02.FECHA as lectura_fecha_2025_02'
    //         )
    //         ->orderBy('lecturas_2025_02.FECHA', 'asc')
    //         ->get();
    
    //     // Consultar para el mes 2025-03
    //     $lecturasFtvTotal03 = DB::table('proyectos')
    //         ->join('contadores', 'proyectos.ID_COMUNIDAD', '=', 'contadores.ID_COMUNIDAD')
    //         ->leftJoin('lecturas_2025_03', 'contadores.ID_CONTADOR', '=', 'lecturas_2025_03.ID_CONTADOR')
    //         ->where('proyectos.ID_COMUNIDAD', 5066)
    //         ->where('contadores.DESCRIPCION', 'Produccion FTV Total')
    //         ->select(
    //             'proyectos.ID_COMUNIDAD',
    //             'proyectos.COMUNIDAD',
    //             'contadores.ID_CONTADOR',
    //             'contadores.DESCRIPCION',
    //             'lecturas_2025_03.LECTURA as LECTURA_2025_03',
    //             'lecturas_2025_03.FECHA as lectura_fecha_2025_03'
    //         )
    //         ->orderBy('lecturas_2025_03.FECHA', 'asc')
    //         ->get();
    
    //     // Calcular el consumo para 2025-01
    //     $lecturasFtvMaxMonth01 = $this->calcularConsumo($lecturasFtvTotal01, '2025-01');
    //     // Calcular el consumo para 2025-02
    //     $lecturasFtvMaxMonth02 = $this->calcularConsumo($lecturasFtvTotal02, '2025-02');
    //     // Calcular el consumo para 2025-03
    //     $lecturasFtvMaxMonth03 = $this->calcularConsumo($lecturasFtvTotal03, '2025-03');
    
    //     // Combinar los resultados en un solo array
    //     $lecturasFtvMaxMonth = $lecturasFtvMaxMonth01->merge($lecturasFtvMaxMonth02)->merge($lecturasFtvMaxMonth03);
    
    //     // Retornar el resultado final
    //     return $lecturasFtvMaxMonth;
    // }
    
    // // Función para calcular el consumo total (diferencia entre primer y último valor)
    // private function calcularConsumo($lecturasFtvTotal, $mes)
    // {
    //     // Agrupar las lecturas por mes (aunque ya las tenemos, es para mantener la coherencia)
    //     $lecturasFtvTotalGrouped = $lecturasFtvTotal->groupBy(function($date) use ($mes) {
    //         return \Carbon\Carbon::parse($date->{'lectura_fecha_' . $mes})->format('Y-m');  // Agrupamos por año-mes
    //     });
    
    //     // Calcular el consumo para cada grupo de mes
    //     return $lecturasFtvTotalGrouped->map(function($group) use ($mes) {
    //         // Aseguramos que haya al menos una lectura
    //         if(count($group) >= 1) {
    //             // Ordenamos las lecturas por fecha de forma ascendente
    //             $group = $group->sortBy('lectura_fecha_' . $mes); // Cambiar según la fecha de cada mes
    
    //             // Tomamos la primera lectura (más baja) y la última lectura (más alta)
    //             $firstValue = $group->first()->{'LECTURA_' . $mes};  // Primer valor (más bajo)
    //             $firstDate = $group->first()->{'lectura_fecha_' . $mes}; // Fecha del primer valor
    
    //             $lastValue = $group->last()->{'LECTURA_' . $mes};   // Último valor (más alto)
    //             $lastDate = $group->last()->{'lectura_fecha_' . $mes}; // Fecha del último valor
    
    //             // Calculamos el consumo total (diferencia entre el último y el primero)
    //             $LECTURA = $lastValue - $firstValue;
    
    //             // Retornamos los valores: el primer valor, último valor, consumo total, y la fecha del mes
    //             return [
    //                 'ID_COMUNIDAD' => $group->first()->ID_COMUNIDAD,  // ID de la comunidad
    //                 'COMUNIDAD' => $group->first()->COMUNIDAD,        // Nombre de la comunidad
    //                 'ID_CONTADOR' => $group->first()->ID_CONTADOR,    // ID del contador
    //                 'DESCRIPCION' => $group->first()->DESCRIPCION,    // Descripción
    //                 'fecha' => \Carbon\Carbon::parse($lastDate)->format('Y-m'), // Solo la fecha del mes (Año-Mes)
    //                 'primer_valor' => $firstValue,
    //                 'ultimo_valor' => $lastValue,
    //                 'LECTURA' => $LECTURA
    //             ];
    //         } else {
    //             // Si no hay suficientes datos para calcular el consumo, retornamos null
    //             return null;
    //         }
    //     });
    // }
    
    
    public function index()
    {
        // Llamamos al método 'lecturasInstalaciones' para obtener los datos
        $proyectosContadoresLecturas = $this->lecturasInstalaciones();
        $proyectosContadores = $this->getProyectosConContadores();
        // $lecturasFtvMaxMonth = $this->lecturasFtv();
        // dd($proyectosContadores);
        //dd($lecturasFtvMaxMonth);
    
        // Pasamos los datos a la vista 'welcome'
        return view('welcome', ['proyectosContadoresLecturas' => $proyectosContadoresLecturas, 'proyectosContadores' => $proyectosContadores]);
    }
      
}
