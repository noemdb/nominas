<div>
    <div class="py-4">
        @php
            $name = 'institution_id';
            $model = 'bank.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-native-select label="{{ $comment }}" placeholder="Seleccione" :options="$list_institution"
            wire:model.defer="{{ $model }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'name';
            $model = 'bank.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}"
            corner-hint="Ejemplo: John" />
    </div>

    <div class="py-4">
        @php
            $name = 'acronym';
            $model = 'bank.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'branch';
            $model = 'bank.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}"
            placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'account_number';
            $model = 'bank.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}"
            placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'account_type';
            $model = 'bank.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-native-select label="{{ $comment }}" placeholder="Seleccione" :options="$list_account_type"
            wire:model.defer="{{ $model }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'routing_number';
            $model = 'bank.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}"
            placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'swift_code';
            $model = 'bank.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}"
            placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'iban';
            $model = 'bank.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}"
            placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'contact_person';
            $model = 'bank.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}"
            placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'phone_number';
            $model = 'bank.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-inputs.maskable wire:model.defer="{{ $model }}" label="{{ $comment }}" mask="(###) ###-####"
            placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'email';
            $model = 'bank.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}"
            suffix="@mail.com" />
    </div>

    <div class="py-4">
        @php
            $name = 'address';
            $model = 'bank.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-textarea wire:model.defer="{{ $model }}" label="{{ $comment }}"
            placeholder="{{ $comment }}" />
    </div>

    <x-errors />

</div>
