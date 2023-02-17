<?php

namespace App\Http\Livewire;
use App\Models\TmPeriodosrol;
use App\Models\TmRubrosrol;
use App\Models\TdPlanillaRubros;
use App\Models\TmPersonas;


use Livewire\Component;

class VcPlanillaRubros extends Component
{
    public $periodoId, $totpersona;
    public $tblrecords=[];
    public $rubros=[];
    public $personas=[];
    public $detalle=[];
    public $row=[];
    public $fecha;
    public $lnvalor;
    
    
    public function render()
    {
        $ldate = date('Y-m-d H:i:s');
        $this->fecha = date('Y-m-d',strtotime($ldate));
        
        $tblperiodos = TmPeriodosrol::where('procesado',0)
        ->where('tiempo','M')
        ->get();
        $this->loadRubros();

        return view('livewire.vc-planilla-rubros',[
            'tblrecords'  => $this->tblrecords,
            'tblperiodos' => $tblperiodos,
            'rubros'      => $this->rubros,
        ]);
    }

    public function add(){

        reset($this->rubros);
        $this->loadRubros();

        $tiporol = TmPeriodosrol::query()
        ->join("tm_tiposrols as t","t.id","=","tm_periodosrols.tiporol_id")
        ->where('tm_periodosrols.id',$this->periodoId)
        ->first();

        $this-> personas = TmPersonas::query()
        ->join("tm_contratos as c","c.persona_id","=","tm_personas.id")
        ->where('tipoempleado_id',$tiporol->tipoempleado_id)
        ->where('tipocontrato_id',$tiporol->tipocontrato_id)
        ->where('tm_personas.estado','A')
        ->orderBy('tm_personas.apellidos','asc')
        ->get();

        /*$this-> personas = TmPeriodosrol::query()
        ->join("tm_tiposrols as t","t.id","=","tm_periodosrols.tiporol_id")
        ->join("tm_contratos as c",function ($join){
            $join->on('c.tipoempleado_id','=','t.tipoempleado_id')
            ->andOn('c.tipocontrato_id','=','t.tipocontrato_id');
        })
        ->join("tm_personas as p","p.id","=","c.persona_id")
        ->where('tm_periodosrols.id',$this->periodoId)
        ->where('p.estado','A')
        ->get();*/
        
        $campo="";
        $this->totpersona = count($this->personas);
        
        for ($fila=0; $fila<count($this->personas);$fila++){
            $campo = '0,1,2';
            for ($columna=0;$columna<count($this->rubros)+3;$columna++){
                $campo = $campo . ',' . strval( $columna+3);
            }
            $recno = [
                $fila => $campo 
            ];
            array_push($this->tblrecords,$recno);
        }
        $this->row = [$campo];
        
        foreach ($this-> personas as $index => $data)
        {
            $this->tblrecords[$index][0] = $data->persona_id;
            $this->tblrecords[$index][1] = $data->nui;
            $this->tblrecords[$index][2] = $data->apellidos.' '.$data->nombres;

            for ($columna=0;$columna<count($this->rubros)+3;$columna++){
                if ($columna>=3) {
                    $this->tblrecords[$index][$columna] = 0.00;
                    $this->row[$columna] = 0.00;
                }
            }
            
        }
        $this->row[0] = "";
        $this->row[1] = "";
        $this->row[2] = "";


             
    }

    public function loadRubros(){

        $this->rubros = TmPeriodosrol::query()
        ->join("tm_tiposrols as t","t.id","=","tm_periodosrols.tiporol_id")
        ->join("td_tiporol_rubros as tr","tr.tiposrol_id","=","t.id")
        ->join("tm_rubrosrols as r","r.id","=","tr.rubrosrol_id")
        ->where([
            ['r.registro',"NO"],
            ['r.regplanilla',1],
            ['tm_periodosrols.id',$this->periodoId],
        ])
        ->orderBy('r.tipo', 'desc')
        ->orderBy('r.id', 'asc')
        ->get();

    }

    public function createData(){
        
        $tiporol = TmPeriodosrol::find($this->periodoId);
        $this->loadRubros();

        $dataRow=[
            'fecha' => "",
            'tiposrol_id' => 0,
            'periodosrol_id' => 0,
            'persona_id' => 0,
            'rubrosrol_id' => 0,
            'valor' => 0,
            'usuario' => "",
            'estado' => ""
        ];


        foreach ($this->tblrecords as $index => $data)
        {   

            for ($col=0;$col<count($this->rubros);$col++){

                    $dataRow['fecha'] = $this->fecha;
                    $dataRow['tiposrol_id'] = $tiporol['tiporol_id'];
                    $dataRow['periodosrol_id'] = $this->periodoId;
                    $dataRow['persona_id'] = $data[0];
                    $dataRow['rubrosrol_id'] = $this->rubros[$col]->id;
                    $dataRow['valor'] = $data[$col+3];
                    $dataRow['usuario'] = auth()->user()->name;
                    $dataRow['estado']  = 'G';

                array_push($this->detalle,$dataRow);
            }
                    
        }

        //dd($this->detalle);
        
        TdPlanillaRubros::insert($this->detalle);
        
        $this->dispatchBrowserEvent('msg-grabar'); 

    }

   

}
