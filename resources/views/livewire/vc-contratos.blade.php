<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="orderList">
                <div class="card-header  border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">Listado de Contratos</h5>
                        <div class="flex-shrink-0">
                            <button type="button" wire:click.prevent="add()" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn"
                                data-bs-target=""><i class="ri-add-line align-bottom me-1"></i> Agregar
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body border border-dashed border-end-0 border-start-0">
                    <form>
                        <div class="row g-3">
                            <div class="col-xxl-5 col-sm-6">
                                <div class="search-box">
                                    <input type="text" class="form-control search"
                                        placeholder="Buscar por apellidos y nombres" wire:model="filters.nombres">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <select class="form-select" data-choices data-choices-search-false
                                        name="choices-single-default" id="cmbnivel" wire:model="filters.departamento">
                                        <option value="" selected>Todos</option>
                                        @foreach ($areas as $area)
                                            <option value="{{$area->id}}">{{$area->descripcion}}</option>
                                        @endforeach                                
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <select class="form-select" data-choices data-choices-search-false
                                        name="choices-single-default" id="cmbestado" wire:model="filters.cargo">
                                        <option value="" selected>Todos</option>
                                        @foreach ($cargos as $cargo)
                                            <option value="{{$cargo->id}}">{{$cargo->descripcion}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-1 col-sm-4">
                                <div>
                                    <button type="button" class="btn btn-primary w-100" wire:click="resetFilter();"> <i
                                            class="ri-equalizer-fill me-1 align-bottom"></i>
                                        Todos
                                    </button>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>
                <div class="card-body pt-0">
                    <div>
                        <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
                        </ul>

                        <div class="table-responsive table-card mb-1">
                            <table class="table table-nowrap align-middle" id="orderTable">
                                <thead class="text-muted table-light">
                                    <tr class="text-uppercase">
                                        <th scope="col">Fecha Ingreso</th>
                                        <th scope="col">Colaborador</th>                                        
                                        <th scope="col">Tipo Contrato</th>
                                        <th scope="col">Area</th>
                                        <th scope="col">Departamento</th>
                                        <th scope="col">Cargo</th>
                                        <th scope="col">Código IESS</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Acción</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                @foreach ($tblrecords as $record)    
                                    <tr>
                                        <td>{{date('d/m/Y', strtotime($record->fecha_ingreso))}}</td>
                                        <td>{{$record->persona->apellidos}} {{$record->persona->nombres}}</td> 
                                        <td>{{$record->tipocontrato->descripcion}}</td>
                                        <td>{{$record->area->descripcion}}</td>
                                        <td>{{$record->departamento->descripcion}}</td>
                                        <td>{{$record->cargo->descripcion}}</td>
                                        <td>{{$record->codigo_sectorial}}</td>
                                        
                                        <td>
                                            @if($record->estado)
                                                <span class="badge badge-soft-success text-uppercase">Activo</span>
                                            @else
                                                <span class="badge badge-soft-warning text-uppercase">Inactivo</span>
                                            @endif
                                        </td>
                                        <td>
                                            <ul class="list-inline hstack gap-2 mb-0">
                                                <li class="list-inline-item edit" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                    <a href="" wire:click.prevent="edit({{ $record }})">
                                                        <i class="ri-pencil-fill fs-16"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                    <a class="text-danger d-inline-block remove-item-btn"
                                                        data-bs-toggle="modal" href="" wire:click.prevent="delete({{ $record->id }})">
                                                        <i class="ri-delete-bin-5-fill fs-16"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    
                        {{$tblrecords->links('')}}

                    </div>

                    <div wire.ignore.self class="modal fade zoomIn" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" >
                            <div class="modal-content">
                                
                                <div class="modal-header bg-light p-3">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        @if($showEditModal)
                                            <span>Modificación de Contrato &nbsp;</span>
                                        @else
                                            <span>Registro de Contrato &nbsp;</span>
                                        @endif
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                </div>
                                <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateData' : 'createData' }}">
                                    
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-lg-9">
                                                <div class="mb-3">
                                                    <label for="fecha" class="form-label">Empleado</label>
                                                    <select class="form-select" data-choices data-choices-search-false 
                                                        name="choices-single-default" id="cmbnivel" wire:model.defer="record.persona_id" required>
                                                        <option value="" selected>Seleccione Empleado</option>
                                                        @foreach ($personas as $persona) 
                                                            <option value="{{$persona->id}}">{{$persona->apellidos}} {{$persona->nombres}}</option>
                                                        @endforeach                              
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="mb-3">
                                                    <label for="date-field" class="form-label">Fecha de Emision</label>
                                                    <input type="date" id="date-field" class="form-control"
                                                        data-provider="flatpickr" data-date-format="d-m-Y" data-enable-time
                                                        required placeholder="Seleccionar fecha" wire:model.defer="record.fecha" required/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="card-header mb-3">
                                                <h6 class="flex-grow-1 mb-0 text-primary"><i
                                                    class="mdi mdi-account-tie align-middle me-1 text-success"></i>
                                                    Datos para la Empresa</h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="cmbarea" class="form-label">Área</label>
                                                    <select class="form-select" data-choices data-choices-search-false
                                                        name="choices-single-default" id="cmbarea" wire:model.defer="record.area_id" required>
                                                        <option value="" selected>Seleccione Área</option>
                                                        @foreach ($areas as $area)
                                                            @if ($area->area_id==null)) 
                                                                <option value="{{$area->id}}">{{$area->descripcion}}</option>
                                                            @endif
                                                        @endforeach                              
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="cmbdepartamento" class="form-label">Departamento</label>
                                                    <select class="form-select" data-choices data-choices-search-false
                                                        name="choices-single-default" id="cmbdepartamento" wire:model.defer="record.departamento_id" required>
                                                        <option value="" selected>Seleccione Departamento</option>
                                                        @foreach ($areas as $area)
                                                            @if ($area->area_id>0) 
                                                                <option value="{{$area->id}}">{{$area->descripcion}}</option>
                                                            @endif
                                                        @endforeach                              
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="cmbtcontrato" class="form-label">Tipo de Contrato</label>
                                                    <select class="form-select" data-choices data-choices-search-false
                                                        name="choices-single-default" id="cmbtcontrato" wire:model.defer="record.tipocontrato_id" required>
                                                        <option value="" selected>Seleccione Tipo de Contrato</option>
                                                        @foreach ($tcontratos as $tcontrato)
                                                            <option value="{{$tcontrato->id}}">{{$tcontrato->descripcion}}</option>
                                                        @endforeach                              
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="cmbtempleado" class="form-label">Tipo Empleado</label>
                                                    <select class="form-select" data-choices data-choices-search-false
                                                        name="choices-single-default" id="cmbtempleado" wire:model.defer="record.tipoempleado_id" required>
                                                        <option value="" selected>Seleccione Tipo de Empleados</option>
                                                        @foreach ($templeados as $templeado)
                                                            <option value="{{$templeado->id}}">{{$templeado->descripcion}}</option>
                                                        @endforeach                              
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="cmbcargo" class="form-label">Cargo</label>
                                                    <select class="form-select" data-choices data-choices-search-false
                                                        name="choices-single-default" id="cmbcargo" wire:model.defer="record.cargo_id" required>
                                                        <option value="" selected>Seleccione Cargo</option>
                                                        @foreach ($cargos as $cargo)
                                                            <option value="{{$cargo->id}}">{{$cargo->descripcion}}</option>
                                                        @endforeach                              
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="codsectorial" class="form-label">Código Sectorial</label>
                                                    <input type="number" class="form-control" id="codsectorial"
                                                    placeholder="Enter your number" wire:model.defer="record.codigo_sectorial" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="card-header mb-3">
                                                <h6 class="flex-grow-1 mb-0 text-primary"><i
                                                    class="mdi mdi-account-tie align-middle me-1 text-success"></i>
                                                    Configuraciones Generales</h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label for="cmbfreserva" class="form-label">Fondo de Reserva</label>
                                                <select class="form-select" data-trigger name="cmbfreserva" wire:model.defer="record.fondo_reserva" required>
                                                    <option value="PA">Pagar desde el año</option>
                                                    <option value="PI">Pagar desde el ingreso</option>
                                                    <option value="AA">Acumular desde el año</option>
                                                    <option value="AI">Acumular desde el ingreso</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="sueldo" class="form-label">Sueldo</label>
                                                    <input type="number" class="form-control" step="0.01" id="sueldo"
                                                    placeholder="Ingrese el sueldo" wire:model.defer="record.sueldo" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="anticipo" class="form-label">Anticipo</label>
                                                    <input type="number" class="form-control" step="0.01" id="anticipo"
                                                    placeholder="Ingrese el anticipo ($)" wire:model.defer="record.anticipo" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <label for="tipopago" class="form-label">Tipo Pago</label>
                                                <select class="form-select" data-trigger name="tipopago" wire:model.defer="record.tipo_pago" required>
                                                    <option value="TRA">Transferencia</option>
                                                    <option value="CHQ">Cheque</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-4">
                                                <label for="date-field" class="form-label">Fecha de Ingreso</label>
                                                <input type="date" id="date-field" class="form-control"
                                                data-provider="flatpickr" data-date-format="d-m-Y" data-enable-time
                                                placeholder="Seleccionar fecha" wire:model.defer="record.fecha_ingreso" required/>
                                            </div>
                                            <div class="col-lg-4">
                                                <label for="date-field" class="form-label">Fecha de Salida</label>
                                                <input type="date" id="date-field" class="form-control"
                                                data-provider="flatpickr" data-date-format="d-m-Y" data-enable-time
                                                placeholder="Seleccionar fecha" wire:model.defer="record.fecha_salida" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-success" id="add-btn">Grabar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div wire.ignore.self class="modal fade flip" id="deleteRecord" tabindex="-1" aria-hidden="true" wire:model='selectId'>
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body p-5 text-center">
                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                        colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px">
                                    </lord-icon>
                                    <div class="mt-4 text-center">
                                        <h4>¿Está a punto de inactivar el registro? {{ $selectValue }}</h4>
                                        <p class="text-muted fs-15 mb-4">Inactivar el registro afectará toda su 
                                        información de nuestra base de datos.</p>
                                        <div class="hstack gap-2 justify-content-center remove">
                                            <button class="btn btn-link link-success fw-medium text-decoration-none"
                                                data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i>
                                                Cerrar </button>
                                            <button class="btn btn-danger" id="delete-record"  wire:click="deleteData()"> Si,
                                                Inactivar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--end modal -->
                </div>
            </div>

        </div>
        <!--end col-->
    </div>
    <!--end row-->

</div>

