<?php

namespace App\Http\Livewire;
use App\Models\TmTiposrol;
use App\Models\TmRubrosrol;
use App\Models\TdTiporolRubros;


use Livewire\Component;
use Livewire\WithPagination;

class VcTiposrolRubros extends Component
{
    
    use WithPagination;
    public $selectId =1, $nomtiporol="", $showEditModal=false;
    public $rubroId, $rubroTipo, $rubroPago;
    public $arrayTipo = [
        'P' => 'Percepción',
        'D' => 'Deducción'
    ];
    public $arrayPago = [
        'Q' => 'Quincenal',
        'M' => 'Mensual'
    ];

    public function render()
    {
        $tbltiposrols = TmTiposrol::all();
        $tblrubros    = TmRubrosrol::all();
        $tblrecords   = TdTiporolRubros::where('tiposrol_id',$this->selectId)->paginate(12);

        return view('livewire.vc-tiposrol-rubros',[
            'tbltiposrols' => $tbltiposrols,
            'tblrecords'   => $tblrecords,
            'tblrubros'    => $tblrubros
        ]);

    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap'; 
    }

    public function loadData($id){
        $this->selectId = $id;
        $data = TmTiposrol::find($this->selectId);
        $this->nomtiporol = $data['descripcion'];
    }

    public function add(){
        
        $this->showEditModal = false;

        $this->rubroId= 0;
        $this->rubroTipo= '';
        $this->rubroPago= '';    
        $this->dispatchBrowserEvent('show-form');
        
    }

    public function createData(){
        
        $this ->validate([
            'rubroId'   => 'required',
            'rubroTipo' => 'required',
            'rubroPago' => 'required',
        ]);

        TdTiporolRubros::Create([
            'tiposrol_id' => $this -> selectId,
            'rubrosrol_id' => $this -> rubroId,
            'tipo' => $this -> rubroTipo,
            'remuneracion' => $this -> rubroPago,
            'usuario' => auth()->user()->name,
        ]);

        $this->dispatchBrowserEvent('hide-form', ['message'=> 'added successfully!']);  
        
    }




}
