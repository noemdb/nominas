<div>
    <div class="py-4">
        @php
            $name = 'institution_id';
            $model = 'authority.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-native-select label="{{ $comment }}" placeholder="Seleccione" :options="$list_institution"
            wire:model.defer="{{ $model }}" option-key-value />
    </div>
    <div class="py-4">
        @php
            $name = 'name';
            $model = 'authority.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}"
            corner-hint="Ejemplo: John" />
    </div>

    <div class="py-4">
        @php
            $name = 'position';
            $model = 'authority.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'email';
            $model = 'authority.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}"
            suffix="@mail.com" />
    </div>

    <div class="py-4">
        @php
            $name = 'phone_number';
            $model = 'authority.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-inputs.maskable wire:model.defer="{{ $model }}" label="{{ $comment }}" mask="(###) ###-####"
            placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'address';
            $model = 'authority.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-textarea wire:model.defer="{{ $model }}" label="{{ $comment }}"
            placeholder="{{ $comment }}" />
    </div>
    <div class="py-4">
        @php
            $name = 'profile_professional';
            $model = 'authority.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}"
            placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'finicial';
            $model = 'authority.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-datetime-picker label="{{ $comment }}" placeholder="{{ $comment }}"
            wire:model.defer="{{ $model }}" without-time="true" />
    </div>

    <div class="py-4">
        @php
            $name = 'ffinal';
            $model = 'authority.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-datetime-picker label="{{ $comment }}" placeholder="{{ $comment }}"
            wire:model.defer="{{ $model }}" without-time="true" />
    </div>

    <x-errors />

</div>
