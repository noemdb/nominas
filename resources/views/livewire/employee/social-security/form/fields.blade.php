{{--
'employee_id','number','card_number','card_issue_date','card_expiration_date','benefits_eligibility','benefits_payment_amount',
        'benefits_payment_start_date','benefits_payment_end_date'
--}}

<x-card>
    @if ($modeCreate)
        <div class="py-4">
            @php
                $name = 'employee_id';
                $model = 'social_security.' . $name;
                $comment = $list_comment[$name];
            @endphp
            <x-native-select label="{{ $comment }}" placeholder="Seleccione" :options="$list_employee" option-key-value wire:model.defer="{{ $model }}" />
        </div>
    @endif
    @if ($modeEdit)
        <div class="py-4">
            @php
                $name = 'employee_id';
                $model = 'social_security.' . $name;
                $comment = $list_comment[$name];
            @endphp
            {{ ($social_security->employee) ? $social_security->employee->name : null}}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <div class="py-4">
            @php
                $name = 'number';
                $model = 'social_security.' . $name;
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
                $name = 'card_number';
                $model = 'social_security.' . $name;
                $comment = $list_comment[$name];
            @endphp
            <x-inputs.maskable
                label="{{$comment}}"
                mask="##########"
                placeholder="{{$comment}}"
                wire:model.defer="{{ $model }}"
            />
        </div>
    </div>


    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <div class="py-4">
            @php
                $name = 'card_issue_date';
                $model = 'social_security.' . $name;
                $comment = $list_comment[$name];
            @endphp
            <x-datetime-picker label="{{ $comment }}" placeholder="{{ $comment }}"
                wire:model.defer="{{ $model }}" without-time="true" />
        </div>

        <div class="py-4">
            @php
                $name = 'card_expiration_date';
                $model = 'social_security.' . $name;
                $comment = $list_comment[$name];
            @endphp
            <x-datetime-picker label="{{ $comment }}" placeholder="{{ $comment }}"
                wire:model.defer="{{ $model }}" without-time="true" />
        </div>
    </div>

    <div class="py-4">
        @php
            $name = 'benefits_eligibility';
            $model = 'social_security.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-toggle wire:model.defer="model" label="{{ $comment }}" placeholder="{{ $comment }}" wire:model.defer="{{ $model }}"/>
    </div>

    <div class="py-4">
        @php
            $name = 'benefits_payment_amount';
            $model = 'social_security.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-inputs.maskable
            label="{{$comment}}"
            mask="##########"
            placeholder="{{$comment}}"
            wire:model.defer="{{ $model }}"
        />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <div class="py-4">
            @php
                $name = 'benefits_payment_start_date';
                $model = 'social_security.' . $name;
                $comment = $list_comment[$name];
            @endphp
            <x-datetime-picker label="{{ $comment }}" placeholder="{{ Str::limit($comment,30,'...') }}"
                wire:model.defer="{{ $model }}" without-time="true" />
        </div>

        <div class="py-4">
            @php
                $name = 'card_expiration_date';
                $model = 'social_security.' . $name;
                $comment = $list_comment[$name];
            @endphp
            <x-datetime-picker label="{{ $comment }}" placeholder="{{ Str::limit($comment,30,'...') }}"
                wire:model.defer="{{ $model }}" without-time="true" />
        </div>
    </div>


    <x-errors />

</x-card>
