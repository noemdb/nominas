<div>
    <div class="py-4">
        @php
            $name = 'institution_id';
            $model = 'area.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-native-select label="{{ $comment }}" placeholder="Seleccione" :options="$list_institution"
            wire:model.defer="{{ $model }}" option-key-value />
    </div>
    <div class="py-4">
        @php
            $name = 'name';
            $model = 'area.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}"
            corner-hint="Ejemplo: John" />
    </div>

    <div class="py-4">
        @php
            $name = 'description';
            $model = 'area.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-textarea wire:model.defer="{{ $model }}" label="{{ $comment }}"
            placeholder="{{ $comment }}" />
    </div>

    <x-errors />

</div>
