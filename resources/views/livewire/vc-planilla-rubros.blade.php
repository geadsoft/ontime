<div>
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
                                <button type="button" wire:click.prevent="add()" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn"
                                    data-bs-target=""><i class="ri-add-line align-bottom me-1"></i> Add New Staff
                                </button>
                                <button type="button" wire:click.prevent="createData()" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn"
                                    data-bs-target=""><i class="ri-add-line align-bottom me-1"></i> Grabar
                                </button>
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
                            <div class="search-box">
                                <input type="text" class="form-control search"
                                    placeholder="Search for contact..." wire:model="">
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
                                        <th scope="col" style="display:none">Id</th>
                                        <th scope="col">Nui</th>
                                        <th scope="col">Nombre</th>
                                        
                                         @foreach ($rubros as $data)
                                            <th scope="col" style="width: 150px;">{{$data->etiqueta}}</th>
                                         @endforeach
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    
                                    @foreach ($tblrecords as $fil => $data)
                                        <tr id="{{$fil}}" class="detalle">
                                            <th scope="row">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="chk_child"
                                                        value="option1">
                                                </div>
                                            </th>
                                            @for ($col=0;$col<count($rubros)+3;$col++)

                                                @if ($col>=3)
                                                    <td>
                                                    <input type="number" style="width:80px" class="form-control form-control-sm product-price"
                                                     id="col-{{$col}}" wire:model="tblrecords.{{$fil}}.{{$col}}" />
                                                    </td>
                                                @else
                                                    @switch ($col)
                                                    @case(1)
                                                        <td>
                                                        <input type="text" style="width:100px" class="form-control form-control-sm product-price" id="col-{{$col}}" value="{{$data[$col]}}" disabled/>
                                                        </td>
                                                        @break
                                                    @case(2)
                                                        <td>
                                                        <input type="text" style="width:230px" class="form-control form-control-sm product-price" id="col-{{$col}}" value="{{$data[$col]}}" disabled/>
                                                        </td>
                                                        @break
                                                    @default
                                                        <td style="display:none">
                                                        <input type="text" class="form-control form-control-sm product-price" id="col-{{$col}}" value="{{$data[$col]}}" disabled/>
                                                        </td>
                                                    @endswitch
                                                @endif
                                                
                                            @endfor
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
                    
                    <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close" id="btn-close"></button>
                                </div>
                                <div class="modal-body p-5 text-center">
                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json"
                                        trigger="loop" colors="primary:#405189,secondary:#f06548"
                                        style="width:90px;height:90px"></lord-icon>
                                    <div class="mt-4 text-center">
                                        <h4 class="fs-semibold">You are about to delete a contact ?</h4>
                                        <p class="text-muted fs-14 mb-4 pt-1">Deleting your contact will
                                            remove all of your information from our database.</p>
                                        <div class="hstack gap-2 justify-content-center remove">
                                            <button
                                                class="btn btn-link link-success fw-medium text-decoration-none"
                                                data-bs-dismiss="modal"><i
                                                    class="ri-close-line me-1 align-middle"></i>
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
        
        <!--end col-->
    </div>
    <!--end row-->
</div>

