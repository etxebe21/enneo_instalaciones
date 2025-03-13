<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lectura extends Model
{
    use HasFactory;

    protected $table = 'lecturas';  // Nombre de la tabla en tu DB

    protected $fillable = [
        'ID_CONTADOR', 'LECTURA', 'FECHA'
    ];

    public function contador()
    {
        return $this->belongsTo(Contador::class);
    }
}
