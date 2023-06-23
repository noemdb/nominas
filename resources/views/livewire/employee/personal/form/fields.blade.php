{{-- 'employee_id','address','city','state','zip_code','country','phone_number','home_phone','emergency_contact_name','emergency_contact_relationship','emergency_contact_phone','emergency_contact_email','other_details', --}}
<x-card>
    <div class="py-4">
        @php
            $name = 'institution_id';
            $model = 'employee.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-native-select label="{{ $comment }}" placeholder="Seleccione" :options="$list_institution" option-key-value
            wire:model.defer="{{ $model }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'name';
            $model = 'employee.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}"
            {{-- corner-hint="Ejemplo: John" --}}
        />
    </div>

    <div class="py-4">
        @php
            $name = 'ci';
            $model = 'employee.' . $name;
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
            $name = 'hire_date';
            $model = 'employee.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-datetime-picker label="{{ $comment }}" placeholder="{{ $comment }}"
            wire:model.defer="{{ $model }}" without-time="true" />
    </div>

    <div class="py-4">
        @php
            $name = 'termination_date';
            $model = 'employee.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-datetime-picker label="{{ $comment }}" placeholder="{{ $comment }}"
            wire:model.defer="{{ $model }}" without-time="true" />
    </div>

    <div class="py-4">
        @php
            $name = 'status';
            $model = 'employee.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-native-select label="{{ $comment }}" placeholder="Seleccione" :options="$list_status"
            wire:model.defer="{{ $model }}" />
    </div>

    <div class="py-4">
        @php $name = 'email'; $model = 'employee.'.$name; $comment = $list_comment[$name]; @endphp
        <x-input wire:model.defer="{{$model}}" label="{{$comment}}" placeholder="{{$comment}}" suffix="@mail.com"/>
    </div>

{{--

    <div class="py-4">
        @php $name = 'acronym'; $model = 'employee.'.$name; $comment = $list_comment[$name]; @endphp
        <x-input wire:model.defer="{{$model}}" label="{{$comment}}" placeholder="{{$comment}}" />
    </div>

    <div class="py-4">
        @php $name = 'phone_number'; $model = 'employee.'.$name; $comment = $list_comment[$name]; @endphp
        <x-inputs.maskable  wire:model.defer="{{$model}}" label="{{$comment}}" mask="(###) ###-####" placeholder="{{$comment}}" />
    </div>

    <div class="py-4">
        @php $name = 'email'; $model = 'employee.'.$name; $comment = $list_comment[$name]; @endphp
        <x-input wire:model.defer="{{$model}}" label="{{$comment}}" placeholder="{{$comment}}" suffix="@mail.com"/>
    </div>

    <div class="py-4">
        @php $name = 'type'; $model = 'employee.'.$name; $comment = $list_comment[$name]; @endphp
        <x-native-select label="{{$comment}}" placeholder="Seleccione" :options="$list_type" wire:model.defer="{{$model}}" />
    </div>

    <div class="py-4">
        @php $name = 'address'; $model = 'employee.'.$name; $comment = $list_comment[$name]; @endphp
        <x-textarea wire:model.defer="{{$model}}" label="{{$comment}}" placeholder="{{$comment}}" />
    </div>

    <div class="py-4">
        @php $name = 'website'; $model = 'employee.'.$name; $comment = $list_comment[$name]; @endphp
        <x-input wire:model.defer="{{$model}}" label="{{$comment}}" placeholder="{{$comment}}"/>
    </div>

    <div class="py-4">
        @php $name = 'foundation_date'; $model = 'employee.'.$name; $comment = $list_comment[$name]; @endphp
        <x-datetime-picker label="{{$comment}}" placeholder="{{$comment}}" wire:model.defer="{{$model}}" without-time="true" />
    </div>

    <div class="py-4">
        @php $name = 'legal_status'; $model = 'employee.'.$name; $comment = $list_comment[$name]; @endphp
        <x-native-select label="{{$comment}}" placeholder="Seleccione" :options="$list_legal_status" wire:model.defer="{{$model}}" />
    </div>


    <div class="py-4">
        @php $name = 'tax_id'; $model = 'employee.'.$name; $comment = $list_comment[$name]; @endphp
        <x-input wire:model.defer="{{$model}}" label="{{$comment}}" placeholder="{{$comment}}" />
    </div>

    <div class="py-4">
        @php $name = 'registration_number'; $model = 'employee.'.$name; $comment = $list_comment[$name]; @endphp
        <x-input wire:model.defer="{{$model}}" label="{{$comment}}" placeholder="{{$comment}}" />
    </div>

--}}

    <x-errors />

</x-card>
