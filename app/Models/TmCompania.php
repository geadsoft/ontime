<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmCompania extends Model
{
    //use HasFactory;
    protected $table = 'tm_empresas';
    protected $primaryKey = "id";
    protected $fillable = [
        'razonsocial',
        'nombrecomercial',
        'ruc',
        'telefono',
        'provincia',
        'ciudad',
        'canton',
        'ubicacion',
        'representante',
        'identificacion',
        'website',
        'email',
        'imagen',
        'salario_basico',
        'aporte_personal',
        'rubro_appersonal',
        'aporte_patronal',
        'rubro_appatronal',
        'aporte_secap',
        'rubro_secap',
        'aporte_iece',
        'rubro_iece',
        'rubro_freserva',
        'rubro_pagofreserva',
        'decimo_tercero',
        'decimo_cuarto',
        'vacaciones',
        'elaborado',
        'revisado',
        'visto_bueno',
        'usuario',
    ];

}
