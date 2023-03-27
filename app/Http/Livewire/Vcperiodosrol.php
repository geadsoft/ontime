<?php

namespace App\Http\Livewire;
use App\Models\TmPeriodosrol;
use App\Models\TmTiposrol;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Vcperiodosrol extends Component
{   
    use WithPagination;
    public $showEditModal = false;
    public $selectId, $selectValue;
    public $record;
    public $meses = [ 
        1 => 'Enero',
        2 => 'Febrero',
        3 => 'Marzo',
        4 => 'Abril',
        5 => 'Mayo',
        6 => 'Junio',
        7 => 'Julio',
        8 => 'Agosto',
        9 => 'Septiembre',
        10 => 'Octubre',
        11 => 'Noviembre',
        12 => 'Diciembre'];
    
    public $tiempo = [
        'Q' => 'Quincenal',
        'M' => 'Mensual'];
    
    public $filters = [
        'periodo' => '',
        'mes' => '',
        'proceso' => '',
        'estado' => '',
        'procesado' => '',
        'aprobado' => '',
        'cerrado' => '',

    ];

    protected $listeners = ['saveData'];



    public function render()
    {

        $tbltiporols = TmTiposrol::all();
        $periodos    = DB::Select("
            Select year(fechafin) as periodo from tm_periodosrols
            Where remuneracion = 'M'
            Group by year(fechafin)");

        $this->estado();

        $tblrecords  = TmPeriodosrol::query()
        ->when($this->filters['periodo'],function($query){
            return $query->whereRaw('year(fechafin) = '.$this->filters['periodo']);
        })
        ->when($this->filters['mes'],function($query){
            return $query->where('mes',$this->filters['mes']);
        })
        ->when($this->filters['proceso'],function($query){
            return $query->where('remuneracion',$this->filters['proceso']);
        })
        ->when($this->filters['procesado'],function($query){
            return $query->where('procesado',$this->filters['procesado']);
        })
        ->when($this->filters['aprobado'],function($query){
            return $query->where('aprobado',$this->filters['aprobado']);
        })
        ->when($this->filters['cerrado'],function($query){
            return $query->where('cerrado',$this->filters['cerrado']);
        })

        ->orderByRaw('tiporol_id, mes')
        ->paginate(10);


        return view('livewire.vc-periodosrol',[
            'tblrecords' => $tblrecords,
            'tbltiporols' => $tbltiporols,
            'periodos' => $periodos,
        ]);

    }

    public function estado(){

        switch ($this->filters['estado']){
            case 'G':
                $this->filters['procesado'] = 1;
                $this->filters['aprobado'] = '';
                $this->filters['cerrado'] = '';
                break;
            case 'A':
                $this->filters['aprobado'] = 1;
                $this->filters['procesado'] = '';
                $this->filters['cerrado'] = '';
                break;
            case 'C':
                $this->filters['cerrado'] = 1;
                $this->filters['aprobado'] = '';
                $this->filters['procesado'] = '';
                break;
            default:
                $this->filters['cerrado'] = '';
                $this->filters['aprobado'] = '';
                $this->filters['procesado'] = '';
        }

    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap'; 
    }

    public function add(){
        
        $this->showEditModal = false;
        $this->reset(['record']);
        $this->record['tiporol_id']= 0;
        $this->record['mes']= 0;
        $this->record['tiempo']= "";
        $this->record['fechaini']= ""; 
        $this->record['fechafin']= "";       
        $this->dispatchBrowserEvent('show-form');

    }
    public function edit(TmPeriodosrol $tblrecords ){
        
        $this->showEditModal = true;
        $this->record  = $tblrecords->toArray();
       
        $this->selectId = $this -> record['id'];
        $this->dispatchBrowserEvent('show-form');

    }

    public function delete( $id ){
        
        $this->selectId = $id;
        $record = TmPeriodosrol::find($id);
        $this->selectValue = $record->tiporol['descripcion'];

        $this->dispatchBrowserEvent('show-delete');

    }

    public function createData(){
        
        $this->dispatchBrowserEvent('hide-form');
        $this->dispatchBrowserEvent('get-date');
        
    }    

    public function saveData($objDate=null){
        
        $this->record['fechaini'] = $objDate['fechaini']; 
        $this->record['fechafin'] = $objDate['fechafin']; 
        
        $this ->validate([
            'record.mes' => 'required',
            'record.remuneracion' => 'required',
            'record.fechaini' => 'required',
            'record.fechafin' => 'required',
            'record.tiporol_id' => 'required',
        ]);

        TmPeriodosrol::Create([
            'tiporol_id' => $this -> record['tiporol_id'],
            'mes' => $this -> record['mes'],
            'remuneracion' => $this -> record['remuneracion'],
            'fechaini' => $this -> record['fechaini'],
            'fechafin' => $this -> record['fechafin'],
            'procesado' => false,
            'aprobado' => false,
            'cerrado' => false,
            'usuario' => auth()->user()->name,
        ]);
  
        $this->dispatchBrowserEvent('msg-grabar');
        
    }


    public function updateData(){

        $this ->validate([
            'record.tiporol_id' => 'required',
            'record.mes' => 'required',
            'record.remuneracion' => 'required',
            'record.fechaini' => 'required',
            'record.fechafin' => 'required',
        ]);
        
        
        if ($this->selectId){
            $record = TmPeriodosrol::find($this->selectId);
            $record->update([
                'tiporol_id' => $this -> record['tiporol_id'],
                'mes' => $this -> record['mes'],
                'remuneracion' => $this -> record['remuneracion'],
                'fechaini' => date('Y-m-d H:i:s', strtotime($this -> record['fechaini'])),
                'fechafin' => date('Y-m-d H:i:s', strtotime($this -> record['fechafin'])),
            ]);
            
        }
      
        $this->dispatchBrowserEvent('hide-form', ['message'=> 'added successfully!']);
        $this->dispatchBrowserEvent('msg-actualizar');
        
    }

    public function deleteData(){

        $record = TmTiposrol::find($this->selectId);
        $record->Update([
            'estado' => 'I',
        ]);

        $this->dispatchBrowserEvent('hide-delete');
    }

    public function resetFilter(){

        $this->filters['periodo'] = '';
        $this->filters['mes'] = '';
        $this->filters['proceso'] = '';
        $this->filters['estado'] = '';
        $this->filters['procesado'] = '';
        $this->filters['aprobado'] = '';
        $this->filters['cerrado'] = '';

    }

}
