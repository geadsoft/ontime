<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="orderList">
                <div class="card-header  border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">Listado de Tipos - Rol de Pagos</h5>
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
                                        placeholder="Buscar por descripción..." wire:model="filters.descripcion">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <select class="form-select" data-choices data-choices-search-false
                                        name="choices-single-default" id="idempledos" wire:model="filters.empleado">
                                        <option value="0" selected>Tipo Empleados</option>
                                        @foreach ($tblempleados as $empleado)
                                            <option value="{{$empleado->id}}">{{$empleado->descripcion}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <select class="form-select" data-choices data-choices-search-false
                                        name="choices-single-default" id="idPayment" wire:model="filters.contrato">>
                                        <option value="all" selected>Tipo Contratos</option>
                                        @foreach ($tblcontratos as $contrato)
                                            <option value="{{$contrato->id}}">{{$contrato->descripcion}}</option>
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
                                        <th class="sort" data-sort="id"> ID</th>
                                        <th class="sort" data-sort="description">Descripción</th>
                                        <th class="sort" data-sort="area">Tipo Empleado</th>
                                        <th class="sort" data-sort="administrator">Tipo Contrato</th>
                                        <th class="sort" data-sort="ledger_account">Tipo</th>
                                        <th class="sort" data-sort="status">Estado</th>
                                        <th class="sort" data-sort="city">Acción</th>
                                        
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                @foreach ($tblrecords as $record)    
                                    <tr>
                                        <td>{{$record->id}}</td>
                                        <td>{{$record->descripcion}}</td> 
                                        <td>{{$record->tipoempleado->descripcion}}</td>
                                        <td>{{$record->tipocontrato->descripcion}}</td>    
                                        <td>{{$tipos[$record->tipoderol]}}</td>
                                        <td class="status"><span
                                                class="badge badge-soft-success text-uppercase">{{$estados[$record->estado]}}</span>
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
                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                        colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px">
                                    </lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                    <p class="text-muted">We've searched more than 150+ Orders We did
                                        not find any
                                        orders for you search.</p>
                                </div>
                            </div>
                        </div>
                        {{$tblrecords->links('')}}
                    </div>

                    <div wire.ignore.self class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" >
                            <div class="modal-content">
                                
                                <div class="modal-header bg-light p-3">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        @if($showEditModal)
                                            <span>Editar Tipos de Rol &nbsp;</span>
                                        @else
                                            <span>Agregar Tipo de Rol  &nbsp;</span>
                                        @endif
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                </div>
                                <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateData' : 'createData' }}">
                                    
                                    <div class="modal-body">
                                        <!--<input type="hidden" id="id-field" />-->

                                        <div class="id" id="modal-id">
                                            @if($showEditModal)
                                                <label for="record.id" class="form-label">ID</label>
                                                <input type="text" wire:model.defer="record.id" class="form-control" placeholder="ID" readonly />
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <label for="record.descripcion" class="form-label">Descripción</label>
                                            <input type="text" wire:model.defer="record.descripcion" class="form-control" name="record.descripcion"
                                                placeholder="Ingrese Descripción" required />
                                        </div>

                                        <div class="mb-3">
                                            <label for="cmbtipoempleado" class="form-label">Tipo de Empleado</label>
                                            @if($showEditModal)
                                                <select type="select" class="form-control" data-trigger name="cmbtipoempleado" wire:model.defer="record.tipoempleado_id" disabled required>
                                            @else
                                                <select type="select" class="form-control" data-trigger name="cmbtipoempleado" wire:model.defer="record.tipoempleado_id" required>
                                            @endif
                                                <option value="">Seleccione Tipo de Empleado</option>
                                                @foreach ($tblempleados as $empleado)
                                                    <option value="{{$empleado->id}}">{{$empleado->descripcion}}</option>
                                                @endforeach
                                            </select>
                                        </div>  

                                        <div class="mb-3">
                                            <label for="cmbtipocontrato" class="form-label">Tipo de Contrato</label>
                                            @if($showEditModal)
                                                <select type="select" class="form-control" data-trigger name="cmbtipocontrato" wire:model.defer="record.tipocontrato_id" disabled required>
                                            @else
                                                <select type="select" class="form-control" data-trigger name="cmbtipocontrato" wire:model.defer="record.tipocontrato_id" required>
                                            @endif
                                                <option value="">Seleccione Tipo de Contrato</option>
                                                @foreach ($tblcontratos as $contrato)
                                                    <option value="{{$contrato->id}}">{{$contrato->descripcion}}</option>
                                                @endforeach
                                            </select>
                                        </div>                                  

                                        <div class="mb-3">
                                            <label for="opttiporol" class="form-label">Tipo de Rol</label>
                                            <div class="form-control form-control-sm ">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="opttiporolE" wire:model.defer="record.tipoderol" value="E">
                                                    <label class="form-check-label" >Estandar</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="opttiporolV" wire:model.defer="record.tipoderol" value="V">
                                                    <label class="form-check-label" >Vacaciones</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="opttiporolL" wire:model.defer="record.tipoderol" value="L">
                                                    <label class="form-check-label" >Liquidación</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="opttiporolB" wire:model.defer="record.tipoderol" value="B">
                                                    <label class="form-check-label" >Beneficios</label>
                                                </div>
                                             </div>   
                                        </div>
                                        
                                        <div>
                                            <label for="record.estado" class="form-label">Status</label>
                                                <select class="form-control" data-trigger name="record.estado" wire:model.defer="record.estado">
                                                <option value="A">Activo</option>
                                                <option value="I">Inactivo</option>
                                                <option value="E">Eliminado</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success" id="add-btn">Save</button>
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
