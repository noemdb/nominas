<div>
    <div class="py-4">
        @php
            $name = 'area_id';
            $model = 'rol.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-native-select label="{{ $comment }}" placeholder="Seleccione" :options="$list_areas"
            wire:model.defer="{{ $model }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'name';
            $model = 'rol.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}"
            corner-hint="Ejemplo: John" />
    </div>

    <div class="py-4">
        @php
            $name = 'description';
            $model = 'rol.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-textarea wire:model.defer="{{ $model }}" label="{{ $comment }}"
            placeholder="{{ $comment }}" />
    </div>

    <x-errors />

</div>
