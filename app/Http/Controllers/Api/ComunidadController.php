<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ComunidadController extends Controller
{
   
    public function getProyectosConContadores()
    {
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
            ->whereBetween('proyectos.ID_COMUNIDAD', [4895, 5150])
            ->get();

        // Retornamos los proyectos con sus contadores asociados en formato JSON
        return response()->json($proyectosContadores);
    }

    public function lecturasFtv()
    {
        // Listado de tablas por cada mes
        $tablas = ['lecturas_2024_12', 'lecturas_2025_01', 'lecturas_2025_02', 'lecturas_2025_03']; 
    
        $lecturasFtvMaxMonth = collect(); // Colección vacía para almacenar los datos
    
        foreach ($tablas as $tabla) {
            $lecturasFtvTotal = DB::table('proyectos')
                ->join('contadores', 'proyectos.ID_COMUNIDAD', '=', 'contadores.ID_COMUNIDAD')
                ->leftJoin($tabla, 'contadores.ID_CONTADOR', '=', "$tabla.ID_CONTADOR")
                ->whereBetween('proyectos.ID_COMUNIDAD', [4895, 5150])
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
            })->filter(); 
    
            // Agregar resultados a la colección principal
            $lecturasFtvMaxMonth = $lecturasFtvMaxMonth->merge($resultadosMes);
        }
    
        return $lecturasFtvMaxMonth->values(); // Devolver valores en formato de array
    }
    
    public function index()
    {
        $proyectosContadoresLecturas = $this->lecturasInstalaciones();
        $proyectosContadores = $this->getProyectosConContadores();
        $lecturasFtvMaxMonth = $this->lecturasFtv();

        // Pasamos los datos a la vista 'welcome'
        return view('welcome', ['proyectosContadoresLecturas' => $proyectosContadoresLecturas, 'proyectosContadores' => $proyectosContadores, 'lecturasFtvMaxMonth'=>$lecturasFtvMaxMonth]);
    }

    public function show($id)
    {
        $proyectosContadores = DB::table('proyectos')
            ->join('contadores', 'proyectos.ID_COMUNIDAD', '=', 'contadores.ID_COMUNIDAD')
            ->where('proyectos.ID_COMUNIDAD', $id)
            ->select(
                'proyectos.ID_COMUNIDAD', 
                'proyectos.COMUNIDAD', 
                'contadores.ID_CONTADOR',
                'contadores.DESCRIPCION',
                'contadores.ULTIMA_LECTURA',
                'contadores.FECHA'
            )
            ->get();

        // Obtener el último dato de cada 'DESCRIPCION' de contadores
    $ultimoDatoPorDescripcion = DB::table('proyectos')
    ->join('contadores', 'proyectos.ID_COMUNIDAD', '=', 'contadores.ID_COMUNIDAD')
    ->leftJoin('lecturas_2025_03', 'contadores.ID_CONTADOR', '=', 'lecturas_2025_03.ID_CONTADOR')
    ->where('proyectos.ID_COMUNIDAD', $id)
    ->select(
        'contadores.DESCRIPCION',
        DB::raw('MAX(lecturas_2025_03.FECHA) as ultima_lectura_fecha')  // Obtenemos la última fecha de lectura
    )
    ->groupBy('contadores.DESCRIPCION')
    ->get();

    // Para cada descripción, obtener las lecturas de los últimos 7 días
    $proyectosContadoresLecturas = collect();

    foreach ($ultimoDatoPorDescripcion as $descripcion) {
        $fechaLimite = \Carbon\Carbon::parse($descripcion->ultima_lectura_fecha)->subDays(7)->startOfDay();

        // Obtener las lecturas de las instalaciones para la comunidad seleccionada en el rango de los últimos 7 días
        $lecturas = DB::table('proyectos')
            ->join('contadores', 'proyectos.ID_COMUNIDAD', '=', 'contadores.ID_COMUNIDAD')
            ->leftJoin('lecturas_2025_03', 'contadores.ID_CONTADOR', '=', 'lecturas_2025_03.ID_CONTADOR')
            ->where('proyectos.ID_COMUNIDAD', $id)
            ->where('contadores.DESCRIPCION', $descripcion->DESCRIPCION)
            ->where('lecturas_2025_03.FECHA', '>=', $fechaLimite)  
            ->select(
                'proyectos.ID_COMUNIDAD', 
                'proyectos.COMUNIDAD', 
                'contadores.ID_CONTADOR', 
                'contadores.DESCRIPCION', 
                'lecturas_2025_03.ID_LECTURA',
                'lecturas_2025_03.LECTURA',
                'lecturas_2025_03.FECHA as lectura_fecha'
            )
            ->get();

        // Agregar las lecturas a la colección de resultados
        $proyectosContadoresLecturas = $proyectosContadoresLecturas->merge($lecturas);
    }
            
        // Definir las tablas por mes (Añadir más meses si es necesario)
        $tablas = ['lecturas_2024_12', 'lecturas_2025_01', 'lecturas_2025_02', 'lecturas_2025_03']; 
        
        $lecturasFtvMaxMonth = collect(); // Colección vacía para almacenar las lecturas
    
        foreach ($tablas as $tabla) {
            $lecturasFtvTotal = DB::table('proyectos')
                ->join('contadores', 'proyectos.ID_COMUNIDAD', '=', 'contadores.ID_COMUNIDAD')
                ->leftJoin($tabla, 'contadores.ID_CONTADOR', '=', "$tabla.ID_CONTADOR")
                ->where('proyectos.ID_COMUNIDAD', $id)
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
            
            // Agrupar por mes utilizando Carbon
            $lecturasFtvTotalGrouped = $lecturasFtvTotal->groupBy(function ($date) {
                return \Carbon\Carbon::parse($date->lectura_fecha)->format('Y-m'); // Agrupando por año-mes
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
            })->filter();
    
            // Agregar los resultados a la colección principal
            $lecturasFtvMaxMonth = $lecturasFtvMaxMonth->merge($resultadosMes);
        }
    
        return view('welcome', compact('proyectosContadores', 'proyectosContadoresLecturas', 'lecturasFtvMaxMonth'));
    }
         
}