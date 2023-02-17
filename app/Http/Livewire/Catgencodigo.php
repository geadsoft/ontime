<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Catgencodigo extends Component
{
    
    public $codigo;
    public $superior;
    protected $listeners = ['changeData'=>'viewchange'];

    public function render()
    {
        return view('livewire.catgencodigo');
    }

    public function viewchange($val1=null,$val2=null){
        $this->codigo = $val1;
        $this->superior = $val2;

       
        /*$this->superior = $value;
        
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
            
        }*/
        
        $this->emit('setData',$this->codigo,$this->superior);
    }

    public function updatedsuperior(){
            alert('ok');
    }

}
