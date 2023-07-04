{{-- 'institution_id','name','latex','description' --}}
<div>
    @if ($modeCreate)
        <div class="py-4">
            @php
                $name = 'institution_id';
                $model = 'formulation.' . $name;
                $comment = $list_comment[$name];
            @endphp
            <x-native-select label="{{ $comment }}" placeholder="Seleccione" :options="$list_institution" option-key-value
                wire:model.defer="{{ $model }}" />
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
            <div class="font-semibold">{{ $formulation->institution ? $formulation->institution->name : null }}</div>

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
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'description';
            $model = 'formulation.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-textarea wire:model.defer="{{ $model }}" label="{{ $comment }}"
            placeholder="{{ $comment }}" />
    </div>

    <div class="py-4 flex flex-col gap-1">
        @php
            $name = 'latex';
            $model = 'formulation.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <label class="text-sm">{{ $comment }}</label>
        <math-field wire:model.defer="{{ $model }}" id="latex"
            class="placeholder-secondary-400 dark:bg-secondary-800 dark:text-secondary-400 dark:placeholder-secondary-500 border border-secondary-300 focus:ring-primary-500 focus:border-primary-500 dark:border-secondary-600 form-input block w-full sm:text-sm rounded-md transition ease-in-out duration-100 focus:outline-none shadow-sm">
        </math-field>
    </div>

    <x-errors />
</div>
