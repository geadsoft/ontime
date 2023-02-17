<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmRubrosrol extends Model
{
    protected $table = 'tm_rubrosrols';
    protected $primaryKey = "id";
    protected $fillable = [
        'descripcion',
        'tipo',
        'registro',
        'regplanilla',
        'etiqueta',
        'imprimerol1',
        'imprimerol2',
        'imprimerol3',
        'variable1',
        'importe',
        'variable2',
        'constante',
        'estado',
        'usuario',
    ];
}
