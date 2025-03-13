<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comunidad extends Model
{
    use HasFactory;

    protected $table = 'proyectos';  // Asegúrate de que la tabla tenga este nombre en la base de datos

    protected $fillable = [
        'ID_COMUNIDAD', 'COMUNIDAD'
        
    ];

    public function contadores()
    {
        return $this->hasMany(Contador::class);
    }
}
