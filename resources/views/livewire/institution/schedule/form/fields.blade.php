<div>
    <div class="py-4">
        @php
            $name = 'area_id';
            $model = 'schedule.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-native-select label="{{ $comment }}" placeholder="Seleccione" :options="$list_areas"
            wire:model.defer="{{ $model }}" option-key-value />
    </div>

    <div class="py-4">
        @php
            $name = 'rol_id';
            $model = 'schedule.' . $name;
            $comment = $list_comment[$name];
        @endphp

        <x-native-select label="{{ $comment }}" placeholder="Seleccione" :options="$list_rols"
            wire:model.defer="{{ $model }}" option-key-value />
    </div>

    <div class="py-4">
        @php
            $name = 'start_time';
            $model = 'schedule.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-time-picker wire:model.defer="{{ $model }}" label="{{ $comment }}"
            placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'end_time';
            $model = 'schedule.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-time-picker wire:model.defer="{{ $model }}" label="{{ $comment }}"
            placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'schedule_type';
            $model = 'schedule.' . $name;
            $comment = $list_comment[$name];
        @endphp

        <x-native-select label="{{ $comment }}" placeholder="Seleccione" :options="$list_type"
            wire:model.defer="{{ $model }}" option-key-value />
    </div>

    <div class="py-4">
        @php
            $name = 'weekday';
            $model = 'schedule.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-inputs.number wire:model.defer="{{ $model }}" label="{{ $comment }}"
            placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'notes';
            $model = 'schedule.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-textarea wire:model.defer="{{ $model }}" label="{{ $comment }}"
            placeholder="{{ $comment }}" />
    </div>

    <x-errors />

</div>
