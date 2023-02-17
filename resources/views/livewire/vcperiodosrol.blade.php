<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="orderList">
                <div class="card-header  border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">List of Periods Type Rol</h5>
                        <div class="flex-shrink-0">
                            <button type="button" wire:click.prevent="add()" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn"
                                data-bs-target=""><i class="ri-add-line align-bottom me-1"></i> Create
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
                                        placeholder="Search for description..." wire:model="filters.descripcion">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <select class="form-select" data-choices data-choices-search-false
                                        name="choices-single-default" id="filtertipo"  wire:model="filters.tipo">
                                        <option value="" selected>All</option>
                                        <option value="Q">Quincenal</option>
                                        <option value="M">Mensual</option>
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <select class="form-select" data-choices data-choices-search-false
                                        name="choices-single-default" id="filtermes" wire:model="filters.mes">
                                        <option value="" selected>All</option>
                                        @for ($i =1; $i <= 12; $i++)
                                            <option value="{{$i}}">{{ $meses[$i] }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-1 col-sm-4">
                                <div>
                                    <button type="button" class="btn btn-primary w-100" onclick="SearchData();"> <i
                                            class="ri-equalizer-fill me-1 align-bottom"></i>
                                        Filters
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
                                        <th class="sort" data-sort="description">Tipo de Rol</th>
                                        <th class="sort" data-sort="area">Proceso</th>
                                        <th class="sort" data-sort="administrator">Mes</th>
                                        <th class="sort" data-sort="ledger_account">Fecha</th>
                                        <th class="sort">Estado</th>
                                        <th class="sort" data-sort="city">Acción</th>
                                        
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                @foreach ($tblrecords as $record)    
                                    <tr>
                                        <td>{{$record->id}}</td>
                                        <td>{{$record->tiporol->descripcion}}</td> 
                                        <td>{{$tiempo[$record->tiempo]}}</td> 
                                        <td> {{$meses[$record->mes]}}</td>    
                                        <td> {{date('d/m/Y', strtotime($record->fechaini))}} - {{date('d/m/Y', strtotime($record->fechafin))}}                                       
                                        </td>
                                        <td class="status">
                                            @if($record->procesado)
                                                <span class="badge badge-soft-warning text-uppercase">Generado</span>
                                            @else
                                                <span class="badge badge-soft-dark text-uppercase">No Generado</span>
                                            @endif
                                            @if($record->aprobado)
                                                <span class="badge badge-soft-success text-uppercase">Aprobado</span>
                                            @endif
                                            @if($record->cerrado)
                                                <span class="badge badge-soft-secondary text-uppercase">Cerrado</span>
                                            @endif
                                        </td>
                                        <td>
                                            <ul class="list-inline hstack gap-2 mb-0">
                                                <!--<li class="list-inline-item edit" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                    <a href="" wire:click.prevent="edit({{ $record }})" >
                                                        <i class="ri-pencil-fill fs-16"></i>
                                                    </a>
                                                </li>-->
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
                                            <span>Editar Periodo Tipos Rol &nbsp;</span>
                                        @else
                                            <span>Agregar Periodo Tipos Rol  &nbsp;</span>
                                        @endif
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                </div>
                                <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateData' : 'createData' }}">
                                    
                                    <div class="modal-body">
                                        <div class="id" id="modal-id">
                                            @if($showEditModal)
                                                <label for="record.id" class="form-label">ID</label>
                                                <input type="text" wire:model.defer="record.id" class="form-control" placeholder="ID" readonly />
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <label for="cmbtiporol" class="form-label">Tipo de Rol</label>
                                            <select type="select" class="form-select" data-trigger id="cmbtiporol" wire:model.defer="record.tiporol_id" required>
                                            <option value="">Ingrese tipo de rol</option>
                                            @foreach ($tbltiporols as $tiporol)
                                                <option value="{{$tiporol->id}}">{{$tiporol->descripcion}}</option>
                                            @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="cmbtipo" class="form-label">Remuneración</label>
                                            <select type="select" class="form-select" data-trigger id="cmbtipo" wire:model.defer="record.tiempo" required>
                                            <option value="">Ingrese tipo de pago</option>
                                            <option value="Q">Quincenal</option>
                                            <option value="M">Mensual</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="cmbmes" class="form-label">Mes de Pago</label>
                                            <select type="select" class="form-select" data-trigger id="cmbmes" wire:model.defer="record.mes" onchange="fechaMes()" required>
                                            <option value="">Ingrese mes de pago</option>
                                            @for ($i=1; $i <= 12; $i++)
                                                <option value="{{$i}}">{{ $meses[$i] }}</option>
                                            @endfor
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="" class="form-label">Fecha</label>
                                            <div>
                                                <input id="dfechaini" name="dateIni" type="date" class="form-control" data-provider="flatpickr" data-date-format="d-m-Y" data-time="true" required disabled>
                                            </div>
                                            <br>
                                            <div>
                                                <input id="dfechafin" name="dateFin" type="date" class="form-control" data-provider="flatpickr" data-date-format="d-m-Y" data-time="true" required disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success" id="add-btn">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div wire.ignore.self class="modal fade flip" id="deleteOrder" tabindex="-1" aria-hidden="true" wire:model='selectId'>
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body p-5 text-center">
                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                        colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px">
                                    </lord-icon>
                                    <div class="mt-4 text-center">
                                        <h4>You are about to delete the record ? {{ $selectId }}</h4>
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

                    <!--end modal -->
                </div>
            </div>

        </div>
        <!--end col-->
    </div>
    <!--end row-->

</div>

