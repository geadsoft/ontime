<?php

namespace App\Http\Livewire;
use App\Models\TmCompania;


use Livewire\Component;

class Vccompania extends Component
{
    
    public $showEditModal = false;
    public $existsrecno = true;
    public $selectId;
    public $record;
    public $view;    
    
    public function render()
    {
        
        $tblrecords = TmCompania::all();
        if ($tblrecords==null){
            $this->existsrecno = false;
        }

        $views = TmCompania::find(1);
        $this->view = $views;
        

        return view('livewire.vccompania',[
            'tblrecords' => $tblrecords,
        ]);
    }

    public function add(){
        
        $this->showEditModal = false;     
        $this->dispatchBrowserEvent('show-form');

    }

    public function edit(TmCompania $tblrecords ){
        
        $this->showEditModal = true;
        $this->record  = $tblrecords->toArray();
       
        $this->selectId = $this -> record['id'];
        $this->dispatchBrowserEvent('show-form');

    }

    public function delete( $id ){
        
        $this->selectId = $id;
        $this->dispatchBrowserEvent('show-delete');

    }

    public function view( $id ){
        
        $this->view = TmCompania::find($id)->toArray();

    }


    public function createData(){
        
        $this ->validate([
            'record.razonsocial' => 'required',
            'record.nombrecomercial' => 'required',
            'record.ruc' => 'required',
            'record.telefono' => 'required',
            'record.provincia' => 'required',
            'record.ciudad' => 'required',
            'record.canton' => 'required',
            'record.ubicacion' => 'required',
            'record.representante' => 'required',
            'record.identificacion' => 'required',
            'record.website' => 'required',
            'record.email' => 'required',
        ]);

        TmCompania::Create([
            'razonsocial' => $this -> record['razonsocial'],
            'nombrecomercial' => $this -> record['nombrecomercial'],
            'ruc' => $this -> record['ruc'],
            'telefono' => $this -> record['telefono'],
            'provincia' => $this -> record['provincia'],
            'ciudad' => $this -> record['ciudad'],
            'canton' => $this -> record['canton'],
            'ubicacion' => $this -> record['ubicacion'],
            'representante' => $this -> record['representante'],
            'identificacion' => $this -> record['identificacion'],
            'website' => $this -> record['website'],
            'email' => $this -> record['email'],
            'imagen' => "",
            'usuario' => auth()->user()->name,
        ]);

        $this->dispatchBrowserEvent('hide-form', ['message'=> 'added successfully!']);  
        
    }

    public function updateData(){

        $this ->validate([
            'record.id' => 'required',
            'record.razonsocial' => 'required',
            'record.nombrecomercial' => 'required',
            'record.ruc' => 'required',
            'record.telefono' => 'required',
            'record.provincia' => 'required',
            'record.ciudad' => 'required',
            'record.canton' => 'required',
            'record.ubicacion' => 'required',
            'record.representante' => 'required',
            'record.identificacion' => 'required',
            'record.website' => 'required',
            'record.email' => 'required',
        ]);
        
        
        if ($this->selectId){
            $record = TmCompania::find($this->selectId);
            $record->update([
                'razonsocial' => $this -> record['razonsocial'],
                'nombrecomercial' => $this -> record['nombrecomercial'],
                'ruc' => $this -> record['ruc'],
                'telefono' => $this -> record['telefono'],
                'provincia' => $this -> record['provincia'],
                'ciudad' => $this -> record['ciudad'],
                'canton' => $this -> record['canton'],
                'ubicacion' => $this -> record['ubicacion'],
                'representante' => $this -> record['representante'],
                'identificacion' => $this -> record['identificacion'],
                'website' => $this -> record['website'],
                'email' => $this -> record['email'],
                'usuario' => auth()->user()->name,
            ]);
            
        }
      
        $this->dispatchBrowserEvent('hide-form', ['message'=> 'added successfully!']);
        
    }

    public function deleteData(){
        TmCompania::find($this->selectId)->delete();
        $this->dispatchBrowserEvent('hide-delete');
    }


}
