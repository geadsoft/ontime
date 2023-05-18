<?php

namespace App\Http\Livewire;
use App\Models\TmPersonas;
use App\Models\TmRubrosrol;
use App\Models\TmCatalogogeneral;
use App\Models\TmPeriodosrol;
use App\Models\TrPrestamosCabs;
use App\Models\TrPrestamosDets;
use App\Models\TmContratos;


use Livewire\Component;

class VcPrestamos extends Component
{
    public $rubroId, $fecha; 
    public $record, $tblperiodos=[];
    public $cuotas;
    public $prestamoId;

    public function mount($id){
        
        if ($id!=""){
            $this->prestamoId = $id;
            $this->loadData();
        }

    }
    
    public function render()
    {
        
        $tblpersonas = TmPersonas::orderby('apellidos','asc')->get();
        $tblrubros   = TmRubrosrol::where('registro','PR')->get();
        $tbltipo     = TmCatalogogeneral::where('superior',5)->get();
        
        $this->rubroId = $tblrubros[0]['id'];

        return view('livewire.vc-prestamos',[
            'tblperiodos' => $this->tblperiodos,
            'tblpersonas' => $tblpersonas,
            'tblrubros' => $tblrubros,
            'tbltipo' => $tbltipo,
        ]);
        
    }

    public function loadData(){

        if ($this->prestamoId>0){
        
            $this->record  = TrPrestamosCabs::find($this->prestamoId)->toArray();
            $this->record['fecha'] = date('Y-m-d',strtotime($this->record['fecha']));
            $this->cuotas  = TrPrestamosDets::where('prestamo_id',$this->prestamoId)->get();

            $this->loadperiodo();

        }else{
            
            $this->tblrecord = TrPrestamosCabs::find($this->prestamoId);
            $this->add();
        }

    }

    public function add(){

        $ldate = date('Y-m-d H:i:s');
        $this->fecha = date('Y-m-d',strtotime($ldate));
        
        $this->reset(['record']);
        $this->record['nombres']= '';
        $this->record['fecha']= $this->fecha;
        $this->record['persona_id']= 0;
        $this->record['tipoprestamo_id']= 0;
        $this->record['rubrosrol_id']= 0;
        $this->record['periodosrol_id']= 0;
        $this->record['monto']= 0.00;
        $this->record['cuota']= 0;
        $this->record['comentario']="";

    }

    public function loadperiodo(){

        $tmcontrato  = TmContratos::where('persona_id',$this->record['persona_id'])->first();


        $this->tblperiodos = TmPeriodosrol::query()
        ->join("tm_tiposrols as t","t.id","=","tm_periodosrols.tiporol_id")
        ->where('t.tipoempleado_id',$tmcontrato->tipoempleado_id)
        ->where('t.tipocontrato_id',$tmcontrato->tipocontrato_id)
        ->where('tm_periodosrols.remuneracion','M')
        ->select('tm_periodosrols.id','tm_periodosrols.fechafin')
        ->get();
              

    }

    public function createData(){
        
        $this ->validate([
            'record.fecha' => 'required',
            'record.persona_id' => 'required',
            'record.tipoprestamo_id' => 'required',
            'record.rubrosrol_id' => 'required',
            'record.periodosrol_id' => 'required',
            'record.monto' => 'required',
            'record.cuota' => 'required',
            'record.comentario' => 'required',
        ]);

        $trPrestamoCabs = TrPrestamosCabs::Create([
            'fecha' => $this -> record['fecha'],
            'persona_id' => $this -> record['persona_id'],
            'tipoprestamo_id' => $this -> record['tipoprestamo_id'],
            'rubrosrol_id' => $this -> record['rubrosrol_id'],
            'periodosrol_id' => $this -> record['periodosrol_id'],
            'monto' => $this -> record['monto'],
            'cuota' => $this -> record['cuota'],
            'comentario' => $this -> record['comentario'],
            'usuario' => auth()->user()->name,
            'estado' => 'P',
        ]);

        $this->prestamoId = $trPrestamoCabs->id;

        $valor = $this->record['monto']/$this->record['cuota'];
        $fecha = "";

        foreach ($this->tblperiodos as $data)
        {
            if ($data['id']==$this->record['periodosrol_id']){
                $fecha    = $data['fechafin'];
            }
        }

        for ($numcuota=1;$numcuota<=$this->record['cuota'];$numcuota++){

            $mes = date('m',strtotime($fecha))+1;
            $año = date('Y',strtotime($fecha));
            
            if ($mes==13){
                $mes = 1;
                $año = date('Y',strtotime($fecha))+1;
            } 
                
            $fecha = strval($año)."-".str_pad($mes, 2, "0", STR_PAD_LEFT).'-01';
            $fecha = date("Y-m-t", strtotime($fecha));
            
            TrPrestamosDets::Create([
                'prestamo_id' => $this->prestamoId,
                'cuota' => $numcuota,
                'fecha' => $fecha,
                'valor' => $valor,
                'estado' => 'P',
                'usuario' => auth()->user()->name,
            ]);

        }

        $this->dispatchBrowserEvent('msg-grabar'); 
        return redirect()->to('/payroll/prestamos/'.$this->prestamoId);
       
    }

}
