<div>
    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            @include('livewire.setup.partials.header')
            @include('livewire.setup.partials.search')
            @include('livewire.setup.partials.table')
            @includeWhen($showModal, 'livewire.setup.partials.modal')
        </div>
    </div>
</div>
