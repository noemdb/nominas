{{--
    'employee_id','name','description','provider','start','end','location','duration_hours','certificate_number','certificate_issue','certificate_expiration',
--}}
<x-card>
    @if ($modeCreate)
        <div class="py-4">
            @php
                $name = 'employee_id';
                $model = 'training.' . $name;
                $comment = $list_comment[$name];
            @endphp
            <x-native-select label="{{ $comment }}" placeholder="Seleccione" :options="$list_employee" option-key-value wire:model.defer="{{ $model }}" />
        </div>
    @endif
    @if ($modeEdit)
        <div class="py-4">
            @php
                $name = 'employee_id';
                $model = 'training.' . $name;
                $comment = $list_comment[$name];
            @endphp
            {{ ($training->employee) ? $training->employee->name : null}}
        </div>
    @endif

    <div class="py-4">
        @php
            $name = 'name';
            $model = 'training.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'description';
            $model = 'training.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-textarea wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'provider';
            $model = 'training.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}" />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <div class="py-4">
            @php
                $name = 'start';
                $model = 'training.' . $name;
                $comment = $list_comment[$name];
            @endphp
            <x-datetime-picker label="{{ $comment }}" placeholder="{{ Str::limit($comment,30,'...') }}"
                wire:model.defer="{{ $model }}" without-time="true" />
        </div>

        <div class="py-4">
            @php
                $name = 'end';
                $model = 'training.' . $name;
                $comment = $list_comment[$name];
            @endphp
            <x-datetime-picker label="{{ $comment }}" placeholder="{{ Str::limit($comment,30,'...') }}"
                wire:model.defer="{{ $model }}" without-time="true" />
        </div>
    </div>

    <div class="py-4">
        @php
            $name = 'location';
            $model = 'training.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'duration_hours';
            $model = 'training.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-inputs.number
            label="{{ $comment }}"
            placeholder="{{ $comment }}"
            wire:model.defer="{{ $model }}"
        />
    </div>

    <div class="py-4">
        @php
            $name = 'certificate_number';
            $model = 'training.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}" />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <div class="py-4">
            @php
                $name = 'certificate_issue';
                $model = 'training.' . $name;
                $comment = $list_comment[$name];
            @endphp
            <x-datetime-picker label="{{ $comment }}" placeholder="{{ Str::limit($comment,30,'...') }}"
                wire:model.defer="{{ $model }}" without-time="true" />
        </div>

        <div class="py-4">
            @php
                $name = 'certificate_expiration';
                $model = 'training.' . $name;
                $comment = $list_comment[$name];
            @endphp
            <x-datetime-picker label="{{ $comment }}" placeholder="{{ Str::limit($comment,30,'...') }}"
                wire:model.defer="{{ $model }}" without-time="true" />
        </div>
    </div>

    <x-errors />

</x-card>
