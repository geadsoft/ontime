<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmPersonas extends Model
{
    //use HasFactory;
    protected $table = 'tm_personas';
    protected $primaryKey = "id";
    protected $fillable = [
        'nombres',
        'apellidos',
        'tiponui',
        'nui',
        'direccion',
        'telefono',
        'instruccion',
        'carga_familiar',
        'sexo',
        'estado_civil',
        'fecha_nace',
        'tipo_sangre',
        'entidadbancaria_id',
        'tipocuenta',
        'cuentabanco',
        'estado',
    ];
}

