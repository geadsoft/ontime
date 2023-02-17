<?php

namespace App\Http\Livewire;
use App\Models\TdPlanillaRubros;
use App\Models\TmRubrosrol;
use App\Models\TmPersonas;
use Livewire\WithPagination;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class VcModalRubros extends Component
{
    use WithPagination;

    public $tblrecords=[];
    public $showEdit = false;
    public $tblrubros, $rubrorolId="", $valor=0, $tiporolId, $periodorolId, $personaId, $tipodato;

    protected $listeners = ['setRubros'];
    
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

    public function setRubros($event,$tiporol,$periodorol,$empleadorol){

        $this->tblrecords=[];

        $this->tipodato = $event;
        $this->tiporolId = $tiporol; 
        $this->periodorolId = $periodorol;
        $this->personaId = $empleadorol;

        if (($event=='V-INGF') || ($event=='V-EGRF')) {
            
            $tipo = 'P';
            if($event=='V-EGRF'){
                $tipo = 'D';
            }

            $this->showEdit = false;

            $rubros = TmRubrosrol::where([
                ['tipo',$tipo],
                ['regplanilla','0'],
                ['imprimerol1','1'],
            ])->get();
            
            foreach ($rubros as $recno){
                $arrayRubro = [
                    'id'     => 0,
                    'nombre' => $recno['descripcion'],
                    'etiqueta' => $recno['etiqueta'],
                    'valor' => 0.00,
                ];
                array_push($this->tblrecords,$arrayRubro);
            }

        } else {

            $this->showEdit = false;
            $tipo = 'P';

            if (($event=='E-INGO') || ($event=='E-EGRO')) {
                $this->showEdit = true;

                if ($event=='E-EGRO'){
                    $tipo = 'D';
                }
            }

            if ($event=='V-EGRO'){
                $tipo = 'D';
            }


            $this->tblrubros = $planilla = TdPlanillaRubros::query()
            ->join("tm_rubrosrols as r","r.id","=","td_planillarubros.rubrosrol_id")
            ->select('td_planillarubros.rubrosrol_id','r.descripcion','r.etiqueta')
            ->where([
                ['tiposrol_id',$tiporol],
                ['periodosrol_id',$periodorol],
                ['persona_id',$empleadorol],
                ['r.tipo',$tipo],
                ['valor',0],
            ])->get();
            
            $planilla = TdPlanillaRubros::query()
            ->join("tm_rubrosrols as r","r.id","=","td_planillarubros.rubrosrol_id")
            ->select('td_planillarubros.id','td_planillarubros.rubrosrol_id','valor')
            ->where([
                ['tiposrol_id',$tiporol],
                ['periodosrol_id',$periodorol],
                ['persona_id',$empleadorol],
                ['r.tipo',$tipo],
                ['valor','>',0],
            ])->get();

            foreach ($planilla as $recno){
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

        $this->setRubros($this->tipodato,$this->tiporolId,$this->periodorolId,$this->personaId);

    }

    public function delete($selectId){

        $planilla = TdPlanillaRubros::find($selectId);

        $planilla->update([
            'valor' => 0,
        ]);

        $this->valor=0;
        $this->rubrorolId="";
        $this->setRubros($this->tipodato,$this->tiporolId,$this->periodorolId,$this->personaId);

    }



}
