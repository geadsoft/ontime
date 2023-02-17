<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmDepartament extends Model
{
    //use HasFactory;
    
    protected $table = 'tmdepartaments';
    protected $primaryKey = "id";
    protected $fillable = [
        'descripcion',
        'idarea',
        'idpersonal',
        'idcuenta',
        'idccosto',
        'usuario',
        'estado',
    ];

    
}
