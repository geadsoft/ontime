<?php

namespace App\Http\Livewire;
use App\Models\TmCatalogogeneral;
use Livewire\Component;
use Livewire\WithPagination;

class Vccatalogogeneral extends Component
{
    use WithPagination;

    public $showEditModal = false;
    public $selectId, $selectValue;
    public $record;
    public $codigo;
    public $tblsuperior,$tblrecords;

    public $sortDirection = 'desc';
    public $sortData = 'codigo';
    public $superior = 0;
    public $ultcod = 0;
    public $filters = [
        'estado' => 'A',
        'nivel' => '',
        'descripcion' => '',
    ];

    
    public function render()
    {
        $this->tblsuperior = TmCatalogogeneral::where('superior',0)->get();
        $this->tblrecords  = TmCatalogogeneral::query()
        ->when($this->filters['descripcion'],function($query){
            return $query->where('descripcion','like','%'.$this->filters['descripcion'].'%');
        })
        ->when($this->filters['estado'],function($query){
            return $query->where('estado',$this->filters['estado']);
        })
        ->when($this->filters['nivel'],function($query){
            return $query->where('superior',$this->filters['nivel'])
                         ->orWhere('codigo',$this->filters['nivel']);
        })
        ->orderBy('root', 'asc')
        ->paginate(10);  
        
        return view('livewire.Vccatalogogeneral',[
            'tblrecords'  => $this->tblrecords,
            'tblsuperior' => $this->tblsuperior,
        ]);

    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap'; 
    }

    public function add(){
        
        $this->showEditModal = false;
        $this->reset(['record']);
        $this->record['codigo']= 0;
        $this->record['descripcion']= '';
        $this->record['superior']= 0;
        $this->record['estado']= 'A'; 
        $this->record['root']= '';       
        $this->dispatchBrowserEvent('show-form');
        /*$this->emit('getrecord',$this->record,$this->showEditModal);*/

    }

    public function edit(TmCatalogogeneral $tblrecords ){
        
        $this->showEditModal = true;
        $this->record  = $tblrecords->toArray();
       
        $this->selectId = $this -> record['id'];
        $this->dispatchBrowserEvent('show-form');

    }

    public function delete( $id ){
        
        $this->selectId = $id;
        $record = TmCatalogogeneral::find($this->selectId);
        $this->selectValue = $record['descripcion'];

        $this->dispatchBrowserEvent('show-delete');

    }


    public function createData(){
        
        $this->setCodigo();

        $this ->validate([
            'record.descripcion' => 'required',
            'record.codigo' => 'required',
            'record.superior' => 'required',
        ]);

        TmCatalogogeneral::Create([
            'codigo' => $this -> codigo,
            'descripcion' => $this -> record['descripcion'],
            'superior' => $this -> superior,
            'estado' => $this -> record['estado'],
            'root' => $this -> record['root'],
            'usuario' => auth()->user()->name,
        ]);

        $this->dispatchBrowserEvent('hide-form', ['message'=> 'added successfully!']);  
        $this->dispatchBrowserEvent('msg-grabar');
    }

    public function updateData(){

        $this ->validate([
            'record.id' => 'required',
            'record.codigo' => 'required',
            'record.descripcion' => 'required',
            'record.superior' => 'required',
            'record.estado'=> 'required',
            'record.root' => 'required',            
        ]);
        
        
        if ($this->selectId){
            $record = TmCatalogogeneral::find($this->selectId);
            $record->update([
                'descripcion' => $this -> record['descripcion'],
                'estado' => $this -> record['estado'],
            ]);
            
        }
      
        $this->dispatchBrowserEvent('hide-form', ['message'=> 'added successfully!']);
        $this->dispatchBrowserEvent('msg-actualizar');
        
    }

    public function deleteData(){

        $record = TmCatalogogeneral::find($this->selectId);

        $record->update([
            'estado' => 'I',
        ]);

        $this->dispatchBrowserEvent('hide-delete');
    }
   
    public function setCodigo(){
        
        $this->superior = $this -> record['superior'];

        if ($this->superior==0){
            
            $this->ultcod = TmCatalogogeneral::where('superior',0)->orderBy($this->sortData,$this->sortDirection)->first();
            
            if ($this->ultcod==null){
                $this->codigo = 1;  
            } else {  
                $this->codigo = $this->ultcod['codigo']+1;
            }    
                        
        } else {
        
            $this->ultcod = TmCatalogogeneral::where('superior',$this->superior)->orderBy($this->sortData,$this->sortDirection)->first();

            if ($this->ultcod==null){
                $this->codigo = ($this->superior*100)+1;
            } else {  
                $this->codigo = $this->ultcod['codigo']+1;
            }
            
        }

        $sizevar = strlen($this->codigo);
        $cont=1;
        $root=""; 
        
        while ($cont<=($sizevar)){
            $root = $root.substr(strval($this->codigo),0,$cont).'/';
            $cont = $cont+2;
        }
        
        $this->record['codigo']= $this->codigo;
        $this->record['root']= $root;
 
    }

    public function resetFilter(){

        $this->filters['estado'] = 'A';
        $this->filters['nivel'] = '';
        $this->filters['descripcion'] = '';

    }

}
