<?php

namespace App\Http\Livewire;
use App\Models\TmPeriodosrol;
use App\Models\TcRolPagos;
use App\Models\TdRolPagos;
use App\Models\TdTiporolRubros;
use App\Models\TmRubrosrol;
use App\Models\TmTiposrol;
use App\Models\TmCompania;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Luecano\NumeroALetras\NumeroALetras;
use PDF;

class VcRegistrarPagos extends Component
{
    public $detalle = [], $objnomina = [], $totalRol = [], $objWhere = ['tipoRol' => 0,'periodoRol' => 0];
    public $rolpagoId,$titulo,$periodoId,$datos,$nomina,$fecha, $personas, $rubros, $valorletra, $estado;
    public $editar;
    
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
        'estado' => '',
    ];
    public $mes = [
        1 => 'ENERO',
        2 => 'FEBRERO',
        3 => 'MARZO',
        4 => 'ABRIL',
        5 => 'MAYO',
        6 => 'JUNIO',
        7 => 'JULIO',
        8 => 'AGOSTO',
        9 => 'SEPTIEMBRE',
        10 => 'OCTUBRE',
        11 => 'NOVIEMBRE',
        12 => 'DICIEMBRE'
    ];
    
    public function mount($id,$edit){

        $this->rolpagoId = $id;
        $this->editar    = $edit;

        $tcrolPago = TcRolPagos::find($id);
        $this->objWhere['rolpagoId'] = $id;
        $this->objWhere['periodoRol'] = $tcrolPago['periodosrol_id'];
        $this->objWhere['tipoRol'] = $tcrolPago['tiposrol_id'];

        $this->loadData();

    }

    public function render()
    {
        $this->tblperiodos = TmPeriodosrol::where('procesado',0)
        ->get();

        return view('livewire.vc-registrar-pagos',[
            'tblperiodos' => $this->tblperiodos,
            'nomina' => $this->nomina,
            'detalle' => $this->detalle,
            'totalrol' => $this->totalRol,
        ]);

    }

    public function loadData(){

        reset($this->detalle);

        $totIng = 0.00;
        $totOtring = 0.00;
        $totEgr = 0.00;
        $totOtregr = 0.00;
        $total = 0.00;
        
        $this->nomina = TcRolPagos::query()
        ->where('id',$this->rolpagoId)
        ->first();

        $this->fecha = date('Y-m-d',strtotime($this->nomina['fecha']));
        $this->estado = $this->nomina['estado'];

        $personas = TdRolPagos::query()
        ->join("tm_personas as p","p.id","=","td_rol_pagos.persona_id")
        ->select('p.id','p.nombres','p.apellidos','cuenta_banco')
        ->where('rolpago_id',$this->rolpagoId)
        /*->where([
            ['tiposrol_id',$this->objWhere['tipoRol']],
            ['periodosrol_id',$this->objWhere['periodoRol']],
        ])*/
        ->groupBy('p.id','p.nombres','p.apellidos','cuenta_banco')
        ->orderBy('p.apellidos','asc')
        ->get();

        $arraypagos = [];
        
        foreach ($personas as $data)
        {
            
            $this->ingreso = 0.00;
            $this->otringr = 0.00;
            $this->egresos = 0.00;
            $this->otegres = 0.00;
            
            /* Rubros Planilla */

            $planilla = TdRolPagos::where('registro','P')
            ->where('persona_id',$data['id'])
            ->where('rolpago_id',$this->rolpagoId)
            ->where('valor','>',0)
            ->get();


            foreach ($planilla as $recno){

                if ($recno['tipo']=='P') {
                    $this->otringr = $this->otringr + $recno['valor'];
                }

                if ($recno['tipo']=='D') {
                    $this->otegres = $this->otegres + $recno['valor'];
                }

            }

            /* Rubros Rol */

            $planilla = TdRolPagos::where('registro','R')
            ->where('persona_id',$data['id'])
            ->where('valor','>',0)
            ->where('rubrosrol_id','>',0)
            ->where('rolpago_id',$this->rolpagoId)
            ->get();

            foreach ($planilla as $recno){
               
                $rubro = TdTiporolRubros::query()
                ->join('tm_rubrosrols as r','r.id','=','td_tiporol_rubros.rubrosrol_id')
                ->select('r.id', 'r.registro','r.variable1', 'td_tiporol_rubros.tipo', 'r.importe', 'r.imprimerol1', 'r.imprimerol2')
                ->where([
                    ['r.id',$recno['rubrosrol_id']],
                    ['remuneracion',$this->nomina['remuneracion']],
                    ['tiposrol_id',$this->objWhere['tipoRol']],
                ])->first();
                
                if ($rubro['imprimerol1']==1 & $rubro['imprimerol2']==1){
                    if ($rubro['tipo']=='P'){
                        $this->ingreso =  $this->ingreso + $recno['valor'];
                    }
                    if ($rubro['tipo']=='D'){
                        $this->egresos =  $this->egresos + $recno['valor'];
                    }
                }

            }

            $this->rowdata['empleado_id'] = $data['id'];
            $this->rowdata['empleado'] = $data['apellidos'].' '.$data['nombres'];
            $this->rowdata['ingresos'] = $this->ingreso;
            $this->rowdata['otingresos'] = $this->otringr;
            $this->rowdata['egresos'] = $this->egresos;
            $this->rowdata['otegresos'] = $this->otegres;
            $this->rowdata['total'] = ($this->ingreso+$this->otringr)-($this->egresos+$this->otegres);
            $this->rowdata['tipo_pago'] = 'TRA';
            $this->rowdata['cuentabanco'] = $data['cuenta_banco'];
            $this->rowdata['entidad_id'] = $data['entidadbancaria_id'];
            $this->rowdata['estado'] = $this->nomina['estado'];

            $totIng    = $totIng + $this->ingreso;
            $totOtring = $totOtring  + $this->otringr;
            $totEgr    = $totEgr + $this->egresos;
            $totOtregr = $totOtregr + $this->otegres;
            $total     = ($totIng+$totOtring)-($totEgr+$totOtregr);

            array_push($arraypagos,$this->rowdata);
               
        }
        
        if (empty($this->detalle)){
            $this->detalle = $arraypagos;
        }

        //Totales
        $this->totalRol['totIng'] = $totIng;
        $this->totalRol['totOtring'] = $totOtring;
        $this->totalRol['totEgr'] = $totEgr;
        $this->totalRol['totOtregr'] = $totOtregr;
        $this->totalRol['total'] = $total;

        
        $this->datos = json_encode($this->objWhere);
        
    }

    public function add(){

        $this->dispatchBrowserEvent('hide-form');
        $this->loadData();

    }

    public function procesar(){

        $ldate    = date('Y-m-d H:i:s');
        $fechareg = date('Y-m-d',strtotime($ldate));
        $periodo  = TmPeriodosrol::find($this->objWhere['periodoRol']);

        foreach ($this->detalle as $recno){

            $Ingresos = $recno['ingresos']+$recno['otingresos'];
            $Egresos  = $recno['egresos']+$recno['otegresos'];
            $Total    = $Ingresos-$Egresos;
            
            //Ingresos
            TdRolPagos::Create([
            'rolpago_id' => $this->rolpagoId,    
            'fecha' => $this->fecha,
            'mes' => date('m',strtotime($this->fecha)),
            'periodo' => date('Y',strtotime($this->fecha)),
            'remuneracion' => $periodo['remuneracion'],
            'registro' => 'R',
            'persona_id' => $recno['empleado_id'],
            'tipo' => 'P',
            'rubro_total' => 'TOTING',
            'valor' => $Ingresos,
            'usuario' => auth()->user()->name,
            'estado' => 'P',
            ]);

        
            //Egresos
            TdRolPagos::Create([
            'rolpago_id' => $this->rolpagoId, 
            'fecha' => $this->fecha,
            'mes' => date('m',strtotime($this->fecha)),
            'periodo' => date('Y',strtotime($this->fecha)),
            'remuneracion' => $periodo['remuneracion'],
            'registro' => 'R',
            'persona_id' => $recno['empleado_id'],
            'tipo' => 'D',
            'rubro_total' => 'TOTEGR',
            'valor' => $Egresos,
            'usuario' => auth()->user()->name,
            'estado' => 'P',
            ]);
            
            //Total
            TdRolPagos::Create([
            'rolpago_id' => $this->rolpagoId, 
            'fecha' => $this->fecha,
            'mes' => date('m',strtotime($this->fecha)),
            'periodo' => date('Y',strtotime($this->fecha)),
            'remuneracion' => $periodo['remuneracion'],
            'registro' => 'R',
            'persona_id' => $recno['empleado_id'],
            'tipo' => 'P',
            'rubro_total' => 'TOTPAG',
            'valor' => $Total,
            'usuario' => auth()->user()->name,
            'estado' => 'P',
            ]);

        }

        $estado = "'P'";
        DB::Update('Update td_rol_pagos set estado = '.$estado.'
            where rolpago_id = '.$this->rolpagoId);

        $tcrolPago = TcRolPagos::find($this->rolpagoId);
        $tcrolPago->Update([
            'estado' => 'P', 
        ]);

        $objperiodo = TmPeriodosrol::find($this->objWhere['periodoRol']);
        $objperiodo->Update([
            'cerrado' => 1, 
        ]);

        $this->dispatchBrowserEvent('msg-grabar'); 
        $this->loadData();

    }

    public function rubros($empleadorol,$event){

        if ($this->estado=='P'){
            return;
        }

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
                
        $tiporol = $this->objWhere['tipoRol'];
        $periodorol = $this->objWhere['periodoRol'];

        $this->dispatchBrowserEvent('show-form');
        $this->emitTo('vc-modal-rubros','setRegistraRol',$event,$this->rolpagoId,$empleadorol,'RR');

    }

    public function impresion(){

        $objPersonas = DB::Select('select * from (
            select persona_id, p.apellidos, p.nombres, p.nui
            from td_rol_pagos r
            inner join tm_personas as p on p.id = r.persona_id
            where rolpago_id = '.$this->objWhere['rolpagoId'].' and valor > 0
            group by persona_id, p.apellidos, p.nombres, p.nui ) p 
            order by apellidos'
        );

        $objRubros = DB::Select('select rubrosrol_id, tipo, etiqueta from (
            select rubrosrol_id, p.tipo, r.etiqueta 
            from td_rol_pagos p
            inner join tm_rubrosrols r on r.id = p.rubrosrol_id
            where valor > 0 and imprimerol1 = 1 and  rolpago_id = '.$this->objWhere['rolpagoId'].' 
            group by rubrosrol_id, p.tipo, etiqueta) as d
            order by tipo desc, rubrosrol_id');  

        foreach ($objPersonas as $index => $data)
        {
            $this->objnomina[$index]['id'] = $data->persona_id;
            $this->objnomina[$index]['nom'] = $data->apellidos.' '.$data->nombres;
            $this->objnomina[$index]['nui'] = $data->nui;

            foreach ($objRubros as $rubro){
                if ($rubro->tipo=='P'){
                    $this->objnomina[$index][$rubro->rubrosrol_id] = 0.00;
                }
            }
            $this->objnomina[$index]['TOTING'] = 0.00;

            foreach ($objRubros as $rubro){
                if ($rubro->tipo=='D'){
                    $this->objnomina[$index][$rubro->rubrosrol_id] = 0.00;
                }
            }
            $this->objnomina[$index]['TOTEGR'] = 0.00;
            $this->objnomina[$index]['TOTPAG'] = 0.00;
            
        }

        //Nomina
        foreach ($objPersonas as $index => $data){

            $ingresos = 0.00;
            $egresos = 0.00;

            $nomina = TdRolPagos::query()
            ->join("tm_rubrosrols as r","r.id","=","td_rol_pagos.rubrosrol_id")
            ->select('td_rol_pagos.*')
            ->where([
                ['rolpago_id',$this->objWhere['rolpagoId']],
                ['persona_id',$data->persona_id],
                ['valor','>',0],
                ['r.imprimerol1','=',1],
            ])->get();

            foreach ($nomina as $rol){

                if ($this->objnomina[$index]['id'] == $rol['persona_id']){
                    $this->objnomina[$index][$rol['rubrosrol_id']] = $rol['valor'] ;
                }

                if ($rol['tipo']=='P'){
                    $ingresos = $ingresos + $rol['valor'];
                }else{
                    $egresos = $egresos + $rol['valor'];
                }

            }

            $this->objnomina[$index]['TOTING'] = $ingresos;
            $this->objnomina[$index]['TOTEGR'] = $egresos;
            $this->objnomina[$index]['TOTPAG'] = $ingresos-$egresos;

        }

        $this->rubros = $objRubros;
        $this->personas = $objPersonas;

        return $this->objnomina;
    }

    public function rolIndividual(){

        $objPersonas = DB::Select('select * from (
            select r.persona_id, p.apellidos, p.nombres, p.nui, p.cuenta_banco, p.tipo_cuenta, c.sueldo, a.descripcion as departamento, 
            ca.descripcion as cargo
            from td_rol_pagos r
            inner join tm_personas as p on p.id = r.persona_id
            inner join tm_contratos as c on c.persona_id = p.id
            inner join tm_areas as a on a.id = c.departamento_id
            inner join tm_cargocias as ca on ca.id = c.cargo_id
            where rolpago_id = '.$this->objWhere['rolpagoId'].' and valor > 0
            group by r.persona_id, p.apellidos, p.nombres, p.nui, c.sueldo, p.cuenta_banco, p.tipo_cuenta, 
            a.descripcion, ca.descripcion ) p 
            order by apellidos'
        );

        $objRubros = DB::Select('select rubrosrol_id, tipo, etiqueta from (
            select rubrosrol_id, p.tipo, r.etiqueta 
            from td_rol_pagos p
            inner join tm_rubrosrols r on r.id = p.rubrosrol_id
            where valor > 0 and imprimerol3 = 1 and rolpago_id = '.$this->objWhere['rolpagoId'].'
            group by rubrosrol_id, p.tipo, etiqueta) as d
            order by tipo desc, rubrosrol_id'); 
        
        $nomina = TdRolPagos::query()
        ->join("tm_rubrosrols as r","r.id","=","td_rol_pagos.rubrosrol_id")
        ->select('td_rol_pagos.*')
        ->where([
            ['rolpago_id',$this->objWhere['rolpagoId']],
            ['valor','>',0],
            ['r.imprimerol1','=',1],
        ])
        ->orderByRaw('persona_id,tipo desc,rubrosrol_id')
        ->get();
        
        $this->rubros = $objRubros;
        $this->personas = $objPersonas;

        return $nomina;

    }

    public function deleteRol(){
        
        TdRolPagos::query()
        ->where('rolpago_id',$this->objWhere['rolpagoId'])
        ->delete();

        $objperiodo = TmPeriodosrol::find($this->objWhere['periodoRol']);
        $objperiodo->Update([
            'aprobado' => 0, 
        ]);

        return redirect()->to('/payroll/rolpago');

    }

    public function downloadPDF($objdata)
    {   
        $data = json_decode($objdata);
        $this->objWhere['rolpagoId']  = $data->rolpagoId;
        $this->objWhere['tipoRol']    = $data->tipoRol;
        $this->objWhere['periodoRol'] = $data->periodoRol;

        $tblrecords = $this->impresion();

        //Datos Cia
        $objCia = TmCompania::find(1);

        //Datos Reporte
        $tiporol    = TmTiposrol::find($data->tipoRol);
        $periodorol = TmPeriodosrol::find($data->periodoRol);
        $remuneracion = 'QUINCENAL';
        if ($periodorol->remuneracion=='M'){
            $remuneracion = 'MENSUAL';
        }

        $objDatos = [
            'descripcion' => $tiporol->descripcion,
            'fechaini' => date('d/m/Y',strtotime($periodorol->fechaini)),
            'fechafin' => date('d/m/Y',strtotime($periodorol->fechafin)),
            'mes' => date('m',strtotime($periodorol->fechafin)),
            'periodo' => date('Y',strtotime($periodorol->fechafin)),
            'remuneracion' => $remuneracion,
        ];
        
        //Etiqueta
        $etiqueta = [];
        $fila = 0;

        foreach ($this->rubros as $index => $data){
            if ($data->tipo == 'P'){
                $etiqueta[$fila]['codigo'] = $data->rubrosrol_id;
                $etiqueta[$fila]['etiqueta'] = $data->etiqueta;
                $fila++;
            }
        }

        $etiqueta[$fila]['codigo'] = 'TOTING';
        $etiqueta[$fila]['etiqueta'] = 'Total Ingr';
        $fila++;

        foreach ($this->rubros as $index => $data){
            if ($data->tipo == 'D'){
                $etiqueta[$fila]['codigo'] = $data->rubrosrol_id;
                $etiqueta[$fila]['etiqueta'] = $data->etiqueta;
                $fila++;
            }
        }

        $etiqueta[$fila]['codigo'] = 'TOTEGR';
        $etiqueta[$fila]['etiqueta'] = 'Total Egr';
        $fila++;

        $etiqueta[$fila]['codigo'] = 'TOTPAG';
        $etiqueta[$fila]['etiqueta'] = 'Neto a Pagar';

        $roltotal = TdRolPagos::where('rolpago_id',$this->objWhere['rolpagoId'])
        ->where('rubro_total','TOTPAG')
        ->get();
        
        $formatter = new NumeroALetras();
        $valorletra = $formatter->toMoney($roltotal->sum('valor'), 2, 'DÓLARES', 'CENTAVOS');

         //Vista
         $pdf = PDF::loadView('reports/nomina_general',[
            'tblcia' => $objCia,
            'roldatos' => $objDatos,
            'tblrecords' => $tblrecords,
            'etiqueta' => $etiqueta,
            'valorletra' => $valorletra,
        ]);        

        return $pdf->setPaper('a4', 'landscape')->download('Nomina General.pdf');
    }


    public function downloadRolPDF($objdata)
    {   
        $data = json_decode($objdata);
        $this->objWhere['rolpagoId']  = $data->rolpagoId;
        $this->objWhere['tipoRol']    = $data->tipoRol;
        $this->objWhere['periodoRol'] = $data->periodoRol;

        $tblrecords = $this->rolIndividual();

        //Datos Cia
        $objCia = TmCompania::find(1);

        //Datos Reporte
        $tiporol    = TmTiposrol::find($data->tipoRol);
        $periodorol = TmPeriodosrol::find($data->periodoRol);
        $remuneracion = 'QUINCENAL';
        if ($periodorol->remuneracion=='M'){
            $remuneracion = 'MENSUAL';
        }
        
        $objDatos = [
            'descripcion' => $tiporol->descripcion,
            'fechaini' => date('d/m/Y',strtotime($periodorol->fechaini)),
            'fechafin' => date('d/m/Y',strtotime($periodorol->fechafin)),
            'mes' => date('m',strtotime($periodorol->fechafin)),
            'periodo' => date('Y',strtotime($periodorol->fechafin)),
            'remuneracion' => $remuneracion,
        ];
        
        //Etiqueta
        $etiqueta = [];

        foreach ($this->rubros as $index => $data){
            if ($data->tipo == 'P'){
                $etiqueta[$data->rubrosrol_id] =  $data->etiqueta;
            }
        }

        $etiqueta['TOTING'] = 'Total Ingr';

        foreach ($this->rubros as $index => $data){
            if ($data->tipo == 'D'){
                $etiqueta[$data->rubrosrol_id] =  $data->etiqueta;
            }
        }

        $etiqueta['TOTEGR'] = 'Total Egr';
        $etiqueta['TOTPAG'] = 'Neto a Pagar';


        //Totales
        $objtotal = TdRolPagos::where([
            ['rolpago_id',$this->objWhere['rolpagoId']],
            ['valor','>',0],
            ['rubro_total','<>',''],
        ])->get();

         //Vista
         $pdf = PDF::loadView('reports/rol_individual',[
            'tblcia' => $objCia,
            'roldatos' => $objDatos,
            'tblrecords' => $tblrecords,
            'etiqueta' => $etiqueta,
            'personas' =>$this->personas,
            'totales' => $objtotal,
        ]);        

        return $pdf->download('Rol Individual.pdf');


    }


    

}

?>
