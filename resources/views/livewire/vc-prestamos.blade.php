<div>
    <div class="row">
        <form autocomplete="off" wire:submit.prevent="{{ 'createData' }}" id="encashment_form">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="card-header">
                                <h5 class="card-title flex-grow-1 mb-0 text-primary"><i
                                    class="mdi mdi-account-cash align-middle me-1 text-success"></i>
                                    Datos Generales</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="row g-3">
                                <div class="col-lg-2 col-sm-6">
                                    <label for="cmbtiporol" class="form-label">Emisión</label>
                                    <div>
                                        <input id="dfechaini" name="dateIni" type="date" class="form-control" data-provider="flatpickr" data-date-format="d-m-Y" data-time="true" wire:model.defer="record.fecha" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 ">
                                    <label for="cmbtiporol" class="form-label">Empleado</label>
                                    <div class="input-group">
                                        <select type="select" class="form-control" data-trigger id="cmbtiporol" wire:model="record.persona_id" wire:change="loadperiodo()" required>
                                            <option value="">Seleccione Empleado</option>
                                            @foreach ($tblpersonas as $personas)
                                                @if ($record['persona_id'] == $personas->id)
                                                    <option value="{{$personas->id}}" Selected>{{$personas->apellidos}} {{$personas->nombres}}</option>
                                                @else
                                                     <option value="{{$personas->id}}">{{$personas->apellidos}} {{$personas->nombres}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <a id="btnstudents" class ="input-group-text btn btn-soft-info" wire:click=""><i class="ri-search-2-line"></i></a>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label for="txtconcepto" class="form-label">Concepto</label>
                                        <select type="select" class="form-select" id="cmbtipo" placeholder="Ingrese el concepto" wire:model.defer="record.tipoprestamo_id" required>
                                            <option value="">Seleccione Concepto</option>
                                            @foreach ($tbltipo as $tipo)
                                                <option value="{{$tipo->id}}">{{$tipo->descripcion}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label for="cmbrubros" class="form-label">Rubro</label>
                                    <select type="select" class="form-select" data-trigger id="cmbrubros" wire:model.defer="record.rubrosrol_id" required>
                                        <option value="">Seleccione rubro</option>
                                        @foreach ($tblrubros as $rubros)
                                            <option value="{{$rubros->id}}">{{$rubros->descripcion}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="cmbperiodo" class="form-label">Periodo</label>
                                    <select type="select" class="form-select" data-trigger id="cmbperiodo" wire:model.defer="record.periodosrol_id" required>
                                        <option value="">Seleccione periodo</option>
                                        @foreach ($tblperiodos as $periodo)
                                            <option value="{{$periodo->id}}">{{$periodo->fechafin}}</option>
                                        @endforeach                                    
                                    </select>
                                </div>
                                <div class="col-lg-2 col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="txtvalor">Monto</label>
                                        <input type="number" class="form-control  product-price" id="txtvalor" step="0.01" placeholder="0.00" wire:model.defer="record.monto" required>
                                    </div>
                                </div>  
                                <div class="col-lg-1 col-sm-6">
                                    <div class="mb-3">
                                        <label for="txtplazo" class="form-label"># Cuotas</label>
                                        <input type="number" class="form-control" id="txtplazo" placeholder="1" wire:model.defer="record.cuota" required>
                                    </div>
                                </div>                      
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3"> 
                                <label for="txtplazo" class="form-label">Comentario</label>   
                                <textarea type="text" class="form-control" id="txtcomentario" placeholder="Ingrese su comentario" wire:model.defer="record.comentario" required>
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
            <div class="col-xxl-12">
                <div class="card" id="contactList">
                    @if(!is_null($cuotas))
                    <div class="card-header">
                        <label class="form-label">Detalle de Cuotas</label>
                    </div>                
                    <div class="card-body">
                        <div>
                            <div class="table-responsive table-card mb-3">
                                <div style="overflow-x:auto;">
                                <table class="table table-nowrap align-middle" style="width:100%">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col"># Cuota</th>
                                            <th scope="col">Fecha</th>
                                            <th scope="col">Valor</th>
                                            <th scope="col">Estado</th>                                         
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        @foreach ($cuotas as $record)    
                                            <tr>
                                                <td>{{$record->cuota}}</td>
                                                <td>{{date('d/m/Y', strtotime($record->fecha))}}</td> 
                                                <td>{{$record->valor}}</td>
                                                <td>
                                                    @if($record->estado=='P')
                                                        <span class="badge badge-soft-success text-uppercase">Pendiente</span>
                                                    @else
                                                        <span class="badge badge-soft-info text-uppercase">Cancelado</span>
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
                    @endif
                </div>
                <!--end card-->
            </div>
            <!--end col-->
            
            <!--end col-->
            <div class="row g-3">
                <div class="col-md-auto ms-auto">
                    <div class="justify-content-center">
                        <button type="submit" class="btn btn-success w-sm" ><i class="ri-save-3-fill align-bottom me-1"></i>Grabar</button>
                    </div>
                </div>
            </div>
        </form>
        
    </div>
    <!--end row-->
</div>

