<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="orderList">
                <div class="card-header  border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">Departamentos</h5>
                        <div class="flex-shrink-0">
                            <button type="button" wire:click.prevent="add()" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn"
                                data-bs-target=""><i class="ri-add-line align-bottom me-1"></i> Create
                                </button>
                            <!--<button type="button" class="btn btn-info"><i
                                    class="ri-file-download-line align-bottom me-1"></i> Import</button>
                            <button class="btn btn-danger" onClick="deleteMultiple()"><i
                                    class="ri-delete-bin-2-line"></i></button>-->
                        </div>
                    </div>
                </div>
                <div class="card-body border border-dashed border-end-0 border-start-0">
                    <form>
                        <div class="row g-3">
                            <div class="col-xxl-5 col-sm-6">
                                <div class="search-box">
                                    <input type="text" class="form-control search"
                                        placeholder="Search for order ID, customer, order status or something...">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                            <!--end col-->
                            <!--<div class="col-xxl-2 col-sm-6">
                                <div>
                                    <input type="text" class="form-control" data-provider="flatpickr"
                                        data-date-format="d M, Y" data-range-date="true" id="demo-datepicker"
                                        placeholder="Select date">
                                </div>
                            </div>-->
                            <!--end col-->
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <select class="form-control" data-choices data-choices-search-false
                                        name="choices-single-default" id="idStatus">
                                        <option value="">Status</option>
                                        <option value="all" selected>All</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Inprogress">Inprogress</option>
                                        <option value="Cancelled">Cancelled</option>
                                        <option value="Pickups">Pickups</option>
                                        <option value="Returns">Returns</option>
                                        <option value="Delivered">Delivered</option>
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <select class="form-control" data-choices data-choices-search-false
                                        name="choices-single-default" id="idPayment">
                                        <option value="">Select Payment</option>
                                        <option value="all" selected>All</option>
                                        <option value="Mastercard">Mastercard</option>
                                        <option value="Paypal">Paypal</option>
                                        <option value="Visa">Visa</option>
                                        <option value="COD">COD</option>
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
                            <!--<li class="nav-item">
                                <a class="nav-link active All py-3" data-bs-toggle="tab" id="All" href="#home1" role="tab"
                                    aria-selected="true">
                                    <i class="ri-store-2-fill me-1 align-bottom"></i> All Orders
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link py-3 Delivered" data-bs-toggle="tab" id="Delivered" href="#delivered"
                                    role="tab" aria-selected="false">
                                    <i class="ri-checkbox-circle-line me-1 align-bottom"></i> Delivered
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link py-3 Pickups" data-bs-toggle="tab" id="Pickups" href="#pickups"
                                    role="tab" aria-selected="false">
                                    <i class="ri-truck-line me-1 align-bottom"></i> Pickups <span
                                        class="badge bg-danger align-middle ms-1">2</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link py-3 Returns" data-bs-toggle="tab" id="Returns" href="#returns"
                                    role="tab" aria-selected="false">
                                    <i class="ri-arrow-left-right-fill me-1 align-bottom"></i> Returns
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link py-3 Cancelled" data-bs-toggle="tab" id="Cancelled" href="#cancelled"
                                    role="tab" aria-selected="false">
                                    <i class="ri-close-circle-line me-1 align-bottom"></i> Cancelled
                                </a>
                            </li>-->
                        </ul>

                        <div class="table-responsive table-card mb-1">
                            <table class="table table-nowrap align-middle" id="orderTable">
                                <thead class="text-muted table-light">
                                    <tr class="text-uppercase">
                                        <!--<th scope="col" style="width: 25px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="checkAll"
                                                    value="option">
                                            </div>
                                        </th>-->
                                        <th class="sort" data-sort="id"> ID</th>
                                        <th class="sort" data-sort="description">Descripción</th>
                                        <th class="sort" data-sort="area">Area</th>
                                        <th class="sort" data-sort="administrator">Administrador</th>
                                        <th class="sort" data-sort="ledger_account">Cuenta Contable</th>
                                        <th class="sort" data-sort="cost_center">Centro de Costo</th>
                                        <th class="sort" data-sort="status">Estado</th>
                                        <th class="sort" data-sort="city">Acción</th>
                                        
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                @foreach ($tblrecords as $tblrecord)    
                                    <tr>
                                        <td>{{$tblrecord->id}}</td>
                                        <td>{{$tblrecord->descripcion}}</td> 
                                        <td>{{$tblrecord->idarea}}</td> 
                                        <td>{{$tblrecord->idpersonal}}</td> 
                                        <td>{{$tblrecord->idcuenta}}</td>    
                                        <td>{{$tblrecord->idccosto}}</td>
                                        <td>{{$tblrecord->estado}}</td>
                                        <td>
                                            <ul class="list-inline hstack gap-2 mb-0">
                                                <li class="list-inline-item edit" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                    <a href="" wire:click.prevent="edit({{ $tblrecord }})">
                                                        <i class="ri-pencil-fill fs-16"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                    <a class="text-danger d-inline-block remove-item-btn"
                                                        data-bs-toggle="modal" href="" wire:click.prevent="delete({{ $tblrecord->id }})">
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
                        <div class="d-flex justify-content-end">
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

                    <div wire.ignore.self class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" >
                            <div class="modal-content">
                                
                                <div class="modal-header bg-light p-3">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        @if($showEditModal)
                                            <span>Editar Departamento &nbsp;</span>
                                        @else
                                            <span>Agregar Departamento  &nbsp;</span>
                                        @endif
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                </div>
                                <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateData' : 'createData' }}">
                                    
                                    <div class="modal-body">
                                        <!--<input type="hidden" id="id-field" />-->

                                        <div class="id" id="modal-id">
                                            @if($showEditModal)
                                                <label for="tblrecord.id" class="form-label">ID</label>
                                                <input type="text" wire:model.defer="tblrecord.id" class="form-control" placeholder="ID" readonly />
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <label for="tblrecord.descripcion" class="form-label">Description</label>
                                            <input type="text" wire:model.defer="tblrecord.descripcion" class="form-control" name="tblrecord.descripcion"
                                                placeholder="Enter name" required />
                                        </div>

                                        <div class="mb-3">
                                            <label for="tblrecord.idarea" class="form-label">Description</label>
                                            <select class="form-select" data-trigger name="tblrecord.idarea" wire:model.defer="tblrecord.idarea">
                                                @foreach ($tblareas as $tblarea)  
                                                    <option value={{$tblarea->id}}>{{$tblarea->descripcion}}</option>
                                                @endforeach
                                             </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="tblrecord.idpersonal" class="form-label">Administrator</label>
                                            <select class="form-select" data-trigger name="tblrecord.idpersonal" wire:model.defer="tblrecord.idpersonal">
                                                <option value="0">Administrator</option>
                                            </select>
                                        </div>

                                        <!--<div class="mb-3">
                                            <label for="date-field" class="form-label">Order
                                                Date</label>
                                            <input type="date" id="date-field" class="form-control"
                                                data-provider="flatpickr" data-date-format="d M, Y" data-enable-time
                                                required placeholder="Select date" />
                                        </div>-->

                                        <!--<div class="mb-3">
                                            <label for="tblrecord.idcuenta" class="form-label">Ledger Account</label>
                                            <select class="form-control" data-trigger name="tblrecord.idcuenta" wire:model.defer="tblrecord.idcuenta">
                                                <option value="0">Ledger Account</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="tblrecord.idccosto" class="form-label">Cost Center</label>
                                            <select class="form-control" data-trigger name="tblrecord.idccosto" wire:model.defer="tblrecord.idccosto">
                                                <option value="0">Cost Center</option>
                                            </select>
                                        </div>-->

                                        <div>
                                            <label for="tblrecord.estado" class="form-label">Status</label>
                                            <select class="form-control" data-trigger name="tblrecord.estado" wire:model.defer="tblrecord.estado">
                                                <option value="A">Active</option>
                                                <option value="I">Inactivate</option>
                                            </select>
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
                                        <p class="text-muted fs-15 mb-4">DDeleting the record will remove
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
