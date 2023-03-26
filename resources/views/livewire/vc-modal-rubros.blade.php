<div>
    <div class="mb-3">
        <p class="fw-medium mb-1"><span>Nombre: </span><span class="text-muted mb-1">{{$personal['apellidos']}} {{$personal['nombres']}}</span></p>
        <p class="fw-medium mb-1"><span>Cédula: </span><span class="text-muted mb-1">{{$personal['nui']}}</span></p>
        <p class="fw-medium mb-1"><span>Fecha Ingreso: </span><span class="text-muted mb-1">{{$personal['fecha_ingreso']}}</span></p>
    </div>
    <hr>
        @if ($showEdit)
        <div class="row">
            <div class="col-lg-7 col-sm-6">
                <label class="form-label">Rubro</label> 
                <select type="select" class="form-select" name="cmbentidad" id="cmbentidad" value = "32" style="" wire:model.defer="rubrorolId" required>
                    <option value="">Seleccione Rubro</option>
                    @foreach ($tblrubros as $data)
                        <option value="{{$data->rubrosrol_id}}">{{$data->descripcion}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3 col-sm-6">
                <label class="form-label">Valor</label>
                <input type="number" class="form-control  product-price" id="txtvalor" step="0.01" placeholder="0.00" wire:model.defer="valor" required>
            </div>
            <div class="col-lg-2 col-sm-6 text-center">
                <div class="mb-3">
                    <label class="form-label">-</label>                                     
                    <a href="" wire:click.prevent="updateData()" id="add-pago" class ="form-control btn btn-soft-secondary"><i class="ri-add-fill me-1"></i> Agregar</a>
                </div>
            </div>
        </div>
        <hr>
        @Endif  
    <div class="mb-3">
        <div class="d-flex align-items-center">
            <h6 class="mb-0 flex-grow-1">Detalle</h5>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive table-card mb-3">
            <div style="overflow-x:auto;">
            <table class="table table-nowrap align-middle" style="width:100%">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Etiqueta</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody class="list form-check-all">
                    @foreach ($tblrecords as $data)
                        <tr class="detrubro">
                            <td>
                                {{$data['nombre']}}
                            </td>
                            <td>
                                {{$data['etiqueta']}}
                            </td>
                            <td>
                                {{number_format($data['valor'],2)}} 
                            </td>
                            <td>
                                @if ($showEdit)
                                    <a href="" wire:click.prevent="delete({{ $data['id'] }})" id="delete" class ="text-danger d-inline-block"><i class="ri-delete-bin-5-fill fs-16"></i></a>
                                @else
                                    <a href="" wire:click.prevent="" id="delete" class ="text-danger d-inline-block" disabled><i class="ri-delete-bin-5-fill fs-16"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </div>
</div>
