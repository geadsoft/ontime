<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdRolPagos extends Model
{
    //use HasFactory;
    protected $table = 'td_rol_pagos';
    protected $primaryKey = "id";
    protected $fillable = [
        'rolpago_id',
        'fecha',
        'mes',
        'periodo',
        'remuneracion',
        'registro',
        'persona_id',
        'rubrosrol_id',
        'tipo',
        'rubro_total',
        'valor',
        'usuario',
        'estado',
    ];

    public function persona(){
        return $this->belongsTo('App\Models\TmPersonas');
    }

    public function rubrosrol(){
        return $this->belongsTo('App\Models\TmRubrosrol');
    }

}

?>
