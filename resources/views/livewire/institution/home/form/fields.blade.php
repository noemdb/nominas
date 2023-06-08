<x-card>
    <div class="py-4">
        @php $name = 'name'; $model = 'institution.'.$name; $comment = $list_comment[$name]; @endphp
        <x-input wire:model.lazy="{{$model}}" label="{{$comment}}" placeholder="{{$comment}}" />
    </div>

    <div class="py-4">
        @php $name = 'acronym'; $model = 'institution.'.$name; $comment = $list_comment[$name]; @endphp
        <x-input wire:model.lazy="{{$model}}" label="{{$comment}}" placeholder="{{$comment}}" />
    </div>

    <div class="py-4">
        @php $name = 'phone_number'; $model = 'institution.'.$name; $comment = $list_comment[$name]; @endphp
        <x-inputs.maskable  wire:model.lazy="{{$model}}" label="{{$comment}}" mask="(###) ###-####" placeholder="{{$comment}}" />
    </div>

    <div class="py-4">
        @php $name = 'email'; $model = 'institution.'.$name; $comment = $list_comment[$name]; @endphp
        <x-input wire:model.lazy="{{$model}}" label="{{$comment}}" placeholder="{{$comment}}" />
    </div>

    <div class="py-4">
        @php $name = 'type'; $model = 'institution.'.$name; $comment = $list_comment[$name]; @endphp
        <x-native-select label="{{$comment}}" placeholder="{{$comment}}" :options="$list_type" wire:model.lazy="{{$model}}" />
    </div>

    <div class="py-4">
        @php $name = 'address'; $model = 'institution.'.$name; $comment = $list_comment[$name]; @endphp
        <x-textarea wire:model.lazy="{{$model}}" label="{{$comment}}" placeholder="{{$comment}}" />
    </div>

    <div class="py-4">
        @php $name = 'website'; $model = 'institution.'.$name; $comment = $list_comment[$name]; @endphp
        <x-input wire:model.lazy="{{$model}}" label="{{$comment}}" placeholder="{{$comment}}" />
    </div>

    <div class="py-4">
        @php $name = 'foundation_date'; $model = 'institution.'.$name; $comment = $list_comment[$name]; @endphp
        <x-datetime-picker label="{{$comment}}" placeholder="{{$comment}}" wire:model.lazy="{{$model}}" without-time="true" />
    </div>

    <div class="py-4">
        @php $name = 'legal_status'; $model = 'institution.'.$name; $comment = $list_comment[$name]; @endphp
        <x-native-select label="{{$comment}}" placeholder="{{$comment}}" :options="$list_legal_status" wire:model.lazy="{{$model}}" />
    </div>

    <div class="py-4">
        @php $name = 'tax_id'; $model = 'institution.'.$name; $comment = $list_comment[$name]; @endphp
        <x-input wire:model.lazy="{{$model}}" label="{{$comment}}" placeholder="{{$comment}}" />
    </div>

    <div class="py-4">
        @php $name = 'registration_number'; $model = 'institution.'.$name; $comment = $list_comment[$name]; @endphp
        <x-input wire:model.lazy="{{$model}}" label="{{$comment}}" placeholder="{{$comment}}" />
    </div>

    <x-errors />

</x-card>

{{--

name
type
acronym
address
phone_number
email
website
foundation_date
legal_status
tax_id
registration_number
logo

--}}
