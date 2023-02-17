<div>
    <div wire.ignore.self class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" >
            <div class="modal-content">
                
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel">
                        @if($showEditModal)
                            <span>Editar Catálogo General &nbsp;</span>
                        @else
                            <span>Agregar Catálogo General  &nbsp;</span>
                        @endif
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                </div>
                <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateData' : 'createData' }}">
                    
                    <div class="modal-body">
                        <!--<input type="hidden" id="id-field" />-->

                        <div class="id" id="modal-id">
                            @if($showEditModal)
                                <label for="id" class="form-label">ID</label>
                                <input type="text" wire:model='id' class="form-control" placeholder="ID" readonly />
                            @endif
                        </div>

                        @livewire('catgencbosuperior')
                        @livewire('catgencodigo')

                        <div class="mb-3">
                            <label for="detalle" class="form-label">Descripción</label>
                            <input type="text" wire:model.defer='detalle' class="form-control" name="detalle"
                                placeholder="Enter name" required />
                        </div>

                        <!--<div class="mb-3">
                            <label for="date-field" class="form-label">Order
                                Date</label>
                            <input type="date" id="date-field" class="form-control"
                                data-provider="flatpickr" data-date-format="d M, Y" data-enable-time
                                required placeholder="Select date" />
                        </div>-->

                        <div>
                            <label for="record.estado" class="form-label">Status</label>
                                <select class="form-control" data-trigger name="record.estado" wire:model.defer='estado'>
                                <option value="A">Activo</option>
                                <option value="I">Inactivo</option>
                                <option value="E">Eliminado</option>
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
</div>