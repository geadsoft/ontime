<?php

namespace App\Http\Livewire;
use App\Models\TmCatalogogeneral;
use Livewire\Component;

class Catgencbosuperior extends Component
{
    
    public $record;
    public $sortDirection = 'asc';
    public $sortData = 'codigo';
    public $superior;
    public $ultcod = 0;
    public $codigo = 0;
    /*protected $listeners = ['setcodigo'=>'getCodigo'];*/

    public function render()
    {
        
        $tblrecords = TmCatalogogeneral::all();
        return view('livewire.catgencbosuperior',[
            'tblrecords' => $tblrecords,
        ]);
    
    }

    /*public function getCodigo($value){

        $this->superior = $value;
        
        if ($this->superior==0){
            
            $this->ultcod = TmCatalogogeneral::where('superior',0)->orderBy($this->sortData,$this->sortDirection)->first();
            
            if ($this->ultcod==null){
                $this->codigo = 1;  
            } else {  
                $this->codigo = $this->ultcod+1;
            }    
                        
        } else {

            $this->ultcod = TmCatalogogeneral::where('superior',$this->superior)->orderBy($this->sortData,$this->sortDirection)->first();

            if ($this->ultcod==null){
                $this->codigo = ($this->superior*100)+1;
            } else {  
                $this->codigo = ($this->superior*100)+$this->ultcod;
            }
            
        }

        $this->emit('changeData',$this->codigo);

    }*/

    public function updatedsuperior(){

        if ($this->superior==0){
            
            $this->ultcod = TmCatalogogeneral::where('superior',0)->orderBy($this->sortData,$this->sortDirection)->first();
            
            if ($this->ultcod==null){
                $this->codigo = 1;  
            } else {  
                $this->codigo = $this->ultcod+1;
            }    
                        
        } else {

            $this->ultcod = TmCatalogogeneral::where('superior',$this->superior)->orderBy($this->sortData,$this->sortDirection)->first();

            if ($this->ultcod==null){
                $this->codigo = ($this->superior*100)+1;
            } else {  
                $this->codigo = ($this->superior*100)+$this->ultcod;
            }
            
        }
        
        $this->emit('changeData',$this->codigo,$this->superior);
        
    }

    
}
