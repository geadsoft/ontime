<div>
    <form id="addrubro-form" autocomplete="off" class="needs-validation" wire:submit.prevent="createData()">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label for="cmbtiporol" class="form-label">Periodo</label>
                            <select type="select" class="form-select" data-trigger id="cmbtiporol" wire:model.defer="periodoId" required>
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
                                <button type="button" wire:click.prevent="add()" class="btn btn-danger add-btn" data-bs-toggle="modal" id="create-btn"
                                    data-bs-target=""><i class="ri-file-copy-fill align-bottom me-1"></i> Ver Rubros
                                </button>
                                <button type="sumit" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn"
                                    data-bs-target=""><i class="ri-save-3-fill align-bottom me-1"></i> Grabar
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
                                                    <input type="number" step="0.01"  style="width:80px" class="form-control form-control-sm product-price"
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
                        </div>                 
                    </div>
                </div>
            </div>
            <!--end card-->
        </div>
        <!--end col-->
        
        <!--end col-->
    </div>
    <!--end row-->
    </form>
</div>

