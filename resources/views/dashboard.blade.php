<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('McDonald´s') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="logged-in-message" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Ha iniciado sessión!") }}
                </div>
            </div>
        </div>
    </div>

    <script>
        // Espera 3 segundos antes de ocultar el mensaje
        setTimeout(function() {
            document.getElementById('logged-in-message').style.display = 'none';
        }, 3000); // 3000 milisegundos = 3 segundos
    </script>
</x-app-layout>
