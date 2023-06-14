<div>
    <div class="py-4">
        @php
            $name = 'name';
            $model = 'institution.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}"
            corner-hint="Ejemplo: John" />
    </div>

    <div class="py-4">
        @php
            $name = 'position';
            $model = 'institution.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'email';
            $model = 'institution.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}"
            suffix="@mail.com" />
    </div>

    <div class="py-4">
        @php
            $name = 'phone_number';
            $model = 'institution.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-inputs.maskable wire:model.defer="{{ $model }}" label="{{ $comment }}" mask="(###) ###-####"
            placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'address';
            $model = 'institution.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-textarea wire:model.defer="{{ $model }}" label="{{ $comment }}"
            placeholder="{{ $comment }}" />
    </div>
    <div class="py-4">
        @php
            $name = 'profile_professional';
            $model = 'institution.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}"
            placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'finicial';
            $model = 'institution.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-datetime-picker label="{{ $comment }}" placeholder="{{ $comment }}"
            wire:model.defer="{{ $model }}" without-time="true" />
    </div>

    <div class="py-4">
        @php
            $name = 'ffinal';
            $model = 'institution.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-datetime-picker label="{{ $comment }}" placeholder="{{ $comment }}"
            wire:model.defer="{{ $model }}" without-time="true" />
    </div>

    <x-errors />

</div>
