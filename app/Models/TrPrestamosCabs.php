<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrPrestamosCabs extends Model
{
    protected $table = 'tr_prestamos_cabs';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'fecha',
        'persona_id',
        'tipoprestamo_id',
        'rubrosrol_id',
        'periodosrol_id',
        'monto',
        'cuota',
        'comentario',
        'estado',
        'usuario',
    ];

}
