<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-0">

                        <div class="d-flex align-items-center">
                            <h5 class="card-title mb-0 flex-grow-1">Listado de Personal</h5>
                            <div class="flex-shrink-0">
                                <button type="button" wire:click.prevent="add()" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn"
                                    data-bs-target=""><i class="ri-add-line align-bottom me-1"></i> Agregar
                                </button>
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
                            <div class="search-box">
                                <input type="text" class="form-control search"
                                    placeholder="Buscar por apellidos o nombres..." wire:model="filters.srv_nombre">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <div class="col-md-auto ms-auto">
                            <div class="hstack text-nowrap gap-2">
                                <button class="btn btn-soft-secondary">PDF</button>
                                <button class="btn btn-soft-secondary">Excel</button>
                                <button class="btn btn-soft-secondary">Print</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div>
                        <div class="table-responsive table-card mb-3">
                            <table class="table table-nowrap align-middle mb-0" id="customerTable">
                                <thead class="text-muted table-light">
                                    <tr class="text-uppercase">
                                        <th scope="col" style="width: 50px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="checkAll" value="option">
                                            </div>
                                        </th>
                                        <!--<th class="sort" data-sort="id" scope="col">ID</th>-->
                                        <th class="sort" data-sort="name" scope="col">Identification</th>
                                        <th class="sort" data-sort="company_name" scope="col">Nombre</th>
                                        <th class="sort" data-sort="phone" scope="col">Fecha Nacimiento</th>
                                        <th class="sort" data-sort="lead_score" scope="col">Estado Civil</th>
                                        <th class="sort" data-sort="tags" scope="col">Telefono(s)</th>
                                        <th class="sort" data-sort="tags" scope="col">Estado</th>
                                        <th scope="col">Acción</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                @foreach ($tblrecords as $record)
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                                            </div>
                                        </th>
                                        
                                        <td>{{$record->nui}}</td>
                                        <td>{{$record->apellidos}} {{$record->nombres}}</td>
                                        <td>{{date('d/m/Y',strtotime($record->fecha_nace))}}</td>
                                        <td>{{$ecivil[$record->estado_civil]}}</td>
                                        <td>{{$record->telefono}}</td>
                                        <td>
                                            @if($record->estado=='Q')
                                                <span class="badge badge-soft-danger text-uppercase">{{$estado[$record->estado]}}</span>
                                            @else
                                                <span class="badge badge-soft-success text-uppercase">{{$estado[$record->estado]}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <ul class="list-inline hstack gap-2 mb-0">
                                                <!--<li class="list-inline-item" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top" title="View">
                                                    <a href="" wire:click.prevent="view({{ $record->id }})" class="view-item-btn"><i
                                                            class="ri-eye-fill align-bottom text-muted"></i></a>
                                                </li>-->
                                                <li class="list-inline-item" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                    <a href="" class="edit-item-btn" wire:click.prevent="edit({{ $record->id }})"><i
                                                            class="ri-pencil-fill align-bottom text-muted"></i></a>
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
                        {{$tblrecords->links('')}}
                    </div>
                    
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
                    <!--end delete modal -->

                </div>
            </div>
            <!--end card-->
        </div>
        <!--end col-->
        
        <!--end col-->
    </div>
    <!--end row-->
</div>
