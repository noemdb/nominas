<div>
	
    <div class="rounded-lg bg-gray-100 p-4">
        <h2 class="text-2xl font-bold mb-6">Ausencias y permisos registrados</h2>
        @include('livewire.absence.report.partials.table')
    </div>

    <hr class="my-4">

    <div class="rounded-lg bg-gray-100 p-4">
        <h2 class="text-2xl font-bold mb-6">Registrar una nueva ausencias/permisos</h2>
        @include('livewire.absence.report.partials.form')
    </div>
    
</div>