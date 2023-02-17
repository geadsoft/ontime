<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmVariables extends Model
{
    //use HasFactory;
    protected $table = 'tm_variables';
    protected $primaryKey = "id";
    protected $fillable = [
        'descripcion',
        'tipo',
        'referencia',
        'campo',
        'formula',
        'usuario',
    ];

}
