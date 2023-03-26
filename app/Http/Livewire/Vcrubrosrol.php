<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TmRubrosrol;
use Livewire\WithPagination;

class Vcrubrosrol extends Component
{
    use WithPagination;

    public $showEditModal = false;
    public $selectId,$selectValue;
    public $record;
    public $filters = [
        'estado' => 'A',
        'descripcion' => '',
        'registro' => '',
    ];

    public function render()
    {        
        $tblrecords = TmRubrosrol::query()
        ->when($this->filters['descripcion'],function($query){
            return $query->where('descripcion','like','%'.$this->filters['descripcion'].'%');
        })
        ->when($this->filters['registro'],function($query){
            return $query->where('registro',$this->filters['registro']);
        })
        ->when($this->filters['estado'],function($query){
            return $query->where('estado',$this->filters['estado']);
        })
        ->paginate(10);

        return view('livewire.Vcrubrosrol',[
            'tblrecords' => $tblrecords
        ]);
    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap'; 
    }

    public function add(){
        
        return redirect()->to('/form/rubros-add');

    }

    public function edit(TmRubrosrol $tblrecords ){
        
        $this->showEditModal = true;
        $this->record  = $tblrecords->toArray();
       
        $this->selectId = $this -> record['id'];

        $this->dispatchBrowserEvent('show-form');
        
    }

    public function delete( $id ){
        
        $this->selectId = $id;
        $record = TmRubrosrol::find($id);

        $this->selectValue = $record['descripcion'];

        $this->dispatchBrowserEvent('show-delete');

    }


    public function createData(){
      
        $this ->validate([
            'record.descripcion' => 'required',
            'record.etiqueta' => 'required',
            'record.registro' => 'required',
        ]);

        TmRubrosrol::Create([
            'descripcion' => $this -> record['descripcion'],
            'etiqueta' => $this -> record['etiqueta'],
            'tipo' => $this -> record['tipo'],
            'registro' => $this -> record['registro'],

            'imprimerol1' => $this -> record['imprimerol1'],
            'imprimerol2' => $this -> record['imprimerol2'],
            'imprimerol3' => $this -> record['imprimerol3'],
            'variable1' => $this -> record['variable1'],
            'importe' => $this -> record['importe'],
            'variable2' => $this -> record['variable2'],
            'constante' => $this -> record['contante'],
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
            'record.etiqueta' => 'required',
            'record.registro' => 'required',
            'record.estado'=> 'required',
        ]);
        
        
        if ($this->selectId){
            $record = TmRubrosrol::find($this->selectId);
            $record->update([
                'descripcion' => $this -> record['descripcion'],
                'etiqueta' => $this -> record['etiqueta'],
                'tipo' => $this -> record['tipo'],
                'registro' => $this -> record['registro'],
                'imprimerol1' => $this -> record['imprimerol1'],
                'imprimerol2' => $this -> record['imprimerol2'],
                'imprimerol3' => $this -> record['imprimerol3'],
                'variable1' => $this -> record['variable1'],
                'importe' => $this -> record['importe'],
                'variable2' => $this -> record['variable2'],
                'constante' => $this -> record['contante'],
                'usuario' => auth()->user()->name,
                'estado' => $this -> record['estado'],
            ]);
            
        }
      
        $this->dispatchBrowserEvent('hide-form');
        $this->dispatchBrowserEvent('msg-actualizar');
        
    }

    public function deleteData(){

        $record = TmRubrosrol::find($this->selectId);
        $record->update([
            'estado' => 'I',
        ]);

        $this->dispatchBrowserEvent('hide-delete');
    }

    public function resetFilter(){

        $this->filters['estado'] = 'A';
        $this->filters['registro'] = '';
        $this->filters['descripcion'] = '';

    }

}
