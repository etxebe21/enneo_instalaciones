<?php

namespace App\Livewire;

use Livewire\Component;

class Enneoprueba extends Component
{

    public $proyectosContadores = [];
    public $fechaUltimaLectura;
    public $id;


    // Método para obtener los datos de la comunidad desde la API
    public function mount($id)
    {
        $this->id = $id;
        $this->obtenerDatos($id);
        
        // Actualización automática cada 5 minutos
        $this->dispatchBrowserEvent('setInterval', ['interval' => 5 * 60 * 1000]);  // 5 minutos en milisegundos
    }

    // Función común para obtener los datos usando la API
    public function obtenerDatos($id, $endpoint = '')
    {
        // Si no se pasa un endpoint, usamos el valor por defecto (comunidad)
        $url = $endpoint ? "/api/comunidad/{$id}/{$endpoint}" : "/api/comunidad/{$id}";

        $response = Http::get(url($url));

        if ($response->successful()) {
            $this->proyectosContadores = $response->json();
            $this->fechaUltimaLectura = $this->proyectosContadores[0]['FECHA'] ?? 'No disponible';
        } else {
            $this->proyectosContadores = [];
            $this->fechaUltimaLectura = 'No disponible';
        }
    }

    // Método para actualizar los datos manualmente usando la API
    public function actualizarDatos($id)
    {
        $this->obtenerDatos($id, 'actualizado');
    }

    // Método para actualizar los datos automáticamente cada 5 minutos
    public function actualizarDatosAutomáticamente()
    {
        // Verificamos si tenemos datos cargados antes de intentar actualizar
        if (!empty($this->proyectosContadores)) {
            $idComunidad = $this->proyectosContadores[0]['ID_COMUNIDAD'] ?? null;
            if ($idComunidad) {
                $this->actualizarDatos($idComunidad); // Actualiza los datos de la comunidad
            }
        }
    }

    public function render()
    {
        return view('livewire.enneoprueba');
    }
}
