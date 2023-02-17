<?php

namespace App\Http\Livewire;
use App\Models\TmDepartament;
use App\Models\TmArea;
use Livewire\Component;

class Vcdepartaments extends Component
{
    protected $listener = ['edit'];
    public $showEditModal = false;
    public $tblarea;
    public $selectId;
    public $tblrecord;
    
    public function render()
    {
        
        $tblareas = Tmarea::all();
        
        $tblrecords = TmDepartament::all();
        return view('livewire.Vcdepartaments',[
            'tblrecords' => $tblrecords,
            'tblareas' => $tblareas
        ]);

 
    }

    public function add(){
        
        $this->showEditModal = false;
        $this->reset(['tblrecord']);
        $this->tblrecord['descripcion']= "";
        $this->tblrecord['idarea']= 0;
        $this->tblrecord['idpersonal']= 0;
        $this->tblrecord['idcuenta']= 0; 
        $this->tblrecord['idccosto']= 0; 
        $this->tblrecord['estado']= 'A';       
        $this->dispatchBrowserEvent('show-form');

    }

    public function edit(TmDepartament $tblrecords ){
        
        $this->showEditModal = true;
        $this->tblrecord  = $tblrecords->toArray();
       
        $this->selectId = $this -> tblrecord['id'];
        $this->dispatchBrowserEvent('show-form');

    }

    public function delete( $id ){
        
 
        $this->selectId = $id;
        $this->dispatchBrowserEvent('show-delete');

    }


    public function createData(){
        
        $this ->validate([
            'tblrecord.descripcion' => 'required',
            'tblrecord.idarea' => 'required',
        ]);

        TmDepartament::Create([
            'descripcion' => $this -> tblrecord['descripcion'],
            'idarea' => $this -> tblrecord['idarea'],
            'idpersonal' => $this -> tblrecord['idpersonal'],
            'idcuenta' => $this -> tblrecord['idcuenta'],
            'idccosto' => $this -> tblrecord['idccosto'],
            'usuario' => auth()->user()->name,
            'estado' => $this -> tblrecord['estado'],
        ]);

        $this->dispatchBrowserEvent('hide-form', ['message'=> 'added successfully!']);  
        
    }

    public function updateData(){

        $this ->validate([
            'tblrecord.id' => 'required',
            'tblrecord.descripcion' => 'required',
            'tblrecord.idarea' => 'required',
            'tblrecord.idpersonal' => 'required',
            'tblrecord.idcuenta'=> 'required',
            'tblrecord.idccosto'=> 'required',
            'tblrecord.estado'=> 'required',
        ]);
        
        
        if ($this->selectId){
            $record = TmDepartament::find($this->selectId);
            $record->update([
                'descripcion' => $this -> tblrecord['descripcion'],
                'idarea' => $this -> tblrecord['idarea'],
                'idpersonal' => $this -> tblrecord['idpersonal'],
                'idcuenta' => $this -> tblrecord['idcuenta'],
                'idccosto' => $this -> tblrecord['idccosto'],
                'usuario' => $this -> tblrecord['usuario'],
                'estado' => $this -> tblrecord['estado'],
            ]);
            
        }
      
        $this->dispatchBrowserEvent('hide-form', ['message'=> 'added successfully!']);
        
    }

    public function deleteData(){
        TmDepartament::find($this->selectId)->delete();
        $this->dispatchBrowserEvent('hide-delete');
    }
}
