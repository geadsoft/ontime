<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TmRubrosrol;
use App\Models\TmVariables;
use App\Models\TdRubrosrolBases;


class Vcrubrosadd extends Component
{

    use WithPagination;

    public $AddNew = false;
    public $selectId;
    public $record;
    public $baseRubros = [];
    public $rubros = [
        'id' => 0,
        'rubrorol_id' => 0,
        'descripcion' => "",
        'baserubrorol_id' => 0,
        'importe' => 0,
        'constante' => 0,
    ];

    public function mount($rubro_id){
        
        if ($rubro_id>0){
            $this->selectId = $rubro_id;
            $this->loadData(); 
            $this->AddNew = true;  
        }

    }

    public function render()
    {
        $tblvariables = TmVariables::all();
        $tblrubros    = TmRubrosrol::all();
                
        if ($this->selectId==0){
            $this->add();
        }
        
        return view('livewire.vcrubrosadd',[
            'record' => $this->record,
            'tblvariables' => $tblvariables,
            'tblrubros' => $tblrubros,
            'baseRubros' => $this->baseRubros
        ]);

    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap'; 
    }

    public function loadData(){

        $this->record   = TmRubrosrol::find($this->selectId)->toArray();
        $tblbases       = TdRubrosrolBases::query()
        ->select('id','rubrorol_id','baserubrorol_id','importe','constante')
        ->where('rubrorol_id',$this->selectId)
        ->get()->toArray();

        if (empty($tblbases)) {
            $this->newRecno();
        }else{
            $this->baseRubros =  $tblbases;
        }

    }

    public function add(){
        
        $this->reset(['record']);
        $this->record['descripcion']= "";
        $this->record['tipo']= "P";
        $this->record['registro']= "NO";
        $this->record['regplanilla']= false;
        $this->record['etiqueta']= ""; 
        $this->record['imprimerol1']= false; 
        $this->record['imprimerol2']= true;  
        $this->record['imprimerol3']= true;
        $this->record['variable1']= 1;
        $this->record['importe']= 0.00;
        $this->record['variable2']= 0;
        $this->record['constante']= 0.00;
        $this->record['estado']= 'A';       

    }

    public function createData(){
      
        $this ->validate([
            'record.descripcion' => 'required',
            'record.etiqueta' => 'required',
            'record.registro' => 'required',
        ]);

        TmRubrosrol::Create([
            'descripcion' => $this -> record['descripcion'],
            'etiqueta' => $this -> record['etiqueta'],
            'tipo' => $this -> record['tipo'],
            'registro' => $this -> record['registro'],
            'regplanilla' => $this -> record['regplanilla'],
            'imprimerol1' => $this -> record['imprimerol1'],
            'imprimerol2' => $this -> record['imprimerol2'],
            'imprimerol3' => $this -> record['imprimerol3'],
            'variable1' => $this -> record['variable1'],
            'importe' => $this -> record['importe'],
            'variable2' => $this -> record['variable2'],
            'constante' => $this -> record['constante'],
            'usuario' => auth()->user()->name,
            'estado' => $this -> record['estado'],
        ]);

        $this->dispatchBrowserEvent('msg-grabar'); 
        return redirect()->to('/form/rubros');
        
    }

    public function updateData(){

        $record = TmRubrosrol::find($this->selectId);
        $record->update([
            'descripcion' => $this -> record['descripcion'],
            'etiqueta'    => $this -> record['etiqueta'],
            'tipo'        => $this -> record['tipo'],
            'registro'    => $this -> record['registro'],
            'regplanilla' => $this -> record['regplanilla'],
            'imprimerol1' => $this -> record['imprimerol1'],
            'imprimerol2' => $this -> record['imprimerol2'],
            'imprimerol3' => $this -> record['imprimerol3'],
            'variable1'   => $this -> record['variable1'],
            'importe'     => $this -> record['importe'],
            'variable2'   => $this -> record['variable2'],
            'constante'   => $this -> record['constante'],

        ]);

        foreach ($this->baseRubros as $data){

            if ($data['id']>0){
                
                $record = TdRubrosrolBases::find($data['id']);
                $record->update([
                    'baserubrorol_id' => $data['baserubrorol_id'],
                    'importe'         => $data['importe'],
                    'constante'       => $data['constante'],
                ]);

            }else{
                
                TdRubrosrolBases::Create([
                    'rubrorol_id'    => $this->selectId,
                    'baserubrorol_id' => $data['baserubrorol_id'],
                    'importe'         => $data['importe'],
                    'constante'       => $data['constante'],
                    'usuario'         => auth()->user()->name,
                ]);

            }

        }

        $this->dispatchBrowserEvent('msg-grabar'); 
        return redirect()->to('/form/rubros');

    }

    public function newRecno(){

        $this->rubros['id'] = 0;
        $this->rubros['rubrorol_id']=0;
        $this->rubros['descripcion']="";
        $this->rubros['baserubrorol_id']=0;
        $this->rubros['importe']=1.00;
        $this->rubros['constante']=0.00;

    }

    public function addRubro(){

        array_push($this->baseRubros,$this->rubros);
        $this->newRecno();

    }









}
