{{-- // 'institution_id','level_id','frequency','name','description', --}}
<x-card>
    @if ($modeCreate)
        <div class="py-4">
            @php
                $name = 'institution_id';
                $model = 'payroll.' . $name;
                $comment = $list_comment[$name];
            @endphp
            <x-native-select label="{{ $comment }}" placeholder="Seleccione" :options="$list_institution" option-key-value wire:model.defer="{{ $model }}" />
        </div>
    @endif
    @if ($modeEdit)
        <div class="py-4">
            @php
                $name = 'institution_id';
                $model = 'payroll.' . $name;
                $comment = $list_comment[$name];
            @endphp
            {{ ($payroll->institution) ? $payroll->institution->name : null}}
        </div>
    @endif

    <div class="py-4">
        @php
            $name = 'level_id';
            $model = 'payroll.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-native-select label="{{ $comment }}" placeholder="Seleccione" :options="$list_level" option-key-value wire:model.defer="{{ $model }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'frequency';
            $model = 'payroll.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-native-select label="{{ $comment }}" placeholder="Seleccione" :options="$list_frequency" wire:model.defer="{{ $model }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'name';
            $model = 'payroll.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'description';
            $model = 'payroll.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-textarea wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'status';
            $model = 'payroll.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-toggle wire:model.defer="model" label="{{ $comment }}" placeholder="{{ $comment }}" wire:model.defer="{{ $model }}"/>
    </div>

    <x-errors />

</x-card>
