<?php

namespace App\Http\Livewire;
use App\Models\TmCompania;
use App\Models\TmRubrosrol;


use Livewire\Component;

class Vccompania extends Component
{
    
    public $showEditModal = false;
    public $existsrecno = false;
    public $selectId;
    public $record;
    public $view;    
    
    public function render()
    {
        
        $tblrecords = TmCompania::all();
        $tblrubros  = TmRubrosrol::whereRaw('variable1 >1 or importe>0')->get();


        if (count($tblrecords)>0){
            $this->existsrecno = true;
        }

        $views = TmCompania::orderBy('id','desc')->first();
        $this->view = $views;

        return view('livewire.vc-compania',[
            'tblrecords' => $tblrecords,
            'tblrubros' => $tblrubros,
        ]);
    }

    public function add(){
        
        $this->showEditModal = false;     
        $this->dispatchBrowserEvent('show-form');

    }

    public function edit(TmCompania $tblrecords ){
        
        $this->showEditModal = true;
        $this->record  = $tblrecords->toArray();
       
        $this->selectId = $this -> record['id'];
        $this->dispatchBrowserEvent('show-form');

    }

    public function delete( $id ){
        
        $this->selectId = $id;
        $this->dispatchBrowserEvent('show-delete');

    }

    public function view( $id ){
        
        $this->view = TmCompania::find($id)->toArray();

    }


    public function createData(){
        
        $this ->validate([
            'record.razonsocial' => 'required',
            'record.nombrecomercial' => 'required',
            'record.ruc' => 'required',
            'record.telefono' => 'required',
            'record.provincia' => 'required',
            'record.ciudad' => 'required',
            'record.canton' => 'required',
            'record.ubicacion' => 'required',
            'record.representante' => 'required',
            'record.identificacion' => 'required',
            'record.website' => 'required',
            'record.email' => 'required',
            'record.salario_basico' => 'required',
            'record.aporte_personal' => 'required',
            'record.rubro_appersonal' => 'required',
            'record.aporte_patronal' => 'required',
            'record.rubro_appatronal' => 'required',
            'record.aporte_secap' => 'required',
            'record.rubro_secap' => 'required',
            'record.aporte_iece' => 'required',
            'record.rubro_iece' => 'required',
            'record.rubro_freserva' => 'required',
            'record.rubro_pagofreserva' => 'required',
            'record.decimo_tercero' => 'required',
            'record.decimo_cuarto' => 'required',
            'record.vacaciones' => 'required',
            'record.elaborado' => 'required',
            'record.revisado' => 'required',
            'record.visto_bueno' => 'required',
        ]);

        TmCompania::Create([
            'razonsocial' => $this -> record['razonsocial'],
            'nombrecomercial' => $this -> record['nombrecomercial'],
            'ruc' => $this -> record['ruc'],
            'telefono' => $this -> record['telefono'],
            'provincia' => $this -> record['provincia'],
            'ciudad' => $this -> record['ciudad'],
            'canton' => $this -> record['canton'],
            'ubicacion' => $this -> record['ubicacion'],
            'representante' => $this -> record['representante'],
            'identificacion' => $this -> record['identificacion'],
            'website' => $this -> record['website'],
            'email' => $this -> record['email'],
            'salario_basico' => $this -> record['salario_basico'],
            'aporte_personal' => $this -> record['aporte_personal'],
            'rubro_appersonal' => $this -> record['rubro_appersonal'],
            'aporte_patronal' => $this -> record['aporte_patronal'],
            'rubro_appatronal' => $this -> record['rubro_appatronal'],
            'aporte_secap' => $this -> record['aporte_secap'],
            'rubro_secap' => $this -> record['rubro_secap'],
            'aporte_iece' => $this -> record['aporte_iece'],
            'rubro_iece' => $this -> record['rubro_iece'],
            'rubro_freserva' => $this -> record['rubro_freserva'],
            'rubro_pagofreserva' => $this -> record['rubro_pagofreserva'],
            'decimo_tercero' => $this -> record['decimo_tercero'],
            'decimo_cuarto' => $this -> record['decimo_cuarto'],
            'vacaciones' => $this -> record['vacaciones'],
            'elaborado' => $this -> record['elaborado'],
            'revisado' => $this -> record['revisado'],
            'visto_bueno' => $this -> record['visto_bueno'],
            'imagen' => "",
            'usuario' => auth()->user()->name,
        ]);

        $this->dispatchBrowserEvent('hide-form', ['message'=> 'added successfully!']);  
        
    }

