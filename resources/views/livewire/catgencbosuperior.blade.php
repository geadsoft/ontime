<div>
    <div class="mb-3">
        <label for="record.superior" class="form-label">Nivel Superior</label>
        <select type="select" class="form-control" data-trigger name="record.superior" wire:model="superior" id="superiorSelect">
            <option value="0">--Select Nivel Superior--</option>
            @foreach ($tblrecords as $record)
                <option value="{{$record->codigo}}">{{$record->descripcion}}</option>
            @endforeach
        </select>
    </div>
</div>

