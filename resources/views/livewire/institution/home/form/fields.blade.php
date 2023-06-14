<x-card>
    <div class="py-4">
        @php $name = 'name'; $model = 'institution.'.$name; $comment = $list_comment[$name]; @endphp
        <x-input wire:model.defer="{{$model}}" label="{{$comment}}" placeholder="{{$comment}}" corner-hint="Ejemplo: John"/>
    </div>

    <div class="py-4">
        @php $name = 'acronym'; $model = 'institution.'.$name; $comment = $list_comment[$name]; @endphp
        <x-input wire:model.defer="{{$model}}" label="{{$comment}}" placeholder="{{$comment}}" />
    </div>

    <div class="py-4">
        @php $name = 'phone_number'; $model = 'institution.'.$name; $comment = $list_comment[$name]; @endphp
        <x-inputs.maskable  wire:model.defer="{{$model}}" label="{{$comment}}" mask="(###) ###-####" placeholder="{{$comment}}" />
    </div>

    <div class="py-4">
        @php $name = 'email'; $model = 'institution.'.$name; $comment = $list_comment[$name]; @endphp
        <x-input wire:model.defer="{{$model}}" label="{{$comment}}" placeholder="{{$comment}}" suffix="@mail.com"/>
    </div>

    <div class="py-4">
        @php $name = 'type'; $model = 'institution.'.$name; $comment = $list_comment[$name]; @endphp
        <x-native-select label="{{$comment}}" placeholder="Seleccione" :options="$list_type" wire:model.defer="{{$model}}" />
    </div>

    <div class="py-4">
        @php $name = 'address'; $model = 'institution.'.$name; $comment = $list_comment[$name]; @endphp
        <x-textarea wire:model.defer="{{$model}}" label="{{$comment}}" placeholder="{{$comment}}" />
    </div>

    <div class="py-4">
        @php $name = 'website'; $model = 'institution.'.$name; $comment = $list_comment[$name]; @endphp
        <x-input wire:model.defer="{{$model}}" label="{{$comment}}" prefix="https://www."/>
    </div>

    <div class="py-4">
        @php $name = 'foundation_date'; $model = 'institution.'.$name; $comment = $list_comment[$name]; @endphp
        <x-datetime-picker label="{{$comment}}" placeholder="{{$comment}}" wire:model.defer="{{$model}}" without-time="true" />
    </div>

    <div class="py-4">
        @php $name = 'legal_status'; $model = 'institution.'.$name; $comment = $list_comment[$name]; @endphp
        <x-native-select label="{{$comment}}" placeholder="Seleccione" :options="$list_legal_status" wire:model.defer="{{$model}}" />
    </div>


    <div class="py-4">
        @php $name = 'tax_id'; $model = 'institution.'.$name; $comment = $list_comment[$name]; @endphp
        <x-input wire:model.defer="{{$model}}" label="{{$comment}}" placeholder="{{$comment}}" />
    </div>

    <div class="py-4">
        @php $name = 'registration_number'; $model = 'institution.'.$name; $comment = $list_comment[$name]; @endphp
        <x-input wire:model.defer="{{$model}}" label="{{$comment}}" placeholder="{{$comment}}" />
    </div>

    <x-errors />

</x-card>
