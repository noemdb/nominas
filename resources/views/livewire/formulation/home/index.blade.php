<div>
    <section class="mb-4 flex justify-between items-center">
        <h2 class="text-2xl font-bold">Fórmulas registradas</h2>
        <x-button.circle wire:click="openModal('create')" primary label="+" />
    </section>

    @include('livewire.formulation.home.partials.table')
</div>

@once
    @prepend('scripts')
        <script src={{ asset('js/mathlive.js') }}></script>
    @endprepend
@endonce

@once
    @push('scripts')
        <script defer>
            const mathField = document.getElementById("latex")

            mathField.addEventListener("input", (ev) => {
                Livewire.emit('latextChange', mathField.value);
            });
        </script>
    @endpush
@endonce
