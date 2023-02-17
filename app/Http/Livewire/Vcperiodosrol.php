<?php

namespace App\Http\Livewire;
use App\Models\TmPeriodosrol;
use App\Models\TmTiposrol;

use Livewire\Component;
use Livewire\WithPagination;

class Vcperiodosrol extends Component
{   
    use WithPagination;
    public $showEditModal = false;
    public $selectId;
    public $record;
    public $meses = [ 
        1 => 'Enero',
        2 => 'Febrero',
        3 => 'Marzo',
        4 => 'Abril',
        5 => 'Mayo',
        6 => 'Junio',
        7 => 'Julio',
        8 => 'Agosto',
        9 => 'Septiembre',
        10 => 'Octubre',
        11 => 'Noviembre',
        12 => 'Diciembre'];
    
    public $tiempo = [
        'Q' => 'Quincenal',
        'M' => 'Mensual'];
    
    public $filters = [
        'mes' => '',
        'tipo' => '',
        'descripcion' => '',
    ];

    protected $listeners = ['saveData'];



    public function render()
    {
        $tbltiporols = TmTiposrol::all();

        $tblrecords  = TmPeriodosrol::query()
        ->when($this->filters['mes'],function($query){
            return $query->where('mes',$this->filters['mes']);
        })
        ->when($this->filters['tipo'],function($query){
            return $query->where('tiempo',$this->filters['tipo']);
        })
        ->paginate(10);

        return view('livewire.Vcperiodosrol',[
            'tblrecords' => $tblrecords,
            'tbltiporols' => $tbltiporols
        ]);

    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap'; 
    }

    public function add(){
        
        $this->showEditModal = false;
        $this->reset(['record']);
        $this->record['tiporol_id']= 0;
        $this->record['mes']= 0;
        $this->record['tiempo']= "";
        $this->record['fechaini']= ""; 
        $this->record['fechafin']= "";       
        $this->dispatchBrowserEvent('show-form');

    }
    public function edit(TmPeriodosrol $tblrecords ){
        
        $this->showEditModal = true;
        $this->record  = $tblrecords->toArray();
       
        $this->selectId = $this -> record['id'];
        $this->dispatchBrowserEvent('show-form');

    }

    public function delete( $id ){
        
        $this->selectId = $id;
        $this->dispatchBrowserEvent('show-delete');

    }

    public function createData(){
        
        $this->dispatchBrowserEvent('get-date');
        
    }    

    public function saveData($objDate=null){
        
        $this->record['fechaini'] = $objDate['fechaini']; 
        $this->record['fechafin'] = $objDate['fechafin']; 
        
        $this ->validate([
            'record.tiporol_id' => 'required',
            'record.mes' => 'required',
            'record.tiempo' => 'required',
            'record.fechaini' => 'required',
            'record.fechafin' => 'required',
        ]);
        
        TmPeriodosrol::Create([
            'tiporol_id' => $this -> record['tiporol_id'],
            'mes' => $this -> record['mes'],
            'tiempo' => $this -> record['tiempo'],
            'fechaini' => $this -> record['fechaini'],
            'fechafin' => $this -> record['fechafin'],
            'procesado' => false,
            'aprobado' => false,
            'cerrado' => false,
            'usuario' => auth()->user()->name,
        ]);

        $this->dispatchBrowserEvent('hide-form');  
        $this->dispatchBrowserEvent('msg-grabar');
        
    }


    public function updateData(){

        $this ->validate([
            'record.tiporol_id' => 'required',
            'record.mes' => 'required',
            'record.tiempo' => 'required',
            'record.fechaini' => 'required',
            'record.fechafin' => 'required',
        ]);
        
        
        if ($this->selectId){
            $record = TmPeriodosrol::find($this->selectId);
            $record->update([
                'tiporol_id' => $this -> record['tiporol_id'],
                'mes' => $this -> record['mes'],
                'tiempo' => $this -> record['tiempo'],
                'fechaini' => date('Y-m-d H:i:s', strtotime($this -> record['fechaini'])),
                'fechafin' => date('Y-m-d H:i:s', strtotime($this -> record['fechafin'])),
            ]);
            
        }
      
        $this->dispatchBrowserEvent('hide-form', ['message'=> 'added successfully!']);
        
    }

    public function deleteData(){
        TmTiposrol::find($this->selectId)->delete();
        $this->dispatchBrowserEvent('hide-delete');
    }




}
