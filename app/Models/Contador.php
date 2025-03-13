<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contador extends Model
{
    use HasFactory;

    protected $table = 'contadores';  // Nombre de la tabla en tu DB

    protected $fillable = [
        'ID_CONTADOR', 'DESCRIPCION', 'ID_COMUNIDAD', 
           'TIPO_CONTADOR', 'ULTIMA_LECTURA', 'FECHA'
    ];

    public function comunidad()
    {
        return $this->belongsTo(Comunidad::class);
    }

    public function lecturas()
    {
        return $this->hasMany(Lectura::class);
    }
}
