<?php

namespace App\Http\Livewire;
use App\Models\TmPeriodosrol;
use App\Models\TdPlanillaRubros;
use App\Models\TmPersonas;
use App\Models\TmRubrosrol;
use App\Models\TdRubrosrolBases;
use App\Models\TdTiporolRubros;
use App\Models\TmContratos;
use App\Models\TmCompania;
use App\Models\TrPrestamosCabs;
use App\Models\TcRolPagos;
use App\Models\TdRolPagos;

use Livewire\WithPagination;

use Illuminate\Support\Facades\DB;

use Livewire\Component;

class VcRolPago extends Component
{   
    
    public $tblCia, $fecha, $periodoId=0, $tiporolid, $titulo, $count=1;
    public $ingreso, $otringr, $egresos, $otegres, $tblperiodos, $grabar;
    public $detalle = [], $aportes=[], $totalRol = [], $personal;
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

    public function mount() {

        $tblCia = TmCompania::where('id',1)->first();

        $arraporte = [
            'rubro'   => $tblCia['rubro_appersonal'],
            'nombre'  => 'aporte_personal',
            'importe' => $tblCia['aporte_personal'],
        ];
        array_push($this->aportes,$arraporte);

        $arraporte = [
            'rubro'   => $tblCia['rubro_appatronal'],
            'nombre'  => 'aporte_patronal',
            'importe' => $tblCia['aporte_patronal'],
        ];
        array_push($this->aportes,$arraporte);

        $arraporte = [
            'rubro'   => $tblCia['rubro_secap'],
            'nombre'  => 'aporte_secap',
            'importe' => $tblCia['aporte_secap'],
        ];
        array_push($this->aportes,$arraporte);

        $arraporte = [
            'rubro'   => $tblCia['rubro_iece'],
            'nombre'  => 'aporte_iece',
            'importe' => $tblCia['aporte_iece'],
        ];
        array_push($this->aportes,$arraporte);

    }

    public function render()
    {
        $ldate = date('Y-m-d H:i:s');
        $this->fecha = date('Y-m-d',strtotime($ldate));
        
        $this->tblperiodos = TmPeriodosrol::where('aprobado',0)
        ->get();

        $this->tblCia = TmCompania::where('id',1)->first();
        
        return view('livewire.vc-rol-pago',[
            'tblperiodos' => $this->tblperiodos,
            'detalle' => $this->detalle,
        ]);
        
    }


    public function add($accion){  
        
        $this->grabar = $accion;

        $totIng = 0.00;
        $totOtring = 0.00;
        $totEgr = 0.00;
        $totOtregr = 0.00;
        $total = 0.00;
        
        if ($this->periodoId==0){
            $this->dispatchBrowserEvent('msg-alerta');
            return ; 
        }
        
        $tblperiodos = TmPeriodosrol::find($this->periodoId);
        $this->detalle = [];

        $tiporol = TmPeriodosrol::query()
        ->join("tm_tiposrols as t","t.id","=","tm_periodosrols.tiporol_id")
        ->where('tm_periodosrols.id',$this->periodoId)
        ->first();

        $this->tiporolid = $tblperiodos['tiporol_id'];

        $personas = TmPersonas::query()
        ->join("tm_contratos as c","c.persona_id","=","tm_personas.id")
        ->select('tm_personas.*','c.sueldo','c.anticipo','c.fecha_ingreso','c.fondo_reserva')
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
                ['tipo','P'],
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

            if($tblperiodos['remuneracion']=='M'){
                $this->aportBenef($data);
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
            
            $totIng    = $totIng + $this->ingreso + $this->otringr;
            $totEgr    = $totEgr + $this->egresos + $this->otegres;
            $total     = $totIng-$totEgr;

            array_push($this->detalle,$this->rowdata);
            $this->count = $this->count + 1;
        }

        //Totales
        $this->totalRol['totIng'] = $totIng;
        $this->totalRol['totEgr'] = $totEgr;
        $this->totalRol['total'] = $total;

        $objperiodo = TmPeriodosrol::find($this->periodoId);
        $objperiodo->Update([
            'procesado' => 1,
        ]);

        $this->dispatchBrowserEvent('hide-form'); 
        
    }

