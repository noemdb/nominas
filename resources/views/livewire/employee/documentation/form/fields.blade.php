{{--
    'employee_id','description','type','number','expiration_date','issue_date','country','file','comments'
--}}
<x-card>
    <form wire:submit.prevent="save" enctype="multipart/form-data">
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

        <div class="py-4">

            @php
                $name = 'file';
                $model = 'documentation.' . $name;
                $comment = $list_comment[$name];
            @endphp
            {{-- <input type="file" wire:model.defer="file_image"> --}}
            <label for="archivo" class=" text-sm block text-gray-700 mb-2">Selecciona un {{$comment}}:</label>
            <input type="file" wire:model="file_image" id="archivo" name="archivo" class="border rounded-lg py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

            @if ($documentation->file || $file_image)

                <div class="text-center font-semibold mt-2">Vista previa:</div>
                <div class="grid grid-cols-2 md:grid-cols-2 gap-2">

                    @if ($documentation->file)
                        <div class="border rounded-sm shadow-sm w-1/2">
                            <div class="text-muted">Actual:</div>
                            <div style="width: 5rem">
                                @if ($documentation->file_exist)
                                    <img src="{{ asset($documentation->file_url) ?? null }}" class="" alt="...">
                                @else
                                    <div class="border rounded-sm bg-gray-100 w-20 h-20">
                                        {{-- <x-icon name="home" class="w-20 h-20" /> --}}
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if ($file_image)
                        <div class="border rounded-sm shadow-sm w-1/2">
                            <div class="text-muted">Nueva:</div>
                            <div style="width: 5rem">
                                @if(! $errors->has('file_image'))
                                    <img src="{{ ($file_image) ? $file_image->temporaryUrl() : null }}" class="" alt="...">
                                @endif
                            </div>
                        </div>
                    @endif

                </div>
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
    </form>
</x-card>
