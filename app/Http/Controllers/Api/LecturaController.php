<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LecturaController extends Controller
{
    public function getLecturasPorContador($idContador)
    {
        // Hacemos una consulta a la tabla 'lecturas' para obtener los datos del contador específico
        $lecturas = DB::table('lecturas')
            ->where('ID_CONTADOR', $idContador)  // Filtramos por el ID_CONTADOR
            ->select(
                'ID_LECTURA',  // Seleccionamos ID_LECTURA
                'ID_CONTADOR',  // Seleccionamos ID_CONTADOR
                'LECTURA',      // Seleccionamos LECTURA
                'FECHA'         // Seleccionamos FECHA
            )
            ->get();  // Obtenemos los resultados

        // Retornamos las lecturas en formato JSON
        return response()->json($lecturas);
    }
}