    public function aportBenef($objPersona){

        foreach ($this->aportes as $aporte){

            $rubroId = $aporte['rubro'];
            $valor = 0.00;

            $rolbase = TdRubrosrolBases::query()
            ->join('td_planillarubros as pr','pr.rubrosrol_id','=','td_rubrosrol_bases.baserubrorol_id')
            ->selectRaw('sum(valor) as monto')
            ->where([
            ['td_rubrosrol_bases.rubrorol_id',$rubroId],
            ['periodosrol_id',$this -> periodoId],
            ['persona_id',$objPersona['id']],
            ])->first();

            $rubro    = TmRubrosrol::where('id',$rubroId)->first();

            $variable = DB::table('tm_variables')
            ->where('id',$rubro['variable1'])
            ->first();

            $campo   = $variable->campo;
            $importe = $this->tblCia[$campo];
            $valor   = round((($rolbase->monto)*$importe)/100,2);
            
            if ($rubro['imprimerol1']==1 & $rubro['imprimerol2']==1){
                if ($rubro['tipo']=='P'){
                    $this->ingreso =  $this->ingreso + $valor;
                }else{
                    $this->egresos =  $this->egresos + $valor;
                }
            }

            $this->grabaRubros($objPersona['id'],$rubro['id'],$valor);
        }

        //-------------------


        //--- Fondo de Reserva
        $rubrofReserva = $this->tblCia['rubro_freserva'];
        $valor = 0.00;
        
        $rolbase = TdRubrosrolBases::query()
        ->join('td_planillarubros as pr','pr.rubrosrol_id','=','td_rubrosrol_bases.baserubrorol_id')
        ->selectRaw('sum(valor) as monto')
        ->where([
        ['td_rubrosrol_bases.rubrorol_id',$rubrofReserva],
        ['periodosrol_id',$this -> periodoId],
        ['persona_id',$objPersona['id']],
        ])->first();

        $rubro    = TmRubrosrol::where('id',$rubrofReserva)->first();
        $fechaIng = $objPersona['fecha_ingreso'];
        
        $valor = $rolbase->monto * $rubro['importe'];

        switch ($objPersona['fondo_reserva']) {
            case 'PA':
                $rubrofReserva = $this->tblCia['rubro_pagofreserva'];
                $rubro    = TmRubrosrol::find($rubrofReserva)->first();
            break;
            case 'PI':
                $rubrofReserva = $this->tblCia['rubro_pagofreserva'];
                $rubro    = TmRubrosrol::find($rubrofReserva)->first();
            break;
        }
        
        if ($rubro['imprimerol1']==1 & $rubro['imprimerol2']==1){

            if ($rubro['tipo']=='P'){
                $this->ingreso =  $this->ingreso + $valor;
            }else{
                $this->egresos =  $this->egresos + $valor;
            }
        }
        // ------

        $this->grabaRubros($objPersona['id'],$rubrofReserva,$valor);

    }

    public function generaIngEgr($objPersona){

        $periodoRol = TmPeriodosrol::find($this->periodoId);

        $rubros = TdTiporolRubros::query()
        ->join('tm_rubrosrols as r','r.id','=','td_tiporol_rubros.rubrosrol_id')
        ->select('r.id', 'r.registro','r.variable1', 'td_tiporol_rubros.tipo', 'r.importe', 'r.imprimerol1', 'r.imprimerol2')
        ->where([
            ['regplanilla',0],
            ['remuneracion',$periodoRol['remuneracion']],
            ['tiposrol_id',$periodoRol['tiporol_id']],
        ])->orderBy('r.registro','desc', 'imprimerol1', 'desc', 'imprimerol2', 'r.importe')
        ->get();

        foreach ($rubros as $recno){

            switch ($recno['registro']) {
                case 'NO':
                    $this->loadFijos();
                break;
                case 'CA':
                    $this->calculaRubros($objPersona,$recno);
                break;
                case 'PR':
                    $this->loadPrestamo($objPersona,$recno);
                break;
            }

        }

    }

