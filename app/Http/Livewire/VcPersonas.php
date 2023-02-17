<?php

namespace App\Http\Livewire;
use App\Models\TmPersonas;

use Livewire\Component;
use Livewire\WithPagination;

class VcPersonas extends Component
{
    
    use WithPagination;

    public $filters = [
        'srv_nombre' => '',
    ];

    public $ecivil = [
        'S' => 'Soltero',
        'C' => 'Casado',
        'D' => 'Divorciado',
        'V' => 'Viudo',
        'U' => 'Unión de Hecho',
    ];
    
    public function render()
    {
        $tblrecords = TmPersonas::query()
        ->when($this->filters['srv_nombre'],function($query){
            return $query->where('tm_personas.nombres','like','%'.$this->filters['srv_nombre'].'%')
                        ->orWhere('tm_personas.apellidos','like','%'.$this->filters['srv_nombre'].'%');
        })
        ->orderBy('apellidos','asc')
        ->paginate(10);
        
        return view('livewire.vc-personas',[
            'tblrecords' => $tblrecords
        ]);

    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap'; 
    }

    public function add(){
        
        return redirect()->to('/file/staff-add');

    }

    public function edit($selectId){
        
        return redirect()->to('/file/staff-edit/'.$selectId);

    }

    public function delete( $id ){
 
        $this->selectId = $id;
        $this->dispatchBrowserEvent('show-delete');

    }


    

}
