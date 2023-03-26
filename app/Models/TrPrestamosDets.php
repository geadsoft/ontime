<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrPrestamosDets extends Model
{
    protected $table = 'tr_prestamos_dets';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'prestamo_id',
        'cuota',
        'fecha',
        'valor',
        'estado',
        'usuario',
    ];

}