    public function calculaRubros($objPersona,$objData){

        $valor = 0.00;
        if (($this->tblCia['rubro_pagofreserva']==$objData['id']) || ($this->tblCia['rubro_freserva']==$objData['id'])){
            return;
        }

        for ($fila=0;$fila<count($this->aportes);$fila++){
            if ($this->aportes[$fila]['rubro'] == $objData['id']){
                return;
            }
        }

        if ($objData['variable1']==1) {

            $rolbase = TdRubrosrolBases::query()
                ->join('td_planillarubros as pr','pr.rubrosrol_id','=','td_rubrosrol_bases.baserubrorol_id')
                ->selectRaw('sum(valor) as monto')
                ->where([
                ['td_rubrosrol_bases.rubrorol_id',$objData['id']],
                ['periodosrol_id',$this -> periodoId],
                ['persona_id',$objPersona['id']],
                ])->first();
            
            $importe = $objData['importe'];

            if ($importe>0){
                $valor = $rolbase->monto * $importe;
            } else {
                $valor = $rolbase->monto;
            }


            if ($objData['imprimerol1']==1 & $objData['imprimerol2']==1){

                if ($objData['tipo']=='P'){
                    $this->ingreso =  $this->ingreso + $valor;
                }else{
                    $this->egresos =  $this->egresos + $valor;
                }
            }

            $this->grabaRubros($objPersona['id'],$objData['id'],$valor);

        } else {
       
            $variable = DB::table('tm_variables')
                ->where('id',$objData['variable1'])
                ->first();
        
            switch ($variable->tipo) {

                case 'E':
                    
                    $campo = $variable->campo;
                    $valor = $objPersona[$campo];
                
                    if ($objData['imprimerol1']==1 & $objData['imprimerol2']==1){

                        if ($objData['tipo']=='P'){
                            $this->ingreso =  $this->ingreso + $valor;
                        }else{
                            $this->egresos =  $this->egresos + $valor;
                        }
                    }

                    $this->grabaRubros($objPersona['id'],$objData['id'],$valor);

                break;
                case 'P':

                    $campo = $variable->campo;
                    $importe = $this->tblCia[$campo];
                    
                    $rolbase = TdRubrosrolBases::query()
                    ->join('td_planillarubros as pr','pr.rubrosrol_id','=','td_rubrosrol_bases.baserubrorol_id')
                    ->selectRaw('sum(valor) as monto')
                    ->where([
                    ['td_rubrosrol_bases.rubrorol_id',$objData['id']],
                    ['periodosrol_id',$this -> periodoId],
                    ['persona_id',$objPersona['id']],
                    ])->first();
                    
                    if ($objData['importe']==0){
                        $monto = $rolbase->monto;
                        $valor = $monto*$importe;
                    } else {
                        $monto = $rolbase->monto;
                        $valor = $monto*$objData['importe'];
                    }
                    
                    if ($objData['imprimerol1']==1 & $objData['imprimerol2']==1){

                        if ($objData['tipo']=='P'){
                            $this->ingreso =  $this->ingreso + $valor;
                        }else{
                            $this->egresos =  $this->egresos + $valor;
                        }
                    }

                    $this->grabaRubros($objPersona['id'],$objData['id'],$valor);                    

                break;
            }

        }
        
    }

    public function loadFijos(){

    }
    
    public function loadPrestamo($objpersona,$objrubro){

        foreach ($this->tblperiodos as $periodo){
            if ($periodo['id'] == $this -> periodoId){
                $fechafin = date('Y-m-d',strtotime($periodo['fechafin']));
            }
        }

        $data = TrPrestamosCabs::query()
        ->join('tr_prestamos_dets as d','d.prestamo_id','=','tr_prestamos_cabs.id')
        ->where('persona_id',$objpersona['id'])
        ->where('rubrosrol_id',$objrubro['id'])
        ->where('d.fecha',$fechafin)
        ->first();

        if ($data==null){
            return;
        }

        $valor = $data['valor'];

        if ($objrubro['tipo']=='P'){
            $this->ingreso =  $this->ingreso + $valor;
        }else{
            $this->egresos =  $this->egresos + $valor;
        }

        $this->grabaRubros($objpersona['id'],$objrubro['id'],$valor);

    }

