<?php

namespace App\Http\Livewire;
use App\Models\TmTiposrol;
use App\Models\TmCatalogogeneral;

use Livewire\Component;
use Livewire\WithPagination;

class Vctiposrol extends Component
{

    use WithPagination;

    public $showEditModal = false;
    public $selectId, $selectValue;
    public $record;
    public $estados = [
        'A' => 'Activo',
        'I' => 'Inactivo',
    ];
    public $tipos = [
        'E' => 'Estandar',
        'V' => 'Vacaciones',
        'B' => 'Beneficios',
        'L' => 'Liquidación',
    ];
    public $filters = [
        'descripcion' => '',
        'empleado' => '',
        'contrato' => '',
    ];


    public function render()
    {        
        $tblrecords = TmTiposrol::query()
        ->when($this->filters['descripcion'],function($query){
            return $query->where('descripcion','like','%'.$this->filters['descripcion'].'%');
        })
        ->when($this->filters['empleado'],function($query){
            return $query->where('tipoempleado_id',$this->filters['empleado']);
        })
        ->when($this->filters['contrato'],function($query){
            return $query->where('tipocontrato_id',$this->filters['contrato']);
        })     
        ->paginate(10);

        $tblempleados =  TmCatalogogeneral::where('superior',1)->orderBy('codigo','asc')->get();
        $tblcontratos =  TmCatalogogeneral::where('superior',2)->orderBy('codigo','asc')->get();

        return view('livewire.vc-tiposrol',[
            'tblrecords' => $tblrecords,
            'tblempleados' => $tblempleados,
            'tblcontratos' => $tblcontratos
        ]);
    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap'; 
    }

    public function add(){
        
        $this->showEditModal = false;
        $this->reset(['record']);
        $this->record['descripcion']= "";
        $this->record['tipoempleado_id']= 0;
        $this->record['tipocontrato_id']= 0;
        $this->record['tipoderol']= "E"; 
        $this->record['estado']= 'A';       
        $this->dispatchBrowserEvent('show-form');

    }

    public function edit(TmTiposrol $tblrecords ){
        
        $this->showEditModal = true;
        $this->record  = $tblrecords->toArray();
       
        $this->selectId = $this -> record['id'];
        $this->dispatchBrowserEvent('show-form');

    }

    public function delete( $id ){
        
        $this->selectId = $id;
        $record = TmTiposrol::find($id);

        $this->selectValue = $record['descripcion'];
        $this->dispatchBrowserEvent('show-delete');

    }


    public function createData(){
      
        $this ->validate([
            'record.descripcion' => 'required',
            'record.tipoempleado_id' => 'required',
            'record.tipocontrato_id' => 'required',
            'record.tipoderol' => 'required',
        ]);

        TmTiposrol::Create([
            'descripcion' => $this -> record['descripcion'],
            'tipoempleado_id' => $this -> record['tipoempleado_id'],
            'tipocontrato_id' => $this -> record['tipocontrato_id'],
            'tipoderol' => $this -> record['tipoderol'],
            'usuario' => auth()->user()->name,
            'estado' => $this -> record['estado'],
        ]);

        $this->dispatchBrowserEvent('hide-form');
        $this->dispatchBrowserEvent('msg-grabar');  
        
    }

    public function updateData(){

        $this ->validate([
            'record.id' => 'required',
            'record.descripcion' => 'required',
            'record.tipoempleado_id' => 'required',
            'record.tipocontrato_id' => 'required',
            'record.tipoderol'=> 'required',
            'record.estado'=> 'required',
        ]);
        
        
        if ($this->selectId){
            $record = TmTiposrol::find($this->selectId);
            $record->update([
                'descripcion' => $this -> record['descripcion'],
                'tipoempleado_id' => $this -> record['tipoempleado_id'],
                'tipocontrato_id' => $this -> record['tipocontrato_id'],
                'tipoderol' => $this -> record['tipoderol'],
                'usuario' => $this -> record['usuario'],
                'estado' => $this -> record['estado'],
            ]);
            
        }
      
        $this->dispatchBrowserEvent('hide-form');
        $this->dispatchBrowserEvent('msg-actualizar');
        
    }

    public function deleteData(){

        $record = TmTiposrol::find($this->selectId);
        $record->update([
            'estado' => 'I',
        ]);

        $this->dispatchBrowserEvent('hide-delete');
    }
    public function resetFilter(){

        $this->filters['descripcion'] = '';
        $this->filters['empleado']    = '';
        $this->filters['contrato']    = '';

    }



}
