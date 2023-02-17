<div>
    <form id="addrubro-form" autocomplete="off" wire:submit.prevent="{{ $AddNew ? 'updateData' : 'createData' }}">
        <div class="row">
            <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="record.descripcion" class="form-label">Descripción</label>
                                <input type="text" wire:model.defer="record.descripcion" class="form-control" name="record.descripcion"
                                    placeholder="Ingrese Descripción" required />
                            </div>
                            
                            <div class="mb-3">
                                <label for="record.tipo" class="form-label">Tipo</label>
                                <select type="select" class="form-select" data-trigger name="record.tipo" wire:model.defer="record.tipo" required>
                                <option value="P">Percepción</option>
                                <option value="D">Deducción</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="record.etiqueta" class="form-label">Etiqueta</label>
                                <input type="text" wire:model.defer="record.etiqueta" class="form-control" name="record.etiqueta"
                                    placeholder="Ingrese Descripción" required />
                            </div>

                            <!--<div>
                                <label>Product Description</label>

                                <div id="ckeditor-classic">
                                    <p>Tommy Hilfiger men striped pink sweatshirt. Crafted with cotton. Material composition is 100% organic cotton. This is one of the world’s leading designer lifestyle brands and is internationally recognized for celebrating the essence of classic American cool style, featuring preppy with a twist designs.</p>
                                    <ul>
                                        <li>Full Sleeve</li>
                                        <li>Cotton</li>
                                        <li>All Sizes available</li>
                                        <li>4 Different Color</li>
                                    </ul>
                                </div>
                            </div>-->
                        </div>
                    </div>
                    <!-- end card -->

                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#addproduct-general-info"
                                        role="tab">
                                        Base Cálculo
                                    </a>
                                </li>
                                <!--<li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#addproduct-metadata"
                                        role="tab">
                                        Pago
                                    </a>
                                </li>-->
                            </ul>
                        </div>
                        <!-- end card header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="addproduct-general-info" role="tabpanel">
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="rubro-select">Rubro</label>
                                                <select type="select" class="form-select" data-trigger name="rubro-select" wire:model.defer="rubros.baserubrorol_id">
                                                <option value="">Seleccione Rubro</option>
                                                @foreach ($tblrubros as $rubro)
                                                    <option value="{{$rubro->id}}">{{$rubro->descripcion}}</option>
                                                @endforeach                                                
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="importe-input">Importe</label>
                                                <input type="number" class="form-control  product-price" id="importe-input" step="0.01" placeholder="0.00" wire:model.defer="rubros.importe">
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-sm-6">
                                             <div class="mb-3">
                                                <label class="form-label" for="constante-input">Constante</label>
                                                <input type="number" class="form-control  product-price" id="constante-input" step="0.01" placeholder="0.00" wire:model.defer="rubros.constante">
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-sm-6 text-center">
                                            <div class="mb-3">
                                             <label class="form-label">-</label>                                     
                                             <a id="add_base" class ="form-control btn btn-soft-secondary" wire:click="addRubro()" ><i class="ri-add-fill me-1"></i> Agregar</a>
                                             <!--<button type="button" wire:click="addRubro()" class="btn btn-soft-secondary" id="addrubro-btn"><i class="ri-add-fill me-1"></i> Add
                                            </button>-->
                                            </div>
                                        </div>
                                        <!-- end col -->
                                        
                                    </div>
                                    
                                    <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3">
                                    </ul>
                                    <div class="table-responsive table-card mb-1">
                                        <table class="table table-nowrap align-middle" id="orderTable">
                                            <thead class="text-muted table-light">
                                                <tr class="text-uppercase">
                                                    <th class="sort">Descripción</th>
                                                    <th class="sort">Importe</th>
                                                    <th class="sort">Constante</th>
                                                    <th >Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                            @foreach ($baseRubros as $record)
                                            <tr>
                                                <td> 
                                                    <select type="select" class="form-control" data-trigger name="detrubro" value="{{$record['baserubrorol_id']}}" disabled>
                                                    @foreach ($tblrubros as $rubro)
                                                        @if ($record['baserubrorol_id']==$rubro->id)
                                                            <option value="{{$rubro->id}}" selected>{{$rubro->descripcion}}</option>
                                                        @else
                                                            <option value="{{$rubro->id}}">{{$rubro->descripcion}}</option>
                                                        @endif
                                                    @endforeach                                                
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control  product-price" id="detimporte" step="0.01" placeholder="0.00" value= {{number_format($record['importe'],2)}} disabled>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control  product-price" id="detcontante" step="0.01" placeholder="0.00" value={{number_format($record['constante'],2)}} disabled>
                                                </td>
                                                <td>
                                                    <ul class="list-inline hstack gap-2 mb-0">
                                                        <li class="list-inline-item" data-bs-toggle="tooltip"
                                                            data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                            <a class="text-danger d-inline-block remove-item-btn"
                                                                data-bs-toggle="modal" href="" wire:click.prevent="deleteBase({{ $record['id'] }})">
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

                                    <!-- end row -->
                                </div>
                                <!-- end tab-pane -->

                                <div class="tab-pane" id="addproduct-metadata" role="tabpanel">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="checkbox" id="formCheck6">
                                                    <label class="form-check-label" for="formCheck6">
                                                        Enero
                                                    </label>
                                                </div>
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="checkbox" id="formCheck6">
                                                    <label class="form-check-label" for="formCheck6">
                                                        Febrero
                                                    </label>
                                                </div>
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="checkbox" id="formCheck6">
                                                    <label class="form-check-label" for="formCheck6">
                                                        Marzo
                                                    </label>
                                                </div>
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="checkbox" id="formCheck6">
                                                    <label class="form-check-label" for="formCheck6">
                                                        Abril
                                                    </label>
                                                </div>
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="checkbox" id="formCheck6">
                                                    <label class="form-check-label" for="formCheck6">
                                                        Mayo
                                                    </label>
                                                </div>
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="checkbox" id="formCheck6">
                                                    <label class="form-check-label" for="formCheck6">
                                                        Junio
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="checkbox" id="formCheck6">
                                                    <label class="form-check-label" for="formCheck6">
                                                        Julio
                                                    </label>
                                                </div>
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="checkbox" id="formCheck6">
                                                    <label class="form-check-label" for="formCheck6">
                                                        Agosto
                                                    </label>
                                                </div>
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="checkbox" id="formCheck6">
                                                    <label class="form-check-label" for="formCheck6">
                                                        Septiembre
                                                    </label>
                                                </div>
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="checkbox" id="formCheck6">
                                                    <label class="form-check-label" for="formCheck6">
                                                        Octubre
                                                    </label>
                                                </div>
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="checkbox" id="formCheck6">
                                                    <label class="form-check-label" for="formCheck6">
                                                        Noviembre
                                                    </label>
                                                </div>
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="checkbox" id="formCheck6">
                                                    <label class="form-check-label" for="formCheck6">
                                                        Diciembre
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                    </div>
                                    <!-- end row -->

                                </div>
                                <!-- end tab pane -->
                            </div>
                            <!-- end tab content -->
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                    
            </div>
            <!-- end col -->

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Registro</h5>
                    </div>
                    <div class="card-body">
                         <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <div class="form-check form-radio-success mb-3">
                                <input class="form-check-input" type="radio" name="record.registro" wire:model.defer="record.registro" value="NO">
                                <label class="form-check-label">
                                    Novedad
                                </label>
                            </div>
                            <div class="form-check form-radio-warning mb-3">
                                <input class="form-check-input" type="radio" name="record.registro" wire:model.defer="record.registro" value="PR">
                                <label class="form-check-label">
                                    Prestamo
                                </label>
                            </div>
                            <div class="form-check form-radio-info mb-3">
                                <input class="form-check-input" type="radio" name="record.registro" wire:model.defer="record.registro" value="CA">
                                <label class="form-check-label">
                                    Calculo Automatico
                                </label>
                            </div>
                            
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="form-check form-check-secondary mb-3">
                                <input class="form-check-input" type="checkbox" wire:model.defer="record.regplanilla">
                                <label class="form-check-label" for="record.regplanilla">
                                    Planilla/Novedad
                                </label>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Impresión Rol</h5>
                    </div>
                    <!-- end card body -->
                    <div class="card-body">
                        <div class="form-check form-check-success mb-3">
                            <input class="form-check-input" type="checkbox" wire:model.defer="record.imprimerol1">
                            <label class="form-check-label" for="record.imprimerol1">
                                Horizontal
                            </label>
                        </div>
                        <div class="form-check form-check-success mb-3">
                            <input class="form-check-input" type="checkbox" wire:model.defer="record.imprimerol2">
                            <label class="form-check-label" for="record.imprimerol2">
                                Percepción - Deducción
                            </label>
                        </div>
                        <div class="form-check form-check-success mb-3">
                            <input class="form-check-input" type="checkbox"wire:model.defer="record.imprimerol3">
                            <label class="form-check-label" for="record.imprimerol3">
                                Comprobante de Pago
                            </label>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Formula de Cálculo</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="cmbvariable" class="form-label">Variable</label>
                            <select type="select" class="form-select" data-trigger name="cmbvariable" wire:model.defer="record.variable1">
                            @foreach ($tblvariables as $variable)
                                <option value="{{$variable->id}}">{{ $variable->descripcion }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="record.importe" class="form-label">Importe</label>
                            <input type="number" class="form-control  product-price" id="txtimporte" step="0.000001" placeholder="0.00"  
                            wire:model.defer="record.importe" required>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
                <div class="card">
                    <div class="card-body">
                        <div class="justify-content-end">
                            <button type="submit" class="btn btn-success w-sm">Grabar</button>
                            <button type="submit" class="btn btn-secondary w-sm">Cancelar</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- end row -->
    </form>
</div>
