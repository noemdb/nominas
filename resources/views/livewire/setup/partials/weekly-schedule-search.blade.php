<div class="grid grid-cols-1 gap-4 mb-6 md:grid-cols-3">
    <div>
        <input wire:model.live="search" type="text" placeholder="Buscar por cargo..."
            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
    </div>
    <div>
        <select wire:model.live="selectedPosition" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            <option value="">Todos los cargos</option>
            @foreach($positions as $position)
                <option value="{{ $position->id }}">{{ $position->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="flex items-center">
        <label class="inline-flex items-center">
            <input wire:model.live="filterActive" type="checkbox" class="form-checkbox">
            <span class="ml-2">Mostrar solo activos</span>
        </label>
    </div>
</div>
