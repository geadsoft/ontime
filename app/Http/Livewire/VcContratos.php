<?php

namespace App\Http\Livewire;
use App\Models\TmContratos;
use App\Models\TmCatalogogeneral;
use App\Models\TmArea;
use App\Models\TmCargocia;
use App\Models\TmPersonas;

use Livewire\Component;
use Livewire\WithPagination;

class VcContratos extends Component
{
    use WithPagination;

    public $showEditModal = false;
    public $selectId, $record;

    public function render()
    {
        $personas   = TmPersonas::orderBy('apellidos','asc')->get();
        $templeados = TmCatalogogeneral::where('superior',1)->get();
        $tcontratos = TmCatalogogeneral::where('superior',2)->get();
        $areas      = TmArea::all();
        $cargos     = TmCargocia::all();
        $tblrecords = TmContratos::paginate(10);

        return view('livewire.vc-contratos',[
            'tblrecords'  => $tblrecords,
            'templeados'  => $templeados,
            'tcontratos'  => $tcontratos,
            'areas'      => $areas,
            'cargos'     => $cargos, 
            'personas'   => $personas,           
        ]);
    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap'; 
    }

    public function add(){
        
        $this->showEditModal = false;
        $this->reset(['record']);

        $ldate = date('Y-m-d H:i:s');
        $this->record['fecha']= date('Y-m-d',strtotime($ldate));
        $this->record['persona_id']= 0;
        $this->record['codigo_sectorial']= '';
        $this->record['tipoempleado_id']= 0; 
        $this->record['tipocontrato_id']= 0;
        $this->record['area_id']= 0;
        $this->record['departamento_id']= 0;
        $this->record['cargo_id']= 0;
        $this->record['fecha_ingreso']= '';
        $this->record['fecha_salida']= null;
        $this->record['fondo_reserva']= 'PA';
        $this->record['anticipo']= 0.00;
        $this->record['sueldo']= 0.00;
        $this->record['tipo_pago']= 'TRA';

        $this->dispatchBrowserEvent('show-form');
        
    }

    public function edit(TmContratos $tblrecords){
        
        $this->showEditModal = true;
        $this->record  = $tblrecords->toArray();
       
        $this->selectId = $this -> record['id'];
        $this->record['fecha']         = date('Y-m-d',strtotime($this -> record['fecha']));
        $this->record['fecha_ingreso'] = date('Y-m-d',strtotime($this -> record['fecha_ingreso']));
       
        $this->dispatchBrowserEvent('show-form');

    }

    public function delete( $id ){
        
        $this->selectId = $id;
        $this->dispatchBrowserEvent('show-delete');

    }

    //Procesos//

    public function createData(){
        
        $this ->validate([
            'record.fecha' => 'required',
            'record.persona_id' => 'required',
            'record.tipoempleado_id' => 'required',
            'record.tipocontrato_id' => 'required',
            'record.area_id' => 'required',
            'record.departamento_id' => 'required',
            'record.cargo_id' => 'required',
            'record.fecha_ingreso' => 'required',
            'record.fondo_reserva' => 'required',
            'record.sueldo' => 'required',
            'record.anticipo' => 'required',
        ]);

        TmContratos::Create([
            'fecha' => $this -> record['fecha'],
            'persona_id' => $this -> record['persona_id'],
            'tipoempleado_id' => $this -> record['tipoempleado_id'],
            'tipocontrato_id' => $this -> record['tipocontrato_id'],
            'area_id' => $this -> record['area_id'],
            'departamento_id' => $this -> record['departamento_id'],
            'cargo_id' => $this -> record['cargo_id'],
            'fecha_ingreso' => $this -> record['fecha_ingreso'],
            'fecha_salida' => $this -> record['fecha_salida'],
            'fondo_reserva' => $this -> record['fondo_reserva'],
            'sueldo' => $this -> record['sueldo'],
            'anticipo' => $this -> record['anticipo'],
            'codigo_sectorial' => $this -> record['codigo_sectorial'],
            'tipo_pago' => $this -> record['tipo_pago'],
            'estado' => 'A',
            'usuario' => auth()->user()->name,
        ]);

        $this->dispatchBrowserEvent('hide-form', ['message'=> 'added successfully!']);  
        
    }




}
