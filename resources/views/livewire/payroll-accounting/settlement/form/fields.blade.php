{{-- 'employee_id','frequency','amount' --}}
<x-card>
    @if ($modeCreate)
        <div class="py-4">
            @php
                $name = 'employee_id';
                $model = 'salary.' . $name;
                $comment = $list_comment[$name];
            @endphp
            <x-native-select label="{{ $comment }}" placeholder="Seleccione" :options="$list_institution" option-key-value wire:model.defer="{{ $model }}" />
        </div>
    @endif

    @if ($modeEdit)
        <div class="py-4">
            @php
                $name = 'employee_id';
                $model = 'salary.' . $name;
                $comment = $list_comment[$name];
            @endphp
            {{ ($salary->employee) ? $salary->employee->name : null}}
        </div>
    @endif

    <div class="py-4">
        @php
            $name = 'frequency';
            $model = 'salary.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-native-select label="{{ $comment }}" placeholder="Seleccione" :options="$list_frequency" wire:model.defer="{{ $model }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'amount';
            $model = 'salary.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-inputs.currency wire:model.defer="{{ $model }}" label="{{ $comment }}" suffix="Bs " thousands="." decimal="," />
    </div>

    {{-- <div class="py-4">
        @php
            $name = 'payment_status';
            $model = 'salary.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-toggle wire:model.defer="model" label="{{ $comment }}" placeholder="{{ $comment }}" wire:model.defer="{{ $model }}" :disabled='true'/>
    </div> --}}

    <x-errors />

</x-card>
