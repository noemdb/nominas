{{--
    'employee_id','address','city','state','zip_code','country','phone_number','home_phone','emergency_contact_name',
    'emergency_contact_relationship','emergency_contact_phone','emergency_contact_email','other_details',
--}}
<x-card>
    @if ($modeCreate)
        <div class="py-4">
            @php
                $name = 'employee_id';
                $model = 'personal.' . $name;
                $comment = $list_comment[$name];
            @endphp
            <x-native-select label="{{ $comment }}" placeholder="Seleccione" :options="$list_institution" option-key-value wire:model.defer="{{ $model }}" />
        </div>
    @endif
    @if ($modeEdit)
        <div class="py-4">
            @php
                $name = 'employee_id';
                $model = 'personal.' . $name;
                $comment = $list_comment[$name];
            @endphp
            {{ ($personal->employee) ? $personal->employee->name : null}}
        </div>
    @endif

    <div class="py-4">
        @php
            $name = 'address';
            $model = 'personal.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-textarea wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'city';
            $model = 'personal.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'state';
            $model = 'personal.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'country';
            $model = 'personal.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'zip_code';
            $model = 'personal.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-inputs.maskable wire:model.defer="{{ $model }}" mask="#####" label="{{ $comment }}" placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'phone_number';
            $model = 'personal.' . $name;
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
            $model = 'personal.' . $name;
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
            $model = 'personal.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'emergency_contact_relationship';
            $model = 'personal.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-native-select label="{{ $comment }}" placeholder="Seleccione" :options="$list_relationship"
            wire:model.defer="{{ $model }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'emergency_contact_phone';
            $model = 'personal.' . $name;
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
            $model = 'personal.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{$model}}" label="{{$comment}}" placeholder="{{$comment}}" suffix="@mail.com"/>
    </div>

    <div class="py-4">
        @php
            $name = 'other_details';
            $model = 'personal.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-textarea wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'disability';
            $model = 'personal.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-native-select label="{{$comment}}" placeholder="Seleccione" :options="$list_disability" wire:model.defer="{{$model}}" />
    </div>

    <x-errors />

</x-card>
