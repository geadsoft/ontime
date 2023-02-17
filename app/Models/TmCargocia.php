<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmCargocia extends Model
{
    //use HasFactory;
    protected $table = 'tm_cargocias';
    protected $primaryKey = "id";
    protected $fillable = [
        'descripcion',
        'cargo_id',
        'estado',
        'usuario',
    ];

    public function cargo(){
        return $this->belongsTo('App\Models\tmcargocia');
    }

}
