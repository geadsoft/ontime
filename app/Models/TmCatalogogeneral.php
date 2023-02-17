<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmCatalogogeneral extends Model
{
    //use HasFactory;
    protected $table = 'tm_catalogogenerals';
    protected $primaryKey = "id";
    protected $fillable = [
        'codigo',
        'descripcion',
        'superior',
        'estado',
        'root',
        'usuario',
    ];
}
