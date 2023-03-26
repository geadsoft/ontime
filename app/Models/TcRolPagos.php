<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TcRolPagos extends Model
{
    //use HasFactory;

    protected $table = 'tc_rol_pagos';
    protected $primaryKey = "id";
    protected $fillable = [
        'fecha',
        'mes',
        'periodo',
        'tiposrol_id',
        'periodosrol_id',
        'remuneracion',
        'ingresos',
        'egresos',
        'total',
        'usuario',
        'estado',
    ];

    public function tiposrol(){
        return $this->belongsTo('App\Models\TmTiposrol');
    }

    public function periodosrol(){
        return $this->belongsTo('App\Models\TmPeriodosrol');
    }
    
}
