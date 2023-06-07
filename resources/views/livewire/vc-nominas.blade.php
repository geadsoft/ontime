<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="orderList">
                <div class="card-header  border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">Roles de Pagos</h5>
                    </div>
                </div>
                <div class="card-body border border-dashed border-end-0 border-start-0">
                    <form>
                        <div class="row g-3">
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <label for="cmbtiporol" class="form-label">Periodo</label>
                                    <select class="form-select" data-choices data-choices-search-false
                                        name="choices-single-default" id="cmbnivel" wire:model="filters.tiporol">
                                        <option value="0" selected>All</option>                                
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <label for="cmbtiporol" class="form-label">Mes</label>
                                    <select class="form-select" data-choices data-choices-search-false
                                        name="choices-single-default" id="cmbnivel" wire:model="filters.mes">
                                        <option value="0" selected>All</option>
                                        @for($mes=1;$mes<=12;$mes++)                                
                                            <option value="{{$mes}}">{{$meses[$mes]}}</option> 
                                        @endfor                                 
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <label for="cmbtiporol" class="form-label">Departamento</label>
                                    <select class="form-select" data-choices data-choices-search-false
                                        name="choices-single-default" id="cmbnivel" wire:model="filters.departamento">
                                        <option value="0" selected>All</option>                              
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <label for="cmbtiporol" class="form-label">Rol</label>
                                    <select class="form-select" data-choices data-choices-search-false
                                        name="choices-single-default" id="cmbnivel" wire:model="filters.proceso">
                                        <option value="0" selected>All</option>
                                        <option value="Q">QUINCENAL</option>
                                        <option value="M">MENSUAL</option>                                   
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <label for="cmbtiporol" class="form-label">Estado</label>
                                    <select class="form-select" data-choices data-choices-search-false
                                        name="choices-single-default" id="cmbestado" wire:model="filters.estado">
                                        <option value="">Select Estatus</option>
                                        <option value="C">CREADA</option>
                                        <option value="P">PROCESADA</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-1 col-sm-4">
                                <div>
                                    <label for="cmbtiporol" class="form-label">-</label>
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
                                        <th class="sort" data-sort="id"> Periodo</th>
                                        <th class="sort" data-sort="id"> Pago</th>
                                        <th class="sort" data-sort="superior">Departamento</th>
                                        <th class="sort" data-sort="codigo"> Ingresos</th>
                                        <th class="sort" data-sort="descripcion">Egresos</th>
                                        <th class="sort" data-sort="descripcion">Total</th>
                                        <th class="sort" data-sort="estado">Estado</th>
                                        <th class="sort" data-sort="accion">Acción</th>
                                        
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                @foreach ($tblrecords as $record)    
                                    <tr>
                                        <td> <a href="/payroll/registrar-pagos/{{$record->id}}"><strong>{{$meses[$record->mes]}} {{$record->periodo}}</strong></a></td>
                                        @if ($record->remuneracion=='Q')
                                            <td> QUINCENAL</td>
                                        @else
                                            <td> MENSUAL</td>
                                        @endif
                                        <td>{{$record->tiposrol->descripcion}}</td>
                                        <td>{{$record->ingresos}}</td>
                                        <td>{{$record->egresos}}</td>
                                        <td>{{$record->total}}</td>
                                        <td>
                                            @if($record->estado=='C')
                                               <span class="badge badge-soft-success text-uppercase">CREADA</span>
                                            @else
                                                <span class="badge badge-soft-info text-uppercase">PROCESADA</span>
                                            @endif
                                        </td>
                                        <td>
                                            <ul class="list-inline hstack gap-2 mb-0">
                                                <li class="list-inline-item edit" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                    <a href="" wire:click.prevent="edit({{ $record->id }})">
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
                       
                        <!--<div class="d-flex justify-content-end">
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
                        {{$tblrecords->links('')}}

                    </div>
                </div>
            </div>

        </div>
        <!--end col-->
    </div>
    <!--end row-->

</div>

