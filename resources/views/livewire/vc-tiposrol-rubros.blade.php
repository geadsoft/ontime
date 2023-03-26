<div>
    <div class="row">
        <!--<div class="col-xl-3 col-lg-4">
            <div class="card">
                <div class="card-header ">
                    
                    <div class="file-manager-sidebar">
                            <div class="p-3 d-flex flex-column h-100">
                                <div class="mb-3">
                                    <h5 class="mb-0 fw-semibold">Tipos Rol</h5>
                                </div>
                                <div class="search-box">
                                    <input type="text" class="form-control bg-light border-light" placeholder="Search here...">
                                    <i class="ri-search-2-line search-icon"></i>
                                </div>
                                <div class="mt-3 mx-n4 px-4 file-menu-sidebar-scroll" data-simplebar>
                                    <ul class="list-unstyled file-manager-menu">
                                    @foreach ($tbltiposrols as $tipo)
                                    <li>
                                        <a href="#!" wire:click.prevent="loadData({{ $tipo->id }})"><i class="ri-file-list-2-line align-bottom me-2"></i> <span class="file-list-link">{{$tipo->descripcion}}</span></a>
                                    </li>
                                    @endforeach 
                                </ul>
                            </div>
                                                
                        </div>
                    </div>

                </div>
                

            </div>
            
                
           
        </div>-->
        <!-- end col -->

        <div class="col-xl-12 col-lg-12">
            <div>
                <div class="card">
                    
                    <!-- end card header -->
                    <div class="card-body">

                        <div class="table-responsive table-card mb-1">
                            <div class="file-manager-content w-100 p-3 py-0">
                                <div class="mx-n3 pt-4 px-4 file-manager-content-scroll" data-simplebar>
                                    <div class="d-flex align-items-center mb-3">
                                        <!--<h5 class="flex-grow-1 fs-16 mb-0" id="filetype-title">{{$nomtiporol}}</h5>-->
                                        <div class="input-group">
                                            <div class="col-sm-1 ">
                                                <input type="text" class="form-control border-0 fw-semibold" placeholder="ID"  value="TIPO ROL:"/>
                                            </div>
                                            <div class="col-xxl-4 col-sm-4">
                                                <select class="form-select" data-choices data-choices-search-false
                                                    name="choices-single-default" id="cmbnivel" wire:model.defer ="selectId" wire:change='loadData()'>
                                                     @foreach ($tbltiposrols as $tipo)
                                                        <option value="{{$tipo->id}}" selected>{{$tipo->descripcion}}</option>
                                                     @endforeach                                
                                                </select>
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <button class="btn btn-success" wire:click.prevent="add()" data-bs-toggle="modal" data-bs-target="" ><i class="ri-add-line align-bottom me-1"></i>Agregar Rubro</button>
                                        </div>
                                    </div>
                                    <div class="card-body border border-dashed border-end-0 border-start-0 mb-3">
                                    </div>
                                    <div class="table-responsive table-card mb-1">
                                        <table class="table table-nowrap align-middle" id="orderTable">
                                            <thead class="text-muted table-light">
                                                <tr class="text-uppercase">
                                                    <th scope="col">Rubro</th>
                                                    <th scope="col">Etiqueta</th>
                                                    <th scope="col">Tipo</th>
                                                    <th scope="col">Remuneración</th>
                                                    <th scope="col" class="text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="file-list">
                                                 @foreach ($tblrecords as $record)    
                                                <tr>
                                                    <td>{{$record->rubrosrol->descripcion}}</td>
                                                    <td>{{$record->rubrosrol->etiqueta}}</td>
                                                    <td>{{$arrayTipo[$record->tipo]}}</td>
                                                    <td>{{$arrayPago[$record->remuneracion]}}</td>
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
                            </div>
                        </div>
                        
                        <!-- end tab content -->
                        <div wire.ignore.self class="modal fade zoomIn" id="showModal" tabindex="-1" aria-labelledby="createFileModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0">
                                    <div class="modal-header p-3 bg-light">
                                        <h5 class="modal-title" id="createFileModalLabel">Agregar Rubros</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" id="addFileBtn-close" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form autocomplete="off" class="needs-validation createfile-form" id="createfile-form" wire:submit.prevent="{{ $showEditModal ? 'updateData' : 'createData' }}">
                                            <div class="mb-4">
                                                <label for="filename-input" class="form-label">Rubro</label>
                                                <select type="select" class="form-select" data-trigger name="rubro-select" wire:model.defer="rubroId">
                                                <option value="">Seleccione Rubro</option>
                                                @foreach ($tblrubros as $rubro)
                                                    <option value="{{$rubro->id}}">{{$rubro->descripcion}}</option>
                                                @endforeach                                                
                                                </select>                                                
                                            </div>
                                            <div class="mb-4">
                                                <label for="filename-input" class="form-label">Tipo</label>
                                                <select type="select" class="form-select" data-trigger name="record.tipo" wire:model.defer="rubroTipo" required>
                                                    <option value="">Seleccione Tipo</option>
                                                    <option value="P">Percepción</option>
                                                    <option value="D">Deducción</option>
                                                </select>
                                            </div>
                                            <div class="mb-4">
                                                <label for="filename-input" class="form-label">Remuneración</label>
                                                <select type="select" class="form-select" data-trigger id="cmbtipo" wire:model.defer="rubroPago" required>
                                                    <option value="">Seleccione tipo de remuneración</option>
                                                    <option value="Q">Quincenal</option>
                                                    <option value="M">Mensual</option>
                                                </select>
                                            </div>

                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="ri-close-line align-bottom"></i> Close</button>
                                                <button type="submit" class="btn btn-success" id="addNewFile">Grabar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->



    <!-- removeItemModal -->
    <div id="removeItemModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                            colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Are you Sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Product ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn w-sm btn-danger " id="delete-product">Yes, Delete It!</button>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
