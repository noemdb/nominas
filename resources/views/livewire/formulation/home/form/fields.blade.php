{{-- 'institution_id','name','latex','description' --}}
<x-card>

    @if ($modeCreate)
        <div class="py-4">
            @php
                $name = 'institution_id';
                $model = 'formulation.' . $name;
                $comment = $list_comment[$name];
            @endphp
            <x-native-select label="{{ $comment }}" placeholder="Seleccione" :options="$list_institution" option-key-value wire:model.defer="{{ $model }}" />
        </div>
    @endif
    @if ($modeEdit)
        <div class="py-4">
            @php
                $name = 'institution_id';
                $model = 'formulation.' . $name;
                $comment = $list_comment[$name];
            @endphp
            <div class="font-semibold text-gray-400">Institución:</div>
            <div class="font-semibold">{{ ($formulation->institution) ? $formulation->institution->name : null}}</div>

        </div>
    @endif

    {{-- <div class="py-4">
        @php
            $name = 'institution_id';
            $model = 'formulation.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-native-select label="{{ $comment }}" placeholder="Seleccione" :options="$list_institution" option-key-value
            wire:model.defer="{{ $model }}" />
    </div> --}}

    <div class="py-4">
        @php
            $name = 'name';
            $model = 'formulation.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}"
        />
    </div>

    <div class="py-4">
        @php
            $name = 'latex';
            $model = 'formulation.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-textarea wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}"
        />
    </div>

    <div class="py-4">
        @php
            $name = 'description';
            $model = 'formulation.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-textarea wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}"
        />
    </div>

    <x-errors />

</x-card>
