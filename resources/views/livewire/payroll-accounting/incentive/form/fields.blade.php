<div>
    <div class="py-4">
        @php
            $name = 'employee_id';
            $model = 'incentive.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-native-select label="{{ $comment }}" placeholder="Seleccione" :options="$list_employee"
            wire:model.defer="{{ $model }}" option-key-value />
    </div>

    <div class="py-4">
        @php
            $name = 'type';
            $model = 'incentive.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-native-select label="{{ $comment }}" placeholder="Seleccione" :options="$list_type"
            wire:model.defer="{{ $model }}" option-key-value />
    </div>

    <div class="py-4">
        @php
            $name = 'amount';
            $model = 'incentive.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-inputs.number label="{{ $comment }}" placeholder="{{ $comment }}"
            wire:model.defer="{{ $model }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'frequency';
            $model = 'incentive.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-native-select label="{{ $comment }}" placeholder="Seleccione" :options="$list_frequency"
            wire:model.defer="{{ $model }}" option-key-value />
    </div>

    <div class="py-4">
        @php
            $name = 'date';
            $model = 'incentive.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-datetime-picker label="{{ $comment }}" placeholder="{{ $comment }}"
            wire:model.defer="{{ $model }}" without-time="true" />
    </div>

    <div class="py-4">
        @php
            $name = 'description';
            $model = 'incentive.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-textarea wire:model.defer="{{ $model }}" label="{{ $comment }}"
            placeholder="{{ $comment }}" />
    </div>

    <x-errors />

</div>
