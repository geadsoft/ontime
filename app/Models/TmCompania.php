<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmCompania extends Model
{
    //use HasFactory;
    protected $table = 'tm_companias';
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
        'usuario',
    ];

}
