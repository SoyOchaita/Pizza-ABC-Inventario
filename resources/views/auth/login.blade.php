<x-guest-layout>
    <!-- Logo de McDonald's -->
    <div class="flex justify-center mt-8">
        <a href="{{ route('home') }}">
            <img src="https://eastgateshoppingcentre.com/wp-content/uploads/2023/08/maccies.png" 
                alt="Logo McDonald's" class="h-20 w-auto">
        </a>
    </div>

    <!-- Formulario de Login -->
    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-stone-800 py-8 px-6 shadow rounded-lg sm:px-10">
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Correo Electrónico')" />
                    <x-text-input id="email" class="block mt-1 w-full bg-stone-700 text-white" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Contraseña')" />
                    <x-text-input id="password" class="block mt-1 w-full bg-stone-700 text-white" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Botón de Iniciar Sesión -->
                <div>
                    <x-primary-button class="w-full justify-center bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-2 px-4 rounded">
                        {{ __('Iniciar Sesión') }}
                    </x-primary-button>
                </div>

                <!-- Checkbox Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center text-white">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-yellow-500 shadow-sm focus:ring-yellow-500" name="remember">
                        <span class="ml-2 text-sm">{{ __('Recuérdame') }}</span>
                    </label>
                </div>

                <!-- Botón de Registro -->
                <div class="text-center mt-6">
                    <p class="text-sm text-white">
                        ¿No tienes cuenta?
                        <a href="{{ route('register') }}" class="font-medium text-yellow-500 hover:text-yellow-400">
                            Regístrate
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
