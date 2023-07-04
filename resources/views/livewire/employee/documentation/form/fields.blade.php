{{--
    'employee_id','description','type','number','expiration_date','issue_date','country','file','comments'
--}}
<x-card>

    @if ($modeCreate)
        <div class="py-4">
            @php
                $name = 'employee_id';
                $model = 'documentation.' . $name;
                $comment = $list_comment[$name];
            @endphp
            <x-native-select label="{{ $comment }}" placeholder="Seleccione" :options="$list_employee" option-key-value wire:model.defer="{{ $model }}" />
        </div>
    @endif
    @if ($modeEdit)
        <div class="py-4">
            @php
                $name = 'employee_id';
                $model = 'documentation.' . $name;
                $comment = $list_comment[$name];
            @endphp
            {{ ($documentation->employee) ? $documentation->employee->name : null}}
        </div>
    @endif

    <div class="py-4">
        @php
            $name = 'description';
            $model = 'documentation.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-textarea wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'number';
            $model = 'documentation.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-inputs.maskable wire:model.defer="{{ $model }}" mask="#####" label="{{ $comment }}" placeholder="{{ $comment }}" />
    </div>

    <div class="py-4">
        @php
            $name = 'type';
            $model = 'documentation.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-native-select label="{{ $comment }}" placeholder="Seleccione" :options="$list_type"
            wire:model.defer="{{ $model }}" />
    </div>

    <div class="grid grid-cols-2 md:grid-cols-1 gap-2">
        <div class="py-4">
            @php
                $name = 'issue_date';
                $model = 'documentation.' . $name;
                $comment = $list_comment[$name];
            @endphp
            <x-datetime-picker label="{{ $comment }}" placeholder="{{ Str::limit($comment,30,'...') }}"
                wire:model.defer="{{ $model }}" without-time="true" />
        </div>

        <div class="py-4">
            @php
                $name = 'expiration_date';
                $model = 'documentation.' . $name;
                $comment = $list_comment[$name];
            @endphp
            <x-datetime-picker label="{{ $comment }}" placeholder="{{ Str::limit($comment,30,'...') }}"
                wire:model.defer="{{ $model }}" without-time="true" />
        </div>
    </div>

    {{-- <div class="py-4">
        @php
            $name = 'file';
            $model = 'documentation.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}" />
    </div> --}}

    <div class="py-4">
        @php
            $name = 'file';
            $model = 'documentation.' . $name;
            $comment = $list_comment[$name];
        @endphp
        {{-- <x-input wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}" /> --}}

        <input type="file" wire:model.defer="{{ $model }}">

        @if ($documentation->file)
            @php
                $url_ima = (is_string($documentation->file)) ? $documentation->file : $documentation->file->temporaryUrl();
            @endphp
            <center>
                <div class="">
                    <div class="text-muted">Vista previa:</div>
                    <div class="card" style="width: 18rem;">
                        <img src="{{ $url_ima }}" class="card-img-top" alt="...">
                    </div>
                </div>
            </center>
        @endif

    </div>

    <div class="py-4">
        @php
            $name = 'comments';
            $model = 'documentation.' . $name;
            $comment = $list_comment[$name];
        @endphp
        <x-textarea wire:model.defer="{{ $model }}" label="{{ $comment }}" placeholder="{{ $comment }}" />
    </div>

    <x-errors />

</x-card>
