<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    use HasFactory;

    protected $table = 'partidos';
    public $timestamps = false;

    protected $fillable = [
        'id_equipo1',
        'id_equipo2',

    ];
}
