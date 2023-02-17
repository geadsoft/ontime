<?php

namespace App\Http\Livewire;
use App\Models\TmPeriodosrol;
use App\Models\TdPlanillaRubros;
use App\Models\TmPersonas;
use App\Models\TmRubrosRol;
use App\Models\TdTiporolRubros;
use App\Models\TmContratos;

use Livewire\WithPagination;

use Illuminate\Support\Facades\DB;

use Livewire\Component;

class VcRolPago extends Component
{   
    

    public $fecha, $periodoId, $titulo, $count=1;
    public $ingreso, $otringr, $egresos, $otegres;
    public $detalle = [];
    public $rowdata = [
        'empleado_id' => '',
        'empleado' => '',
        'ingresos' => 0,
        'otingresos' => 0,
        'egresos' => 0,
        'otegresos' => 0,
        'total' => 0,
        'tipo_pago' => '',
        'cuentabanco' => '',
        'entidad_id' => 0,
    ];

    public function render()
    {
        $ldate = date('Y-m-d H:i:s');
        $this->fecha = date('Y-m-d',strtotime($ldate));
        
        $tblperiodos = TmPeriodosrol::where('procesado',0)
        ->get();
        
        return view('livewire.vc-rol-pago',[
            'tblperiodos' => $tblperiodos,
            'detalle' => $this->detalle,
        ]);
        
    }


    public function add(){     

        $tblperiodos = TmPeriodosrol::find($this->periodoId);
        $this->detalle = [];

        $tiporol = TmPeriodosrol::query()
        ->join("tm_tiposrols as t","t.id","=","tm_periodosrols.tiporol_id")
        ->where('tm_periodosrols.id',$this->periodoId)
        ->first();

        $personas = TmPersonas::query()
        ->join("tm_contratos as c","c.persona_id","=","tm_personas.id")
        ->where('tipoempleado_id',$tiporol->tipoempleado_id)
        ->where('tipocontrato_id',$tiporol->tipocontrato_id)
        ->where('tm_personas.estado','A')
        ->orderBy('tm_personas.apellidos','asc')
        ->get();
      
        foreach ($personas as $data)
        {
            
            $this->ingreso = 0.00;
            $this->otringr = 0.00;
            $this->egresos = 0.00;
            $this->otegres = 0.00;

            $planilla = TdPlanillaRubros::query()
            ->where([
                ['tiposrol_id',$tblperiodos['tiporol_id']],
                ['periodosrol_id',$this->periodoId],
                ['persona_id',$data['id']],
            ])->get();
                
           
            foreach ($planilla as $recno){

                if ($recno->rubrosrol['tipo']=='P') {

                    if ($recno->rubrosrol['regplanilla']){
                        $this->otringr = $this->otringr + $recno['valor'];
                    }else{
                        $this->ingreso = $this->ingreso = 0.00;
                    }

                }

                if ($recno->rubrosrol['tipo']=='D') {

                    if ($recno->rubrosrol['regplanilla']){
                        $this->otegres = $this->otegres + $recno['valor'];
                    }else{
                        $this->egresos = $this->egresos = 0.00;
                    }

                }

            }

            $this->generaIngEgr($data);
            

            $this->rowdata['empleado_id'] = $data['id'];
            $this->rowdata['empleado'] = $data['apellidos'].' '.$data['nombres'];
            $this->rowdata['ingresos'] = $this->ingreso;
            $this->rowdata['otingresos'] = $this->otringr;
            $this->rowdata['egresos'] = $this->egresos;
            $this->rowdata['otegresos'] = $this->otegres;
            $this->rowdata['total'] = ($this->ingreso+$this->otringr)-($this->egresos+$this->otegres);
            $this->rowdata['tipo_pago'] = 'TRA';
            $this->rowdata['cuentabanco'] = $data['cuentabanco'];
            $this->rowdata['entidad_id'] = $data['entidadbancaria_id'];
            array_push($this->detalle,$this->rowdata);

            $this->count = $this->count + 1;
        }

        
    }

    public function generaIngEgr($objPersona){

        $periodoRol = TmPeriodosrol::find($this->periodoId);

        $rubros = TdTiporolRubros::query()
        ->join('tm_rubrosrols as r','r.id','=','td_tiporol_rubros.rubrosrol_id')
        ->select('r.id', 'r.registro','r.variable1', 'td_tiporol_rubros.tipo')
        ->where([
            ['regplanilla',0],
            ['remuneracion',$periodoRol['tiempo']],
            ['tiposrol_id',$periodoRol['tiporol_id']],
            ['imprimerol1',1],
        ])->get();
        
        foreach ($rubros as $recno){

            switch ($recno['registro']) {
                case 'NO':
                    $this->titulo = "Ingresos Fijos";
                break;
                case 'CA':
                    if ($recno['variable1']>1) {
                        $this->calculaRubros($objPersona,$recno);
                    }
                break;
                case 'PR':
                    $this->loadPrestamo();
                break;
            }

        }

    }

    public function loadFijo(){

    }

    public function calculaRubros($objPersona,$objData){

        $variable = DB::table('tm_variables')
            ->where('id',$objData['variable1'])
            ->first();

        $valor = 0.00;
        
        switch ($variable->tipo) {

            case 'E':
                
                $campo = $variable->campo;
                $valor = $objPersona[$campo];

            break;
            case 'P':

                
            break;
        }

        
        if ($objData['tipo']=='P'){
            $this->ingreso =  $this->ingreso + $valor;
        }else{
            $this->egresos =  $this->egresos + $valor;
        }

    }

    
    public function loadPrestamo(){

    }


    public function rubros($empleadorol,$event){

        switch ($event) {
            case 'V-INGF':
                $this->titulo = "Ingresos Fijos";
            break;
            case 'E-INGO':
                $this->titulo = "Otros Ingresos";
            break;
            case 'V-EGRF':
                $this->titulo = "Egresos Fijos";
            break;
            case 'E-EGRO':
                $this->titulo = "Otros Egresos";
            break;
        }
                
        $tiporol = TmPeriodosrol::find($this->periodoId);

        $this->dispatchBrowserEvent('show-form');
        $this->emitTo('vc-modal-rubros','setRubros',$event,$tiporol['tiporol_id'],$this->periodoId,$empleadorol);

    }

}
