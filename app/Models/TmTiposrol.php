<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmTiposrol extends Model
{
    //use HasFactory;

    protected $table = 'tm_tiposrols';
    protected $primaryKey = "id";
    protected $fillable = [
        'descripcion',
        'tipoempleado_id',
        'tipocontrato_id',
        'tipoderol',
        'usuario',
        'estado',
    ];

    public function tipoempleado(){
        return $this->belongsTo('App\Models\TmCatalogogeneral');
    }

    public function tipocontrato(){
        return $this->belongsTo('App\Models\TmCatalogogeneral');
    }

}
