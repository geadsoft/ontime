<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center flex-wrap gap-2">
                        <div class="flex-grow-1">
                            <button wire:click.prevent="add()" class="btn btn-info add-btn" data-bs-toggle="modal" data-bs-target=""><i
                                    class="ri-add-fill me-1 align-bottom"></i> Agregar Compañia</button>
                        </div>
                        <!--<div class="flex-shrink-0">
                            <div class="hstack text-nowrap gap-2">
                                <button class="btn btn-soft-danger" onClick="deleteMultiple()"><i
                                        class="ri-delete-bin-2-line"></i></button>
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addmembers"><i
                                        class="ri-filter-2-line me-1 align-bottom"></i> Filters</button>
                                <button class="btn btn-soft-success">Import</button>
                                <button type="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false"
                                    class="btn btn-soft-info"><i class="ri-more-2-fill"></i></button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                    <li><a class="dropdown-item" href="#">All</a></li>
                                    <li><a class="dropdown-item" href="#">Last Week</a></li>
                                    <li><a class="dropdown-item" href="#">Last Month</a></li>
                                    <li><a class="dropdown-item" href="#">Last Year</a></li>
                                </ul>
                            </div>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
        <div class="col-xxl-9">
            <div class="card" id="companyList">
                <div class="card-header">
                    <div class="row g-2">
                        <!--<div class="col-md-3">
                            <div class="search-box">
                                <input type="text" class="form-control search" placeholder="Search for company...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>-->
                        <div class="col-md-auto ms-auto">
                            <div class="d-flex align-items-center gap-2">
                                <span class="text-muted">Ordenar por: </span>
                                <select class="form-control mb-0" data-choices data-choices-search-false
                                    id="choices-single-default">
                                    <option value="Owner">Representante</option>
                                    <option value="Company">Compañia</option>
                                    <option value="location">Ubicación</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div>
                        <div class="table-responsive table-card mb-3">
                            <table class="table align-middle table-nowrap mb-0" id="customerTable">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 50px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="checkAll"
                                                    value="option">
                                            </div>
                                        </th>
                                        <th class="sort" data-sort="name" scope="col">Compañia</th>
                                        <th class="sort" data-sort="owner" scope="col">Nombre Comercial</th>
                                        <th class="sort" data-sort="owner" scope="col">Representante</th>
                                        <th class="sort" data-sort="industry_type" scope="col">Ciudad</th>
                                        <th class="sort" data-sort="location" scope="col">Ubicación</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="chk_child"
                                                    value="option1">
                                            </div>
                                        </th>
                                        @foreach ($tblrecords as $record)    
                                            
                                                <td>{{$record->razonsocial}}</td>
                                                <td>{{$record->nombrecomercial}}</td> 
                                                <td>{{$record->representante}}</td> 
                                                <td>{{$record->ciudad}}</td>
                                                <td>{{$record->ubicacion}}</td>
                                                <td>
                                                    <ul class="list-inline hstack gap-2 mb-0">
                                                        
                                                        <li class="list-inline-item" data-bs-toggle="tooltip"
                                                            data-bs-trigger="hover" data-bs-placement="top" title="View">
                                                            <a href="" wire:click.prevent="view({{ $record->id }})" class="view-item-btn"><i
                                                                    class="ri-eye-fill align-bottom text-muted"></i></a>
                                                        </li>
                                                        <li class="list-inline-item" data-bs-toggle="tooltip"
                                                            data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                            <a class="edit-item-btn" href="" wire:click.prevent="edit({{ $record }})" data-bs-toggle="modal"><i
                                                                    class="ri-pencil-fill align-bottom text-muted"></i></a>
                                                        </li>
                                                        <li class="list-inline-item" data-bs-toggle="tooltip"
                                                            data-bs-trigger="hover" data-bs-placement="top" title="Delete">
                                                            <a class="remove-item-btn" data-bs-toggle="modal"
                                                                href="" wire:click.prevent="">
                                                                <i class="ri-delete-bin-fill align-bottom text-muted"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            
                                        @endforeach
                                        
                                        <!--                                        
                                        <td class="id" style="display:none;"><a href="javascript:void(0);"
                                                class="fw-medium link-primary">#VZ001</a></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <img src="{{ URL::asset('assets/images/brands/dribbble.png') }}"
                                                        alt="" class="avatar-xxs rounded-circle image_src object-cover">
                                                </div>
                                                <div class="flex-grow-1 ms-2 name">Nesta Technologies
                                                </div>
                                            </div>
                                        </td>
                                        <td class="owner">Tonya Noble</td>
                                        <td class="industry_type">Computer Industry</td>
                                        <td><span class="star_value">4.5</span> <i
                                                class="ri-star-fill text-warning align-bottom"></i></td>
                                        <td class="location">Los Angeles, USA</td>
                                        <td>
                                            <ul class="list-inline hstack gap-2 mb-0">
                                                
                                                <li class="list-inline-item" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top" title="View">
                                                    <a href="javascript:void(0);" class="view-item-btn"><i
                                                            class="ri-eye-fill align-bottom text-muted"></i></a>
                                                </li>
                                                <li class="list-inline-item" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                    <a class="edit-item-btn" href="" wire:click.prevent="" data-bs-toggle="modal"><i
                                                            class="ri-pencil-fill align-bottom text-muted"></i></a>
                                                </li>
                                                <li class="list-inline-item" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top" title="Delete">
                                                    <a class="remove-item-btn" data-bs-toggle="modal"
                                                        href="" wire:click.prevent="delete()">
                                                        <i class="ri-delete-bin-fill align-bottom text-muted"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>-->
                                    </tr>

                                </tbody>
                            </table>
                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                        colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                    </lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                    <p class="text-muted mb-0">We've searched more than 150+ companies
                                        We did not find any
                                        companies for you search.</p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <div class="pagination-wrap hstack gap-2">
                                <a class="page-item pagination-prev disabled" href="#">
                                    Previous
                                </a>
                                <ul class="pagination listjs-pagination mb-0"></ul>
                                <a class="page-item pagination-next" href="#">
                                    Next
                                </a>
                            </div>
                        </div>
                    </div>
                    <div wire.ignore.self class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content border-0">
                                <div class="modal-header bg-soft-info p-3">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        @if($showEditModal)
                                            <span>Editar Compañia  &nbsp;</span>
                                        @else
                                            <span>Nueva Compañia  &nbsp;</span>
                                        @endif                                    
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                        id="close-modal"></button>
                                </div>
                                <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateData' : 'createData' }}">
                                    <div class="modal-body">
                                        <input type="hidden" id="id-field" />
                                        <div class="row g-3">
                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                    <div class="position-relative d-inline-block">
                                                        <div class="position-absolute bottom-0 end-0">
                                                            <label for="company-logo-input" class="mb-0"  data-bs-toggle="tooltip" data-bs-placement="right" title="Select Image">
                                                                <div class="avatar-xs cursor-pointer">
                                                                    <div class="avatar-title bg-light border rounded-circle text-muted">
                                                                        <i class="ri-image-fill"></i>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                            <input class="form-control d-none" value="" id="company-logo-input" type="file"
                                                                accept="image/png, image/gif, image/jpeg">
                                                        </div>
                                                        <div class="avatar-lg p-1">
                                                            <div class="avatar-title bg-light rounded-circle">
                                                                <img src="{{ URL::asset('assets/images/users/multi-user.jpg') }}"
                                                        alt="" id="companylogo-img" class="avatar-md rounded-circle object-cover">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h5 class="fs-13 mt-3">Loco Compañia</h5>
                                                </div>
                                                <div>
                                                    <label for="record.razonsocial"
                                                        class="form-label">Razón Social</label>
                                                    <input type="text" wire:model.defer="record.razonsocial"
                                                        class="form-control"
                                                        placeholder="Ingrese la Razón Social" required />
                                                </div>
                                                
                                            </div>
                                            <div class="col-lg-12">
                                                <div>
                                                    <label for="record.nombrecomercial"
                                                        class="form-label">Nombre Comercial</label>
                                                    <input type="text" wire:model.defer="record.nombrecomercial"
                                                        class="form-control"
                                                        placeholder="Ingrese Nombre Comercial" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div>
                                                    <label for="record.ruc" class="form-label">RUC</label>
                                                    <input type="text" wire:model.defer="record.ruc" class="form-control"
                                                        placeholder="Ingrese Ruc" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div>
                                                    <label for="record.telefono" class="form-label">Teléfono</label>
                                                    <input type="text" wire:model.defer="record.telefono" class="form-control"
                                                        placeholder="Ingrese Teléfono" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div>
                                                    <label for="record.provincia" class="form-label">Provincia</label>
                                                    <input type="text"  wire:model.defer="record.provincia" class="form-control"
                                                        placeholder="Ingrese Provincia" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div>
                                                    <label for="record.ciudad" class="form-label">Ciudad</label>
                                                    <input type="text" wire:model.defer="record.ciudad" class="form-control"
                                                        placeholder="Ingrese ciudad" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div>
                                                    <label for="record.canton" class="form-label">Cantón</label>
                                                    <input type="text" wire:model.defer="record.canton" class="form-control"
                                                        placeholder="Ingrese Cantón" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div>
                                                    <label for="record.ubicacion" class="form-label">Ubicación</label>
                                                    <input type="text" wire:model.defer="record.ubicacion" class="form-control"
                                                        placeholder="Ingrese Ubicación" required />
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-6">
                                                <div>
                                                    <label for="record.representante" class="form-label">Representante Legal</label>
                                                    <input type="text" wire:model.defer="record.representante" class="form-control"
                                                        placeholder="Ingrese Representante Legal" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div>
                                                    <label for="record.identificacion" class="form-label">Identificación</label>
                                                    <input type="text" wire:model.defer="record.identificacion" class="form-control"
                                                        placeholder="Ingrese Identificación" required />
                                                </div>
                                            </div>
                                                                                     
                                            <div class="col-lg-6">
                                                <div>
                                                    <label for="record.website" class="form-label">Pagina Web</label>
                                                    <input type="text" wire:model.defer="record.website"  class="form-control"
                                                        placeholder="Ingrese Pagina Web" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div>
                                                    <label for="record.email" class="form-label">Contacto Email</label>
                                                    <input type="text" wire:model.defer="record.email" class="form-control"
                                                        placeholder="Ingrese Mail" required />
                                                </div>
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
                    <!--end add modal-->

                    <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-labelledby="deleteRecordLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                        id="btn-close"></button>
                                </div>
                                <div class="modal-body p-5 text-center">
                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                        colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px">
                                    </lord-icon>
                                    <div class="mt-4 text-center">
                                        <h4 class="fs-semibold">You are about to delete a company ?</h4>
                                        <p class="text-muted fs-14 mb-4 pt-1">Deleting your company will
                                            remove all of your information from our database.</p>
                                        <div class="hstack gap-2 justify-content-center remove">
                                            <button class="btn btn-link link-success fw-medium text-decoration-none"
                                                data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i>
                                                Close</button>
                                            <button class="btn btn-danger" id="delete-record">Yes,
                                                Delete It!!</button>
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
        <div class="col-xxl-3">
            <div class="card" id="company-view-detail">
                <div class="card-body text-center">
                    <div class="position-relative d-inline-block">
                        <div class="avatar-md">
                            <div class="avatar-title bg-light rounded-circle">
                                <img src="{{ URL::asset('assets/images/brands/logocia.png') }}" alt=""
                                    class="avatar-sm rounded-circle object-cover">
                            </div>
                        </div>
                    </div>
                    <h5 class="mt-3 mb-1">{{ $existsrecno ? $view->id : '' }}</h5>
                    <p class="text-muted">{{ $existsrecno ? $view->representante : '' }}</p>

                    <ul class="list-inline mb-0">
                        <li class="list-inline-item avatar-xs">
                            <a href="javascript:void(0);" class="avatar-title bg-soft-success text-success fs-15 rounded">
                                <i class="ri-global-line"></i>
                            </a>
                        </li>
                        <li class="list-inline-item avatar-xs">
                            <a href="javascript:void(0);" class="avatar-title bg-soft-danger text-danger fs-15 rounded">
                                <i class="ri-mail-line"></i>
                            </a>
                        </li>
                    
                    </ul>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="fw-medium" scope="row">Nombre Comercial</td>
                                    <td>{{ $existsrecno ? $view->nombrecomercial : '' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium" scope="row">Ruc</td>
                                    <td>{{ $existsrecno ? $view->ruc : '' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium" scope="row">Teléfono</td>
                                    <td>{{ $existsrecno ? $view->telefono : '' }}<i class="ri-star-fill text-warning align-bottom"></i></td>
                                </tr>
                                <tr>
                                    <td class="fw-medium" scope="row">Provincia</td>
                                    <td>{{ $existsrecno ? $view->provincia : '' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium" scope="row">Ciudad</td>
                                    <td>{{ $existsrecno ? $view->ciudad : '' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium" scope="row">Ubicación</td>
                                    <td>{{ $existsrecno ? $view->ubicacion : '' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium" scope="row">Pagina Web</td>
                                    <td>
                                        <a href="javascript:void(0);"
                                            class="link-primary text-decoration-underline">{{ $existsrecno ? $view->website : '' }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-medium" scope="row">Contacto Email</td>
                                    <td>{{ $existsrecno ? $view->email : '' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium" scope="row"></td>
                                    <td></td>
                                </tr>
                                <br>
                                <br>
                                <br>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div>
</div>
