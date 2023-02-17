<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmPeriodosrol extends Model
{
    protected $table = 'tm_periodosrols';
    protected $primaryKey = "id";
    protected $fillable = [
        'tiporol_id',
        'mes',
        'tiempo',
        'fechaini',
        'fechafin',
        'procesado',
        'aprobado',
        'cerrado',
        'usuario',
    ];

    public function tiporol(){
        return $this->belongsTo('App\Models\TmTiposrol');
    }

}