    public function updateData(){

        $this ->validate([
            'record.id' => 'required',
            'record.razonsocial' => 'required',
            'record.nombrecomercial' => 'required',
            'record.ruc' => 'required',
            'record.telefono' => 'required',
            'record.provincia' => 'required',
            'record.ciudad' => 'required',
            'record.canton' => 'required',
            'record.ubicacion' => 'required',
            'record.representante' => 'required',
            'record.identificacion' => 'required',
            'record.website' => 'required',
            'record.email' => 'required',
            'record.salario_basico' => 'required',
            'record.aporte_personal' => 'required',
            'record.rubro_appersonal' => 'required',
            'record.aporte_patronal' => 'required',
            'record.rubro_appatronal' => 'required',
            'record.aporte_secap' => 'required',
            'record.rubro_secap' => 'required',
            'record.aporte_iece' => 'required',
            'record.rubro_iece' => 'required',
            'record.rubro_freserva' => 'required',
            'record.rubro_pagofreserva' => 'required',
            'record.decimo_tercero' => 'required',
            'record.decimo_cuarto' => 'required',
            'record.vacaciones' => 'required',
        ]);
        
        
        if ($this->selectId){
            $record = TmCompania::find($this->selectId);
            $record->update([
                'razonsocial' => $this -> record['razonsocial'],
                'nombrecomercial' => $this -> record['nombrecomercial'],
                'ruc' => $this -> record['ruc'],
                'telefono' => $this -> record['telefono'],
                'provincia' => $this -> record['provincia'],
                'ciudad' => $this -> record['ciudad'],
                'canton' => $this -> record['canton'],
                'ubicacion' => $this -> record['ubicacion'],
                'representante' => $this -> record['representante'],
                'identificacion' => $this -> record['identificacion'],
                'website' => $this -> record['website'],
                'email' => $this -> record['email'],
                'salario_basico' => $this -> record['salario_basico'],
                'aporte_personal' => $this -> record['aporte_personal'],
                'rubro_appersonal' => $this -> record['rubro_appersonal'],
                'aporte_patronal' => $this -> record['aporte_patronal'],
                'rubro_appatronal' => $this -> record['rubro_appatronal'],
                'aporte_secap' => $this -> record['aporte_secap'],
                'rubro_secap' => $this -> record['rubro_secap'],
                'aporte_iece' => $this -> record['aporte_iece'],
                'rubro_iece' => $this -> record['rubro_iece'],
                'rubro_freserva' => $this -> record['rubro_freserva'],
                'rubro_pagofreserva' => $this -> record['rubro_pagofreserva'],
                'decimo_tercero' => $this -> record['decimo_tercero'],
                'decimo_cuarto' => $this -> record['decimo_cuarto'],
                'vacaciones' => $this -> record['vacaciones'],
                'elaborado' => $this -> record['elaborado'],
                'revisado' => $this -> record['revisado'],
                'visto_bueno' => $this -> record['visto_bueno'],
                'usuario' => auth()->user()->name,
            ]);
            
        }
      
        $this->dispatchBrowserEvent('hide-form', ['message'=> 'added successfully!']);
        
    }

    public function deleteData(){
        TmCompania::find($this->selectId)->delete();
        $this->dispatchBrowserEvent('hide-delete');
    }


}
