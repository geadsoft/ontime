<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdTiporolRubros extends Model
{
    //use HasFactory;
    protected $table = 'td_tiporol_rubros';
    protected $primaryKey = "id";
    protected $fillable = [
        'tiposrol_id',
        'rubrosrol_id',
        'tipo',
        'remuneracion',
        'usuario',
    ];

    public function rubrosrol(){
        return $this->belongsTo('App\Models\TmRubrosrol');
    }

}
