<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
    use HasFactory;

    protected $table = 'resultados';
    public $timestamps = false;

    protected $fillable = [
        'id_partido',
        'goles_equipo1',
        'goles_equipo2',

    ];
}
