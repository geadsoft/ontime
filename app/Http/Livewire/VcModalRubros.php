<?php

namespace App\Http\Livewire;
use App\Models\TdPlanillaRubros;
use App\Models\TmPeriodosrol;
use App\Models\TmRubrosrol;
use App\Models\TmPersonas;
use App\Models\TdTiporolRubros;
use App\Models\TcRolPagos;
use App\Models\TdRolPagos;
use Livewire\WithPagination;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class VcModalRubros extends Component
{
    use WithPagination;

    public $tblrecords=[], $modalRol;
    public $showEdit = false;
    public $rolpagoId = 0, $tblrubros, $rubrorolId="", $valor=0, $tiporolId, $periodorolId, $personaId, $tipodato, $rolpago;
    public $personal = [
        'nombres' => '',
        'apellidos' => '',
        'nui' => '',
        'fecha_ingreso' => '',
    ];

    protected $listeners = ['setRubros','setRegistraRol'];
    
    public function render()
    {
        return view('livewire.vc-modal-rubros',[
            'tblrecords' => $this->tblrecords,
            'tblrubros' => $this->tblrubros,
        ]);

    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap'; 
    }

    public function setRegistraRol($event,$rolpagoId,$empleadorol,$rol){

        $this->modalRol   = $rol;
        $this->rolpagoId = $rolpagoId;
      
        $tcrolPago = TcRolPagos::find($rolpagoId);

        $this->setRubros($event,$tcrolPago['tiposrol_id'],$tcrolPago['periodosrol_id'],$empleadorol,$rol);

    }

    

    public function setRubros($event,$tiporol,$periodorol,$empleadorol,$rol){

        $this->modalRol   = $rol;
        $periodo = TmPeriodosrol::find($periodorol);
        
        $this->personal = TmPersonas::query()
        ->join('tm_contratos as c','c.persona_id','=','tm_personas.id')
        ->select('apellidos','nombres','nui','c.fecha_ingreso')
        ->where('tm_personas.id',$empleadorol)->first();

        $fecha = $this->personal['fecha_ingreso'];
        $this->personal['fecha_ingreso'] = date('d/m/Y',strtotime($fecha));

        $this->tblrecords=[];

        $this->tipodato     = $event;
        $this->tiporolId    = $tiporol; 
        $this->periodorolId = $periodorol;
        $this->personaId    = $empleadorol;
        $this->rol          = $rol;
        $this->rolpago      = $periodo['remuneracion'];

        switch ($event) {
            case 'V-INGF':
                $this->loadIngresos($this->tiporolId,$this->periodorolId,$this->personaId);
                break;
            case 'E-INGO':
                $this->loadOtroIng($this->tiporolId,$this->periodorolId,$this->personaId,$event);
                break;
            case 'V-INGO':
                $this->loadOtroIng($this->tiporolId,$this->periodorolId,$this->personaId,$event);
                break;
            case 'V-EGRF':
                $this->loadEgresos($this->tiporolId,$this->periodorolId,$this->personaId);
                break;
            case 'E-EGRO':
                $this->loadOtroEgr($this->tiporolId,$this->periodorolId,$this->personaId,$event);
                break;
            case 'V-EGRO':
                $this->loadOtroEgr($this->tiporolId,$this->periodorolId,$this->personaId,$event);
                break;
        }
        
    }

    public function loadIngresos(){

        $this->showEdit = false;

        if ($this->modalRol=='GR'){
            $planilla = TdPlanillaRubros::where([
                ['tipo','R'],
                ['persona_id',$this->personaId],
                ['tiposrol_id',$this->tiporolId],
                ['periodosrol_id',$this->periodorolId],
                ['valor','>',0],
            ])
            ->get();
        }else{
            $planilla = TdRolPagos::where('registro','R')
            ->where('persona_id',$this->personaId)
            ->where('valor','>',0)
            ->where('rolpago_id',$this->rolpagoId)
            ->get();
        }

        foreach ($planilla as $recno){
            
            $rubro = TdTiporolRubros::query()
            ->join('tm_rubrosrols as r','r.id','=','td_tiporol_rubros.rubrosrol_id')
            ->select('r.id','r.descripcion','r.etiqueta','td_tiporol_rubros.tipo','r.imprimerol1','r.imprimerol2')
            ->where([
                ['r.id',$recno['rubrosrol_id']],
                ['remuneracion',$this->rolpago],
                ['tiposrol_id',$this->tiporolId],
            ])->first();

            if ($rubro['tipo']=='P'){
                
                if ($rubro['imprimerol1']==1 & $rubro['imprimerol2']==1){
            
                    $arrayRubro = [
                        'id'     => 0,
                        'nombre' => $rubro['descripcion'],
                        'etiqueta' => $rubro['etiqueta'],
                        'valor' => $recno['valor'],
                    ];
                    array_push($this->tblrecords,$arrayRubro);
    
                }
                
            }

        }

    }

    public function loadEgresos(){

        $this->showEdit = false;
            
        if ($this->rol=='GR'){
            $planilla = TdPlanillaRubros::where('tipo','R')
            ->where('persona_id',$this->personaId)
            ->where('valor','>',0)
            ->get();
        }else{
            $planilla = TdRolPagos::where('registro','R')
            ->where('persona_id',$this->personaId)
            ->where('valor','>',0)
            ->get();
        }

        foreach ($planilla as $recno){
            
            $rubro = TdTiporolRubros::query()
            ->join('tm_rubrosrols as r','r.id','=','td_tiporol_rubros.rubrosrol_id')
            ->select('r.id','r.descripcion','r.etiqueta','td_tiporol_rubros.tipo','r.imprimerol1','r.imprimerol2')
            ->where([
                ['r.id',$recno['rubrosrol_id']],
                ['remuneracion',$this->rolpago],
                ['tiposrol_id',$this->tiporolId],
            ])->first();

            if ($rubro['tipo']=='D'){
                
                if ($rubro['imprimerol1']==1 & $rubro['imprimerol2']==1){
            
                    $arrayRubro = [
                        'id'     => 0,
                        'nombre' => $rubro['descripcion'],
                        'etiqueta' => $rubro['etiqueta'],
                        'valor' => $recno['valor'],
                    ];
                    array_push($this->tblrecords,$arrayRubro);
    
                }

            }
                        
        }

    }

    public function loadOtroIng($tiporol,$periodorol,$empleadorol,$modal){

        $this->showEdit = true;
        if ($modal=='V-INGO'){
            $this->showEdit = false;
        }       

        if ($this->rol=='GR'){

            $this->tblrubros = TdPlanillaRubros::query()
            ->join("tm_rubrosrols as r","r.id","=","td_planillarubros.rubrosrol_id")
            ->select('td_planillarubros.rubrosrol_id','r.descripcion','r.etiqueta')
            ->where([
                ['tiposrol_id',$tiporol],
                ['periodosrol_id',$periodorol],
                ['persona_id',$empleadorol],
                ['r.tipo','P'],
                ['valor',0],
                ['regplanilla',1]
            ])->get();

            $planilla = TdPlanillaRubros::query()
            ->join("tm_rubrosrols as r","r.id","=","td_planillarubros.rubrosrol_id")
            ->select('td_planillarubros.id','td_planillarubros.rubrosrol_id','valor')
            ->where([
                ['tiposrol_id',$tiporol],
                ['periodosrol_id',$periodorol],
                ['persona_id',$empleadorol],
                ['td_planillarubros.tipo','P'],
                ['valor','>',0],
            ])->get();

        } else {

            $this->tblrubros = TdRolPagos::query()
            ->join("tm_rubrosrols as r","r.id","=","td_rol_pagos.rubrosrol_id")
            ->select('td_rol_pagos.rubrosrol_id','r.descripcion','r.etiqueta')
            ->where([
                ['rolpago_id',$this->rolpagoId],
                ['persona_id',$empleadorol],
                ['r.tipo','P'],
                ['valor',0],
                ['regplanilla',1]
            ])->get();

            $planilla = TdRolPagos::query()
            ->join("tm_rubrosrols as r","r.id","=","td_rol_pagos.rubrosrol_id")
            ->select('td_rol_pagos.id','td_rol_pagos.rubrosrol_id','valor')
            ->where([
                ['rolpago_id',$this->rolpagoId],
                ['persona_id',$empleadorol],
                ['td_rol_pagos.registro','P'],
                ['valor','>',0],
            ])->get();

        }

        foreach ($planilla as $recno){

            $rubro = TdTiporolRubros::query()
            ->join('tm_rubrosrols as r','r.id','=','td_tiporol_rubros.rubrosrol_id')
            ->select('r.id','r.descripcion','r.etiqueta','td_tiporol_rubros.tipo','r.imprimerol1','r.imprimerol2')
            ->where([
                ['r.id',$recno['rubrosrol_id']],
                ['remuneracion','M'],
                ['tiposrol_id',$this->tiporolId],
            ])->first();
                
            if ($rubro['tipo']=='P'){
                
                $arrayRubro = [
                    'id'     => $recno['id'],
                    'nombre' => $recno->rubrosrol['descripcion'],
                    'etiqueta' => $recno->rubrosrol['etiqueta'],
                    'valor' => $recno['valor'],
                ];
                array_push($this->tblrecords,$arrayRubro);
                
            }

        }
    }

    public function loadOtroEgr($tiporol,$periodorol,$empleadorol,$modal){

        $this->showEdit = true;

        if ($modal=='V-INGO'){
            $this->showEdit = false;
        }

        if ($this->rol=='GR'){

            $this->tblrubros = TdPlanillaRubros::query()
            ->join("tm_rubrosrols as r","r.id","=","td_planillarubros.rubrosrol_id")
            ->select('td_planillarubros.rubrosrol_id','r.descripcion','r.etiqueta')
            ->where([
                ['tiposrol_id',$tiporol],
                ['periodosrol_id',$periodorol],
                ['persona_id',$empleadorol],
                ['r.tipo','D'],
                ['valor',0],
                ['regplanilla',1]
            ])->get();

            $planilla = TdPlanillaRubros::query()
            ->join("tm_rubrosrols as r","r.id","=","td_planillarubros.rubrosrol_id")
            ->select('td_planillarubros.id','td_planillarubros.rubrosrol_id','valor')
            ->where([
                ['tiposrol_id',$tiporol],
                ['periodosrol_id',$periodorol],
                ['persona_id',$empleadorol],
                ['td_planillarubros.tipo','P'],
                ['valor','>',0],
            ])->get();

        } else {

            $this->tblrubros = TdRolPagos::query()
            ->join("tm_rubrosrols as r","r.id","=","td_rol_pagos.rubrosrol_id")
            ->select('td_rol_pagos.rubrosrol_id','r.descripcion','r.etiqueta')
            ->where([
                ['rolpago_id',$this->rolpagoId],
                ['persona_id',$empleadorol],
                ['r.tipo','D'],
                ['valor',0],
                ['regplanilla',1]
            ])->get();

            $planilla = TdRolPagos::query()
            ->join("tm_rubrosrols as r","r.id","=","td_rol_pagos.rubrosrol_id")
            ->select('td_rol_pagos.id','td_rol_pagos.rubrosrol_id','valor')
            ->where([
                ['rolpago_id',$this->rolpagoId],
                ['persona_id',$empleadorol],
                ['td_rol_pagos.registro','P'],
                ['valor','>',0],
            ])->get();

        }

        foreach ($planilla as $recno){

            $rubro = TdTiporolRubros::query()
            ->join('tm_rubrosrols as r','r.id','=','td_tiporol_rubros.rubrosrol_id')
            ->select('r.id','r.descripcion','r.etiqueta','td_tiporol_rubros.tipo','r.imprimerol1','r.imprimerol2')
            ->where([
                ['r.id',$recno['rubrosrol_id']],
                ['remuneracion','M'],
                ['tiposrol_id',$this->tiporolId],
            ])->first();
            
                
            if ($rubro['tipo']=='D'){
                
                $arrayRubro = [
                    'id'     => $recno['id'],
                    'nombre' => $recno->rubrosrol['descripcion'],
                    'etiqueta' => $recno->rubrosrol['etiqueta'],
                    'valor' => $recno['valor'],
                ];
                array_push($this->tblrecords,$arrayRubro);

            }
            
        }

    }

    public function updateData(){

        $this ->validate([
            'rubrorolId' => 'required',
            'valor' => 'required',          
        ]);
        
        if ($this->modalRol =='GR'){

            $record = TdPlanillaRubros::query()
            ->where([
                ['tiposrol_id',$this->tiporolId],
                ['periodosrol_id',$this->periodorolId],
                ['persona_id',$this->personaId],
                ['rubrosrol_id',$this->rubrorolId],
            ])->first();

            TdPlanillaRubros::find($record['id'])
            ->update([
                'valor' => $this -> valor,
            ]);

            $this->setRubros($this->tipodato,$this->tiporolId,$this->periodorolId,$this->personaId,'GR');

        } else {

            $record = TdRolPagos::query()
            ->where([
                ['rolpago_id',$this->rolpagoId],
                ['persona_id',$this->personaId],
                ['rubrosrol_id',$this->rubrorolId],
            ])->first();

            TdRolPagos::find($record['id'])
            ->update([
                'valor' => $this -> valor,
            ]);

            $this->setRegistraRol($this->tipodato,$this->rolpagoId,$this->personaId,'RR');

        }
            
    }

    public function delete($selectId){

        if ($this->modalRol =='GR'){
        
            $planilla = TdPlanillaRubros::find($selectId);

            $planilla->update([
                'valor' => 0,
            ]);

            $this->setRubros($this->tipodato,$this->tiporolId,$this->periodorolId,$this->personaId,'GR');

        } else {

            $planilla = TdRolPagos::find($selectId);

            $planilla->update([
                'valor' => 0,
            ]);

            $this->setRegistraRol($this->tipodato,$this->rolpagoId,$this->personaId,'RR');

        }

        $this->valor=0;
        $this->rubrorolId="";

    }



}

?>