    public function grabaRubros($personaId,$rubroId,$valor){

        if ($this->grabar=='N'){
            return;
        }

        $objData = TdPlanillaRubros::where([
            ['tiposrol_id',$this->tiporolid],
            ['periodosrol_id', $this -> periodoId],
            ['rubrosrol_id',$rubroId],
            ['persona_id',$personaId],
        ])->first();
        
        if ($objData!=null){

            $recno = TdPlanillaRubros::find($objData['id']);
            $recno->delete(); 
        } 

        TdPlanillaRubros::Create([
            'fecha' => $this ->fecha,
            'tipo' => 'R',
            'tiposrol_id' => $this->tiporolid,
            'periodosrol_id' => $this -> periodoId,
            'persona_id' => $personaId,
            'rubrosrol_id' => $rubroId,
            'valor' => $valor,
            'usuario' => auth()->user()->name,
            'estado' => 'G',
            
        ]);

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
        $this->emitTo('vc-modal-rubros','setRubros',$event,$tiporol['tiporol_id'],$this->periodoId,$empleadorol,'GR');

    }

    public function grabarRol(){

        $fecha   = strtotime($this->fecha);
        $periodo = TmPeriodosrol::find($this->periodoId);
        $detalle = [];
    
        $rolpago = TcRolPagos::Create([
            'fecha' => $this->fecha,
            'mes' => date('m',$fecha),
            'periodo' => date('Y',$fecha),
            'tiposrol_id' => $this->tiporolid,
            'periodosrol_id' =>$this->periodoId,
            'remuneracion'=> $periodo['remuneracion'],
            'ingresos' => $this->totalRol['totIng'],
            'egresos' => $this->totalRol['totEgr'],
            'total' => $this->totalRol['total'],
            'usuario' => auth()->user()->name,
            'estado' => 'C',
        ]);

        $dataRow=[
            'rolpago_id' => 0,
            'fecha' => "",
            'mes' => 0,
            'periodo' => 0,
            'remuneracion' => '',
            'persona_id' => 0,
            'rubrosrol_id' => null,
            'tipo'=> 0,
            'rubro_total' => null,
            'valor' => 0,
            'usuario' => "",
            'estado' => ""
        ];

        if ($periodo['remuneracion']=='Q'){
            $tblrecord = TdPlanillaRubros::where([
                ['tiposrol_id',$this->tiporolid],
                ['periodosrol_id',$this->periodoId],
                ['valor','>',0],
            ])->get();
        }else{
            $tblrecord = TdPlanillaRubros::where([
                ['tiposrol_id',$this->tiporolid],
                ['periodosrol_id',$this->periodoId],
            ])->get();
        }

        foreach ($tblrecord as $record){

            $rubro = TdTiporolRubros::where([
                ['tiposrol_id',$this->tiporolid],
                ['rubrosrol_id',$record['rubrosrol_id']],
                ['remuneracion',$periodo['remuneracion']],
            ])->first();
            
            
            $dataRow['rolpago_id'] = $rolpago->id;
            $dataRow['fecha'] = $this->fecha;
            $dataRow['mes'] = date('m',$fecha);
            $dataRow['periodo'] = date('Y',$fecha);
            $dataRow['remuneracion'] = $periodo['remuneracion'];
            $dataRow['registro'] = $record['tipo'];
            $dataRow['persona_id'] = $record['persona_id'];
            $dataRow['rubrosrol_id'] = $record['rubrosrol_id'];
            $dataRow['tipo'] = $rubro['tipo'];
            $dataRow['valor'] = $record['valor'];
            $dataRow['usuario'] = auth()->user()->name;
            $dataRow['estado']  = 'C';
            
            array_push($detalle,$dataRow);
        }

        TdRolPagos::insert($detalle); 
        
        $objperiodo = TmPeriodosrol::find($this->periodoId);
        $objperiodo->Update([
            'aprobado' => 1,
        ]);

        $this->dispatchBrowserEvent('msg-grabar'); 
        return redirect()->to('/payroll/registrar-pagos/'.$rolpago->id);        

    }

}

?>
