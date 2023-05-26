<?php

namespace App\Http\Livewire;
use App\Models\TmTiposrol;
use App\Models\TmRubrosrol;
use App\Models\TdTiporolRubros;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class VcTiposrolRubros extends Component
{
    
    use WithPagination;
    public $selectId=1, $nomtiporol="", $showEditModal=false;
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
        $tblrubros    = TmRubrosrol::query()
        ->leftJoin('td_tiporol_rubros as t', function($join)
        {
            $join->on('tm_rubrosrols.id', '=', 't.rubrosrol_id');
            $join->on('t.tiposrol_id', '=',DB::raw($this->selectId));
        })
        ->select('tm_rubrosrols.*')
        ->whereRaw("estado='A' and t.rubrosrol_id is null")->get();

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

    public function loadData(){

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

    public function edit($record){
        
        $this->showEditModal = true;
        $this->rubroId   = $record['rubrosrol_id'];
        $this->rubroTipo = $record['tipo'];
        $this->rubroPago = $record['remuneracion'];
       
        $this->selectId = $record['id'];
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
        $this->dispatchBrowserEvent('msg-grabar');  
        
    }

    public function updateData(){

        $this ->validate([
            'rubroId'   => 'required',
            'rubroTipo' => 'required',
            'rubroPago' => 'required',
        ]);        
        

        $record = TdTiporolRubros::find($this->selectId);
        $record->update([
            'tipo' => $this -> rubroTipo,
            'remuneracion' => $this -> rubroPago,
        ]);
            
        $this->dispatchBrowserEvent('hide-form');
        $this->dispatchBrowserEvent('msg-actualizar');

        
    }




}
