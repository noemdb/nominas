<div>
    <div class="py-4">
        @php
            $name = 'employee_id';
            $model = 'previous_works.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-native-select label="{{ $comment }}" placeholder="Seleccione" :options="$list_employee"
            wire:model.defer="{{ $model }}" option-key-value />
    </div>

    <div class="py-4">
        @php
            $name = 'company_name';
            $model = 'previous_works.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'position';
            $model = 'previous_works.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'start_date';
            $model = 'previous_works.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-time-picker wire:model.defer="{{ $model }}" label="{{ $comment }}"
            placeholder="{{ $comment }}" format="24" />
    </div>

    <div class="py-4">
        @php
            $name = 'end_date';
            $model = 'previous_works.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-time-picker wire:model.defer="{{ $model }}" label="{{ $comment }}"
            placeholder="{{ $comment }}" format="24" />
    </div>

    <div class="py-4">
        @php
            $name = 'reason_for_leaving';
            $model = 'previous_works.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-textarea wire:model.defer="{{ $model }}" label="{{ $comment }}"
            placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'references';
            $model = 'previous_works.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-textarea wire:model.defer="{{ $model }}" label="{{ $comment }}"
            placeholder="{{ $comment }}" />
    </div>

    <x-errors />

</div>
