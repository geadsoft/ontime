<div>
    <form id="addrubro-form" autocomplete="off" wire:submit.prevent="procesar()">
    <div class="row mb-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <div class="card-header">
                                <h5 class="card-title flex-grow-1 mb-0 text-primary"><i
                                    class="mdi mdi-account-cash align-middle me-1 text-success"></i>Periodo de Pago
                                </h5>
                            </div>
                        </div>
                        <div class="col-md-auto ms-auto">
                            <div class="hstack text-nowrap gap-2">
                                @if ($nomina['estado']=='P')
                                <button type="button" data-bs-toggle="" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle dropdown">
                                <i class="ri-exchange-dollar-line fs-22"></i>
                                </button>
                                <button type="button" data-bs-toggle="" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle dropdown">
                                <i class="bx bx-mail-send fs-22"></i>
                                </button>
                                <button type="button" data-bs-toggle="dropdown" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle dropdown">
                                <i class="bx bxs-file-pdf fs-22"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="/download-pdf/nomina/{{$datos}}"><i class="ri-article-line align-bottom me-2 text-muted"></i> Nomina General </a></li>
                                    <li><a class="dropdown-item" href="/download-pdf/pagorol/{{$datos}}"><i class="ri-stack-line align-bottom me-2 text-muted"></i> Comprobante de Pago </a></li>
                                </ul>
                                @endif
                                <a href="" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"><i class="ri-file-excel-2-line align-bottom fs-22"></i></a>                               
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-2">
                            <label class="form-label"><span class="text-uppercase">{{$nomina->tiposrol->descripcion}}</span></label>
                            <div>
                            <label class="form-label">{{$mes[$nomina['mes']]}} {{$nomina['periodo']}}</label>
                            </div>
                            <div>
                            @if ($nomina['estado']=='C')
                                <label class="form-label">ESTADO: <span class="badge badge-soft-success text-uppercase fs-12">CREADA</span></label>
                            @else
                                <label class="form-label">ESTADO: <span class="badge badge-soft-info text-uppercase fs-12">PROCESADA</span></label>
                            @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="cmbtiporol" class="form-label">PERIODO</label>
                            <select type="select" class="form-select" data-trigger id="cmbtiporol" wire:model.defer="nomina.periodosrol_id">
                                <option value="{{$nomina->periodosrol->id}}">{{date('d/m/Y', strtotime($nomina->periodosrol->fechaini))}} - {{date('d/m/Y', strtotime($nomina->periodosrol->fechafin))}}</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="cmbtiporol" class="form-label">EMISIÓN</label>
                            <div>
                                <input id="dfechaini" name="dateIni" type="date" class="form-control" data-provider="flatpickr" data-date-format="d-m-Y" data-time="true" wire:model.defer="fecha" required>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
        <div class="col-xxl-12">
            <div class="card" id="contactList">
                <div class="card-header">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <h5 class="flex-grow-1 mb-0 text-primary"><i
                                class="ri-team-fill align-middle me-1 text-success"></i>
                                Empleados</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div>
                        <div class="table-responsive table-card mb-3">
                            <div style="overflow-x:auto;">
                            <table class="table table-nowrap align-middle" style="width:100%">
                                <thead class="table-light">
                                    <tr>
                                        <!--<th scope="col" style="width: 50px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="checkAll" value="option">
                                            </div>
                                        </th>-->
                                        <!--<th class="sort" data-sort="id" scope="col">ID</th>-->
                                        <th scope="col" style="width: 320px;" class="text-center">Empleados</th>
                                        <th scope="col" style="width: 200px;" class="text-center">Ingresos</th>
                                        <th scope="col" style="width: 200px;" class="text-center">Otros Ingresos</th>
                                        <th scope="col" style="width: 200px;" class="text-center">Egresos</th>
                                        <th scope="col" style="width: 200px;" class="text-center">Otros Egresos</th>
                                        <th scope="col" style="width: 150px;" class="text-center">Total</th>
                                        <th scope="col" style="width: 180px;" class="text-center">Tipo Pago</th>
                                        <th scope="col" style="width: 180px;" class="text-center">Cta Bancaria</th>
                                        <th scope="col" class="text-center">Estado</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($detalle as $data)
                                        <tr class="detalle">
                                            <!--<th scope="row">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="chk_child"
                                                        value="option1">
                                                </div>
                                            </th>-->
                                            <td>
                                                <input type="text" class="form-control bg-light border-0" value='{{$data['empleado']}}' disabled/>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="text" inputmode="numeric" class="form-control product-price bg-light border-0" id="txting" step="0.01" placeholder="0.00" value = '{{number_format($data['ingresos'],2)}}' disabled>
                                                    <button type="button" wire:click.prevent="rubros({{$data['empleado_id']}},'V-INGF')" class="btn dropdown bg-light" 
                                                        data-bs-target=""><i class="ri-checkbox-multiple-blank-line align-bottom me-1"></i>
                                                    </button>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="text" inputmode="numeric" class="form-control product-price bg-light border-0" id="txtoting" step="0.01" placeholder="0.00" value = '{{number_format($data['otingresos'],2)}}' disabled>
                                                    <button type="button" data-bs-toggle="dropdown" class="btn dropdown bg-light">
                                                    <i class="ri-download-2-line align-bottom me-1"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item" href="" wire:click.prevent="rubros({{$data['empleado_id']}},'E-INGO')"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Editar </a></li>
                                                        <li><a class="dropdown-item" href="" wire:click.prevent="rubros({{$data['empleado_id']}},'V-INGO')"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> Visualizar </a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="text" inputmode="numeric" class="form-control product-price bg-light border-0" id="txtoting" step="0.01" placeholder="0.00" value = '{{number_format($data['egresos'],2)}}' disabled>
                                                    <button type="button" wire:click.prevent="rubros({{$data['empleado_id']}},'V-EGRF')" class="btn dropdown bg-light" 
                                                        data-bs-target=""><i class="ri-checkbox-multiple-blank-line align-bottom me-1"></i>
                                                    </button>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="text" inputmode="numeric" class="form-control product-price bg-light border-0" id="txtoting" step="0.01" placeholder="0.00" value = '{{number_format($data['otegresos'],2)}}' disabled>
                                                    <button type="button" data-bs-toggle="dropdown" class="btn dropdown bg-light" >
                                                    <i class="ri-download-2-line align-bottom me-1"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item" href="" wire:click.prevent="rubros({{$data['empleado_id']}},'E-EGRO')"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Editar </a></li>
                                                        <li><a class="dropdown-item" href="" wire:click.prevent="rubros({{$data['empleado_id']}},'V-EGRO')"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> Visualizar </a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td>
                                                @if($data['total']<=0)
                                                    <input type="text" inputmode="numeric" class="form-control product-price bg-light border-0 badge-soft-danger" id="txtoting" step="0.01" placeholder="0.00" value = '{{number_format($data['total'],2)}}' disabled>
                                                @else 
                                                    <input type="text" inputmode="numeric" class="form-control product-price bg-light border-0" id="txtoting" step="0.01" placeholder="0.00" value = '{{number_format($data['total'],2)}}' disabled>                                                
                                                @endif
                                            </td>
                                            <td>
                                                <ul class="list-inline hstack gap-2 mb-0">
                                                    <select class="form-select bg-light border-0" name="cmbgrupo" id="cmbgrupo" >
                                                        <option value="CHQ">CHEQUE</option>
                                                        <option value="TRA" Selected>TRANSFERENCIA</option>
                                                    </select>
                                                                                                  
                                                </ul>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control bg-light border-0" value='{{$data['cuentabanco']}}' disabled/> 
                                            </td>
                                            <td>
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr class="total">
                                        <td class="text-right">
                                            <span><strong>TOTALES: </strong></span>
                                        </td>
                                        <td>
                                            <strong>$ {{number_format($totalrol['totIng'],2)}}</strong>
                                        </td>
                                        <td>
                                            <strong>$ {{number_format($totalrol['totOtring'],2)}}</strong>
                                        </td>
                                        <td>
                                            <strong>$ {{number_format($totalrol['totEgr'],2)}}</strong>
                                        </td>
                                        <td>
                                            <strong>$ {{number_format($totalrol['totOtregr'],2)}}</strong>
                                        </td>
                                        <td>
                                            <strong>$ {{number_format($totalrol['total'],2)}}</strong>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                            </div>
                            
                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json"
                                        trigger="loop" colors="primary:#121331,secondary:#08a88a"
                                        style="width:75px;height:75px">
                                    </lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                    <p class="text-muted mb-0">We've searched more than 150+ contacts We
                                        did not find any
                                        contacts for you search.</p>
                                </div>
                            </div>
                        </div>
                        <!--<div class="d-flex justify-content-end mt-3">
                            <div class="pagination-wrap hstack gap-2">
                                <a class="page-item pagination-prev disabled" href="#">
                                    Previous
                                </a>
                                <ul class="pagination listjs-pagination mb-0"></ul>
                                <a class="page-item pagination-next" href="#">
                                    Next
                                </a>
                            </div>
                        </div>-->
                        
                    </div>

                    <div wire.ignore.self class="modal fade" id="showModalRubros" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" >
                            <div class="modal-content modal-content border-0">
                                
                                <div class="modal-header p-3 bg-light">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        <span> {{$titulo}} &nbsp;</span>
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                </div>
                                <form autocomplete="off" wire:submit.prevent="">
                                    <div class="modal-body">
                                        
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title flex-grow-1 mb-0 text-primary"><i
                                                    class="ri-user-follow-fill align-middle me-1 text-success"></i>
                                                    Datos de Empleado</h5>
                                            </div>
                                        </div>
                                         @livewire('vc-modal-rubros')                                       
                                    </div>
                                    <div class="modal-footer">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" wire:click.prevent="add()" class="btn btn-success" id="add-btn">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div wire.ignore.self class="modal fade flip" id="loadRecordModal" tabindex="-1" aria-hidden="true" wire:model='selectId'>
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body p-5 text-center">
                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                        colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px">
                                    </lord-icon>
                                    <div class="mt-4 text-center">
                                        <h4>You are about to delete the record ?</h4>
                                        <p class="text-muted fs-15 mb-4">Deleting the record will remove
                                            all of
                                            your information from our database.</p>
                                        <div class="hstack gap-2 justify-content-center remove">
                                            <button class="btn btn-link link-success fw-medium text-decoration-none"
                                                data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i>
                                                Close</button>
                                            <button class="btn btn-danger" id="delete-record"  wire:click="deleteData()"> Yes,
                                                Delete It</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end delete modal -->

                </div>
            </div>
            <!--end card--> 
        </div>
        <!--end col-->
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-2">
            </div>                        
            <div class="col-md-auto ms-auto">
                <div class="hstack text-nowrap gap-2">
                    @if ($this->editar == 'S' && $this->nomina['estado'] == 'C' )
                        <button type="submit" class="btn btn-info w-sm" ><i class="ri-save-3-fill align-bottom me-1"></i>Procesar</button>
                        <button class="btn btn-warning w-sm" wire:click="deleteRol()"><i class="ri-delete-back-2-line align-bottom me-1"></i>Reversar</button>
                    @endif
                </div>
            </div>
        </div>
        
        <!--end col-->
    </div>
              
    
    </form>
    <!--end row-->
</div>

