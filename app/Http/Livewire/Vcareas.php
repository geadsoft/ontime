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
    public $selectId, $selectValue;
    public $tblrecord;
    public $areaId=null;
    public $filters = [
        'estado' => 'A',
        'area' => '',
        'descripcion' => '',
    ];
    
    public function render()
    {
        
        $tblareas = TmArea::Raw('ifnull(area_id,0)','=',0)->get();

        $tblrecords = TmArea::query()
        ->when($this->filters['descripcion'],function($query){
            return $query->where('descripcion','like','%'.$this->filters['descripcion'].'%');
        })
        ->when($this->filters['estado'],function($query){
            return $query->where('estado',$this->filters['estado']);
        })
        ->when($this->filters['area'],function($query){
            return $query->where('area_id',$this->filters['area']);
        })
        ->orderByRaw('case when area_id is null then id else area_id end, area_id')
        ->paginate(10);

        return view('livewire.Vcareas',[
            'tblrecords' => $tblrecords,
            'tblareas' => $tblareas,
        ]);

 
    }

    
    public function add($area_id){
        
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
        $this->areaId   = $this -> tblrecord['area_id'];
        $this->dispatchBrowserEvent('show-form');

    }

    public function delete( $id ){
        
        $this->selectId = $id;
        $record = TmArea::find($id);

        $this->selectValue = $record['descripcion'];

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

        $this->dispatchBrowserEvent('hide-form');  
        $this->dispatchBrowserEvent('msg-grabar');
        
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
      
        $this->dispatchBrowserEvent('hide-form');
        $this->dispatchBrowserEvent('msg-actualizar');
        
    }

    public function deleteData(){

        $record = TmArea::find($this->selectId);

        $record->update([
            'estado' => 'I',
        ]);

        $this->dispatchBrowserEvent('hide-delete');
    }

    public function resetFilter(){

        $this->filters['estado'] = 'A';
        $this->filters['area'] = '';
        $this->filters['descripcion'] = '';

    }

}
