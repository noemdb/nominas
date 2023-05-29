<div>

    <div class="bg-white shadow rounded-lg p-6">

        <div class="flex items-center justify-between mb-4">
            @if ($action)



                {{-- <button class="rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    <div x-data="{ open: false }">
                        <button @click="open = true"><x-icon name="dots-vertical" class="w-4 h-4 text-gray-500" /></button>
                        <span x-show="open">
                            {{$action}}
                        </span>
                    </div>
                </button> --}}

                {{-- <x-dropdown>
                    <x-dropdown.item>
                        <b>{{ $action }}</b>
                    </x-dropdown.item>
                    <x-dropdown.header label="{{ $action }}">
                        <x-dropdown.item label="Preferences" />
                        <x-dropdown.item label="My Profile" />
                    </x-dropdown.header>
                </x-dropdown> --}}

                {{-- <div x-data="{ open: false }">
                    <button @click="open = ! open"><x-icon name="dots-vertical" class="w-4 h-4 text-gray-500" /></button>
                    <div x-show="open" @click.outside="open = false">
                        {{ $action }}
                    </div>
                </div> --}}
                {{-- {{ $action }} --}}
            @endif

            <div class="text-lg font-bold text-gray-900">
                {{$header ?? null}}
            </div>
            <div class="text-4xl border rounded-full p-2  font-bold text-blue-500">
                {{$count ?? null}}
            </div>
        </div>
        <div class="text-sm text-gray-500">
            {{$description ?? null}}
        </div>
    </div>

</div>
