<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    {{-- <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Username -->
        <div>
            <x-input-label for="username" :value="__('username')" />
            <x-text-input id="username" class="block mt-1 w-full" type="username" name="username" :value="old('username')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form> --}}

    {{-- <div class="flex min-h-screen items-center justify-center bg-[#161616] px-4 py-12 sm:px-6 lg:px-8"> --}}
    <div class="flex items-center justify-center bg-[#161616] px-4 mx:4 py-12 sm:px-6 sm:mx-4 lg:px-8">
        <div class="w-full space-y-8">
            <div class="space-y-2 text-center">
                <h1 class="text-4xl font-semibold tracking-tight text-white">Nóminas</h1>
                <p class="text-lg text-gray-400">Ingresa los datos para el inicio de sesión</p>
            </div>

            @if ($errors->any())
                <div class="rounded-md bg-red-50 p-4">
                    <div class="flex">
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">
                                Se encontraron errores
                            </h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                <div class="space-y-4">
                    <div class="space-y-2">

                        {{-- <x-wireui-input label="username" placeholder="nombre de usuario" hint="ingresa tu nombre de usuario" id="username" name="username"/> --}}

                        <label for="email" class="block text-sm font-medium text-gray-300">
                            Nombre de usuario
                        </label>
                        <input
                            id="username"
                            name="username"
                            type="text"
                            autocomplete="username"
                            required
                            value="{{ old('username') }}"
                            required autofocus
                            class="w-full rounded-md bg-gray-600 border-gray-800 text-white placeholder:text-gray-500 focus:border-[#2b725e] focus:ring focus:ring-[#2b725e] focus:ring-opacity-50"
                        />
                    </div>
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-medium text-gray-300">
                            Password
                        </label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            autocomplete="current-password"
                            required
                            class="w-full rounded-md bg-[#1c1c1c] border-gray-800 text-white focus:border-[#2b725e] focus:ring focus:ring-[#2b725e] focus:ring-opacity-50"
                        />
                    </div>
                </div>

                <button
                    type="submit"
                    class="w-full bg-[#2b725e] hover:bg-[#235e4c] text-white py-6 text-lg font-medium rounded-lg h-[60px] transition duration-150 ease-in-out"
                >
                    Iniciar
                </button>

                <div class="flex items-center justify-center space-x-2 text-gray-400">
                    <span>Soportado por</span>
                    <span class="text-white font-semibold">Laravel v10 [@noemdb]</span>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
