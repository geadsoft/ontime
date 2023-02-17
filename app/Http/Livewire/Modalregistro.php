<?php

namespace App\Http\Livewire;
use App\Models\TmCatalogogeneral;

use Livewire\Component;

class Modalregistro extends Component
{
    public $showEditModal = false;
    public $codigo;
    public $superior; 
    public $detalle;
    public $estado;
    
    protected $listeners = ['setData'=>'getData'];

    public function render()
    {
        return view('livewire.modalregistro');
    }

    public function getData($codigo,$superior){
        $this->codigo = $codigo;
        $this->superior= $superior;
    }


}
