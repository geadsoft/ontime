<?php

namespace App\Http\Livewire;
use App\Models\TmArea;
use Livewire\Component;
use Livewire\WithPagination;

class Vcareas extends Component
{
    use WithPagination;

    protected $listener = ['edit'];
    public $showEditModal = false;
    public $showAddDepart = false;
    public $tblarea;
    public $selectId;
    public $tblrecord;
    public $areaId=null;
    
    public function render()
    {
        
        $tblareas = TmArea::Raw('ifnull(area_id,0)','=',0)->get();

        $tblrecords = TmArea::orderByRaw('case when area_id is null then id else area_id end, area_id')->paginate(10);
        return view('livewire.Vcareas',[
            'tblrecords' => $tblrecords,
            'tblareas' => $tblareas,
        ]);

 
    }

    
    public function add($area_id=null){
        
        $this->showEditModal = false;
        $this->areaId = $area_id;
        $this->reset(['tblrecord']);
        $this->tblrecord['descripcion']= "";
        $this->tblrecord['area_id']= $area_id;
        $this->tblrecord['estado']= 'A';      
        $this->dispatchBrowserEvent('show-form');

    }

    public function edit(TmArea $tblrecords ){
        
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
            'tblrecord.estado' => 'required',
        ]);
        
        TmArea::Create([
            'descripcion' => $this -> tblrecord['descripcion'],
            'area_id' => $this -> areaId,
            'usuario' => auth()->user()->name,
            'estado' => $this -> tblrecord['estado'],
        ]);

        $this->dispatchBrowserEvent('hide-form', ['message'=> 'added successfully!']);  
        
    }

    public function updateData(){

        $this ->validate([
            'tblrecord.id' => 'required',
            'tblrecord.descripcion' => 'required',
            'tblrecord.estado'=> 'required',
        ]);
        
        
        if ($this->selectId){
            $record = TmArea::find($this->selectId);
            $record->update([
                'descripcion' => $this -> tblrecord['descripcion'],
                'area_id' => $this -> tblrecord['area_id'],
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
