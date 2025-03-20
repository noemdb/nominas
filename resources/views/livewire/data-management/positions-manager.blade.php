<div> 

    <!-- Estado de carga (Spinner) -->
    {{-- @include('components.loading') --}}

    <!-- Información sobre el Filtro -->
    @if ($selected_worker_id)
        <div class="p-1 mb-1">
            Mostrando cargos para el trabajador: {{ $selected_worker->fullname ?? null }}
        </div>
    @endif

    <!-- Botón para Crear Nuevo Cargo -->
    <button wire:click="createPosition" class="px-4 py-2 mb-4 text-white bg-blue-500 rounded hover:bg-blue-600">
        Crear Nuevo Cargo
    </button>

    <!-- Contenedor para la tabla y el formulario -->
    {{-- <div class="grid grid-cols-1 gap-4 @if($isOpenPosition) lg:grid-cols-2 @endif"> --}}
        
        <!-- partials contentivo de el listado de posiciones del selected_worker -->
        <div>
            @include('livewire.data-management.position.table')
        </div>

        <!-- partials contentivo del form para crear/editar posicions del selected_worker -->
        @if($isOpenPosition)
            <div class=" border-y-2 py-2 border-gray-700">
                {{-- @include('livewire.data-management.position.form') --}}
                @include('livewire.data-management.position.main')
            </div>
        @endif

    {{-- </div>   --}}

</div>
