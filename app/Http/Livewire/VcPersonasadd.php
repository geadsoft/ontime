<?php

namespace App\Http\Livewire;
use App\Models\TmPersonas;
use App\Models\TmCatalogogeneral;

use Livewire\Component;

class VcPersonasadd extends Component
{   

    public $record;
    public $personaId, $fechanace, $addPersona = false;

    public function mount($id){
        
        if ($id!=""){
            $this->personaId = $id;
            $this->loadData();
        }

    }


    public function render()
    {
        $tblBancos = TmCatalogogeneral::where('superior',6)->get();

        return view('livewire.vc-personasadd',[
            'record'    => $this->record,
            'tblbancos' => $tblBancos,
        ]);

    }

    public function loadData(){

        if ($this->personaId>0){
            
            $this->addPersona = false;

            $this->record     = TmPersonas::find($this->personaId)->toArray();
            $this->fechanace  = date('Y-m-d',strtotime($this->record['fecha_nace'])); 

        }else{
            
            $this->addPersona = true;

            $this->record   = TmPersonas::find($this->personaId);
            $this->add();
        }
        
    }

    public function add(){
        
        $this->reset(['record']);
        $this->record['nombres']= '';
        $this->record['apellidos']= '';
        $this->record['tipo_nui']= 'C';
        $this->record['nui']= '';
        $this->record['direccion']= ''; 
        $this->record['telefono']= ''; 
        $this->record['instruccion']= 'NN';  
        $this->record['carga_familiar']= 0;
        $this->record['sexo']= 'M';
        $this->record['estado_civil']= 'S';
        $this->record['fecha_nace']= '';
        $this->record['tipo_sangre']= 'O+';
        $this->record['entidadbancaria_id']= 17;
        $this->record['tipo_cuenta']= 'AHO';
        $this->record['cuenta_banco']= '';
        $this->record['estado']= 'A';
        
        $this->fechanace = '';

    }

    public function validaNui(){

        if($this->record['nui'] == ''){
            return;
        }

        $data = TmPersonas::where("nui",$this->record['nui'])->first();
        
        if ($data != null){
            $this->record['nui'] = '';
            $this->dispatchBrowserEvent('msg-validanui');
        }
    }

    public function createData(){
        
        $this ->validate([
            'record.nombres' => 'required',
            'record.apellidos' => 'required',
            'record.tipo_nui' => 'required',
            'record.nui' => 'required',
            'record.direccion' => 'required',
            'record.telefono' => 'required',
            'record.instruccion' => 'required',
            'record.sexo' => 'required',
            'record.estado_civil' => 'required',
            'record.tipo_sangre' => 'required'
        ]);

        TmPersonas::Create([
            'nombres' => $this -> record['nombres'],
            'apellidos' => $this -> record['apellidos'],
            'tipo_nui' => $this -> record['tipo_nui'],
            'nui' => $this -> record['nui'],
            'direccion' => $this -> record['direccion'],
            'telefono' => $this -> record['telefono'],
            'instruccion' => $this -> record['instruccion'],
            'sexo' => $this -> record['sexo'],
            'carga_familiar' => $this -> record['carga_familiar'],
            'estado_civil' => $this -> record['estado_civil'],
            'fecha_nace' => $this -> fechanace,
            'tipo_sangre' => $this -> record['tipo_sangre'],
            'entidadbancaria_id' => $this -> record['entidadbancaria_id'],
            'tipo_cuenta' => $this -> record['tipo_cuenta'],
            'cuenta_banco' => $this -> record['cuenta_banco'],
            'usuario' => auth()->user()->name,
            'estado' => $this -> record['estado'],
        ]);

        $this->dispatchBrowserEvent('msg-grabar'); 
        return redirect()->to('/file/staff');

    }

    public function updateData(){

        $this ->validate([
            'record.nombres' => 'required',
            'record.apellidos' => 'required',
            'record.tipo_nui' => 'required',
            'record.nui' => 'required',
            'record.direccion' => 'required',
            'record.telefono' => 'required',
            'record.instruccion' => 'required',
            'record.sexo' => 'required',
            'record.estado_civil' => 'required',
            'record.tipo_sangre' => 'required',
        ]);

        
        $persona = TmPersonas::find($this->personaId);
        $persona->update([
            'nombres' => $this -> record['nombres'],
            'apellidos' => $this -> record['apellidos'],
            'tipo_nui' => $this -> record['tipo_nui'],
            'nui' => $this -> record['nui'],
            'direccion' => $this -> record['direccion'],
            'telefono' => $this -> record['telefono'],
            'instruccion' => $this -> record['instruccion'],
            'sexo' => $this -> record['sexo'],
            'carga_familiar' => $this -> record['carga_familiar'],
            'estado_civil' => $this -> record['estado_civil'],
            'fecha_nace' => $this -> fechanace,
            'tipo_sangre' => $this -> record['tipo_sangre'],
            'entidadbancaria_id' => $this -> record['entidadbancaria_id'],
            'tipo_cuenta' => $this -> record['tipo_cuenta'],
            'cuenta_banco' => $this -> record['cuenta_banco'],
            'estado' => $this -> record['estado'],
        ]);


        $this->dispatchBrowserEvent('msg-editar'); 
        return redirect()->to('/file/staff');

    }



}
