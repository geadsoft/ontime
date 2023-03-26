<?php

namespace App\Http\Livewire;
use App\Models\TmCargocia;
use Livewire\WithPagination;

use Livewire\Component;

class Vccargocia extends Component
{
    
    use WithPagination;
    public $showEditModal = false;
    public $selectId, $selectValue;
    public $record;
    public $filters = [
        'estado' => 'A',
        'descripcion' => '',
    ];
  
    
    public function render()
    {
        
        $tblsuperior = TmCargocia::query()
        ->join("tm_cargocias as c","c.cargo_id","=","tm_cargocias.id")
        ->select('tm_cargocias.id','tm_cargocias.descripcion')
        ->groupBy('tm_cargocias.descripcion','tm_cargocias.id')
        ->get();

        $tblrecords = TmCargocia::query()
        ->when($this->filters['descripcion'],function($query){
            return $query->where('descripcion','like','%'.$this->filters['descripcion'].'%');
        })
        ->when($this->filters['estado'],function($query){
            return $query->where('estado',$this->filters['estado']);
        })
        ->orderByRaw('case when cargo_id = 0 then id else cargo_id end, cargo_id')
        ->paginate(10);

        return view('livewire.vccargocia',[
            'tblrecords'  => $tblrecords,
            'tblsuperior' => $tblsuperior, 
        ]);

    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap'; 
    }

    public function add(){
        
        $this->showEditModal = false;
        $this->reset(['record']);
        $this->record['descripcion']= "";
        $this->record['cargo_id']= NULL;
        $this->record['estado']= 'A';       
        $this->dispatchBrowserEvent('show-form');

    }

    public function edit(TmCargocia $tblrecords ){
        
        $this->showEditModal = true;
        $this->record  = $tblrecords->toArray();
       
        $this->selectId = $this -> record['id'];
        $this->dispatchBrowserEvent('show-form');

    }

    public function delete( $id ){
        
        $this->selectId = $id;
        
        $record = TmCargocia::find($id);
        $this->selectValue = $record['descripcion'];

        $this->dispatchBrowserEvent('show-delete');

    }


    public function createData(){
        
        $this ->validate([
            'record.descripcion' => 'required',
        ]);

        TmCargocia::Create([
            'descripcion' => $this -> record['descripcion'],
            'cargo_id' => $this -> record['cargo_id'],
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
            'record.cargo_id' => 'required',
            'record.estado'=> 'required',
        ]);
        
        
        if ($this->selectId){
            $record = TmCargocia::find($this->selectId);
            $record->update([
                'descripcion' => $this -> record['descripcion'],
                'cargo_id' => $this -> record['cargo_id'],
                'usuario' => $this -> record['usuario'],
                'estado' => $this -> record['estado'],
            ]);
            
        }
      
        $this->dispatchBrowserEvent('hide-form');
        $this->dispatchBrowserEvent('msg-actualizar');
    }

    public function deleteData(){
        
        $record = TmCargocia::find($this->selectId);

        $record->update([
            'estado' => 'I',
        ]);

        $this->dispatchBrowserEvent('hide-delete');
    }

    public function resetFilter(){

        $this->filters['estado'] = 'A';
        $this->filters['descripcion'] = '';

    }

    public function selectValue($value){
        $this->record['cargo_id']= $value;
    } 


}
