<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdPlanillaRubros extends Model
{
    //use HasFactory;
    protected $table = 'td_planillarubros';
    protected $primaryKey = "id";
    protected $fillable = [
        'fecha',
        'tipo',
        'tiposrol_id',
        'periodosrol_id',
        'persona_id',
        'rubrosrol_id',
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
