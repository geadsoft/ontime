<div>
    <form id="addrubro-form" autocomplete="off" wire:submit.prevent="">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label for="cmbtiporol" class="form-label">Periodo</label>
                            <select type="select" class="form-select" data-trigger id="cmbtiporol" wire:model.defer="periodoId">
                                <option value="">Ingrese tipo de rol</option>
                                @foreach ($tblperiodos as $periodo)
                                    <option value="{{$periodo->id}}">{{$periodo->tiporol->descripcion}} {{date('d/m/Y', strtotime($periodo->fechaini))}} - {{date('d/m/Y', strtotime($periodo->fechafin))}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="cmbtiporol" class="form-label">Emisión</label>
                            <div>
                                <input id="dfechaini" name="dateIni" type="date" class="form-control" data-provider="flatpickr" data-date-format="d-m-Y" data-time="true" wire:model.defer="fecha" required>
                            </div>
                        </div>                        
                        <div class="col-md-auto ms-auto">
                            <div class="hstack text-nowrap gap-2">
                                <button type="button" wire:click.prevent="add()" class="btn btn-info add-btn" data-bs-toggle="modal" id="create-btn"
                                    data-bs-target=""><i class="ri-file-copy-fill align-bottom me-1"></i> Ver Rol
                                </button>
                                <!--<button type="button" wire:click.prevent="createData()" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn"
                                    data-bs-target=""><i class="ri-add-line align-bottom me-1"></i> Grabar
                                </button>-->
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
                            <label for="cmbtiporol" class="form-label">Buscar Empleado</label>
                            <div class="search-box">
                                <input type="text" class="form-control search" placeholder="Search for contact..." wire:model="">
                                <i class="ri-search-line search-icon"></i>
                            </div>
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
                                        <th scope="col" style="width: 50px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="checkAll" value="option">
                                            </div>
                                        </th>
                                        <!--<th class="sort" data-sort="id" scope="col">ID</th>-->
                                        <th scope="col">Empleado</th>
                                        <th scope="col">Ingresos</th>
                                        <th scope="col">Otros Ingresos</th>
                                        <th scope="col">Egresos</th>
                                        <th scope="col">Otros Egresos</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Tipo Pago</th>
                                        <th scope="col">Cta Bancaria</th>
                                        <th scope="col">Acción</th>
                                        <th scope="col">Estado</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($detalle as $data)
                                        <tr class="detalle">
                                            <th scope="row">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="chk_child"
                                                        value="option1">
                                                </div>
                                            </th>
                                            <td>
                                                {{$data['empleado']}}
                                                <!--<input type="text" style="width:100px" class="form-control form-control-sm product-price" value="" disabled/>-->
                                            </td>
                                            <td>
                                                <ul class="list-inline hstack gap-2 mb-0">
                                                    <div>
                                                        {{number_format($data['ingresos'],2)}}
                                                    </div>
                                                    <button type="button" wire:click.prevent="rubros({{$data['empleado_id']}},'V-INGF')" class="btn dropdown" 
                                                        data-bs-target=""><i class="ri-checkbox-multiple-blank-line align-bottom me-1"></i>
                                                    </button>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul class="list-inline hstack gap-2 mb-0">
                                                    <div>
                                                        {{number_format($data['otingresos'],2)}}
                                                    </div>
                                                    <button type="button" data-bs-toggle="dropdown" class="btn dropdown">
                                                    <i class="ri-download-2-line align-bottom me-1"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item" href="" wire:click.prevent="rubros({{$data['empleado_id']}},'E-INGO')"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Editar </a></li>
                                                        <li><a class="dropdown-item" href="" wire:click.prevent="rubros({{$data['empleado_id']}},'V-INGF')"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> Visualizar </a></li>
                                                    </ul>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul class="list-inline hstack gap-2 mb-0">
                                                    <div>
                                                        {{number_format($data['egresos'],2)}}
                                                    </div>
                                                    <button type="button" wire:click.prevent="rubros({{$data['empleado_id']}},'V-EGRF')" class="btn dropdown" 
                                                        data-bs-target=""><i class="ri-checkbox-multiple-blank-line align-bottom me-1"></i>
                                                    </button>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul class="list-inline hstack gap-2 mb-0">
                                                    <div>
                                                        {{number_format($data['otegresos'],2)}}
                                                    </div>
                                                    <button type="button" data-bs-toggle="dropdown" class="btn dropdown" >
                                                    <i class="ri-download-2-line align-bottom me-1"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item" href="" wire:click.prevent="rubros({{$data['empleado_id']}},'E-EGRO')"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Editar </a></li>
                                                        <li><a class="dropdown-item" href="" wire:click.prevent="rubros({{$data['empleado_id']}},'V-EGRF')"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> Visualizar </a></li>
                                                    </ul>
                                                </ul>
                                            </td>
                                            <td>
                                                @if($data['total']<=0)
                                                    <span class="badge-soft-danger">{{number_format($data['total'],2)}}</span>
                                                @else 
                                                    {{number_format($data['total'],2)}}                                                
                                                @endif
                                            </td>
                                            <td>
                                                <ul class="list-inline hstack gap-2 mb-0">
                                                    <select class="form-select" name="cmbgrupo" wire:model="filters.srv_grupo" id="cmbgrupo">
                                                        <option value="CHQ">CHEQUE</option>
                                                        <option value="TRA">TRANSFERENCIA</option>
                                                    </select>
                                                    <div>
                                                        {{$data['cuentabanco']}}
                                                    </div>                                                
                                                </ul>
                                            </td>
                                            <td>
                                                {{$data['entidad_id']}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    
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
                                
                                <div class="modal-header p-3 btn-primary">
                                    <h5 class="modal-title" id="exampleModalLabel"  style="color: #D4D4DD">
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
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
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
        <div class="col-md-auto ms-auto">
            <div class="justify-content-center">
                @if (count($detalle)>0)
                <button type="submit" class="btn btn-success w-sm" ><i class="ri-save-3-fill align-bottom me-1"></i>Grabar</button>
                @endif
            </div>
        </div>
        <!--end col-->
        
        <!--end col-->
    </div>
    
    
        
    
    
    </div>
    <!--end row-->
</div>

