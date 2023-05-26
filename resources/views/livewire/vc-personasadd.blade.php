<div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body checkout-tab">
                    <form autocomplete="off" wire:submit.prevent="{{ $addPersona ? 'createData' : 'updateData' }}">
                        @csrf
                        <div class="step-arrow-nav mt-n3 mx-n3 mb-3">

                            <ul class="nav nav-pills nav-justified custom-nav nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fs-15 p-3 active" id="pills-bill-info-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-bill-info" type="button" role="tab"
                                        aria-controls="pills-bill-info" aria-selected="true"><i
                                            class=" ri-open-source-line fs-16 p-2 bg-soft-primary text-primary rounded-circle align-middle me-2"></i>
                                            Datos Personales</button>
                                </li>
                                <!--<li class="nav-item" role="presentation">
                                    <button class="nav-link fs-15 p-3" id="pills-bill-family-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-bill-family" type="button" role="tab"
                                        aria-controls="pills-bill-family" aria-selected="false"><i
                                            class="ri-user-2-line fs-16 p-2 bg-soft-primary text-primary rounded-circle align-middle me-2"></i>
                                            RRHH</button>
                                </li>-->
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="pills-bill-info" role="tabpanel"
                                aria-labelledby="pills-bill-info-tab">
                                                                
                                <div class="row">
                                    <div class="card-header">
                                        <h5 class="card-title flex-grow-1 mb-0 text-primary"><i
                                            class="mdi mdi-account-tie align-middle me-1 text-success"></i>
                                            Personal Data</h5>
                                    </div>
                                </div>
                                <div class="card-body row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="txtnombres" class="form-label">
                                            Nombres</label>
                                            <input type="text" class="form-control" id="txtnombres"
                                                placeholder="Ingrese sus nombres" wire:model.defer="record.nombres" required>
                                            @error('nombres') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="txtapellidos" class="form-label">Apellidos</label>
                                            <input type="text" class="form-control" id="txtapellidos"
                                                placeholder="Ingrese sus apellidos" wire:model.defer="record.apellidos" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="mb-3">
                                            <label for="cmbtipoident" class="form-label">Tipo de Identificación</label>
                                            <select class="form-select" data-choices data-choices-search-false id="cmbtipoident" wire:model.defer="record.tiponui" required>
                                                <option value="C">Cédula</option>
                                                <option value="P">Pasaporte</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="mb-3">
                                            <label for="txtidentificacion" class="form-label">
                                            Identification</label>
                                            <input type="text" class="form-control" id="txtnui"
                                                placeholder="Ingrese su cédula o pasaporte" wire:model.defer="record.nui" required wire:focusout='validaNui()'>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="mb-3">
                                            <label for="txtfechanace" class="form-label">Fecha de Nacimiento</label>
                                            <input type="date" class="form-control" id="txtfechanace" wire:model.defer="fechanace" required> 
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="mb-3">
                                            <label for="cmbgenero" class="form-label">Sexo</label>
                                            <select class="form-select" data-choices data-choices-search-false id="cmbgenero" wire:model.defer="record.sexo" required>
                                                <option value="M">Masculino</option>
                                                <option value="F">Femenino</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="mb-3">
                                            <label for="cmbnacionalidad" class="form-label">Estado Civil</label>
                                            <select class="form-select" data-choices data-choices-search-false id="cmbnacionalidad" wire:model.defer="record.estado_civil" required>
                                                <option value="S" selected>Soltero(a)</option>
                                                <option value="C" selected>Casado(a)</option>
                                                <option value="D" selected>Divorciado(a)</option>
                                                <option value="V" selected>Viudo(a)</option>
                                                <option value="U" selected>Unión de Hecho</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="mb-3">
                                            <label for="cmbetnia" class="form-label">Instrucción</label>
                                            <select class="form-select data-choices data-choices-search-false" id="cmbetnia" wire:model.defer="record.instruccion">
                                                <option value="NN">Ninguna</option>
                                                <option value="PR">Primaria</option>
                                                <option value="SE">Secundaria</option>
                                                <option value="SU">Superior</option>
                                                <option value="MA">Masterado</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="txttelefono" class="form-label">Números de Telefonos</label>
                                            <input type="text" class="form-control" id="txttelefono"
                                                placeholder="Ingrese su número de teléfono" wire:model.defer="record.telefono" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="mb-3">
                                            <label for="cmbetnia" class="form-label">Tipo de Sangre</label>
                                            <select class="form-select data-choices data-choices-search-false" id="cmbetnia" wire:model.defer="record.instruccion">
                                                <option value="O+">O+</option>
                                                <option value="O-">O-</option>
                                                <option value="A+">A+</option>
                                                <option value="A-">A-</option>
                                                <option value="B+">B+</option>
                                                <option value="B-">B-</option>
                                                <option value="AB+">AB+</option>
                                                <option value="AB-">AB-</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="mb-3">
                                            <label for="txtapellidos" class="form-label">Nro. Cargas</label>
                                            <input type="text" class="form-control" id="txtapellidos"
                                                placeholder="Ingrese cargas familiares" wire:model.defer="record.carga_familiar">
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="txtemail" class="form-label">Dirección</label>
                                            <input type="text" class="form-control" id="txtemail"
                                                placeholder="Ingrese su Direccion" wire:model.defer="record.direccion">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="mb-3">
                                            <label for="cmbestado" class="form-label">Estado</label>
                                            <select class="form-select data-choices data-choices-search-false" id="cmbestado" wire:model.defer="record.estado">
                                                <option value="A">Activo</option>
                                                <option value="Q">Liquidado</option>
                                                <option value="V">Vacaciones</option>
                                                <option value="R">Reintegrado</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!--<div class="col-lg-2">
                                        <div class="mb-3">
                                            <label for="cmbprovincia" class="form-label">Provincia</label>
                                            <select class="form-select data-choices data-choices-search-false" id="cmbprovincia" wire:model.defer="">
                                                <option value="NN">Ninguna</option>
                                                <option value="PR">Primaria</option>
                                                <option value="SE">Secundaria</option>
                                                <option value="SU">Superior</option>
                                                <option value="MA">Masterado</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="mb-3">
                                            <label for="cmbcanton" class="form-label">Cantón</label>
                                            <select class="form-select data-choices data-choices-search-false" id="cmbcanton" wire:model.defer="">
                                                <option value="NN">Ninguna</option>
                                                <option value="PR">Primaria</option>
                                                <option value="SE">Secundaria</option>
                                                <option value="SU">Superior</option>
                                                <option value="MA">Masterado</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="mb-3">
                                            <label for="cmbparroquia" class="form-label">Parroquia</label>
                                            <select class="form-select data-choices data-choices-search-false" id="cmbparroquia" wire:model.defer="">
                                                <option value="NN">Ninguna</option>
                                                <option value="PR">Primaria</option>
                                                <option value="SE">Secundaria</option>
                                                <option value="SU">Superior</option>
                                                <option value="MA">Masterado</option>
                                            </select>
                                        </div>
                                    </div>-->

                                </div>
                                <div class="card">
                                    <div class="mb-3">
                                        
                                    </div>
                                    <div class="card-header">
                                        <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#add-direction"
                                                    role="tab">
                                                    Información Bancaria
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="card-body row">
                                            <div class="col-lg-2">
                                                <div class="mb-3">
                                                    <label for="cmbentidad" class="form-label">Entidad Bancaria</label>
                                                    <select class="form-select data-choices data-choices-search-false" id="cmbentidad" wire:model.defer="record.entidadbancaria_id">
                                                        @foreach ($tblbancos as $record)                                    
                                                            <option value="{{$record->id}}">{{$record->descripcion}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="mb-3">
                                                    <label for="cmbtipocta" class="form-label">Tipo de Cuenta</label>
                                                    <select class="form-select" data-choices data-choices-search-false id="cmbtipocta" wire:model.defer="record.tipocuenta">
                                                        <option value="NN">Seleccione Tipo de Cuenta</option>
                                                        <option value="AHO">Ahorro</option>
                                                        <option value="CTE">Corriente</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="mb-3">
                                                    <label for="txtctabanco" class="form-label">Nro de Cuenta</label>
                                                    <input type="text" class="form-control" id="txtctabanco"
                                                        placeholder="Enter your firstname" wire:model.defer="record.cuentabanco">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="hstack gap-2 justify-content-end">
                                        <a class="btn btn-secondary w-sm" href="/file/staff"><i class="me-1 align-bottom"></i>Cancelar</a>
                                        @if ($personaId==0)
                                            <button type="submit" class="btn btn-success">Grabar</button>
                                        @else 
                                            <button type="submit" class="btn btn-success">Grabar</button>
                                        @endif
                                        
                                    </div>
                                </div>
                                   
                            </div>
                            <!-- end tab pane -->
                        </div>
                        <!-- end tab content -->
                        
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

    </div>
    <!-- end row -->

</div>

