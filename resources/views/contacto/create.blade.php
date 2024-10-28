<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-500 leading-tight">
            {{ __('Contacto') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-12">
        <!-- Notificación de éxito -->
        @if(session('success'))
            <div id="success-alert" class="bg-green-500 text-white p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-stone-800 p-6 rounded-lg shadow-lg">
            <form action="{{ route('contacto.send') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Nombre')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required />
                </div>
                
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Correo Electrónico')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required />
                </div>

                <div class="mb-4">
                    <x-input-label for="message" :value="__('Mensaje')" />
                    <textarea id="message" class="block mt-1 w-full bg-stone-700 text-white" name="message" rows="4" required></textarea>
                </div>

                <x-primary-button class="bg-yellow-500 hover:bg-yellow-600">
                    {{ __('Enviar Mensaje') }}
                </x-primary-button>
            </form>
        </div>
    </div>

    <!-- Script para ocultar la notificación después de 3 segundos -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successAlert = document.getElementById('success-alert');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.style.display = 'none';
                }, 3000); // Ocultar después de 3 segundos
            }
        });
    </script>
</x-app-layout>
