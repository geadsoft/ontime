<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmArea extends Model
{
    //use HasFactory;

    protected $table = 'tm_areas';
    protected $primaryKey = "id";
    protected $fillable = [
        'descripcion',
        'area_id',
        'usuario',
        'estado',
    ];

    public function area(){
        return $this->belongsTo('App\Models\TmArea');
    }

}
