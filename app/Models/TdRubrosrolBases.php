<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdRubrosrolBases extends Model
{
    //use HasFactory;
    protected $table = 'td_rubrosrol_bases';
    protected $primaryKey = "id";
    protected $fillable = [
        'rubrorol_id',
        'baserubrorol_id',
        'importe',
        'constante',
        'usuario',
    ];

    public function baserubrorol(){
        return $this->belongsTo('App\Models\TmRubrosrol');
    }

}
