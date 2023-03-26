<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="orderList">
                <div class="card-header  border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1"> Listado de Rubros - Nomina </h5>
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
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <select class="form-control" data-choices data-choices-search-false
                                        name="choices-single-default" id="idRegistro" wire:model="filters.registro">
                                        <option value="">Todos</option>
                                        <option value="NO">Planilla</option>
                                        <option value="CA">Calculo Automatico</option>
                                        <option value="PR">Prestamo</option>
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <select class="form-control" data-choices data-choices-search-false
                                        name="choices-single-default" id="idStatus" wire:model="filters.estado">
                                        <option value="">Todos</option>
                                        <option value="A">Activo</option>
                                        <option value="I">Inactivo</option>
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
                                        <th class="sort" data-sort="area">Tipo</th>
                                        <th class="sort" data-sort="administrator">Etiqueta</th>
                                        <th class="sort" data-sort="registro">Registro</th>
                                        <th class="sort">Estado</th>
                                        <th class="sort" data-sort="city">Acción</th>
                                        
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                @foreach ($tblrecords as $record)    
                                    <tr>
                                        <td>{{$record->id}}</td>
                                        <td>{{$record->descripcion}}</td> 
                                        <td>
                                            @if($record->tipo=="P")
                                                <span class="badge badge-soft-success text-uppercase">Percepción</span>
                                            @else
                                                <span class="badge badge-soft-danger text-uppercase">Deducción</span>
                                            @endif 
                                        </td> 
                                        <td>{{$record->etiqueta}}</td>    
                                        <td>
                                        @switch ($record->registro)
                                         @case("NO")
                                            @if ($record->regplanilla==1)
                                                <span class="badge badge-soft-success text-uppercase">Planilla</span>
                                            @else
                                                <span class="badge badge-soft-success text-uppercase">Novedad</span>
                                            @endif
                                            @break
                                         @case("PR")
                                            <span class="badge badge-soft-warning text-uppercase">Prestamo</span>
                                            @break
                                         @case("CA")
                                            <span class="badge badge-soft-info text-uppercase">Calculo Automatico</span>
                                            @break                                            
                                        @endswitch
                                        </td>
                                        <td class="status">
                                            @if($record->estado="A")
                                                <span class="badge badge-soft-success text-uppercase">Activo</span>
                                            @else
                                                <span class="badge badge-soft-danger text-uppercase">Inactivo</span>
                                            @endif
                                        </td>
                                        <td>
                                            <ul class="list-inline hstack gap-2 mb-0">
                                                <li class="list-inline-item edit" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                    <a href="/form/rubros-edit/{{$record->id}}">
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

