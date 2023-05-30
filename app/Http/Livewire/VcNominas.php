<?php

namespace App\Http\Livewire;
use App\Models\TcRolPagos;

use Livewire\Component;
use Livewire\WithPagination;

class VcNominas extends Component
{   
    use WithPagination;

    public $detalle = [];

    public $filters = [
        'mes' => '',
        'periodo' => '',
        'tiporol' => '',
        'proceso' => '',
    ];

    public $meses = [
        1 => 'ENERO',
        2 => 'FEBRERO',
        3 => 'MARZO',
        4 => 'ABRIL',
        5 => 'MAYO',
        6 => 'JUNIO',
        7 => 'JULIO',
        8 => 'AGOSTO',
        9 => 'SEPTIEMBRE',
        10 => 'OCTUBRE',
        11 => 'NOVIEMBRE',
        12 => 'DICIEMBRE'
    ];

    public function render()
    {
        $tblrecords  = TcRolPagos::query()
        ->when($this->filters['mes'],function($query){
            return $query->where('mes',$this->filters['mes']);
        })
        ->when($this->filters['periodo'],function($query){
            return $query->where('periodo',$this->filters['periodo']);
        })
        ->when($this->filters['tiporol'],function($query){
            return $query->where('tiposrol_id',$this->filters['tiporol']);
        })
        ->when($this->filters['proceso'],function($query){
            return $query->where('remuneracion',$this->filters['proceso']);
        })
        ->orderByRaw('periodo desc, mes desc,tiposrol_id')
        ->paginate(10);

        return view('livewire.vc-nominas',[
            'tblrecords' => $tblrecords,
            'meses' => $this->meses,
        ]);

    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap'; 
    }

    public function loadDetalle(){

    }

    public function edit($rolpagoId){

        return redirect()->to('/payroll/registrar-pagos/edit/'.$rolpagoId);

    }

}
