{{--
    /* 'employee_id','area_id','rol_id','name','description','start','end' */
--}}
<x-card class="!py-2">

    @if ($modeCreate)

        <div class="py-4">
            @php
                $name = 'employee_id';
                $model = 'position.' . $name;
                $comment = $list_comment[$name];
            @endphp
            <x-native-select label="{{ $comment }}" placeholder="Seleccione" :options="$list_employee" option-key-value wire:model.defer="{{ $model }}" />
        </div>

        <div class="py-4 ">
            @php
                $name = 'area_id';
                $model = 'position.' . $name;
                $comment = $list_comment[$name];
            @endphp
            <x-native-select label="{{ $comment }}" placeholder="Seleccione" :options="$list_area" option-key-value wire:model.defer="{{ $model }}" />
        </div>

        <div class="py-4">
            @php
                $name = 'rol_id';
                $model = 'position.' . $name;
                $comment = $list_comment[$name];
            @endphp
            <x-native-select label="{{ $comment }}" placeholder="Seleccione" :options="$list_rol" option-key-value wire:model.defer="{{ $model }}" />
        </div>

    @endif
    @if ($modeEdit)
        <div class="py-4 border rounded p-2 bg-gray-100 font-semibold text-gray-500">
            @php
                $name = 'employee_id';
                $model = 'position.' . $name;
                $comment = $list_comment[$name];
            @endphp
            {{ ($position->employee) ? $position->employee->name : null}}
            <div>
                Área: {{ ($position->area) ? $position->area->name : null}} || Rol: {{ ($position->rol) ? $position->rol->name : null}}
            </div>
        </div>
    @endif

    <div class="py-4">
        @php
            $name = 'name';
            $model = 'position.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'description';
            $model = 'position.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-textarea wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'start';
            $model = 'position.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-datetime-picker label="{{ $comment }}" placeholder="{{ $comment }}"
            wire:model.defer="{{ $model }}" without-time="true" />
    </div>

    <div class="py-4">
        @php
            $name = 'end';
            $model = 'position.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-datetime-picker label="{{ $comment }}" placeholder="{{ $comment }}"
            wire:model.defer="{{ $model }}" without-time="true" />
    </div>

    <div class="py-4">
        @php
            $name = 'status';
            $model = 'position.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-toggle wire:model.defer="model" label="{{ $comment }}" placeholder="{{ $comment }}" wire:model.defer="{{ $model }}"/>
        {{-- <x-datetime-picker label="{{ $comment }}" placeholder="{{ $comment }}" --}}
            {{-- wire:model.defer="{{ $model }}" without-time="true" /> --}}
    </div>

    {{-- <div class="py-4">
        @php
            $name = 'address';
            $model = 'position.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-textarea wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'city';
            $model = 'position.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'state';
            $model = 'position.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'country';
            $model = 'position.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'zip_code';
            $model = 'position.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-inputs.maskable wire:model.defer="{{ $model }}" mask="#####" label="{{ $comment }}" placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'phone_number';
            $model = 'position.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-inputs.maskable
            label="{{$comment}}"
            mask="##########"
            placeholder="{{$comment}}"
            wire:model.defer="{{ $model }}"
        />
    </div>

    <div class="py-4">
        @php
            $name = 'home_phone';
            $model = 'position.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-inputs.maskable
            label="{{$comment}}"
            mask="##########"
            placeholder="{{$comment}}"
            wire:model.defer="{{ $model }}"
        />
    </div>

    <div class="py-4">
        @php
            $name = 'emergency_contact_name';
            $model = 'position.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'emergency_contact_relationship';
            $model = 'position.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-native-select label="{{ $comment }}" placeholder="Seleccione" :options="$list_relationship"
            wire:model.defer="{{ $model }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'emergency_contact_phone';
            $model = 'position.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-inputs.maskable
            label="{{$comment}}"
            mask="##########"
            placeholder="{{$comment}}"
            wire:model.defer="{{ $model }}"
        />
    </div>

    <div class="py-4">
        @php
            $name = 'emergency_contact_email';
            $model = 'position.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{$model}}" label="{{$comment}}" placeholder="{{$comment}}" suffix="@mail.com"/>
    </div>

    <div class="py-4">
        @php
            $name = 'other_details';
            $model = 'position.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-textarea wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'disability';
            $model = 'position.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-native-select label="{{$comment}}" placeholder="Seleccione" :options="$list_disability" wire:model.defer="{{$model}}" />
    </div> --}}

    <x-errors />

</x-card>
