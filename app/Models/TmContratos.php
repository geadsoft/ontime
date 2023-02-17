<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmContratos extends Model
{
    //use HasFactory;
    protected $table = 'tm_contratos';
    protected $primaryKey = "id";
    protected $fillable = [
        'fecha',
        'persona_id',
        'codigo_sectorial',
        'tipoempleado_id',
        'tipocontrato_id',
        'area_id',
        'departamento_id',
        'cargo_id',
        'fecha_ingreso',
        'fecha_salida',
        'fondo_reserva',
        'anticipo',
        'sueldo',
        'tipo_pago',
        'usuario',        
        'estado',
    ];

    public function persona(){
        return $this->belongsTo('App\Models\TmPersonas');
    }

    public function tipoempleado(){
        return $this->belongsTo('App\Models\TmCatalogogeneral');
    }

    public function tipocontrato(){
        return $this->belongsTo('App\Models\TmCatalogogeneral');
    }

    public function area(){
        return $this->belongsTo('App\Models\TmArea');
    }

    public function departamento(){
        return $this->belongsTo('App\Models\TmArea');
    }

    public function cargo(){
        return $this->belongsTo('App\Models\TmCargocia');
    }

}
